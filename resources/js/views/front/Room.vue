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
    onMessageWasSent(message) {
      console.log(message);
      var response = this.$http.post(this.$endpoint('POST:chatPost'), message);

      this.messageList = [...this.messageList, Object.assign({}, message, { id: Math.random() })];
      console.log('メッセージ送信');
    },
    openChat() {
      this.isChatOpen = true;
      console.log('チャットオープン');
    },
    closeChat() {
      this.isChatOpen = false;
      console.log('チャットクローズ');
    },

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
            this.setClickArea(seat.id, section.id, section.role, seat.position, seat.status);

            // 誰かが座っている時
            if (seat.status !== null) {
              // 着席している人を表示
              var position = JSON.parse(seat.position);
              this.putIcon(position.x, position.y, seat.user.icon);

              // ログインユーザーが座っており，座席が休憩室にある場合
              if (seat.id === this.authUser.seat_id && section.role === '休憩') {
                this.enterLounge(section.id);
              }
            }
          } else if (seat.status !== this.roomData.sections[sectionIndex].seats[seatIndex].status) {
            // 現在の状態から変化があれば再描画
            // this.changeColor(seat.status, seat.id);
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

      // システムメッセージの例
      this.messageList.push({
        type: 'system',
        id: 13,
        data: { text: 'You have been transferred to another operator', meta: '04-07-2018 15:57' },
      });
    },

    /**
     * 休憩室への入室
     *
     * @param Number  sectionId   入室する休憩室ID
     */
    enterLounge: async function (sectionId) {
      var response = await this.$http.get(this.$endpoint('GET:chatShow', [sectionId]));

      this.chatParticipants = response.data.chatParticipants;
      this.messageList = response.data.messageList;

      // システムメッセージの例
      this.messageList.push({
        type: 'system',
        id: 13,
        data: { text: 'You have been transferred to another operator', meta: '04-07-2018 15:57' },
      });

      this.openChat();
    },

    /**
     * コメントの投稿
     */
    postComment: async function () {
      var data = { message: this.chatMessage };

      var response = await this.$http.post(this.$endpoint('POST:chatPost'), data);
      this.chatData.push(response.data);
    },

    /**
     * キャンバスマウスオーバーイベント
     */
    canvasMouseOver: function (event) {
      if (event.target) {
        event.target.set({ fill: '#ff0000' });
        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスマウスオーバー解除イベント
     */
    canvasMouseOut: function (event) {
      if (event.target) {
        event.target.set({ fill: '#000000' });
        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスクリックイベント
     */
    canvasMouseDown: function (event) {
      if (!this.isDisabledClick) {
        if (event.target) {
          // 着席処理
          if (this.authUser.seat_id === null) {
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
        // 自分が着席中の座席を探索
        this.canvas.getObjects().forEach((object) => {
          if (object.seatId === this.authUser.seat_id) {
            changeObject = object;
          }
        });
      }

      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          console.log(status);
          this.putIcon(changeObject.left, changeObject.top);
          break;

        case 'leave':
          var color = '#ffffff';
          console.log(status);
          this.removeIcon();
          break;

        case 'break':
          console.log(status);
          var color = '#000000';
          this.putIcon(changeObject.left, changeObject.top);
          break;
      }

      changeObject.set({ fill: color });

      // 変更の適用
      this.canvas.requestRenderAll();

      // データベースへ状態を保存
      await this.seatAction(changeObject.seatId, status);

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

        case 'break':
          var endpoint = this.$endpoint('POST:seatBreak', [seatId]);
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
    setClickArea: function (seatId, sectionId, role, position, status) {
      var position = JSON.parse(position);
      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          break;

        case 'break':
          var color = '#000000';
          break;

        default:
          var color = '#ffffff';
          break;
      }

      this.canvas.add(
        new fabric.Circle({
          seatId: seatId,
          sectionId: sectionId,
          role: role,
          fill: 'black',
          stroke: 'black',
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
     * @param String  iconFilename  アイコンファイル名
     */
    putIcon: function (x, y, iconFilename = this.authUser.icon) {
      new fabric.Image.fromURL(this.$storage('icon') + iconFilename, (icon) => {
        icon.set({
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
     * 退出するとき、アイコンを削除
     *
     */
    removeIcon: function () {
      this.canvas.remove(this.iconObject);
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
    // setInterval(this.syncRoom, 10000);
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
