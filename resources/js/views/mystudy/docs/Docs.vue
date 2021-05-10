<template>
  <v-container id="docs">
    <router-view />
  </v-container>
</template>

<style lang="scss" scoped>
@import '~/_variables';

#docs {
  background-color: $white;

  // router-view内の要素のCSS
  &::v-deep {
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
