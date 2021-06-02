<template>
  <v-container fluid id="content">
    <!-- 目次用 -->
    <h2 class="font-weight-bold" style="display: none">
      <span>クリアおめでとう！！</span>
    </h2>

    <v-sheet color="#f6bf00" width="100%" height="80vh" class="mb-12">
      <h1 class="text-h1 white--text">{{ title }}</h1>
    </v-sheet>

    <v-row justify="center" class="mb-4">
      <v-btn dark color="primary" :to="{ name: 'home' }">みんなを助けに行く</v-btn>
    </v-row>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: this.title,
      };
    },
  },
  data() {
    return {
      title: 'CLEAR', // コンテンツタイトル
      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>

<style lang="scss" scoped>
.v-sheet {
  position: relative;

  h1 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
  }
}
</style>
