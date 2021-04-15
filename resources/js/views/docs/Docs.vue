<template>
  <v-container id="docs">
    <router-view @scroll-to-anchor-point="scrollToAnchorPoint($event)" ref="content" />
  </v-container>
</template>

<script>
export default {
  methods: {
    /**
     * スムーズスクロール
     *
     * @param {String} ref - スクロール先
     */
    scrollToAnchorPoint: function (ref) {
      this.$refs.content.$refs[ref].scrollIntoView({ behavior: 'smooth' });
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#docs {
  background-color: $white;

  // router-view内の要素のCSS
  &::v-deep .container {
    scroll-margin: 80px;

    .index {
      position: fixed;
      margin-left: 3%;

      li {
        cursor: pointer;
      }
    }

    .text-left-border {
      border-left: 6px solid $dark-blue;
    }
  }
}
</style>
