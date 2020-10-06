<template>
  <v-footer app dark absolute padless>
    <v-row justify="center" no-gutters class="black white--text" v-if="!authCheck">
      <v-btn color="white" text rounded class="my-2" :to="{ name: 'index' }"> トップページ </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="{ name: 'register' }"> 新規登録 </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="{ name: 'login' }"> ログイン </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'hoge'"> 利用規約 </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'https://twitter.com/cloto_jp'">
        Twitter
      </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'mailto:info@cloto.jp'"> E-Mail </v-btn>
    </v-row>

    <v-row justify="center" no-gutters class="black white--text" v-else>
      <v-btn color="white" text rounded class="my-2" :to="{ name: 'home' }"> ホーム </v-btn>

      <v-btn color="white" text rounded class="my-2" @click="$emit('logout')"> ログアウト </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'hoge'"> 利用規約 </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'https://twitter.com/cloto_jp'">
        Twitter
      </v-btn>

      <v-btn color="white" text rounded class="my-2" :to="'mailto:info@cloto.jp'"> E-Mail </v-btn>
    </v-row>

    <v-card flat tile class="white--text text-center">
      <v-row>
        <v-card-title class="mx-auto">プライバシーポリシー</v-card-title>
      </v-row>

      <v-card-text class="white--text pt-0">
        <v-row>
          <v-spacer></v-spacer>

          <v-col cols="12" md="5" lg="3">
            <h6 class="text-subtitle-2">個人情報の利用目的</h6>
            <p>
              当サイトでは、お問い合わせやアカウント登録の際、名前やメールアドレス等の個人情報を入力いただく場合がございます。
              取得した個人情報は、お問い合わせに対する回答や必要な情報を電子メールなどをでご連絡する場合に利用させていただくものであり、これらの目的以外では利用いたしません。
            </p>
          </v-col>

          <v-col cols="12" md="5" lg="3">
            <h6 class="text-subtitle-2">アクセス解析ツール</h6>
            <p>
              当サイトでは、Google社のアクセス解析ツール"Googleアナリティクス"と、ユーザーローカル社のヒートマップツール"User
              Heat"を利用しています。
              これらのツールはトラフィックデータの収集のためにCookieを使用しています。
              トラフィックデータは匿名で収集されており、個人を特定するものではありません。
            </p>
          </v-col>

          <v-spacer></v-spacer>
        </v-row>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-text class="white--text">
        {{ new Date().getFullYear() }} — <strong>© CLOTO Team</strong>
      </v-card-text>
    </v-card>
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
