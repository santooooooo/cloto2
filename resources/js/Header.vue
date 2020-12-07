<template>
  <v-app-bar app dark>
    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" v-if="isRelease" />

    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <v-spacer v-if="!isRelease"></v-spacer>

    <v-btn
      depressed
      small
      color="#00acee"
      class="font-weight-bold"
      target="_blank"
      href="https://twitter.com/cloto_jp"
      v-if="!isRelease"
      ><v-icon>mdi-twitter</v-icon>cloto_jp</v-btn
    >

    <template v-slot:extension v-if="!authCheck">
      <v-tabs align-with-title>
        <v-tabs-slider color="yellow"></v-tabs-slider>

        <v-tab :to="{ name: 'index' }">Top</v-tab>
        <v-tab :to="{ name: 'concept' }">Concept</v-tab>
        <v-tab :to="{ name: 'product' }">Product</v-tab>
        <v-tab :to="{ name: 'news' }">News</v-tab>
        <v-tab :to="{ name: 'company' }">About us</v-tab>
        <v-tab :to="{ name: 'contact' }">Contact</v-tab>
      </v-tabs>
    </template>
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
    },
    authCheck() {
      return this.$store.getters['auth/check'];
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 10px;
}

a:hover {
  text-decoration: none;
}
</style>
