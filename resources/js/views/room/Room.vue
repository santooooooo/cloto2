<template>
  <v-layout id="room">
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>

    <Drawer
      :room-name="roomData.name"
      :room-status="roomStatus"
      @input-karte="inputKarte(true)"
      @leave-room="leaveRoom()"
    />

    <!-- 通話室 -->
    <Call
      :call-id="call.id"
      :capacity="call.capacity"
      @leave-call="leaveCall()"
      v-if="call.isEnter"
    />

    <v-flex>
      <!-- 教室 -->
      <v-row no-gutters justify="center">
        <div id="canvas-container" :style="canvasContainerStyle" v-dragscroll>
          <canvas :width="roomWidth" :height="roomHeight" id="canvas"></canvas>
        </div>
      </v-row>

      <!-- プロフィールダイアログ -->
      <ProfileDialog
        :user-param="profile.userId"
        @close="profile.dialog = $event"
        v-if="profile.dialog"
      />

      <!-- プロジェクトダイアログ -->
      <ProjectDialog @start-study="startStudy()" @close="cancelStartStudy()" v-if="projectDialog" />

      <!-- カルテダイアログ -->
      <KarteDialog
        :confirm="karte.confirm"
        @close="karte.dialog = $event"
        @leave-room="leaveRoom()"
        @continue-study="continueStudy()"
        v-if="karte.dialog"
      />
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/room/Drawer';
import Call from '@/components/room/Call';
import ProjectDialog from '@/components/room/ProjectDialog';
import KarteDialog from '@/components/room/KarteDialog';
import ProfileDialog from '@/components/room/ProfileDialog';
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      // 部屋データが取得されるまでは表示しない
      if (Object.keys(this.roomData).length) {
        return {
          inner: this.roomData.name,
        };
      }
    },
  },
  components: {
    Drawer,
    Call,
    ProjectDialog,
    KarteDialog,
    ProfileDialog,
  },
  data() {
    return {
      windowWidth: window.innerWidth, // ウィンドウの横幅
      windowHeight: window.innerHeight - 64, // ウィンドウの縦幅（ヘッダーを除く）
      chime: new Audio(this.$storage('system') + 'chime.mp3'), // チャイム音
      canvas: null, // キャンバスエリア
      isLoading: false, // ロードの制御
      messageOverlay: {
        isShow: false, // メッセージオーバーレイ制御
        message: '', // 表示メッセージ
        color: '', // 表示色
      },
      roomStatus: null, // 教室の状態
      roomData: {}, // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHeight: 600, // 教室サイズ
      call: {
        isEnter: false, // 通話室入室制御
        id: '', // 入室する通話室のID
        capacity: '', // 通話室の定員
      },
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        userId: null, // プロフィールを表示するユーザーID
      },
      projectDialog: false, // プロジェクトダイアログの制御
      karte: {
        dialog: false, // カルテ記入ダイアログの制御
        confirm: true, // 自習継続の確認
      },
    };
  },
  beforeRouteEnter: async (to, from, next) => {
    const response = await axios.get(`/api/room/${to.params.roomId}`);
    if (!Object.keys(response.data).length) {
      next({ path: '/404' });
    } else {
      next();
    }
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
    canvasContainerStyle() {
      return {
        height: this.windowHeight + 'px',
        'margin-top': this.windowHeight < this.roomHeight + 100 ? '0px' : '50px',
        'margin-right': this.windowWidth < this.roomWidth + 250 ? '250px' : '0px',
      };
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
                    this.setUser(seat);
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
                          seat.role === 'lounge' &&
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

        case 'enterCall':
          // 通話室入室処理
          endpoint = this.$endpoint('enterCall', [seatObject.seatId]);
          response = await this.$http.post(endpoint);
          if (response.status === OK) {
            this.enterCall(seatObject.callId, seatObject.callCapacity);
          }
          break;

        case 'leaveCall':
          // 通話室退室処理
          this.canvas.getObjects().forEach((object) => {
            if (object.reservationId === this.authUser.id) {
              endpoint = this.$endpoint('leaveCall', [object.seatId]);
            }
          });
          response = await this.$http.post(endpoint);
          break;
      }

      // エラー発生時
      if (response.status !== OK) {
        this.$store.dispatch('alert/error', response.data);
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * キャンバスマウスオーバーイベント
     */
    canvasMouseOver: function (event) {
      if (event.target && event.target.fill === '') {
        if (this.authUser.seat === null) {
          // 着席前
          // 自習室のみ着席可能
          if (event.target.role === 'study') {
            event.target.set({ fill: '#0000ff' });
            this.canvas.requestRenderAll();
          }
        } else {
          // 着席中
          // 自習室での移動は禁止
          if (event.target.role !== 'study') {
            if (event.target.role === 'lounge') {
              // 休憩室は休憩時間のみ開放
              if (this.roomStatus === 'break') {
                event.target.set({ fill: '#0000ff' });
                this.canvas.requestRenderAll();
              }
            } else {
              // その他は常に開放
              event.target.set({ fill: '#0000ff' });
              this.canvas.requestRenderAll();
            }
          }
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

        if (this.authUser.seat === null) {
          // 着席前
          switch (event.target.role) {
            case 'study': // 自習室
              // 状態変更処理
              await this.userAction('sitting', event.target);
              // if (typeof this.authUser.seat_id === 'number') {
              //   this.projectsDialog = true; //auth userが自習室に初めてsittingしたときダイアログ表示
              // }
              // 自習開始
              this.startStudy();
              break;

            case 'lounge': // 休憩室
              // どこにも着席していない状態で休憩室をクリックした場合
              this.$store.dispatch('alert/error', 'いきなり休憩ですか？まずは自習をしましょう！');
              break;

            case 'hangout': // たまり場
              // どこにも着席していない状態でたまり場をクリックした場合
              this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
              break;

            case 'teacher': // メンタリングルーム（先生）
              // どこにも着席していない状態でたまり場をクリックした場合
              this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');

              break;

            case 'student': // メンタリングルーム（生徒）
              // どこにも着席していない状態でたまり場をクリックした場合
              this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
              break;
          }
        } else {
          // 着席中
          switch (event.target.role) {
            case 'study': // 自習室
              break;

            case 'lounge': // 休憩室
              if (this.roomStatus !== 'break') {
                // 休憩時間以外
                this.$store.dispatch('alert/error', '休憩室は解放されていません！');
              } else {
                // 状態変更処理
                await this.userAction('enterCall', event.target);
              }
              break;

            case 'hangout': // たまり場
              // 状態変更処理
              await this.userAction('enterCall', event.target);
              break;

            case 'teacher': // メンタリングルーム（先生）
              // 状態変更処理
              await this.userAction('enterCall', event.target);
              break;

            case 'student': // メンタリングルーム（生徒）
              // 状態変更処理
              await this.userAction('enterCall', event.target);
              break;
          }
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

      // フロア一覧へ
      this.$router.push({ name: 'entrance' });
    },

    /**
     * カルテ記入後自習続行の処理
     */
    continueStudy: function () {
      this.karte.dialog = false;
    },

    /**
     * 通話室への入室
     *
     * @param String  callId    入室する通話室ID
     * @param Number  capacity  通話室の定員
     */
    enterCall: function (callId, capacity) {
      this.call.id = callId;
      this.call.capacity = capacity;
      this.call.isEnter = true;
    },

    /**
     * 通話室からの退室
     */
    leaveCall: async function () {
      // ロード開始
      this.isLoading = true;

      // 通話室の初期化
      this.call.isEnter = false;
      this.call.id = '';

      // 状態変更処理
      await this.userAction('leaveCall');

      // ロード終了
      this.isLoading = false;
    },

    /**
     * アイコンの設置
     *
     * @param Object  seat  着席する座席
     */
    setUser: function (seat) {
      fabric.Image.fromURL(this.$storage('icon') + seat.user.icon, (icon) => {
        icon.set({
          userId: seat.user.id,
          left: seat.position.x,
          top: seat.position.y,
          originX: 'center',
          originY: 'center',
          scaleX: seat.size / icon.width,
          scaleY: seat.size / icon.height,
          clipPath: new fabric.Circle({
            scaleX: icon.width / seat.size,
            scaleY: icon.height / seat.size,
            radius: seat.size / 2,
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
     * 自習開始
     */
    startStudy: async function () {
      //this.projectDialog = false;
      this.$store.dispatch('alert/showOverlay', { color: '#228b22', message: '自習開始！' });

      // チャイム
      if (this.$store.getters['alert/isSoundOn']) {
        this.chime.play();
      }

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
    // ボリュームの調整
    this.chime.volume = 0.2;

    // ロード開始
    this.isLoading = true;

    // 部屋データの取得
    await this.getRoom();

    // データ取得後にタブタイトルを更新
    this.$emit('updateHead');

    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('canvas', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('room') + 'room_' + this.roomData.id + '.png',
      this.canvas.renderAll.bind(this.canvas)
    );

    // クリックエリアの設定
    this.roomData.sections.forEach((section, sectionIndex) => {
      section.seats.forEach((seat, seatIndex) => {
        var color = '';
        if (seat.status == 'break') {
          color = '#FF0000';
        }

        this.canvas.add(
          new fabric.Circle({
            seatId: seat.id,
            role: seat.role,
            callId: section.uuid,
            callCapacity: section.seats.length,
            fill: color,
            reservationId: seat.reservation_user_id,
            opacity: 0.3,
            left: seat.position.x,
            top: seat.position.y,
            originX: 'center',
            originY: 'center',
            radius: seat.size / 2,
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
          this.setUser(seat);

          // ログインユーザーが座っており，座席が自習室以外にある場合
          if (seat.id === this.authUser.seat_id && seat.role !== 'study') {
            this.enterCall(section.uuid, section.seats.length);
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
        if (this.authUser.seat === null || this.authUser.seat.role === 'study') {
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

    /**
     * 入室時には現在の部屋の状態を確認
     */
    var date = new Date();

    // 2桁で時間を取得
    var hour = String(date.getHours());
    if (hour.length === 1) {
      hour = '0' + hour;
    }

    // 2桁で分数を取得
    var minute = String(date.getMinutes());
    if (minute.length === 1) {
      minute = '0' + minute;
    }

    // 現在時刻
    var now = hour + ':' + minute;

    // オブジェクトを配列化
    var timetable = [];
    Object.keys(this.roomData.timetable).forEach((key) => {
      timetable.push({ separate: key, status: this.roomData.timetable[key] });
    });

    // 時刻の小さい順に並べ替える
    timetable.sort((a, b) => {
      let comparison = 0;
      if (a.separate > b.separate) {
        comparison = 1;
      } else if (a.separate < b.separate) {
        comparison = -1;
      }
      return comparison;
    });

    // 小さい順に時間を確認していく
    timetable.forEach((time, index) => {
      if (this.roomStatus === null) {
        if (now === time.separate) {
          // 現在の状態を保存
          this.roomStatus = timetable[index].status;
        } else if (now < time.separate) {
          // 一つ前の状態を保存（区切りに到達する前のため）
          this.roomStatus = timetable[index - 1].status;
        } else {
          // 時間割の最後まで確認した場合
          if (index + 1 === timetable.length) {
            // 日付更新後の最初の状態を保存
            this.roomStatus = timetable[0].status;
          }
        }
      }
    });

    /**
     * データの同期開始
     */
    Echo.channel('room-' + this.roomData.id)
      .listen('SeatEvent', (event) => {
        // 部屋情報の更新
        this.roomData = event;
      })
      .listen('TimetableEvent', (event) => {
        // 部屋状態の更新
        this.roomStatus = event.status;
      });

    // ウィンドウリサイズ時のイベント
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
      this.windowHeight = window.innerHeight - 64;
    });

    // ロード終了
    this.isLoading = false;
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#room {
  min-height: 100vh;
  background-image: url('/storage/system/room_background.jpg');
  background-size: cover;

  #canvas-container {
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

    &::-webkit-scrollbar {
      display: none;
    }
  }
}
</style>
