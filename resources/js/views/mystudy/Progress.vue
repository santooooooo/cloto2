<template>
  <v-container>
    <h1>てすととととと</h1>
    <router-link :to="{ name: 'sample' }">コンテンツページ例</router-link>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: 'マイスタディ',
      };
    },
  },
};
</script>

<style lang="scss" scoped></style>
