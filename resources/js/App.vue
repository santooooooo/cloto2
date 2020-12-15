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

    <!-- ヘッダー -->
    <Header @show-drawer="isShowDrawer = true" @logout="logout" @leave="leave" />

    <!-- ドロワーメニュー -->
    <Drawer v-model="isShowDrawer" @logout="logout" v-if="isRelease" />

    <!-- メイン -->
    <v-main id="main">
      <router-view />
    </v-main>

    <!-- フッター -->
    <Footer @logout="logout" @leave="leave" />
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
     * ログアウト処理
     */
    logout: async function () {
      // ログアウト処理
      await this.$store.dispatch('auth/logout');

      // トップページへリダイレクト
      if (this.$route.path != this.$router.resolve({ name: 'index' }).href) {
        this.$router.push({ name: 'index' });
      }
    },

    /**
     * 退席処理
     */
    leave: async function () {
      if (this.authUser.seat_id != null) {
        var endpoint = '';
        endpoint = this.$endpoint('seatLeave');
        await this.$http.post(endpoint);
      }
    },
  },
  mounted: function () {
    // ウィンドウリサイズ時のイベントを設定
    window.addEventListener('resize', this.resizeHandler);
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

#main {
  min-height: 100vh;
}
</style>
