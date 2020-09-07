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
import { INTERNAL_SERVER_ERROR } from '@/consts/error';

export default {
  computed: {
    errorCode() {
      return this.$store.state.error.code;
    },
  },
  watch: {
    errorCode: {
      // エラー発生
      handler(val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push({ name: 'INTERNAL_SERVER_ERROR' });
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
