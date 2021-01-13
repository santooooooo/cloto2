<template>
  <v-footer dark padless>
    <v-row justify="center" no-gutters class="black white--text" v-if="!isRelease">
      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'index' }">
        トップページ
      </v-btn>

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
        {{ new Date().getFullYear() }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>

    <v-row justify="center" no-gutters class="black white--text" v-if="isRelease && !authCheck">
      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'index' }">
        トップページ
      </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'register' }">
        新規登録
      </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'login' }">
        ログイン
      </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'company' }"> About </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'terms' }">
        利用規約
      </v-btn>

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
        {{ new Date().getFullYear() }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>

    <v-row justify="center" no-gutters class="black white--text" v-if="isRelease && authCheck">
      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'entrance' }">
        ホーム
      </v-btn>

      <v-btn
        color="white"
        text
        rounded
        exact
        class="my-2"
        @click="
          $emit('leave');
          $emit('logout');
        "
      >
        ログアウト
      </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'company' }"> About </v-btn>

      <v-btn color="white" text rounded exact class="my-2" :to="{ name: 'terms' }">
        利用規約
      </v-btn>

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
        {{ new Date().getFullYear() }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>
  </v-footer>
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

<style lang="scss">
.v-btn:hover {
  text-decoration: none !important;
}
</style>
