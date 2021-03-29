<template>
  <v-footer dark padless v-if="!isSmartphone">
    <v-row justify="center" no-gutters class="black white--text">
      <v-btn
        color="white"
        text
        rounded
        exact
        class="my-2"
        :to="authCheck ? { name: 'entrance' } : { name: 'index' }"
      >
        ホーム
      </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'map' }">施設一覧 </v-btn>

      <v-btn
        color="white"
        text
        rounded
        exact
        class="my-2"
        @click="$emit('logout')"
        v-if="authCheck"
      >
        ログアウト
      </v-btn>

      <!-- <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'terms' }">
        利用規約
      </v-btn> -->

      <v-btn
        color="white"
        text
        rounded
        exact
        class="my-2"
        href="https://twitter.com/cloto_jp"
        target="_blank"
      >
        Twitter
      </v-btn>

      <v-col class="py-4 text-center white--text" cols="12">
        {{ Moment().format('YYYY') }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>
  </v-footer>

  <v-footer dark padless v-else>
    <v-row justify="center" no-gutters class="black white--text">
      <v-btn
        color="white"
        text
        rounded
        exact
        class="my-2"
        href="https://twitter.com/cloto_jp"
        target="_blank"
      >
        Twitter
      </v-btn>

      <v-col class="py-4 text-center white--text" cols="12">
        {{ Moment().format('YYYY') }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>
  </v-footer>
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
    authCheck() {
      return this.$store.getters['auth/check'];
    },
  },
};
</script>

<style lang="scss">
.v-btn:hover {
  text-decoration: none !important;
}
</style>
