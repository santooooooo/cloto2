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
    alert() {
      return this.$store.state.alert;
    },
  },
  methods: {
    /**
     * ログアウト処理
     */
    logout: async function () {
      // ログアウト処理
      this.$http.post(this.$endpoint('logout'));

      // トップページへリダイレクト
      window.location = '/admin/login';
    },
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
