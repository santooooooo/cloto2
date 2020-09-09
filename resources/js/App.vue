<template>
  <div>
    <!-- <v-app> -->
    <!-- <v-app-bar app color="primary" dark> -->
    <vue-header></vue-header>
    <!-- </v-app-bar> -->

    <!-- <v-main> -->
    <router-view />
    <!-- </v-main> -->
    <!-- </v-app> -->
  </div>
</template>

<script>
import { UNAUTHORIZED, INTERNAL_SERVER_ERROR } from '@/consts/status';

export default {
  computed: {
    errorCode() {
      return this.$store.state.error.code;
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
          await this.$http.get(this.$endpoint('GET:regenerateToken'));
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

<style></style>
