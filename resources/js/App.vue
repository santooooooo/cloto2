<template>
  <!-- 画面サイズの最小を設定 -->
  <v-overlay v-if="!isDebug && !$route.meta.isPublic && width < minWidth">
    <h1 class="font-weight-bold">ウィンドウを拡大してください。</h1>
  </v-overlay>

  <v-app v-else>
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
      opacity="0.8"
      :value="alert.overlay.show"
      :color="alert.overlay.color"
      class="message-overlay"
      dark
    >
      <p>{{ alert.overlay.message }}</p>
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
  data() {
    return {
      width: window.innerWidth, // ウィンドウの横幅
      minWidth: 1350, // ウィンドウの最小サイズ
      isShowDrawer: false, // ドロワーメニューの表示制御
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
  methods: {
    /**
     * ウィンドウリサイズ時のイベント
     */
    resizeHandler: function () {
      this.width = window.innerWidth;
    },

    /**
     * 終了処理
     */
    closeApp: async function () {
      if (this.authCheck) {
        // 座席の開放
        if (this.authUser.seat !== null) {
          await this.$http.post(this.$endpoint('closeApp'));
        }
      }
    },

    /**
     * ログアウト処理
     */
    logout: async function () {
      // 終了処理
      await this.closeApp();

      // ログアウト処理
      await this.$store.dispatch('auth/logout');

      // トップページへリダイレクト
      if (this.$route.path !== this.$router.resolve({ name: 'index' }).href) {
        this.$router.push({ name: 'index' });
      }
    },
  },
  mounted: function () {
    // ウィンドウリサイズ時のイベント
    window.addEventListener('resize', this.resizeHandler);

    // ブラウザクローズ時のイベント
    window.addEventListener('beforeunload', this.closeApp);
  },
};
</script>

<style lang="scss" scoped>
.v-alert {
  position: fixed;
  z-index: 9999;
  top: 15px;
  left: 50%;
  transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
}

.message-overlay {
  z-index: 9998;

  p {
    font-size: 100px;
  }
}

#main {
  min-height: 100vh;
}
</style>
