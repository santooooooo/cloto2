<template>
  <v-app>
    <!-- ヘッダー -->
    <Header @show-drawer="isShowDrawer = true" />

    <!-- ドロワーメニュー -->
    <Drawer v-if="isRelease" />

    <!-- メイン -->
    <v-main>
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
      isShowDrawer: false, // ドロワーメニューの表示
    };
  },
  computed: {
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
    },
    errorCode() {
      return this.$store.state.error.code;
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
