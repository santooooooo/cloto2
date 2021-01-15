<template>
  <v-app>
    <!-- メンテナンス時の操作無効化用オーバーレイ -->
    <v-overlay z-index="9999" opacity="1" v-if="isSystemDown">
      <h1 class="font-weight-bold text-center">メンテナンス中です。</h1>
      <h3 class="font-weight-bold text-center mt-12">
        毎日午前３～５時はメンテナンスのためサービスを停止します。<br />明日もご利用お待ちしております。
      </h3>
    </v-overlay>

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
      opacity="0.8"
      :value="alert.overlay.show"
      :color="alert.overlay.color"
      dark
    >
      <p class="overlay-message">{{ alert.overlay.message }}</p>
    </v-overlay>

    <!-- ヘッダー -->
    <Header @show-drawer="isShowDrawer = true" />

    <!-- ドロワーメニュー -->
    <Drawer v-model="isShowDrawer" @logout="logout" v-if="isRelease" />

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
import { UNAUTHORIZED, INTERNAL_SERVER_ERROR } from '@/consts/status';

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
      isSystemDown: false, // メンテナンスモード
      isOffline: false, // オフライン状態
      setOnlineTimer: null, // オンライン状態の通知制御
      isShowDrawer: false, // ドロワーメニューの表示制御
      sitRoom: null, // 着席中の部屋
    };
  },
  computed: {
    isDebug() {
      return process.env.MIX_APP_DEBUG === 'true' ? true : false;
    },
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
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
      if (val) {
        // ログイン中は5分毎にオンライン状態を通知
        this.setOnlineTimer = setInterval(() => {
          axios.get('/api/online');
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

        // 時間割イベントの受信開始
        Echo.channel('room.' + this.sitRoom).listen('TimetableEvent', (event) => {
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
          window.location.reload();
        } else {
          // オンライン状態を通知
          axios.get('/api/online');
        }
      }

      this.isOffline = false;
    },

    /**
     * 戻るボタンの無効化
     */
    stopBackButtonEvent: function () {
      this.$store.dispatch('alert/error', '戻るボタンでの操作は禁止されています。');

      history.go(1);
    },

    /**
     * 戻るボタンでページに復帰した時のイベント
     *
     * @param event
     */
    pageBackEvent: function (event) {
      var historyTraversal =
        event.persisted ||
        (typeof window.performance != 'undefined' && window.performance.navigation.type === 2);
      if (historyTraversal) {
        // リロード（戻るボタンでアクセスすると休憩室に入室できない）
        window.location.reload();
      }
    },

    /**
     * ログアウト処理
     */
    logout: async function () {
      // ログアウト処理
      await this.$store.dispatch('auth/logout');
      // リロード
      window.location.reload();
    },
  },
  created() {
    // システムイベントの受信開始
    Echo.channel('system').listen('SystemDownEvent', () => {
      // メンテナンスモード開始
      this.isSystemDown = true;
    });
  },
  mounted() {
    // ボリュームの調整
    this.chime.volume = 0.2;

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

.overlay-message {
  font-size: 100px;
}

#main {
  min-height: 100vh;
}
</style>
