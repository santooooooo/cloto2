<template>
  <v-layout id="room">
    <!-- ローディング画面 -->
    <v-overlay :value="loading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>

    <Drawer
      :room-name="roomData.name"
      :room-status="roomStatus"
      @input-karte="inputKarte(true)"
      @leave-room="leaveRoom()"
    />

    <!-- 通話室 -->
    <div v-if="call.isEnter">
      <SeminarSpeak
        :call-id="call.id"
        :capacity="call.capacity"
        @leave-call="leaveCall()"
        v-if="authUser.seat.role === 'speak'"
      />
      <SeminarView
        :call-id="call.id"
        :capacity="call.capacity"
        @leave-call="leaveCall()"
        v-else-if="authUser.seat.role === 'view'"
      />
      <Call
        :call-id="call.id"
        :capacity="call.capacity"
        @leave-call="leaveCall()"
        v-else-if="call.roles.includes(authUser.seat.role)"
      />
    </div>

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
        v-if="karte.dialog"
      />
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/room/Drawer';
import Call from '@/components/room/Call';
import SeminarSpeak from '@/components/room/SeminarSpeak';
import SeminarView from '@/components/room/SeminarView';
import Media from '@/components/room/Media';
import KarteDialog from '@/components/room/KarteDialog';
import ProfileDialog from '@/components/room/ProfileDialog';
import { OK } from '@/consts/status';
import { CHIME_SOUND } from '@/consts/sound';

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
    SeminarSpeak,
    SeminarView,
    Media,
    KarteDialog,
    ProfileDialog,
  },
  data() {
    return {
      loading: false, // ローディング制御
      canvas: null, // キャンバスエリア
      roomStatus: null, // 教室の状態
      roomData: {}, // 教室データ
      roomWidth: 2160, // 教室サイズ
      roomHeight: 1200, // 教室サイズ
      call: {
        roles: ['lounge', 'hangout', 'mentor', 'user'], // 通常通話部屋
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
      handler: function (newSections, oldSections) {
        // 初回取得時は除く
        if (typeof oldSections !== 'undefined') {
          newSections.forEach((newSection, sectionIndex) => {
            // 座席のループ
            newSection.seats.forEach((newSeat, seatIndex) => {
              // 座席の元の値
              var oldSeat = oldSections[sectionIndex].seats[seatIndex];

              if (newSeat.status !== oldSeat.status) {
                // 状態の変化があった座席は再描画
                switch (newSeat.status) {
                  case 'sitting':
                    // 着席された場合
                    this.setUser(newSeat);

                    // その座席の予約解除処理
                    if (oldSeat.reservation_user_id !== null) {
                      var object = this.getCanvasObject('seat', 'seatId', newSeat.id);
                      this.resetColor(object);
                    }
                    break;

                  case 'break':
                    // 座席を赤色に変更
                    var object = this.getCanvasObject('seat', 'seatId', newSeat.id);
                    this.setColor(object, '#FF0000');

                    // アイコンを削除
                    var object = this.getCanvasObject('user', 'seatId', newSeat.id);
                    this.removeIcon(object);
                    break;

                  default:
                    if (oldSeat.user !== null) {
                      // 退席された場合
                      var object = this.getCanvasObject('user', 'seatId', newSeat.id);
                      this.removeIcon(object);
                    } else if (oldSeat.reservation_user_id !== null) {
                      // 休憩室から直接退席した場合の予約解除処理（オフライン時の強制退席）
                      var object = this.getCanvasObject('seat', 'seatId', newSeat.id);
                      this.resetColor(object);
                    }
                    break;
                }
              } else {
                // 状態の変化がない場合は取り組み中のタスクのみ更新
                if (newSeat.user) {
                  // 座席に着席中のユーザーがいる場合
                  var object = this.getCanvasObject('user', 'seatId', newSeat.id);
                  object.set({ inProgress: newSeat.user.in_progress });
                  this.canvas.requestRenderAll();
                }
              }
            });
          });
        }
      },
    },

    $windowWidth: function (windowWidth) {
      // ウィンドウリサイズ時に拡大率を変更
      if (this.canvas) {
        var zoom = (windowWidth - 260) / this.roomWidth;
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
     * キャンバス上のオブジェクトの取得
     *
     * @param   String  type  検索するタイプ
     * @param   String  key   要素
     * @param   Number  value 値
     * @returns Object  取得したオブジェクト
     */
    getCanvasObject: function (type, key, value) {
      var object = this.canvas.getObjects().filter((object) => {
        return object.type === type && object[key] === value;
      })[0];

      return object || null;
    },

    /**
     * 座席色の設定
     *
     * @param Object  seatObject  設定する座席オブジェクト
     * @param String  color       設定する色
     */
    setColor: function (seatObject, color) {
      seatObject.set({ fill: color });
      this.canvas.requestRenderAll();
    },

    /**
     * 座席色の初期化
     *
     * @param Object  seatObject  初期化する座席オブジェクト
     */
    resetColor: function (seatObject) {
      this.setColor(seatObject, '');
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
            hoverCursor: 'pointer',
            selectable: false, // 図形の選択を禁止
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
     * 吹き出しの表示
     *
     * @param Object  userObject  表示するユーザーオブジェクト
     */
    showPopup: function (userObject) {
      // 吹き出しの位置を設定
      var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      this.$refs.popup.style.left = window.event.clientX + 'px';
      this.$refs.popup.style.top = window.event.clientY + scrollTop - 50 + 'px';
      // 表示
      this.popup.text = userObject.inProgress || '集中しています！';
      this.popup.isShow = true;
    },

    /**
     * 吹き出しの非表示
     */
    hidePopup: function () {
      this.popup.isShow = false;
      this.popup.text = '';
    },

    /**
     * キャンバスマウスオーバーイベント
     *
     * @param target イベントの対象
     */
    canvasMouseOver: function (target) {
      if (target.type === 'seat') {
        if (target.fill === '') {
          if (this.authUser.seat === null) {
            // 着席前
            if (this.authUser.role === 'mentor') {
              // 自習室またはスタッフルームのみ着席可能
              if (target.role === 'study') {
                this.setColor(target, '#0000FF');
              } else if (target.role === 'staff') {
                this.setColor(target, '#00FF00');
              }
            } else if (this.authUser.role === 'user') {
              // 自習室のみ着席可能
              if (target.role === 'study') {
                this.setColor(target, '#0000FF');
              }
            }
          } else {
            // 着席中
            // 自習室，スタッフルームでの移動は禁止
            if (target.role !== 'study' && target.role !== 'staff') {
              if (target.role === 'lounge') {
                // 休憩室は休憩時間のみ開放
                if (this.roomStatus === 'break') {
                  this.setColor(target, '#0000FF');
                }
              } else if (target.role === 'mentor') {
                // メンタリングルーム（メンター）はスタッフルームにいるメンターのみ着席可能
                if (this.authUser.role === 'mentor' && this.authUser.seat.role === 'staff') {
                  this.setColor(target, '#00FF00');
                }
              } else if (target.role === 'user') {
                // メンタリングルーム（利用者）は自習室にいるユーザーのみ着席可能
                if (this.authUser.seat.role === 'study') {
                  this.setColor(target, '#0000FF');
                }
              } else {
                // その他は常に開放
                this.setColor(target, '#0000FF');
              }
            }
          }
        }
      } else if (target.type === 'user') {
        this.showPopup(target);
      }
    },

    /**
     * キャンバスマウスオーバー解除イベント
     *
     * @param target イベントの対象
     */
    canvasMouseOut: function (target) {
      if (target.type === 'seat') {
        if (target.fill === '#0000FF' || target.fill === '#00FF00') {
          this.resetColor(target);
        }
      } else if (target.type === 'user') {
        this.hidePopup();
      }
    },

    /**
     * キャンバスクリックイベント
     *
     * @param target イベントの対象
     */
    canvasMouseDown: async function (target) {
      if (target.type === 'seat') {
        // クリックした座席に誰も座っていないかつ，予約済みでない場合
        if (target.seatId !== null && target.fill !== '#FF0000') {
          // ロード開始
          this.loading = true;

          if (this.authUser.seat === null) {
            // 着席前
            switch (target.role) {
              case 'study': // 自習室
                // 状態変更処理
                await this.userAction('sitting', target);
                // 自習開始
                this.startStudy();
                break;

              case 'staff': // スタッフルーム
                if (this.authUser.role === 'mentor') {
                  // 状態変更処理
                  await this.userAction('sitting', target);
                  // 勤務開始
                  this.startWork();
                } else if (this.authUser.role === 'user') {
                  this.$store.dispatch('alert/error', 'スタッフルームには入れません！');
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
                  this.$store.dispatch('alert/error', 'スタッフルームに荷物を置きましょう！');
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

              case 'speak': // ホール（登壇者）
                // どこにも着席していない状態でホール（登壇者）をクリックした場合
                this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
                break;

              case 'view': // ホール（視聴者）
                // どこにも着席していない状態でホール（視聴者）をクリックした場合
                this.$store.dispatch('alert/error', '自習室に荷物を置きましょう！');
                break;
            }
          } else {
            // 着席中
            switch (target.role) {
              case 'study': // 自習室
                this.$store.dispatch('alert/error', '自習室内での移動はできません！');
                break;

              case 'staff': // スタッフルーム
                if (this.authUser.role === 'mentor') {
                  this.$store.dispatch('alert/error', 'スタッフルーム内での移動はできません！');
                } else if (this.authUser.role === 'user') {
                  this.$store.dispatch('alert/error', 'スタッフルームには入れません！');
                }
                break;

              case 'lounge': // 休憩室
                if (this.roomStatus !== 'break') {
                  // 休憩時間以外
                  this.$store.dispatch('alert/error', '休憩室は解放されていません！');
                } else {
                  // 状態変更処理
                  await this.userAction('enterCall', target);
                }
                break;

              case 'hangout': // たまり場
                // 状態変更処理
                await this.userAction('enterCall', target);
                break;

              case 'mentor': // メンタリングルーム（メンター）
                // スタッフルームにいるメンター
                if (this.authUser.role === 'mentor' && this.authUser.seat.role === 'staff') {
                  // 状態変更処理
                  await this.userAction('enterCall', target);
                } else {
                  this.$store.dispatch('alert/error', 'スタッフ用の座席です！');
                }
                break;

              case 'user': // メンタリングルーム（利用者）
                // スタッフルームにいるメンター
                if (this.authUser.role === 'mentor' && this.authUser.seat.role === 'staff') {
                  this.$store.dispatch('alert/error', '受講者用の座席です！');
                } else {
                  // 状態変更処理
                  await this.userAction('enterCall', target);
                }
                break;

              case 'media': // メディア視聴ブース
                // 状態変更処理
                await this.userAction('enterMedia', target);
                break;

              case 'speak': // ホール（登壇者）
                // 状態変更処理
                await this.userAction('enterCall', target);
                break;

              case 'view': // ホール（視聴者）
                // 状態変更処理
                await this.userAction('enterCall', target);
                break;
            }
          }

          // ロード終了
          this.loading = false;
        }
      } else if (target.type === 'user') {
        this.profile.dialog = true;
        this.profile.username = String(target.username);
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

          if (response.status === OK) {
            // Slack通知
            this.$slack('着席Bot', ':fire:', this.roomData.name + 'にユーザーが着席しました。');
          }
          break;

        case 'leave':
          // 退席処理
          var response = await axios.post('/api/seats/leave', {
            _method: 'patch',
          });

          if (response.status === OK) {
            // Slack通知
            this.$slack('退席Bot', ':feet:', this.roomData.name + 'からユーザーが退席しました。');
          }
          break;

        case 'enterCall':
          // 通話室入室処理
          var response = await axios.post('/api/seats/move/' + seatObject.seatId, {
            _method: 'patch',
          });
          if (response.status === OK) {
            this.enterCall(seatObject.callId, seatObject.callCapacity);
          }
          break;

        case 'enterMedia':
          // メディア視聴ブース入室処理
          var response = await axios.post('/api/seats/move/' + seatObject.seatId, {
            _method: 'patch',
          });
          break;

        case 'returnSeat':
          // 元の座席に戻る処理
          var response = await axios.post('/api/seats/back', {
            _method: 'patch',
          });
          break;
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * 自習開始（自習室）
     */
    startStudy: async function () {
      this.$store.dispatch('alert/showOverlay', { color: '#228b22', message: '自習開始！' });

      // チャイム
      if (this.$store.getters['alert/isSoundOn']) {
        CHIME_SOUND.play();
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * 自習開始（スタッフルーム）
     */
    startWork: async function () {
      this.$store.dispatch('alert/showOverlay', {
        color: '#8a2be2',
        message: '自習開始！',
        description: 'ここはスタッフ用の座席です。',
      });

      // チャイム
      if (this.$store.getters['alert/isSoundOn']) {
        CHIME_SOUND.play();
      }

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * 自習室からの退席処理
     */
    leaveRoom: async function () {
      this.karte.dialog = false;

      // ロード開始
      this.loading = true;

      // 状態変更処理
      await this.userAction('leave');

      // フロア一覧へ
      this.$router.push({ name: 'entrance' });
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
      this.loading = true;

      // 通話室の初期化
      this.call.isEnter = false;
      this.call.id = '';

      // 状態変更処理
      await this.userAction('returnSeat');

      // ロード終了
      this.loading = false;
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
  },

  async mounted() {
    // ロード開始
    this.loading = true;

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
    this.canvas.defaultCursor = 'grab';

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
            hoverCursor: 'pointer',
            selectable: false, // 図形の選択を禁止
          })
        );

        // 誰かが座っている時
        if (seat.status !== null && seat.status != 'break') {
          this.setUser(seat);

          // ログインユーザーが座っており，座席が通話席の場合
          if (
            seat.id === this.authUser.seat_id &&
            (this.call.roles.includes(seat.role) || seat.role === 'speak' || seat.role === 'view')
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
        this.canvasMouseOver(event.target);
      }
    });

    // マウスオーバー解除イベントの設定
    this.canvas.on('mouse:out', (event) => {
      // オブジェクトのオーバー解除時にのみ実行
      if (event.target) {
        this.canvasMouseOut(event.target);
      }
    });

    // クリックイベントの設定
    this.canvas.on('mouse:down', (event) => {
      this.canvas.defaultCursor = 'grabbing';

      // オブジェクトのクリック時にのみ実行
      if (event.target) {
        // 入室前または自習室，スタッフルームに着席している場合はクリックを受け付ける
        if (
          this.authUser.seat === null ||
          this.authUser.seat.role === 'study' ||
          this.authUser.seat.role === 'staff'
        ) {
          this.canvasMouseDown(event.target);
        }
      }
    });

    // クリック終了イベントの設定
    this.canvas.on('mouse:up', () => {
      this.canvas.defaultCursor = 'grab';
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
      .listen('RoomUpdated', () => {
        // 管理画面から部屋データが更新された場合はリロード
        this.$router.go();
      })
      .listen('SeatStatusUpdated', (event) => {
        // 座席情報の更新
        this.roomData = event;
      })
      .listen('RoomStatusChanged', (event) => {
        // 部屋状態の更新
        this.roomStatus = event.status;
      });

    // ロード終了
    this.loading = false;
  },
};
</script>

<style lang="scss" scoped>
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
