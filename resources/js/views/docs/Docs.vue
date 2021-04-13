<template>
  <v-container id="docs">
    <router-view @scroll-to-anchor-point="scrollToAnchorPoint($event)" ref="docs" />
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
      this.$refs.docs.$refs[ref].scrollIntoView({ behavior: 'smooth' });
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#docs {
  background-color: $white;

  &::v-deep .container {
    scroll-margin: 80px;

    .text-left-border {
      border-left: 6px solid $dark-blue;
    }
  }
}
</style>
