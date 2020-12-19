<template>
  <v-layout>
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>

    <!-- 自習スタートローディング-->
    <v-overlay opacity="0.8" :value="messageOverlay.isShow" :color="messageOverlay.color" dark>
      <div class="message-overlay">{{ messageOverlay.message }}</div>
    </v-overlay>

    <Drawer :room-name="roomData.name" @input-karte="inputKarte(true)" @leave-room="leaveRoom()" />

    <!-- 休憩室 -->
    <v-dialog
      v-model="lounge.isEnter"
      fullscreen
      persistent
      no-click-animation
      transition="dialog-bottom-transition"
    >
      <!-- 正しく全画面表示にするため，コンポーネント外でダイアログを定義 -->
      <!-- 内側にすると，下側の要素がスクロール可能な状態になる -->
      <Lounge
        :lounge-id="lounge.id"
        :capacity="lounge.capacity"
        @leave-lounge="leaveLounge()"
        v-if="lounge.isEnter"
      ></Lounge>
    </v-dialog>

    <v-flex>
      <!-- 教室 -->
      <v-row justify="center" class="pt-5" :style="{ background: backgroundColor }" id="room">
        <canvas :width="roomWidth" :height="roomHight" id="canvas"></canvas>
      </v-row>

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
      chime: new Audio(this.$storage('system') + 'chime.mp3'), // チャイム音
      canvas: '', // キャンバスエリア
      isLoading: false, // ロードの制御
      messageOverlay: {
        isShow: false, // メッセージオーバーレイ制御
        message: '', // 表示メッセージ
        color: '', // 表示色
      },
      backgroundColor: '', // 教室の背景色
      roomStatus: null, // 教室の状態
      roomData: '', // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
      lounge: {
        isEnter: false, // 休憩室入室制御
        id: '', // 入室する休憩室のセクションID
        capacity: '', // 休憩室の定員
      },
      profile: {
        dialog: false, // プロフィールのモーダル制御
        userId: null, // プロフィールを表示するユーザーID
      },
      projectDialog: false, // プロジェクトモーダルの制御
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
            this.enterLounge(seatObject.sectionId, seatObject.sectionCapacity);
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
            this.roomStatus === 'break')
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
              // if (typeof this.authUser.seat_id === 'number') {
              //   this.projectsDialog = true; //auth userが自習室に初めてsittingしたときモーダル表示
              // }
              // 自習開始
              this.startStudy();
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
                if (this.roomStatus !== 'break') {
                  // 休憩室開放時間じゃなければ
                  // 休憩室がクリックされたときにユーザに伝える
                  this.$store.dispatch('alert/show', {
                    type: 'error',
                    message: '休憩室は解放されていません！',
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
     * @param String  loungeId   入室する休憩室ID
     * @param Number  capacity   休憩室の定員
     */
    enterLounge: function (loungeId, capacity) {
      this.lounge.id = loungeId;
      this.lounge.capacity = capacity;
      this.lounge.isEnter = true;
    },

    /**
     * 休憩室からの退室
     */
    leaveLounge: async function () {
      // ロード開始
      this.isLoading = true;

      // 休憩室の初期化
      this.lounge.isEnter = false;
      this.lounge.id = '';

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
     * 部屋の状態を更新
     *
     * @param String  status  部屋の状態
     */
    updateRoomStatus: function (status) {
      // 状態を更新
      this.roomStatus = status;

      // 背景色の変更
      if (this.roomStatus === 'study') {
        // 自習時間
        this.showMessageOverlay('自習時間です！', '#ff4500');
        // チャイム
        if (this.$store.getters['alert/isSoundOn']) {
          this.chime.play();
        }
        this.backgroundColor = '#b0e0e6';
      } else if (this.roomStatus === 'break') {
        // 休憩時間
        this.showMessageOverlay('休憩時間です！', '#4169e1');
        // チャイム
        if (this.$store.getters['alert/isSoundOn']) {
          this.chime.play();
        }
        this.backgroundColor = '#ffe89a';
      }
    },

    /**
     * 自習開始
     */
    startStudy: async function () {
      //this.projectDialog = false;
      this.showMessageOverlay('自習開始！', '#228b22');

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

    /**
     * メッセージの表示
     *
     * @param String  message 表示するテキスト
     * @param String  color   表示色
     */
    showMessageOverlay: function (message, color) {
      this.messageOverlay.message = message;
      this.messageOverlay.color = color;
      this.messageOverlay.isShow = true;

      // 2秒で閉じる
      setTimeout(() => {
        this.messageOverlay.isShow = false;
      }, 2000);
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
            role: section.role,
            sectionId: section.uuid,
            sectionCapacity: section.seats.length,
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

    /**
     * 入室時には現在の部屋の状態を確認
     */
    var date = new Date();

    // 2桁で時間を取得
    var hour = date.getHours();
    if (hour.length === 1) {
      hour = '0' + hour;
    }

    // 2桁で分数を取得
    var minute = date.getMinutes();
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

          // 背景色の設定
          if (this.roomStatus === 'study') {
            // 自習時間
            this.backgroundColor = '#b0e0e6';
          } else if (this.roomStatus === 'break') {
            // 休憩時間
            this.backgroundColor = '#ffe89a';
          }
        } else if (now < time.separate) {
          // 一つ前の状態を保存（区切りに到達する前のため）
          this.roomStatus = timetable[index - 1].status;

          // 背景色の設定
          if (this.roomStatus === 'study') {
            // 自習時間
            this.backgroundColor = '#b0e0e6';
          } else if (this.roomStatus === 'break') {
            // 休憩時間
            this.backgroundColor = '#ffe89a';
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
        // 時間割イベントの受信
        this.updateRoomStatus(event.status);
      });

    // ロード終了
    this.isLoading = false;
  },

  beforeDestroy() {
    /**
     * データの同期終了
     */
    Echo.channel('room-' + this.roomData.id)
      .stopListening('SeatEvent')
      .stopListening('TimetableEvent');
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.message-overlay {
  font-size: 100px;
}

#room {
  min-height: 100vh;
}
</style>
