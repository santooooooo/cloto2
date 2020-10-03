<template>
  <div>
    <v-btn @click="clickLeaveButton()">退席</v-btn>

    <canvas :width="roomWidth" :height="roomHight" id="room"></canvas>
    <v-card class="mx-auto" max-width="344" outlined>
      <h1>{{ this.roomData.name }}教室</h1>
    </v-card>

    <beautiful-chat
      :open="openChat"
      :close="closeChat"
      :onMessageWasSent="onMessageWasSent"
      :colors="chatColors"
      :isOpen="isChatOpen"
      :messageList="messageList"
      :participants="chatParticipants"
      :showCloseButton="true"
      :showEmoji="true"
      :showHeader="true"
      :alwaysScrollToBottom="true"
    >
      <template v-slot:user-avatar="{ message, user }">
        <div
          style="
            border-radius: 50%;
            color: pink;
            font-size: 15px;
            line-height: 25px;
            text-align: center;
            background: tomato;
            width: 25px !important;
            height: 25px !important;
            min-width: 30px;
            min-height: 30px;
            margin: 5px;
            font-weight: bold;
          "
          v-if="message.data.type === 'text' && user && user.name"
        >
          {{ user.name.toUpperCase()[0] }}
        </div>
      </template>
      <template v-slot:system-message-body="{ message }"> [System]: {{ message.text }} </template>
    </beautiful-chat>
  </div>
</template>

<script>
export default {
  data() {
    return {
      canvas: {},
      isDisabledClick: false, // クリック制御
      roomData: [], // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
      loungeSyncTimer: null, // 休憩室同期制御
      chatParticipants: [], // チャット参加者
      messageList: [], // メッセージデータ
      isChatOpen: false, // チャットモーダル制御
      chatColors: {
        // beautiful-chatの色設定
        header: {
          bg: '#D32F2F',
          text: '#fff',
        },
        launcher: {
          bg: '#D32F2F',
        },
        messageList: {
          bg: '#fff',
        },
        sentMessage: {
          bg: '#F44336',
          text: '#fff',
        },
        receivedMessage: {
          bg: '#eaeaea',
          text: '#222222',
        },
        userInput: {
          bg: '#fff',
          text: '#212121',
        },
      },
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 教室の同期
     */
    syncRoom: async function () {
      var response = await this.$http.get(this.$endpoint('roomShow', [this.$route.params.id]));

      // セクションのループ
      response.data.sections.forEach((section, sectionIndex) => {
        // 座席のループ
        section.seats.forEach((seat, seatIndex) => {
          if (this.roomData.length === 0) {
            // 初回取得
            this.setClickArea(
              seat.id,
              section.id,
              section.role,
              seat.reservation_user_id,
              seat.position,
              seat.status
            );

            // 誰かが座っている時
            if (seat.status !== null && seat.status != 'break') {
              // 着席している人を表示

              var position = JSON.parse(seat.position);
              this.putIcon(position.x, position.y, seat.user);

              // ログインユーザーが座っており，座席が休憩室にある場合
              if (seat.id === this.authUser.seat_id && section.role === '休憩') {
                this.enterLounge(section.id);
              }
            }
          } else if (seat.status !== this.roomData.sections[sectionIndex].seats[seatIndex].status) {
            // 現在の状態から変化があれば再描画
            // this.changeColor(seat.status, seat.id);
            switch (seat.status) {
              case 'sitting':
                var position = JSON.parse(seat.position);
                this.putIcon(position.x, position.y, seat.user);

                break;

              case 'break':
                this.canvas.getObjects().forEach((object) => {
                  if (object.seatId === seat.id) {
                    object.set({ reservationId: seat.reservation_user_id });
                    //var position = JSON.parse(seat.position);
                  }
                  if (
                    object.userId === this.roomData.sections[sectionIndex].seats[seatIndex].user.id
                  ) {
                    this.removeIcon(object);
                  }
                });
                //var color = '#000000';
                break;

              default:
                //var color = '#ffffff';
                if (section.role === '休憩') {
                  this.canvas.getObjects().forEach((object) => {
                    if (
                      this.roomData.sections[sectionIndex].seats[seatIndex].user.id ===
                      object.reservationId
                    ) {
                      object.set({ reservationId: null });
                    }
                  });
                }
                this.canvas.getObjects().forEach((object) => {
                  if (
                    object.userId === this.roomData.sections[sectionIndex].seats[seatIndex].user.id
                  ) {
                    this.removeIcon(object);
                  }
                });

                break;
            }
          }
        });
      });

      // データの更新
      this.roomData = response.data;
    },

    /**
     * 休憩室の同期
     *
     * @param Number  sectionId   入室している休憩室ID
     */
    syncLounge: async function (sectionId) {
      var response = await this.$http.get(this.$endpoint('chatShow', [sectionId]));

      this.chatParticipants = response.data.chatParticipants;
      this.messageList = response.data.messageList;
    },

    /**
     * 休憩室への入室
     *
     * @param Number  sectionId   入室する休憩室ID
     */
    enterLounge: async function (sectionId) {
      // 初回取得
      await this.syncLounge(sectionId);

      // 同期開始
      this.loungeSyncTimer = setInterval(() => {
        this.syncLounge(sectionId);
      }, 3000);

      this.openChat();
    },

    /**
     * チャットのオープン
     */
    openChat: function () {
      this.isChatOpen = true;
    },

    /**
     * チャットのクローズ
     */
    closeChat: function () {
      this.isChatOpen = false;
      this.userAction('leaveLounge');

      // 同期停止
      clearInterval(this.loungeSyncTimer);
    },

    /**
     * メッセージ送信
     */
    onMessageWasSent: function (message) {
      this.$http.post(this.$endpoint('chatPost'), message);

      // 一時的に描画するためリストへ追加
      this.messageList = [...this.messageList, Object.assign({}, message, { id: Math.random() })];
    },

    /**
     * キャンバスマウスオーバーイベント
     */
    canvasMouseOver: function (event) {
      if (event.target) {
        event.target.set({ fill: '#0000ff' });
        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスマウスオーバー解除イベント
     */
    canvasMouseOut: function (event) {
      if (event.target) {
        event.target.set({ fill: '#000000' });
        //console.log(event.target);

        this.canvas.getObjects().forEach((object) => {
          if (object.seatId === event.target.seatId) {
            // var MouseOutObject = object;
            // if (object.seatId.status === 'break') {
            //   event.target.set({ fill: 'red' });
            // } else {
            //   event.target.set({ fill: '#000000' });
            // }
          }
        });

        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスクリックイベント
     */
    canvasMouseDown: function (event) {
      this.canvas.getObjects().forEach((object) => {
        if (object.reservationId != null) {
          // console.log('seatid' + object.seatId);
          // console.log('reservationid' + object.reservationId);
        }
      });

      if (!this.isDisabledClick) {
        if (event.target) {
          // 着席処理
          if (this.authUser.seat_id != null) {
            //どこかに座ってるとき
            switch (this.authUser.seat.section.role) {
              case '自習': //ユーザが座ってる場所が自習室なら
                if (event.target.role != '自習') {
                  //押された場所が自習室じゃないとき

                  this.userAction('enterLounge', event.target);
                  this.isDisabledClick = true;
                  /*依然座ってたところは状態をbreakにする
                // 依然座っていたところのが画像をremoveする*/
                  // removeIcon();
                  //enterLounge チャット開く
                  //ユーザのroleの状態を休憩室に変更
                }
                break;

              case '休憩':
                if (event.target.role === '自習') {
                  //userAction 今座ってる場所と今から座る場所両方status変更
                  //  putIconで新しく座ったところに画像を配置
                  //依然座ってたところのアイコンをremoveして
                  //ユーザのroleの状態を自習に変更
                }
                if (event.target.role === '休憩') {
                  this.userAction('leaveLounge', event.target);
                  this.isDisabledClick = true;

                  //userAction 今座ってる場所と今から座る場所両方status変更
                  //  putIconで新しく座ったところに画像を配置
                  //依然座ってたところのアイコンをremoveして
                }
                // this.userAction(event.target, 'break');
                // this.enterLounge(event.target.sectionId);
                break;
            }
          } else {
            //どこも座ってないとき
            switch (event.target.role) {
              case '自習':
                if (event.target.reservationId === null) {
                  this.userAction('sitting', event.target);
                  this.isDisabledClick = true;
                }

                break;

              case '休憩':
                // this.userAction('break', event.target);
                // this.isDisabledClick = true;
                // this.enterLounge(event.target.sectionId);

                alert('いきなり休憩ですか？まずは自習をしましょう！');
                break;
            }
          }
        }
        //this.isDisabledClick = true;
      }
    },

    /**
     * 退席処理
     */
    clickLeaveButton: function () {
      if (!this.isDisabledClick && this.authUser.seat_id !== null) {
        // 状態変更処理
        if (this.authUser.seat.section.role === '休憩') {
          this.userAction('leaveLounge');
          this.userAction('leave');
          this.isDisabledClick = true;
        } else {
          this.userAction('leave');
          this.isDisabledClick = true;
        }
      }
    },

    /**
     * ユーザーの行動の反映
     *
     * @param String  action  行動
     * @param Object  seatObject 状態を変更する座席
     */
    userAction: async function (action, seatObject = null) {
      // クリックを無効化
      //this.isDisabledClick = true;

      var color = '';
      var endpoint = '';
      switch (action) {
        case 'sitting':
          color = '#ff0000';
          endpoint = this.$endpoint('seatSit', [seatObject.seatId]);
          this.putIcon(seatObject.left, seatObject.top, this.authUser);
          break;

        case 'leave':
          this.canvas.getObjects().forEach((object) => {
            if (object.userId === this.authUser.id) {
              seatObject = object;
              this.removeIcon(object);
            }
          });
          endpoint = this.$endpoint('seatLeave');
          break;

        case 'enterLounge':
          color = '#000000';
          endpoint = this.$endpoint('enterLounge', [seatObject.seatId]);
          this.canvas.getObjects().forEach((object) => {
            if (object.userId === this.authUser.id) {
              object.set({ reservationId: this.authUser.id });
              this.removeIcon(object);
            }
          });
          this.putIcon(seatObject.left, seatObject.top, this.authUser);
          this.enterLounge(seatObject.sectionId);
          break;

        case 'leaveLounge':
          color = '#ffffff';
          this.canvas.getObjects().forEach((object) => {
            if (object.userId === this.authUser.id) {
              this.removeIcon(object);
            }

            if (object.reservationId === this.authUser.id) {
              this.putIcon(object.left, object.top, this.authUser);
              endpoint = this.$endpoint('leaveLounge', [object.seatId]);
              object.set({ reservationId: null });
            }
          });
          break;
      }

      // seatObject.set({ fill: color });

      // 変更の適用
      this.canvas.requestRenderAll();

      // データベースへ状態を保存
      await this.$http.post(endpoint);

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');

      // クリックを有効化
      this.isDisabledClick = false;
      console.log('クリックを有効化しました');
    },

    /**
     * クリックエリアの設定
     *
     * @param Number  seatId      描画する座席
     * @param Number  sectionId   座席の区画
     * @param String  role        座席の役割
     * @param JSON    position    描画位置
     * @param String  status      座席状態
     */
    setClickArea: function (seatId, sectionId, role, reservationId, position, status) {
      var position = JSON.parse(position);

      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          break;

        case 'enterLounge':
          var color = '#000000';
          break;

        case 'break':
          var color = '#FF0000';
          // this.canvas.getObjects().forEach((object) => {
          //   if (object.seatId === seatId) {
          //     object.set({ fill: '#ff0000' });
          //     this.canvas.requestRenderAll();
          //   }
          // });

          break;

        default:
          var color = '#000000';
          break;
      }

      //ここの属性にstatusを追加するしかないのではないか?
      this.canvas.add(
        new fabric.Circle({
          seatId: seatId,
          sectionId: sectionId,
          role: role,
          fill: color,
          reservationId: reservationId,
          opacity: 0.3,
          left: position.x,
          top: position.y,
          originX: 'center',
          originY: 'center',
          radius: this.iconSize / 2,
          strokeWidth: 1,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * アイコンの配置
     *
     * @param Int x 配置される座席のx座標
     * @param Int y 配置される座席のy座標
     * @param Object  user  描画するユーザー
     */
    putIcon: function (x, y, user) {
      new fabric.Image.fromURL(this.$storage('icon') + user.icon, (icon) => {
        icon.set({
          userId: user.id,
          left: x,
          top: y,
          originX: 'center',
          originY: 'center',
          scaleX: this.iconSize / icon.width,
          scaleY: this.iconSize / icon.height,
          clipPath: new fabric.Circle({
            scaleX: icon.width / this.iconSize,
            scaleY: icon.height / this.iconSize,
            radius: this.iconSize / 2,
            originX: 'center',
            originY: 'center',
          }),
          selectable: false, // 図形の選択を禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        });

        // 描画
        this.canvas.add(icon);
      });
    },

    /**
     * アイコンの削除
     *
     * @param Object  removeObject  削除するアイコン
     */
    removeIcon: function (removeObject) {
      this.canvas.remove(removeObject);
      this.canvas.requestRenderAll();
    },
  },

  mounted() {
    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('room', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'room.png',
      this.canvas.renderAll.bind(this.canvas)
    );

    this.canvas.on('mouse:over', this.canvasMouseOver);
    this.canvas.on('mouse:out', this.canvasMouseOut);
    this.canvas.on('mouse:down', this.canvasMouseDown);

    // 初回取得
    this.syncRoom();

    // 同期開始
    setInterval(() => {
      this.syncRoom();
    }, 3000);
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

canvas {
  border: 7px solid $gray;
  margin: 0 auto;
}
</style>

<style lang="scss">
/* beautiful-chatのスタイル */
.sc-launcher {
  // モーダルオープンアイコンの無効化
  display: none;
}
</style>
