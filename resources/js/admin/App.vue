<template>
  <v-app>
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
import { UNAUTHORIZED, INTERNAL_SERVER_ERROR } from '@/consts/status';

export default {
  components: {
    Header,
    Drawer,
    Footer,
  },
  computed: {
    isDebug() {
      return process.env.MIX_APP_DEBUG === 'true' ? true : false;
    },
    alert() {
      return this.$store.state.alert;
    },
  },
  methods: {
    /**
     * イベントの設定
     */
    setupEvents: function () {
      // 戻るボタンの無効化
      history.pushState(null, null, location.href);
      window.addEventListener('popstate', this.stopBackButtonEvent);

      // 戻るボタンでページに復帰した時のイベント
      window.addEventListener('pageshow', (event) => {
        this.pageBackEvent(event);
      });

      // エラー発生時のイベント
      Vue.config.errorHandler = (event) => {
        this.$store.dispatch('alert/show', {
          type: 'error',
          message: 'エラーが発生しました。再読み込みしてください。',
        });
      };

      // エラー発生時のイベント
      window.addEventListener('error', (event) => {
        this.$store.dispatch('alert/show', {
          type: 'error',
          message: 'エラーが発生しました。再読み込みしてください。',
        });
      });

      // エラー発生時のイベント
      window.addEventListener('unhandledrejection', (event) => {
        this.$store.dispatch('alert/show', {
          type: 'error',
          message: 'エラーが発生しました。再読み込みしてください。',
        });
      });
    },

    /**
     * 戻るボタンの無効化
     */
    stopBackButtonEvent: function () {
      this.$store.dispatch('alert/show', {
        type: 'error',
        message: '戻るボタンでの操作は禁止されています。',
      });

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
      this.$http.post(this.$endpoint('logout'));

      // トップページへリダイレクト
      window.location.pathname = '/admin/login';
    },
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
