<template>
  <div id="room" ref="room">
    <Drawer
      :roomName="roomData.name"
      @leaveRoom="leaveRoom"
      @goalInput="goalInput"
      @studyRecord="studyRecord"
    />
    <canvas :width="roomWidth" :height="roomHight" id="canvas"></canvas>

    <beautiful-chat
      :open="enterLounge"
      :close="leaveLounge"
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

    <v-dialog persistent v-model="goalDialog" width="500">
      <v-card class="headline grey darken-2 text-center">
        <v-card-text class="pa-4 white--text title whitefont-weight-bold"> 目標入力 </v-card-text>

        <v-textarea
          solo
          class="pa-1"
          name="input-7-4"
          v-model="goalText"
          label="目標を入力しよう!"
        ></v-textarea>

        <v-card-actions class="align-center">
          <v-spacer></v-spacer>
          <v-btn color="white" text> IMG </v-btn>
          <v-btn color="white" text @click="goalDialog = false"> Let's Study </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog persistent v-model="studyRecordDialog" width="500">
      <v-card>
        <v-card-title class="headline grey lighten-2"> カルテ記入 </v-card-title>

        <v-card-text>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum.
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="studyRecordDialog = false"> I accept </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <div class="text-center ma-2">
      <v-snackbar v-model="errorSnackbar">
        {{ errorMessage }}

        <template v-slot:action="{ attrs }">
          <v-btn color="pink" text v-bind="attrs" @click="errorSnackbar = false"> Close </v-btn>
        </template>
      </v-snackbar>
    </div>
  </div>
</template>

<script>
import Drawer from '@/components/room/Drawer';
import { OK } from '@/consts/status';

export default {
  components: {
    Drawer,
  },
  data() {
    return {
      errorSnackbar: false, // エラーメッセージ表示制御
      errorMessage: '', // エラーメッセージ
      canvas: '', // キャンバスエリア
      isLoading: false, // ロードの制御
      loaderOption: '', // loading-overlayの設定
      roomSyncTimer: null, // 教室同期制御
      roomData: '', // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
      loungeSyncTimer: null, // 休憩室同期制御
      chatParticipants: [], // チャット参加者
      messageList: [], // メッセージデータ
      isChatOpen: false, // チャットモーダル制御
      goalDialog: false, // 目標入力モーダルの制御
      studyRecordDialog: false, // カルテ記入モーダルの制御
      goalText: '', //目標のテキストメッセージ

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

  watch: {
    /**
     * 座席データの更新時
     */
    'roomData.sections': {
      handler: function (val, oldVal) {
        // 初回取得時は除く
        if (typeof oldVal !== 'undefined') {
          val.forEach((section, sectionIndex) => {
            // 座席のループ
            section.seats.forEach((seat, seatIndex) => {
              if (seat.status !== oldVal[sectionIndex].seats[seatIndex].status) {
                // 状態の変化があった座席は再描画
                switch (seat.status) {
                  case 'sitting':
                    var position = JSON.parse(seat.position);
                    this.putIcon(position.x, position.y, seat.user);
                    break;

                  case 'break':
                    this.canvas.getObjects().forEach((object) => {
                      // 座席を赤色に変更
                      if (object.seatId === seat.id) {
                        object.set({ fill: '#FF0000', reservationId: seat.reservation_user_id });
                        this.canvas.requestRenderAll();
                      }

                      // アイコンを削除
                      if (object.userId === seat.reservation_user_id) {
                        this.removeIcon(object);
                      }
                    });
                    break;

                  default:
                    // 退席された場合
                    this.canvas.getObjects().forEach((object) => {
                      if (oldVal[sectionIndex].seats[seatIndex].user !== null) {
                        // 着席中の座席からの退席処理
                        if (object.userId === oldVal[sectionIndex].seats[seatIndex].user.id) {
                          // アイコンの削除
                          this.removeIcon(object);
                        }

                        // 休憩室から退席した場合は予約を解除
                        if (
                          section.role === 'lounge' &&
                          object.reservationId === oldVal[sectionIndex].seats[seatIndex].user.id
                        ) {
                          object.set({ reservationId: null, fill: '' });
                          this.canvas.requestRenderAll();
                        }
                      }
                    });
                    break;
                }
              }
            });
          });
        }
      },
    },
  },

  methods: {
    /**
     * 教室データの取得
     */
    getRoom: async function () {
      var response = await this.$http.get(this.$endpoint('roomShow', [this.$route.params.id]));
      this.roomData = response.data.roomData;
    },

    /**
     * 休憩室データの取得
     *
     * @param Number  sectionId   入室している休憩室ID
     */
    getLounge: async function (sectionId) {
      var response = await this.$http.get(this.$endpoint('chatShow', [sectionId]));
      this.chatParticipants = response.data.chatParticipants;
      this.messageList = response.data.messageList;
    },

    /**
     * ユーザーの行動の反映
     *
     * @param String  action  行動
     * @param Object  seatObject 状態を変更する座席
     */
    userAction: async function (action, seatObject = null) {
      var endpoint = '';
      var response = '';
      switch (action) {
        case 'sitting':
          // 着席処理
          endpoint = this.$endpoint('seatSit', [seatObject.seatId]);
          response = await this.$http.post(endpoint);
          break;

        case 'leave':
          // 退席処理
          endpoint = this.$endpoint('seatLeave');
          this.isChatOpen = false;
          response = await this.$http.post(endpoint);
          break;

        case 'enterLounge':
          // 休憩室入室処理
          endpoint = this.$endpoint('enterLounge', [seatObject.seatId]);
          response = await this.$http.post(endpoint);
          if (response.status === OK) {
            this.enterLounge(seatObject.sectionId);
          }
          break;

        case 'leaveLounge':
          // 休憩室退室処理
          this.canvas.getObjects().forEach((object) => {
            if (object.reservationId === this.authUser.id) {
              endpoint = this.$endpoint('leaveLounge', [object.seatId]);
            }
          });
          response = await this.$http.post(endpoint);
          break;
      }

      // データの更新
      this.roomData = response.data.roomData;

      // エラー発生時
      if (response.status !== OK) {
        this.errorMessage = response.data.message;
        this.errorSnackbar = true;
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * キャンバスクリックイベント
     */
    canvasMouseDown: async function (event) {
      // クリックした座席に誰も座っていないかつ，予約済みでない場合

      if (event.target.seatId !== null && event.target.reservationId === null) {
        // ロード開始
        var loader = this.$loading.show(this.loaderOption);
        console.log(event.target.role);

        // 着席処理
        switch (event.target.role) {
          case 'study': // 自習室がクリックされた場合
            // 現在どこにも着席していない場合
            if (this.authUser.seat === null) {
              // 状態変更処理
              await this.userAction('sitting', event.target);
            }
            break;

          case 'lounge': // 休憩室がクリックされた場合
            if (this.authUser.seat === null) {
              // どこにも着席していない状態で休憩室をクリックした場合
              alert('いきなり休憩ですか？まずは自習をしましょう！');
            } else {
              // 現在自習室に着席中の場合
              if (this.authUser.seat.section.role === 'study') {
                // 状態変更処理
                await this.userAction('enterLounge', event.target);
              }
            }
            break;
        }

        // ロード終了
        loader.hide();
      }
    },

    /**
     * 自習室からの退席処理
     */
    leaveRoom: async function () {
      // ロード開始
      var loader = this.$loading.show(this.loaderOption);

      // 状態変更処理
      await this.userAction('leave');

      // ロード終了
      loader.hide();
    },

    /**
     * 休憩室への入室
     *
     * @param Number  sectionId   入室する休憩室ID
     */
    enterLounge: async function (sectionId) {
      // 初回取得
      await this.getLounge(sectionId);

      this.isChatOpen = true;

      // 同期開始
      this.loungeSyncTimer = setInterval(() => {
        this.getLounge(sectionId);
      }, 3000);
    },

    /**
     * 休憩室からの退室
     */
    leaveLounge: async function () {
      // ロード開始
      var loader = this.$loading.show(this.loaderOption);

      // 状態変更処理
      await this.userAction('leaveLounge');

      this.isChatOpen = false;

      // ロード終了
      loader.hide();

      // 同期停止
      clearInterval(this.loungeSyncTimer);
      this.loungeSyncTimer = null;
    },

    /**
     * メッセージの送信
     */
    onMessageWasSent: function (message) {
      this.$http.post(this.$endpoint('chatPost'), message);

      // 一時的に描画するためリストへ追加
      this.messageList = [...this.messageList, Object.assign({}, message, { id: Math.random() })];
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

    goalInput: function () {
      this.goalDialog = 'true';
    },
    studyRecord: function () {
      this.studyRecordDialog = 'true';
    },
  },

  async mounted() {
    /**
     * ロードの設定
     */
    this.loaderOption = {
      container: this.$refs.room,
    };
    // ロード開始
    var loader = this.$loading.show(this.loaderOption);

    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('canvas', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'room.png',
      this.canvas.renderAll.bind(this.canvas)
    );

    // クリックエリアの設定
    await this.getRoom();
    this.roomData.sections.forEach((section, sectionIndex) => {
      section.seats.forEach((seat, seatIndex) => {
        var position = JSON.parse(seat.position);
        var color = '';
        if (seat.status == 'break') {
          color = '#FF0000';
        }

        this.canvas.add(
          new fabric.Circle({
            seatId: seat.id,
            sectionId: section.id,
            role: section.role,
            fill: color,
            reservationId: seat.reservation_user_id,
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

        // 誰かが座っている時
        if (seat.status !== null && seat.status != 'break') {
          this.putIcon(position.x, position.y, seat.user);

          // ログインユーザーが座っており，座席が休憩室にある場合
          if (seat.id === this.authUser.seat_id && section.role === 'lounge') {
            this.enterLounge(section.id);
          }
        }
      });
    });

    // クリックイベントの設定
    this.canvas.on('mouse:down', (event) => {
      // オブジェクトのクリック時にのみ実行
      if (event.target !== null) {
        // 入室前または自習室に着席している場合はクリックを受け付ける
        if (this.authUser.seat === null || this.authUser.seat.section.role === 'study') {
          this.canvasMouseDown(event);
        }
      }
    });

    // ロード終了
    loader.hide();

    /**
     * 部屋の同期開始
     */
    this.roomSyncTimer = setInterval(() => {
      this.getRoom();
    }, 3000);
  },

  destroyed() {
    // ページ遷移時にはタイマーを解除
    if (this.roomSyncTimer !== null) {
      clearInterval(this.roomSyncTimer);
    }
    if (this.loungeSyncTimer !== null) {
      clearInterval(this.loungeSyncTimer);
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#room {
  height: 100vh;
}

#canvas {
  border: 7px solid $gray;
  margin-top: 5vw;
  margin-left: 25vw;
}
</style>

<style lang="scss">
/* beautiful-chatのスタイル */
.sc-launcher {
  // モーダルオープンアイコンの無効化
  display: none;
}
</style>
