<template>
  <div>
    <v-btn @click="buttonClickEvent('leave')">退席</v-btn>
    <v-btn @click="buttonClickEvent('break')">休憩</v-btn>

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
      var response = await this.$http.get(this.$endpoint('GET:roomShow', [this.$route.params.id]));

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
                var color = '#ff0000';
                console.log('sitting された　シート');
                var position = JSON.parse(seat.position);
                this.putIcon(position.x, position.y, seat.user);
                break;

              case 'break':
                var color = '#000000';
                break;

              default:
                var color = '#ffffff';
                this.canvas.getObjects().forEach((object) => {
                  var position = JSON.parse(seat.position);

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
      var response = await this.$http.get(this.$endpoint('GET:chatShow', [sectionId]));

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
      this.changeStatus(null, 'leaveLounge');

      // 同期停止
      clearInterval(this.loungeSyncTimer);
    },

    /**
     * メッセージ送信
     */
    onMessageWasSent: function (message) {
      this.$http.post(this.$endpoint('POST:chatPost'), message);

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
            //   console.log('赤になっちゃった');
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
      // if (!this.isDisabledClick) {
      //   if (event.target) {
      //     // 着席処理
      //     if (this.authUser.seat_id === null) {
      //       switch (event.target.role) {
      //         case '自習':
      //           this.changeStatus(event.target, 'sitting');
      //           break;

      //         case '休憩':
      //           this.changeStatus(event.target, 'enterLounge');
      //           this.enterLounge(event.target.sectionId);
      //           break;
      //       }
      //     }
      //   }
      // }

      if (this.authUser.section === null) {
        //どこにも座っていなかったら
        // console.log(this.authUser.seat.section.role);
        this.changeStatus(event.target, 'sitting');
      }

      if (event.target) {
        //console.log(event.target);
        //console.log('上の方' + this.authUser.seat.section.role);
        // console.log(event.target.role);
        // 着席処理
        if (this.authUser.seat_id != null) {
          //どこかに座ってるとき
          switch (this.authUser.seat.section.role) {
            case '自習': //ユーザが座ってる場所が自習室なら
              if (event.target.role != '自習') {
                //押された場所が自習室じゃないとき

                this.changeStatus(event.target, 'enterLounge');
                /*依然座ってたところは状態をbreakにする
                // 依然座っていたところのが画像をremoveする*/
                // removeIcon();
                //enterLounge チャット開く
                //ユーザのroleの状態を休憩室に変更
              }
              break;

            case '休憩':
              if (event.target.role === '自習') {
                //changeStatus 今座ってる場所と今から座る場所両方status変更
                //  putIconで新しく座ったところに画像を配置
                //依然座ってたところのアイコンをremoveして
                //ユーザのroleの状態を自習に変更
              }
              if (event.target.role === '休憩') {
                this.changeStatus(event.target, 'leaveLounge');
                //changeStatus 今座ってる場所と今から座る場所両方status変更
                //  putIconで新しく座ったところに画像を配置
                //依然座ってたところのアイコンをremoveして
              }
              // this.changeStatus(event.target, 'break');
              // this.enterLounge(event.target.sectionId);
              break;
          }
        } else {
          //どこも座ってないとき
          switch (event.target.role) {
            case '自習':
              this.changeStatus(event.target, 'sitting');
              break;

            case '休憩':
              this.changeStatus(event.target, 'break');
              this.enterLounge(event.target.sectionId);
              break;
          }
        }
      }
    },

    /**
     * ボタンクリックイベント
     *
     * @param String  status  遷移先の状態
     */
    buttonClickEvent: function (status) {
      if (!this.isDisabledClick) {
        // 状態変更処理
        if (this.authUser.seat_id !== null) {
          this.changeStatus(null, status);
        }
      }
    },

    /**
     * 状態の変更
     *
     * @param Object  changeObject 状態を変更する座席
     * @param String  status  遷移先の状態
     */
    changeStatus: async function (changeObject, status) {
      // クリックを無効化
      this.isDisabledClick = true;

      if (changeObject === null) {
        // 退席ボタン or 休憩ボタンが押されたら
        // 自分が着席中の座席を探索
        this.canvas.getObjects().forEach((object) => {
          if (object.seatId === this.authUser.seat_id) {
            changeObject = object;
          }
        });
      }

      switch (status) {
        case 'sitting':
          var seatId = changeObject.seatId;
          var color = '#ff0000';
          this.putIcon(changeObject.left, changeObject.top, this.authUser);
          break;

        case 'leave':
          var seatId = changeObject.seatId;
          var color = '#ffffff';
          this.canvas.getObjects().forEach((object) => {
            if (object.userId === this.authUser.id) {
              //changeObject = object;
              this.removeIcon(object);
            }
          });
          break;

        case 'moveLounge':
          // var color = '#ffffff';
          // this.putIcon(changeObject.left, changeObject.top, this.authUser);
          // this.canvas.getObjects().forEach((object) => {
          //   if (object.userId === this.authUser.id) {
          //     this.removeIcon(object);
          //   }
          // });
          break;

        case 'enterLounge':
          var seatId = changeObject.seatId;
          var color = '#000000';
          this.canvas.getObjects().forEach((object) => {
            if (object.userId === this.authUser.id) {
              object.set({ reservationId: this.authUser.id });
              this.removeIcon(object);
            }
          });
          this.putIcon(changeObject.left, changeObject.top, this.authUser);
          this.enterLounge(changeObject.sectionId);
          break;

        case 'leaveLounge':
          var seatId = '';
          var color = '#ffffff';
          this.canvas.getObjects().forEach((object) => {
            if (object.userId === this.authUser.id) {
              this.removeIcon(object);
            }
            if (object.reservationId === this.authUser.id) {
              this.putIcon(object.left, object.top, this.authUser);
              seatId = object.seatId;
            }
          });
          break;
      }

      // changeObject.set({ fill: color });

      // 変更の適用
      this.canvas.requestRenderAll();

      // データベースへ状態を保存
      await this.seatAction(seatId, status);

      // クリックを有効化
      this.isDisabledClick = false;
    },

    /**
     * 座席状態の変更
     *
     * @param Number  seatId  変更する座席
     * @param String  status  状態
     */
    seatAction: async function (seatId, status) {
      switch (status) {
        case 'sitting':
          var endpoint = this.$endpoint('POST:seatSit', [seatId]);
          break;

        case 'leave':
          var endpoint = this.$endpoint('POST:seatLeave', [seatId]);
          break;

        case 'enterLounge':
          var endpoint = this.$endpoint('POST:enterLounge', [seatId]);
          break;

        case 'leaveLounge':
          var endpoint = this.$endpoint('POST:leaveLounge', [seatId]);
          break;
      }

      await this.$http.post(endpoint);

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
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
          // console.log('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
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
    // setInterval(() => {
    //   this.syncRoom();
    // }, 3000);
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
