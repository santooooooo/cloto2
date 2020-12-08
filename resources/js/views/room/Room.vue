<template>
  <v-layout>
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <!-- 自習スタートローディング-->
    <v-overlay :opacity="0.8" :value="roomStatusDisplay" color="#f6bf00" dark>
      <div class="statusDisplay">{{ displayText }}</div>
    </v-overlay>

    <Drawer :room-name="roomData.name" @input-karte="inputKarte(true)" @leave-room="leaveRoom()" />

    <!-- 休憩室 -->
    <v-dialog
      v-model="isLoungeEnter"
      fullscreen
      persistent
      no-click-animation
      transition="dialog-bottom-transition"
    >
      <!-- 正しく全画面表示にするため，コンポーネント外でダイアログを定義 -->
      <!-- 内側にすると，下側の要素がスクロール可能な状態になる -->
      <Lounge :lounge-id="loungeId" @leave-lounge="leaveLounge()" v-if="isLoungeEnter"></Lounge>
    </v-dialog>

    <v-flex id="main">
      <!-- 教室 -->
      <v-row
        no-gutters
        align="center"
        justify="center"
        v-bind:style="{ background: roomColor }"
        id="room"
      >
        <canvas :width="roomWidth" :height="roomHight" id="canvas"></canvas>
      </v-row>

      <!-- 休憩室 -->
      <!-- <Lounge :lounge-id="loungeId" @leave-lounge="leaveLounge()" v-if="isLoungeEnter"></Lounge> -->

      <!-- プロフィールダイアログ -->
      <ProfileDialog
        :user-param="profile.userId"
        @close="profile.dialog = $event"
        v-if="profile.dialog"
      ></ProfileDialog>

      <!-- プロジェクトダイアログ -->
      <ProjectDialog
        @start-study="startStudy()"
        @close="cancelStartStudy()"
        v-if="projectDialog"
      ></ProjectDialog>

      <!-- カルテダイアログ -->
      <KarteDialog
        :confirm="karte.confirm"
        @close="karte.dialog = $event"
        @leave-room="leaveRoom()"
        @continue-study="continueStudy()"
        v-if="karte.dialog"
      ></KarteDialog>
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
      canvas: '', // キャンバスエリア
      isLoading: false, // ロードの制御
      roomStatusDisplay: false, //自習スタートローディング
      syncTimer: null, // 同期制御
      displayText: '自習スタート', //部屋の状態表示のテキスト文字
      roomData: '', // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
      isLoungeEnter: false, // 休憩室入室制御
      loungeId: '', // 入室する休憩室のセクションID
      profile: {
        dialog: false, // プロフィールのモーダル制御
        userId: null, // プロフィールを表示するユーザーID
      },
      projectDialog: false, // プロジェクトモーダルの制御
      karte: {
        dialog: false, // カルテ記入ダイアログの制御
        confirm: true, // 自習継続の確認
      },
      now: '00:00', // 現在時刻 1240 １２時40分
      nowTimeTable: '', //現在の時間割の状態を格納する study or lounge
      zIndex: 0,
      roomColor: '#ffffff', //部屋の色
      studyRoomColor: '#f4f4f4', //自習時間の背景色
      loungeRoomColor: '#ffe89a', //休憩時間の背景色
      timeTables: [
        { time: '14:00', role: 'study' },
        { time: '14:10', role: 'lounge' },
        { time: '14:15', role: 'study' },
        { time: '14:18', role: 'lounge' },
        { time: '14:55', role: 'study' },
        { time: '14:00', role: 'lounge' },
      ], //時間割
    };
  },
  beforeRouteEnter: async (to, from, next) => {
    const response = await axios.get(`/api/room/${to.params.roomId}`);
    if (response.data.roomData === null) {
      next({ path: '/404' });
    } else {
      next();
    }
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
      var response = await this.$http.get(this.$endpoint('roomShow', [this.$route.params.roomId]));
      this.roomData = response.data;
    },

    /**
     * ユーザーの行動の反映
     *
     * @param String  action  行動
     * @param Object  seatObject 状態を変更する座席
     */
    userAction: async function (action, seatObject = null) {
      var endpoint, response;
      switch (action) {
        case 'sitting':
          // 着席処理
          endpoint = this.$endpoint('seatSit', [seatObject.seatId]);
          response = await this.$http.post(endpoint);
          //this.projectDialog = true;
          break;

        case 'leave':
          // 退席処理
          endpoint = this.$endpoint('seatLeave');
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

      // エラー発生時
      if (response.status !== OK) {
        this.$store.dispatch('alert/show', { type: 'error', message: response.data });
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
        // 着席中：timetableが休憩室開放時間なら休憩室のみ点灯
        // this.authUser.seat !== null && event.target.role === 'lounge' に休憩時間ならばを付け足す
        if (
          (this.authUser.seat === null && event.target.role === 'study') ||
          (this.authUser.seat !== null &&
            event.target.role === 'lounge' &&
            this.nowTimeTable === 'lounge')
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
              this.startDisplay('study');
              await this.userAction('sitting', event.target);
              // if (typeof this.authUser.seat_id === 'number') {
              //   this.projectsDialog = true; //auth userが自習室に初めてsittingしたときモーダル表示
              // }
            }
            break;

          case 'lounge': // 休憩室がクリックされた場合
            if (this.authUser.seat === null) {
              // どこにも着席していない状態で休憩室をクリックした場合
              this.$store.dispatch('alert/show', {
                type: 'error',
                message: 'いきなり休憩ですか？まずは自習をしましょう！',
              });
            } else {
              // 現在自習室に着席中の場合
              if (this.authUser.seat.section.role === 'study') {
                if (this.nowTimeTable != 'lounge') {
                  //休憩室開放時間じゃなければ
                  //休憩室がクリックされたときにユーザに伝える
                  this.$store.dispatch('alert/show', {
                    type: 'error',
                    message: '休憩室は解放されていません',
                  });
                } else {
                  // 状態変更処理
                  await this.userAction('enterLounge', event.target);
                }
              }
            }
            break;
        }

        // ロード終了
        this.isLoading = false;
      } else if (targetType === 'icon') {
        this.profile.dialog = true;
        this.profile.userId = String(event.target.userId);
      }
    },

    /**
     * カルテの記入
     *
     * @param Boolean confirm 自習継続の確認をするか
     */
    inputKarte: function (confirm) {
      this.karte.confirm = confirm;
      this.karte.dialog = true;
    },

    /**
     * 自習室からの退席処理
     */
    leaveRoom: async function () {
      this.karte.dialog = false;

      // ロード開始
      this.isLoading = true;

      // 状態変更処理
      await this.userAction('leave');

      // ロード終了
      this.isLoading = false;
    },

    /**
     * カルテ記入後自習続行の処理
     */
    continueStudy: function () {
      this.karte.dialog = false;
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
     * @param Number x 配置される座席のx座標
     * @param Number y 配置される座席のy座標
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
    /**
     * 時間による制御
     */
    time: function () {
      //test用 time tables
      this.timeTables = [
        { time: '14:00', role: 'study' },
        { time: '14:05', role: 'lounge' },
        { time: '14:08', role: 'study' },
        { time: '14:14', role: 'lounge' },
        { time: '14:17', role: 'study' },
        { time: '14:50', role: 'lounge' },
      ];

      let date = new Date(); //new演算子でオブジェクトのインスタンスを生成
      this.now = date.getHours() + ':' + date.getMinutes();
      let nowRoomRole = ''; //現在の部屋の状態 自習 or 休憩

      //現在時刻と休憩開始時刻を比較
      for (var index in this.timeTables) {
        if (this.timeTables.hasOwnProperty(index)) {
          if (this.now === this.timeTables[index].time) {
            // 自習開始時刻 or　休憩開始時刻ならば
            this.startDisplay(this.timeTables[index].role); //画面に表示
            nowRoomRole = this.timeTables[index].role;
            this.nowTimeTable = nowRoomRole; //休憩室出席処理のために時間割状態を格納
          } else if (this.timeTables[index].time < this.now) {
            //自主中　or　休憩中
            nowRoomRole = this.timeTables[index].role;
            this.nowTimeTable = nowRoomRole; //休憩室出席処理のために時間割状態を格納
          } else {
            if (nowRoomRole === '') console.log('tameTable error');
          }
        }
      }
      this.changeRoomColor(nowRoomRole); //時間割に合わせて背景色変更
    },

    /**
     * 時間による背景色の変更
     * @param status String 'study' or 'lounge'
     */
    changeRoomColor: function (status) {
      if (status === 'study') {
        //自習時間
        this.roomColor = this.studyRoomColor;
      } else {
        //休憩室開放時間
        this.roomColor = this.loungeRoomColor;
      }
    },

    /**
     * 自習開始
     */
    startStudy: async function () {
      //this.projectDialog = false;
      this.startDisplay('study'); //自習開始の表示

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * プロジェクト選択の中断
     */
    cancelStartStudy: function () {
      //this.projectDialog = false;
      this.leaveRoom();
    },
    /**
     * ルームの状態表示開始(休憩時間開始、自習開始など)
     */
    startDisplay: function (role) {
      if (role === 'study') {
        this.displayText = '自習スタート';
      } else {
        this.displayText = '休憩スタート';
      }
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

  created() {
    /**
     * 例外処理
     */
    // if (this.authUser.seat_id !== null && this.authUser.task_id === null) {
    //   // タスク選択中にページ更新された場合の処理
    //   this.leaveRoom();
    // }
  },

  async mounted() {
    // ロード開始
    this.time();
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
            sectionId: section.uuid,
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
            this.enterLounge(section.uuid);
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
    Echo.channel('room-' + this.roomData.id).listen('SeatEvent', (event) => {
      this.roomData = event;
    });

    this.syncTimer = setInterval(() => {
      this.time();
    }, 60000);
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
  //background-color: $light-yellow;

  #room {
    height: 80vh;
  }
}
</style>
