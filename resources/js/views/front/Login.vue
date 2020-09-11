<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="440">
      <v-card>
        <v-spacer></v-spacer>
        <v-card-text>
          <v-form>
            <v-container>
              <v-row>
                <v-col>
                  <img
                    :src="$storage('system') + 'logo.png'"
                    class="login-logo"
                    alt="logo"
                    width="35"
                    height="35"
                  />
                  <h2>
                    <b>ログイン</b>
                  </h2>
                  <v-text-field
                    v-model="loginField"
                    label="ユーザー名 または メールアドレス"
                  ></v-text-field>
                  <v-text-field v-model="password" label="パスワード"></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-form>

          <v-row justify="center">
            <button
              v-on:click="
                login();
                dialog = false;
              "
              type="button"
              class="btn btn-cloto-primary"
              v-bind:disabled="isPush"
            >
              ログイン
            </button>

            <div class="mt-3">
              <router-link :to="{ name: 'register' }">Have not account</router-link>
            </div>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: 'ログイン',
      };
    },
  },
  data() {
    return {
      error: '',
      loginField: '',
      password: '',
      remember: false,
      dialog: true,
      isPush: true,
    };
  },
  computed: {
    _allTexts() {
      return [this.loginField, this.password];
    },
  },
  watch: {
    dialog: function() {
      if (this.dialog === false) {
        this.$router.push({ name: 'home' });
      }
    },
    _allTexts(inputField) {
      if (inputField[0] != '' && inputField[1] != '') {
        this.isPush = false; //ログインボタンの有効か
      } else {
        this.isPush = true; //ログインボタンの無効化
      }
    },
  },
  methods: {
    login: async function() {
      //dialog = false;
      // データの作成
      var params = {
        loginField: this.loginField,
        password: this.password,
        remember: this.remember,
      };

      console.log(params);

      // ログイン処理
      await this.$store.dispatch('auth/login', params);

      // ページ遷移
      this.$router.push({ name: 'home' });
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.login-logo {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

h2 {
  margin-bottom: 1em;
}
</style>
