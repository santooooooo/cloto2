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

    <!-- メディア視聴ブース -->
    <Media
      @close="userAction('returnSeat')"
      v-if="authUser.seat && authUser.seat.role === 'media'"
    />

    <v-flex>
      <!-- 教室 -->
      <v-row no-gutters justify="center">
        <div id="canvas-container" v-dragscroll>
          <canvas :width="roomWidth" :height="roomHeight" id="canvas"></canvas>
        </div>
      </v-row>

      <!-- プロフィール吹き出し -->
      <div id="popup" ref="popup" v-show="popup.isShow">
        <p>{{ popup.text }}</p>
      </div>

      <!-- プロフィールダイアログ -->
      <ProfileDialog
        :username="profile.username"
        @close="profile.dialog = $event"
        v-if="profile.dialog"
      />

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
import Media from '@/components/room/Media';
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
    Media,
    KarteDialog,
    ProfileDialog,
  },
  data() {
    return {
      chime: new Audio(this.$storage('system') + 'chime.mp3'), // チャイム音
      isLoading: false, // ローディング制御
      canvas: null, // キャンバスエリア
      messageOverlay: {
        isShow: false, // メッセージオーバーレイ制御
        message: '', // 表示メッセージ
        color: '', // 表示色
      },
      roomStatus: null, // 教室の状態
      roomData: {}, // 教室データ
      roomWidth: 2160, // 教室サイズ
      roomHeight: 1200, // 教室サイズ
      call: {
        isEnter: false, // 通話室入室制御
        id: '', // 入室する通話室のID
        capacity: '', // 通話室の定員
      },
      popup: {
        isShow: false, // 吹き出し制御
        text: '', // 吹き出しに表示するテキスト
      },
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
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
              // 座席の元の値
              var oldSeatData = oldVal[sectionIndex].seats[seatIndex];

              if (seat.status !== oldSeatData.status) {
                // 状態の変化があった座席は再描画
                switch (seat.status) {
                  case 'sitting':
                    // 着席された場合
                    this.setUser(seat);

                    // その座席の予約解除処理
                    if (oldSeatData.reservation_user_id !== null) {
                      this.canvas.getObjects().forEach((object) => {
                        if (object.type === 'seat' && object.seatId === seat.id) {
                          object.set({ fill: '' });
                          this.canvas.requestRenderAll();
                        }
                      });
                    }
                    break;

                  case 'break':
                    this.canvas.getObjects().forEach((object) => {
                      // 座席を赤色に変更
                      if (object.type === 'seat' && object.seatId === seat.id) {
                        object.set({ fill: '#FF0000' });
                        this.canvas.requestRenderAll();
                      }

                      // アイコンを削除
                      if (object.type === 'user' && object.seatId === seat.id) {
                        this.removeIcon(object);
                      }
                    });
                    break;

                  default:
                    // 退席された場合
                    if (oldSeatData.user !== null) {
                      this.canvas.getObjects().forEach((object) => {
                        // アイコンを削除
                        if (object.type === 'user' && object.seatId === seat.id) {
                          this.removeIcon(object);
                        }
                      });
                    }
                    break;
                }
              } else {
                // 状態の変化がない場合は取り組み中のタスクのみ更新
                if (seat.user) {
                  // 座席に着席中のユーザーがいる場合
                  this.canvas.getObjects().forEach((object) => {
                    if (object.type === 'user' && object.seatId === seat.id) {
                      object.set({ inProgress: seat.user.in_progress });
                      this.canvas.requestRenderAll();
                    }
                  });
                }
              }
            });
          });
        }
      },
    },

    $windowWidth: function (val) {
      // ウィンドウリサイズ時に拡大率を変更
      if (this.canvas) {
        var zoom = (val - 260) / this.roomWidth;
        this.setZoom(zoom);
      }
    },
  },

  methods: {
    /**
     * 教室データの取得
     */
    getRoom: async function () {
      var response = await axios.get('/api/rooms/' + this.$route.params.roomId);
      this.roomData = response.data;
    },

    /**
     * ユーザーの行動の反映
     *
     * @param String  action  行動
     * @param Object  seatObject 状態を変更する座席
     */
    userAction: async function (action, seatObject = null) {
      switch (action) {
        case 'sitting':
          // 着席処理
          var response = await axios.post('/api/seats/sit/' + seatObject.seatId, {
            _method: 'patch',
          });
          break;

        case 'leave':
          // 退席処理
          var response = await axios.post('/api/seats/leave', {
            _method: 'patch',
          });
          break;

        case 'enterCall':
          // 通話室入室処理
          var response = await axios.post('/api/seats/move_seat/' + seatObject.seatId, {
            _method: 'patch',
          });
          if (response.status === OK) {
            this.enterCall(seatObject.callId, seatObject.callCapacity);
          }
          break;

        case 'enterMedia':
          // メディア視聴ブース入室処理
          var response = await axios.post('/api/seats/move_seat/' + seatObject.seatId, {
            _method: 'patch',
          });
          break;

        case 'returnSeat':
          // 元の座席に戻る処理
          var response = await axios.post('/api/seats/return_seat', {
            _method: 'patch',
          });
          break;
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * キャンバスマウスオーバーイベント
     *
     * @param event マウスイベント
     */
    canvasMouseOver: function (event) {
      if (event.target.type === 'seat') {
        if (event.target.fill === '') {
          if (this.authUser.seat === null) {
            // 着席前
            if (this.authUser.role === 'mentor') {
              // 自習室または講師室のみ着席可能
              if (event.target.role === 'study') {
                event.target.set({ fill: '#0000ff' });
                this.canvas.requestRenderAll();
              } else if (event.target.role === 'staff') {
                event.target.set({ fill: '#00ff00' });
                this.canvas.requestRenderAll();
              }
            } else if (this.authUser.role === 'user') {
              // 自習室のみ着席可能
              if (event.target.role === 'study') {
                event.target.set({ fill: '#0000ff' });
                this.canvas.requestRenderAll();
              }
            }
          } else {
            // 着席中
            // 自習室，講師室での移動は禁止
            if (event.target.role !== 'study' && event.target.role !== 'staff') {
              if (event.target.role === 'lounge') {
                // 休憩室は休憩時間のみ開放
                if (this.roomStatus === 'break') {
                  event.target.set({ fill: '#0000ff' });
                  this.canvas.requestRenderAll();
                }
              } else if (event.target.role === 'mentor') {
                // メンタリングルーム（メンター）は講師室にいるメンターのみ着席可能
                if (this.authUser.role === 'mentor' && this.authUser.seat.role === 'staff') {
                  event.target.set({ fill: '#00ff00' });
                  this.canvas.requestRenderAll();
                }
              } else if (event.target.role === 'user') {
                // メンタリングルーム（利用者）は自習室にいるユーザーのみ着席可能
                if (this.authUser.seat.role === 'study') {
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
      } else if (event.target.type === 'user') {
        // 吹き出しの位置を設定
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        this.$refs.popup.style.left = window.event.clientX + 'px';
        this.$refs.popup.style.top = window.event.clientY + scrollTop - 50 + 'px';
        // 表示
        this.popup.text = event.target.inProgress || '集中しています！';
        this.popup.isShow = true;
      }
    },

    /**
     * キャンバスマウスオーバー解除イベント
     *
     * @param event マウスイベント
     */
    canvasMouseOut: function (event) {
      if (event.target.type === 'seat') {
        if (event.target.fill === '#0000ff' || event.target.fill === '#00ff00') {
          event.target.set({ fill: '' });
          this.canvas.requestRenderAll();
        }
      } else if (event.target.type === 'user') {
        // 吹き出しの非表示
        this.popup.isShow = false;
        this.popup.text = '';
      }
    },

    /**
     * キャンバスクリックイベント
     *
     * @param event マウスイベント
     */
    canvasMouseDown: async function (event) {
      if (event.target.type === 'seat') {
        // クリックした座席に誰も座っていないかつ，予約済みでない場合
        if (event.target.seatId !== null && event.target.fill !== '#FF0000') {
          // ロード開始
          this.isLoading = true;

          if (this.authUser.seat === null) {
            // 着席前
            switch (event.target.role) {
              case 'study': // 自習室
                // 状態変更処理
                await this.userAction('sitting', event.target);
                // 自習開始
                this.startStudy();
                break;

              case 'staff': // 講師室
                if (this.authUser.role === 'mentor') {
                  // 状態変更処理
                  await this.userAction('sitting', event.target);
                  // 勤務開始
                  this.startWork();
                } else if (this.authUser.role === 'user') {
                  this.$store.dispatch('alert/error', '講師室には入れません！');
                }
                break;

              case 'lounge': // 休憩室
                // どこにも着席していない状態で休憩室をクリックした場合
                this.$store.dispatch('alert/error', 'いきなり休憩ですか？まずは自習をしましょう！');
                break;

              case 'hangout': // たまり場
                // どこにも着席していない状態でたまり場をクリックした場合
                this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
                break;

              case 'mentor': // メンタリングルーム（メンター）
                // どこにも着席していない状態でメンタリングルームをクリックした場合
                if (this.authUser.role === 'mentor') {
                  this.$store.dispatch('alert/error', '講師室に荷物を置きましょう！');
                } else if (this.authUser.role === 'user') {
                  this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
                }
                break;

              case 'user': // メンタリングルーム（利用者）
                // どこにも着席していない状態でメンタリングルームをクリックした場合
                this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
                break;

              case 'media': // メディア視聴ブース
                // どこにも着席していない状態でメディア視聴ブースをクリックした場合
                this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
                break;
            }
          } else {
            // 着席中
            switch (event.target.role) {
              case 'study': // 自習室
                this.$store.dispatch('alert/error', '自習室内での移動はできません！');
                break;

              case 'staff': // 講師室
                if (this.authUser.role === 'mentor') {
                  this.$store.dispatch('alert/error', '講師室内での移動はできません！');
                } else if (this.authUser.role === 'user') {
                  this.$store.dispatch('alert/error', '講師室には入れません！');
                }
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

              case 'mentor': // メンタリングルーム（メンター）
                // 講師室にいるメンター
                if (this.authUser.role === 'mentor' && this.authUser.seat.role === 'staff') {
                  // 状態変更処理
                  await this.userAction('enterCall', event.target);
                } else {
                  this.$store.dispatch('alert/error', '講師用の座席です！反対側に座ってください。');
                }
                break;

              case 'user': // メンタリングルーム（利用者）
                // 講師室にいるメンター
                if (this.authUser.role === 'mentor' && this.authUser.seat.role === 'staff') {
                  this.$store.dispatch(
                    'alert/error',
                    '受講者用の座席です！反対側に座ってください。'
                  );
                } else {
                  // 状態変更処理
                  await this.userAction('enterCall', event.target);
                }
                break;

              case 'media': // メディア視聴ブース
                // 状態変更処理
                await this.userAction('enterMedia', event.target);
                break;
            }
          }

          // ロード終了
          this.isLoading = false;
        }
      } else if (event.target.type === 'user') {
        this.profile.dialog = true;
        this.profile.username = String(event.target.username);
      }
    },

    /**
     * キャンバススクロールイベント
     *
     * @param event マウスイベント
     */
    canvasScroll: function (event) {
      // 拡大率の計算
      var delta = event.e.deltaY;
      var defaultZoom = (this.$windowWidth - 260) / this.roomWidth;
      var zoom = this.canvas.getZoom();
      zoom *= 0.999 ** delta;
      if (zoom > 1.3) zoom = 1.3;
      if (zoom < defaultZoom) zoom = defaultZoom;

      // 拡大の適用
      this.setZoom(zoom);

      // スクロールによる移動の無効化
      event.e.preventDefault();
      event.e.stopPropagation();
    },

    /**
     * 拡大の適用
     *
     * @param Number  zoom  拡大率
     */
    setZoom: function (zoom) {
      this.canvas.setZoom(zoom);
      this.canvas.setWidth(this.roomWidth * zoom);
      this.canvas.setHeight(this.roomHeight * zoom);
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
      await this.userAction('returnSeat');

      // ロード終了
      this.isLoading = false;
    },

    /**
     * アイコンの設置
     *
     * @param Object  seat  着席する座席
     */
    setUser: function (seat) {
      // 念の為ユーザーの存在確認
      if (seat.user) {
        fabric.Image.fromURL(this.$storage('icon') + seat.user.icon, (icon) => {
          icon.set({
            type: 'user',
            seatId: seat.id,
            username: seat.user.username,
            inProgress: seat.user.in_progress,
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
      }
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
      this.$store.dispatch('alert/showOverlay', { color: '#228b22', message: '自習開始！' });

      // チャイム
      if (this.$store.getters['alert/isSoundOn']) {
        this.chime.play();
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * 勤務開始
     */
    startWork: async function () {
      this.$store.dispatch('alert/showOverlay', { color: '#8a2be2', message: '勤務開始！' });

      // チャイム
      if (this.$store.getters['alert/isSoundOn']) {
        this.chime.play();
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },
  },

  async mounted() {
    // ボリュームの調整
    this.chime.volume = 0.8;

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

    // 初期サイズの設定（横幅MAX）
    var zoom = (this.$windowWidth - 260) / this.roomWidth;
    this.setZoom(zoom);

    // クリックエリアの設定
    this.roomData.sections.forEach((section) => {
      section.seats.forEach((seat) => {
        var color = '';
        if (seat.status == 'break') {
          color = '#FF0000';
        }

        this.canvas.add(
          new fabric.Circle({
            type: 'seat',
            seatId: seat.id,
            role: seat.role,
            callId: section.id,
            callCapacity: section.seats.length,
            fill: color,
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

          // ログインユーザーが座っており，座席が通話席の場合
          if (
            seat.id === this.authUser.seat_id &&
            (seat.role === 'lounge' ||
              seat.role === 'hangout' ||
              seat.role === 'mentor' ||
              seat.role === 'user')
          ) {
            this.enterCall(section.id, section.seats.length);
          }
        }
      });
    });

    // マウスオーバーイベントの設定
    this.canvas.on('mouse:over', (event) => {
      // オブジェクトのオーバー時にのみ実行
      if (event.target) {
        this.canvasMouseOver(event);
      }
    });

    // マウスオーバー解除イベントの設定
    this.canvas.on('mouse:out', (event) => {
      // オブジェクトのオーバー解除時にのみ実行
      if (event.target) {
        this.canvasMouseOut(event);
      }
    });

    // クリックイベントの設定
    this.canvas.on('mouse:down', (event) => {
      // オブジェクトのクリック時にのみ実行
      if (event.target) {
        // 入室前または自習室，講師室に着席している場合はクリックを受け付ける
        if (
          this.authUser.seat === null ||
          this.authUser.seat.role === 'study' ||
          this.authUser.seat.role === 'staff'
        ) {
          this.canvasMouseDown(event);
        }
      }
    });

    // スクロールイベントの設定
    this.canvas.on('mouse:wheel', this.canvasScroll);

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
    Echo.channel('room.' + this.roomData.id)
      .listen('SeatEvent', (event) => {
        // 部屋情報の更新
        this.roomData = event;
      })
      .listen('TimetableEvent', (event) => {
        // 部屋状態の更新
        this.roomStatus = event.status;
      });

    // ロード終了
    this.isLoading = false;
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#room {
  background-image: url('/storage/system/room_background.jpg');
  background-size: cover;

  #canvas-container {
    height: calc(100vh - 64px);
    margin-right: 250px;
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

    &::-webkit-scrollbar {
      display: none;
    }
  }

  #popup {
    position: absolute;
    max-width: 300px;

    p {
      padding: 5px 10px;
      background: #ffffff;
      border: 2px solid #000000;
      border-radius: 10px;
      font-weight: bold;
    }
  }
}
</style>
