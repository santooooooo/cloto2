<template>
  <v-app-bar app dark>
    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <v-spacer></v-spacer>

    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" v-if="isRelease" />

    <v-btn
      depressed
      color="#00acee"
      class="font-weight-bold"
      target="_blank"
      href="https://twitter.com/cloto_jp"
      v-else
      ><v-icon>mdi-twitter</v-icon>&nbsp;@cloto_jp</v-btn
    >
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 15px 0;
}

a:hover {
  text-decoration: none;
}
</style>
