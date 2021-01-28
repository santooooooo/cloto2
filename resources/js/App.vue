<template>
  <v-app>
    <!-- オフライン時の操作無効化用オーバーレイ -->
    <v-overlay z-index="9999" opacity="0.9" v-if="isOffline">
      <h1 class="font-weight-bold">インターネットに接続してください。</h1>
    </v-overlay>

    <!-- アラート -->
    <v-alert
      :value="alert.show"
      :type="alert.type"
      dark
      dense
      dismissible
      transition="scale-transition"
    >
      {{ alert.message }}
      <template v-slot:close>
        <v-icon class="ml-2" @click="$store.dispatch('alert/hide')">mdi-close-circle</v-icon>
      </template>
    </v-alert>

    <!-- メッセージオーバーレイ-->
    <v-overlay
      z-index="9997"
      opacity="0.9"
      :value="alert.overlay.show"
      :color="alert.overlay.color"
      dark
    >
      <p class="text-h1">{{ alert.overlay.message }}</p>
    </v-overlay>

    <!-- アナウンスオーバーレイ-->
    <v-overlay z-index="9996" opacity="0.9" :value="announce.message !== ''" color="primary" dark>
      <v-container>
        <p class="text-h4 mb-12">{{ announce.message }}</p>
        <v-row justify="center">
          <v-btn @click="announce.message = ''">閉じる</v-btn>
        </v-row>
      </v-container>
    </v-overlay>

    <!-- ヘッダー -->
    <Header :sit-room="sitRoom" @open-drawer="isOpenDrawer = true" />

    <!-- ドロワーメニュー -->
    <Drawer v-model="isOpenDrawer" @logout="logout" />

    <!-- メイン -->
    <v-main id="main">
      <router-view />
    </v-main>

    <!-- フッター -->
    <Footer @logout="logout" />

    <!-- 問い合わせ -->
    <Inquiry v-if="authCheck" />
  </v-app>
</template>

<script>
import Header from './Header';
import Drawer from './Drawer';
import Footer from './Footer';
import Inquiry from './Inquiry';
import { OK, NOT_FOUND, UNPROCESSABLE_ENTITY, INTERNAL_SERVER_ERROR } from '@/consts/status';

export default {
  components: {
    Header,
    Drawer,
    Footer,
    Inquiry,
  },
  data() {
    return {
      chime: new Audio(this.$storage('system') + 'chime.mp3'), // チャイム音
      isOffline: false, // オフライン状態
      setOnlineTimer: null, // オンライン状態の通知制御
      isOpenDrawer: false, // ドロワーメニューの表示制御
      sitRoom: null, // 着席中の部屋
      announce: {
        notification: new Audio(this.$storage('system') + 'announce.mp3'), // 通知音
        message: '', // アナウンス内容
      },
    };
  },
  computed: {
    isDebug() {
      return process.env.MIX_APP_DEBUG === 'true' ? true : false;
    },
    alert() {
      return this.$store.state.alert;
    },
    authCheck() {
      return this.$store.getters['auth/check'];
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    authCheck: function (val) {
      if (val === true) {
        // ログアウトの検知
        axios.interceptors.response.use((error) => {
          if (error.status === 401) {
            alert('ログアウトされました。');
            window.location.pathname = '/login';
            throw error.status;
          }

          return error;
        });

        // ログイン中は5分毎にオンライン状態を通知
        this.setOnlineTimer = setInterval(() => {
          axios.post('/api/online');
        }, 300000);
      }
    },
    'authUser.seat': async function (val, oldVal) {
      if (val != null && oldVal == null) {
        /**
         * 着席時
         */
        var response = await axios.get('/api/auth_sit');
        this.sitRoom = response.data;

        Echo.channel('room.' + this.sitRoom)
          .listen('AnnounceEvent', (event) => {
            // アナウンスイベントの受信開始
            if (this.$store.getters['alert/isSoundOn']) {
              this.announce.notification.play();
            }
            this.announce.message = event.message;
          })
          .listen('TimetableEvent', (event) => {
            // 時間割イベントの受信開始
            if (event.status === 'study') {
              // 自習時間
              this.$store.dispatch('alert/showOverlay', {
                color: '#ff4500',
                message: '自習時間です！',
              });
              // チャイム
              if (this.$store.getters['alert/isSoundOn']) {
                this.chime.play();
              }
            } else if (event.status === 'break') {
              // 休憩時間
              this.$store.dispatch('alert/showOverlay', {
                color: '#4169e1',
                message: '休憩時間です！',
              });
              // チャイム
              if (this.$store.getters['alert/isSoundOn']) {
                this.chime.play();
              }
            }
          });
      } else if (val == null && oldVal != null) {
        /**
         * 退席時
         */
        // 部屋イベントの受信終了
        Echo.leave('room.' + this.sitRoom);

        this.sitRoom = null;
      }
    },
  },
  methods: {
    /**
     * イベントの設定
     */
    setupEvents: function () {
      // オフライン時のイベント
      window.addEventListener('offline', this.offlineEvent);

      // オンライン復帰時のイベント
      window.addEventListener('online', this.onlineEvent);

      // 戻るボタンの無効化
      history.pushState(null, null, location.href);
      window.addEventListener('popstate', this.stopBackButtonEvent);

      // 戻るボタンでページに復帰した時のイベント
      window.addEventListener('pageshow', (event) => {
        this.pageBackEvent(event);
      });

      // エラー発生時のイベント
      Vue.config.errorHandler = (error) => {
        this.$store.dispatch('alert/error');
      };

      // エラー発生時のイベント
      window.addEventListener('error', (error) => {
        if (error.message !== 'ResizeObserver loop limit exceeded') {
          this.$store.dispatch('alert/error');
        }
      });

      // エラー発生時のイベント
      window.addEventListener('unhandledrejection', (error) => {
        this.$store.dispatch('alert/error');
      });
    },

    /**
     * オフライン時のイベント
     */
    offlineEvent: function () {
      this.isOffline = true;

      if (this.authUser.seat !== null) {
        alert(
          'インターネットに接続してください。5分以上接続が復帰しない場合は自動的に退席します。'
        );
      }
    },

    /**
     * オンライン復帰時のイベント
     */
    onlineEvent: function () {
      if (this.authCheck) {
        if (this.authUser.seat !== null && this.$route.name === 'room') {
          // 着席中の場合はリロード
          alert('接続が復帰しました。再読み込みします。');
          this.$router.go();
        } else {
          // オンライン状態を通知
          axios.post('/api/online');
        }
      }

      this.isOffline = false;
    },

    /**
     * 戻るボタンの無効化
     */
    stopBackButtonEvent: function () {
      this.$store.dispatch('alert/error', '戻るボタンでの操作は禁止されています。');
      this.$router.go(1);
    },

    /**
     * 戻るボタンでページに復帰した時のイベント
     *
     * @param event
     */
    pageBackEvent: function (event) {
      var historyTraversal =
        event.persisted ||
        (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
      if (historyTraversal) {
        // リロード（戻るボタンでアクセスすると休憩室に入室できない）
        this.$router.go();
      }
    },

    /**
     * ログアウト処理
     */
    logout: function () {
      this.isOpenDrawer = false;

      // ログインページへリダイレクト
      window.location.pathname = '/login';
      // ログアウト処理
      this.$store.dispatch('auth/logout');
    },
  },
  created() {
    // 複数タブ操作の禁止
    setInterval(() => {
      // タブ単位での記憶
      var sessionTabID = sessionStorage.getItem('tabID');
      // ブラウザ単位での記憶
      var localTabID = localStorage.getItem('tabID');

      if (sessionTabID === null) {
        // 新規タブのオープン時にIDを発行
        var tabID = new Date().getTime();
        sessionStorage.setItem('tabID', tabID);
        localStorage.setItem('tabID', tabID);
      } else if (sessionTabID !== localTabID) {
        // タブを無効化
        window.open('about:blank', '_self').close();
      }
    }, 1000);

    // 処理結果アラート表示処理の定義
    axios.interceptors.response.use((response) => {
      if (response.status === OK) {
        // メッセージが存在する場合のみ表示
        if (response.data.message) {
          this.$store.dispatch('alert/success', response.data.message);
        }
      } else if (response.status === NOT_FOUND) {
        // エラー発生時
        this.$store.dispatch('alert/error', 'データが見つかりませんでした。');
      } else if (
        response.status === UNPROCESSABLE_ENTITY ||
        response.status === INTERNAL_SERVER_ERROR
      ) {
        // エラー発生時
        this.$store.dispatch('alert/error', response.data.message || null);
      }

      return response;
    });

    // システムイベントの受信開始
    Echo.channel('system').listen('SystemDownEvent', () => {
      // メンテナンスモード開始
      this.$router.go();
    });
  },
  mounted() {
    // ボリュームの調整
    this.chime.volume = 0.8;
    this.announce.notification.volume = 0.8;

    // イベントの設定
    if (!this.isDebug) {
      this.setupEvents();
    }
  },
};
</script>

<style lang="scss" scoped>
.v-alert {
  position: fixed;
  z-index: 9998;
  top: 15px;
  left: 50%;
  transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
}

#main {
  min-height: 100vh;
}
</style>
