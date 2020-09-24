<template>
  <v-footer app dark absolute padless v-if="!authCheck">
    <v-row justify="center" no-gutters>
      <v-btn color="white" text rounded class="my-2" :to="{ name: 'index' }"> トップページ </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="{ name: 'register' }"> 新規登録 </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="{ name: 'login' }"> ログイン </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'hoge'"> 利用規約 </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'https://twitter.com/cloto_jp'">
        Twitter
      </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'mailto:info@cloto.jp'"> E-Mail </v-btn>

      <v-col dark class="py-4 text-center white--text" cols="12">
        {{ new Date().getFullYear() }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>
  </v-footer>

  <v-footer app dark absolute padless v-else>
    <v-row justify="center" no-gutters>
      <v-btn color="white" text rounded class="my-2" :to="{ name: 'home' }"> ホーム </v-btn>

      <v-btn color="white" text rounded class="my-2" @click="$emit('logout')"> ログアウト </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'hoge'"> 利用規約 </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'https://twitter.com/cloto_jp'">
        Twitter
      </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'mailto:info@cloto.jp'"> E-Mail </v-btn>

      <v-col dark class="py-4 text-center white--text" cols="12">
        {{ new Date().getFullYear() }} — <strong>© CLOTO Team</strong>
      </v-col>
    </v-row>
  </v-footer>
</template>

<script>
export default {
  computed: {
    authCheck() {
      return this.$store.getters['auth/check'];
    },
  },
};
</script>
