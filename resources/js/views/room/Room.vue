<template>
  <v-layout>
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <!-- 自習スタートローディング-->
    <v-overlay :opacity="0.8" :value="roomStatusDisplay" color="#f6bf00" dark>
      <div class="statusDisplay">自習スタート</div>
    </v-overlay>

    <Drawer
      :room-name="roomData.name"
      @leave-room="leaveKarte()"
      @open-project-dialog="projectDialog = $event"
      @open-karte-dialog="karteDialog = $event"
    />

    <v-flex id="main">
      <!-- 教室 -->
      <v-row no-gutters align="center" justify="center" id="room">
        <canvas :width="roomWidth" :height="roomHight" id="canvas"></canvas>
      </v-row>

      <!-- 休憩室 -->
      <Lounge :lounge-id="loungeId" @leave-lounge="leaveLounge()" v-if="isLoungeEnter"></Lounge>

      <!-- プロフィールダイアログ -->
      <ProfileDialog
        :user-id="profileUserId"
        @close="profileDialog = $event"
        v-if="profileDialog"
      ></ProfileDialog>

      <!-- プロジェクトダイアログ -->
      <ProjectDialog
        @start-study="startStudy()"
        @close="cancelStartStudy()"
        v-if="projectDialog"
      ></ProjectDialog>

      <!-- カルテダイアログ -->
      <KarteDialog
        :confirm="confirmDialog"
        @close="karteDialog = $event"
        @leave="leaveRoom()"
        v-if="karteDialog"
        @open-project-dialog="projectDialog = $event"
        @open-karte-dialog="karteDialog = $event"
        @continue-dialog="confirmDialog = $event"
      ></KarteDialog>

      <!-- エラーメッセージ -->
      <div class="text-center ma-2">
        <v-snackbar v-model="errorSnackbar">
          {{ errorMessage }}

          <template v-slot:action="{ attrs }">
            <v-btn color="pink" text v-bind="attrs" @click="errorSnackbar = false"> Close </v-btn>
          </template>
        </v-snackbar>
      </div>
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/room/Drawer';
import Lounge from '@/components/room/Lounge';
import ProjectDialog from '@/components/room/ProjectDialog';
import KarteDialog from '@/components/room/KarteDialog';
import ProfileDialog from '@/components/room/ProfileDialog';
import { OK } from '@/consts/status';

export default {
  components: {
    Drawer,
    Lounge,
    ProjectDialog,
    KarteDialog,
    ProfileDialog,
  },
  data() {
    return {
      errorSnackbar: false, // エラーメッセージ表示制御
      errorMessage: '', // エラーメッセージ
      canvas: '', // キャンバスエリア
      isLoading: false, // ロードの制御
      roomStatusDisplay: false, //自習スタートローディング
      syncTimer: null, // 同期制御
      roomData: '', // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
      isLoungeEnter: false, // 休憩室入室制御
      loungeId: '', // 入室する休憩室のセクションID
      profileDialog: false, // プロフィールのモーダル制御
      profileUserId: null, // プロフィールを表示するユーザーID
      projectDialog: false, // プロジェクトモーダルの制御
      karteDialog: false, // カルテ記入モーダルの制御
      confirmDialog: true, //falseのときカルテ記入後退席 trueの時自習継続するかのモーダル表示
      now: '00:00', // 現在時刻
      zIndex: 0,
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
                    this.putIcon(seat.position.x, seat.position.y, seat.user);
                    this.time();
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
          this.projectDialog = true;
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
     * キャンバスマウスオーバーイベント
     */
    canvasMouseOver: function (event) {
      if (event.target && event.target.fill === '') {
        // 着席前：自習室のみ点灯
        // 着席中：休憩室のみ点灯
        if (
          (this.authUser.seat === null && event.target.role === 'study') ||
          (this.authUser.seat !== null && event.target.role === 'lounge')
        ) {
          event.target.set({ fill: '#0000ff' });
          this.canvas.requestRenderAll();
        }
      }
    },

    /**
     * キャンバスマウスオーバー解除イベント
     */
    canvasMouseOut: function (event) {
      if (event.target && event.target.fill === '#0000ff') {
        event.target.set({ fill: '' });
        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスクリックイベント
     *
     * @param String  targetType  ターゲットの種類
     */
    canvasMouseDown: async function (event, targetType) {
      if (targetType === 'seat') {
        // ロード開始
        this.isLoading = true;

        // 着席処理
        switch (event.target.role) {
          case 'study': // 自習室がクリックされた場合
            // 現在どこにも着席していない場合
            if (this.authUser.seat === null) {
              // 状態変更処理
              await this.userAction('sitting', event.target);
              if (typeof this.authUser.seat_id === 'number') {
                this.projectsDialog = true; //auth userが自習室に初めてsittingしたときモーダル表示
              }
            }
            break;

          case 'lounge': // 休憩室がクリックされた場合
            if (this.authUser.seat === null) {
              // どこにも着席していない状態で休憩室をクリックした場合
              this.errorMessage = 'いきなり休憩ですか？まずは自習をしましょう！';
              this.errorSnackbar = true;
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
        this.isLoading = false;
      } else if (targetType === 'icon') {
        this.profileDialog = true;
        this.profileUserId = event.target.userId;
      }
    },

    /**
     * 自習室からの退席処理
     */
    leaveRoom: async function () {
      // ロード開始
      this.isLoading = true;

      // 状態変更処理
      await this.userAction('leave');

      // ロード終了
      this.isLoading = false;
    },

    /**
     * 退席ボタン押されたときのカルテ記入処理
     */
    leaveKarte: function () {
      this.karteDialog = true;
      this.confirmDialog = false; //退席の意思があるから自習継続の確認不要
    },

    /**
     * 休憩室への入室
     *
     * @param Number  loungeId   入室する休憩室ID
     */
    enterLounge: function (loungeId) {
      this.loungeId = loungeId;
      this.isLoungeEnter = true;
    },

    /**
     * 休憩室からの退室
     */
    leaveLounge: async function () {
      // ロード開始
      this.isLoading = true;

      // 休憩室の初期化
      this.isLoungeEnter = false;
      this.loungeId = '';

      // 状態変更処理
      await this.userAction('leaveLounge');

      // ロード終了
      this.isLoading = false;
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
    time: function (e) {
      //function(e) この引数eは、eventの「e」
      let date = new Date(); //new演算子でオブジェクトのインスタンスを生成
      //現在時刻の取得 **ここからはjavascript**
      // this.now = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
      this.now = date.getHours() + ':' + date.getMinutes();

      console.log(this.now);
    },

    /**
     * 自習開始
     */
    startStudy: async function () {
      this.projectDialog = false;
      this.startDisplay(); //自習開始の表示

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * プロジェクト選択の中断
     */
    cancelStartStudy: function () {
      this.projectDialog = false;
      this.leaveRoom();
    },
    /**
     * ルームの状態表示開始(休憩時間開始、自習開始など)
     */
    startDisplay: function () {
      this.roomStatusDisplay = true;
      setTimeout(this.closeDisplay, 2000);
    },
    /**
     * 自習開始
     */
    closeDisplay: async function () {
      this.roomStatusDisplay = false;
    },
  },

  async mounted() {
    // ロード開始
    this.isLoading = true;

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
            left: seat.position.x,
            top: seat.position.y,
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
          this.putIcon(seat.position.x, seat.position.y, seat.user);

          // ログインユーザーが座っており，座席が休憩室にある場合
          if (seat.id === this.authUser.seat_id && section.role === 'lounge') {
            this.enterLounge(section.id);
          }
        }
      });
    });

    // マウスオーバーイベントの設定
    this.canvas.on('mouse:over', this.canvasMouseOver);
    this.canvas.on('mouse:out', this.canvasMouseOut);

    // クリックイベントの設定
    this.canvas.on('mouse:down', (event) => {
      // オブジェクトのクリック時にのみ実行
      if (event.target !== null) {
        // 入室前または自習室に着席している場合はクリックを受け付ける
        if (this.authUser.seat === null || this.authUser.seat.section.role === 'study') {
          if (event.target.seatId !== null && event.target.reservationId === null) {
            // クリックした座席に誰も座っていないかつ，予約済みでない場合
            //** 座席のクリックイベントを発火 */
            this.canvasMouseDown(event, 'seat');
          } else if (typeof event.target.userId === 'number') {
            //** アイコンのクリックイベントを発火 */
            this.canvasMouseDown(event, 'icon');
          }
        }
      }
    });

    // ロード終了
    this.isLoading = false;

    /**
     * 部屋の同期開始
     */
    this.syncTimer = setInterval(() => {
      this.getRoom();
      // this.time();
    }, 3000);
  },

  destroyed() {
    // ページ遷移時にはタイマーを解除
    if (this.syncTimer !== null) {
      clearInterval(this.syncTimer);
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.statusDisplay {
  font-size: 1000%;
}

#main {
  background-color: $light-yellow;

  #room {
    height: 80vh;
  }
}
</style>
