<template>
  <v-app-bar app dark height="64px" v-if="!isSmartphone">
    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" v-if="isRelease && authCheck" />

    <router-link :to="authCheck ? { name: 'entrance' } : { name: 'index' }">
      <img :src="$storage('system') + 'header_logo.svg'" />
    </router-link>

    <v-spacer></v-spacer>

    <v-btn
      text
      x-large
      class="font-weight-bold"
      :to="{ name: 'register' }"
      v-if="isRelease && !authCheck"
    >
      新規登録
    </v-btn>

    <v-btn
      text
      x-large
      class="font-weight-bold mx-12"
      :to="{ name: 'login' }"
      v-if="isRelease && !authCheck"
    >
      ログイン
    </v-btn>

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

  <v-app-bar app dark height="64px" v-else>
    <img :src="$storage('system') + 'header_logo.svg'" />
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    isSmartphone() {
      if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
        return true;
      } else {
        return false;
      }
    },
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
