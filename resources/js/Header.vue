<template>
  <v-app-bar app dark height="64px" v-if="!isSmartphone">
    <v-app-bar-nav-icon @click.stop="$emit('open-drawer')" v-if="authCheck" />

    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header_logo.svg'" />
    </router-link>

    <v-spacer></v-spacer>

    <v-btn text x-large class="font-weight-bold" :to="{ name: 'register' }" v-if="!authCheck">
      新規登録
    </v-btn>

    <v-btn text x-large class="font-weight-bold mx-12" :to="{ name: 'login' }" v-if="!authCheck">
      ログイン
    </v-btn>

    <!-- 教室へ戻るボタン -->
    <v-btn
      depressed
      color="primary"
      :to="{ name: 'room', params: { roomId: sitRoom } }"
      v-if="$route.name !== 'room' && sitRoom"
    >
      教室へ戻る
    </v-btn>

    <!-- 通知音ボタン -->
    <v-btn
      color="white"
      icon
      class="mx-6"
      @click="$store.dispatch('alert/switchSound')"
      v-if="authCheck"
    >
      <v-icon large>
        {{ $store.getters['alert/isSoundOn'] ? 'mdi-volume-high' : 'mdi-volume-off' }}
      </v-icon>
    </v-btn>
  </v-app-bar>

  <v-app-bar app dark height="64px" v-else>
    <img :src="$storage('system') + 'header_logo.svg'" />
  </v-app-bar>
</template>

<script>
export default {
  props: {
    sitRoom: Number, // 着席中の部屋
  },
  computed: {
    isSmartphone() {
      if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
        return true;
      } else {
        return false;
      }
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
