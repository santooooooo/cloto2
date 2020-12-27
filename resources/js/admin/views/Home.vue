<template>
  <v-container>
    <h1>管理画面</h1>
    <h5>{{ authUser.handlename }}様 ご利用ありがとうございます。</h5>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: '管理画面',
      };
    },
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>
