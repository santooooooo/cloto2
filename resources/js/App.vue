<template>
  <v-app>
    <!-- アラート -->
    <v-alert v-if="alert.show" :type="alert.type" dark dense dismissible>
      {{ alert.message }}
    </v-alert>

    <!-- ヘッダー -->
    <Header @show-drawer="isShowDrawer = true" @logout="logout" @leave="leave" />

    <!-- ドロワーメニュー -->
    <Drawer v-model="isShowDrawer" @logout="logout" v-if="isRelease" />

    <!-- メイン -->
    <v-main>
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
      isShowDrawer: false, // ドロワーメニューの表示制御
    };
  },
  computed: {
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
    },
    alert() {
      return this.$store.state.alert;
    },
    errorCode() {
      return this.$store.state.error.code;
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    logout: async function () {
      // ログアウト処理
      await this.$store.dispatch('auth/logout');

      // トップページへリダイレクト
      if (this.$route.path != this.$router.resolve({ name: 'index' }).href) {
        this.$router.push({ name: 'index' });
      }
    },
    leave: async function () {
      if (this.authUser.seat_id != null) {
        var endpoint = '';
        endpoint = this.$endpoint('seatLeave');
        await this.$http.post(endpoint);
      }
    },
  },
  watch: {
    errorCode: {
      // エラー発生
      async handler(val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push({ name: 'INTERNAL_SERVER_ERROR' });
        } else if (val === UNAUTHORIZED) {
          // トークンの再発行
          await this.$http.get(this.$endpoint('regenerateToken'));
          // ストアのuserをクリア
          this.$store.commit('auth/setUser', null);
          // ログイン画面へ
          // this.$router.push({ name: 'login' });
          console.log('419');
        }
      },
      immediate: true,
    },
    $route() {
      // エラーの初期化
      this.$store.commit('error/setCode', null);
    },
  },
};
</script>

<style lang="scss" scoped>
.v-alert {
  position: absolute;
  z-index: 9999;
  top: 15px;
  left: 50%;
  transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
}
</style>
