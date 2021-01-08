<template>
  <v-app-bar app dark>
    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" v-if="isRelease" />

    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <v-tabs align-with-title v-if="!isRelease || !authCheck">
      <v-tabs-slider color="yellow"></v-tabs-slider>

      <v-tab :to="{ name: 'index' }">Top</v-tab>
      <!-- <v-tab :to="{ name: 'concept' }">Concept</v-tab> -->
      <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">
          <!-- <v-btn color="primary" dark v-bind="attrs" v-on="on"> Dropdown </v-btn> -->
          <v-tab v-bind="attrs" v-on="on">Concept</v-tab>
        </template>
        <v-list>
          <v-list-item :to="{ name: cloto.to }" v-for="(cloto, index) in selectCloto" :key="index">
            <v-list-item-title>{{ cloto.text }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <!-- <v-tab :to="{ name: 'concept' }">Concept</v-tab> -->
      <v-tab :to="{ name: 'product' }">Product</v-tab>
      <v-tab :to="{ name: 'news' }">News</v-tab>
      <v-tab :to="{ name: 'company' }">About us</v-tab>
      <v-tab :to="{ name: 'contact' }">Contact</v-tab>
    </v-tabs>

    <v-spacer></v-spacer>

    <!-- 通知音ボタン -->
    <v-btn
      color="white"
      icon
      class="mr-6"
      @click="$store.dispatch('alert/switchSound')"
      v-if="isRelease && authCheck"
    >
      <v-icon large>
        {{ $store.getters['alert/isSoundOn'] ? 'mdi-volume-high' : 'mdi-volume-off' }}
      </v-icon>
    </v-btn>

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
  </v-app-bar>
</template>

<script>
export default {
  data() {
    return {
      tab: null,
      selectCloto: [
        {
          img: '',
          text: 'プログラミング学習施設CLOTO',
          to: 'concept',
        },
        {
          img: '',
          text: 'バーチャル商業施設CLOTO',
          to: 'news',
        },
      ],
    };
  },
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
