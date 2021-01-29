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

    <!-- ヘッダー -->
    <Header @logout="logout" />

    <!-- ドロワーメニュー -->
    <Drawer @logout="logout" />

    <!-- メイン -->
    <v-main id="main">
      <router-view />
    </v-main>

    <!-- フッター -->
    <Footer @logout="logout" />
  </v-app>
</template>

<script>
import Header from './Header';
import Drawer from './Drawer';
import Footer from './Footer';
import { OK, NOT_FOUND, UNPROCESSABLE_ENTITY, INTERNAL_SERVER_ERROR } from '@/consts/status';

export default {
  components: {
    Header,
    Drawer,
    Footer,
  },
  data() {
    return {
      isOffline: false, // オフライン状態
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
  },
  watch: {
    authCheck: function (val) {
      if (val === true) {
        // ログアウトの検知
        axios.interceptors.response.use((error) => {
          if (error.status === 401) {
            alert('ログアウトされました。');
            window.location.pathname = '/admin/login';
            throw new Error(error.status);
          }

          return error;
        });
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
        this.$store.dispatch('alert/error');
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
      alert('インターネットに接続してください。');
    },

    /**
     * オンライン復帰時のイベント
     */
    onlineEvent: function () {
      alert('接続が復帰しました。再読み込みします。');
      this.$router.go();
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
        // リロード
        this.$router.go();
      }
    },

    /**
     * ログアウト処理
     */
    logout: async function () {
      // ログアウト処理
      await this.$store.dispatch('auth/logout');
      // ログインページへリダイレクト
      window.location.pathname = '/admin/login';
    },
  },
  created() {
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
    Echo.channel('system').listen('SystemDowned', () => {
      // メンテナンスモード開始
      this.$router.go();
    });
  },
  mounted() {
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
