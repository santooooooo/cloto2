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
                  <h2 class="place">
                    <b>ログイン</b>
                  </h2>
                  <v-text-field
                    v-model="loginField"
                    label="ユーザー名 または メールアドレス"
                  ></v-text-field>
                  <v-text-field
                    :append-icon="show1 ? 'far fa-eye' : 'far fa-eye-slash'"
                    :type="show1 ? 'text' : 'password'"
                    v-model="password"
                    label="パスワード"
                    @click:append="show1 = !show1"
                  ></v-text-field>
                  <div class="btn login">
                    <button
                      v-on:click="login()"
                      type="button"
                      class="btn btn-cloto-primary"
                      v-bind:disabled="isPush"
                    >
                      ログイン
                    </button>
                    <v-alert type="error" v-if="loginErrors">
                      <span v-for="msg in loginErrors.loginField" :key="msg">{{ msg }}</span>
                    </v-alert>
                  </div>
                </v-col>
              </v-row>
            </v-container>
          </v-form>

          <div class="mt-3">
            <p>
              アカウントをお持ちでない方は<router-link :to="{ name: 'register' }"
                >こちら</router-link
              >
            </p>
          </div>
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
      show1: false,
      error: '',
      loginField: '',
      password: '',
      dialog: true,
      isPush: true,
    };
  },
  computed: {
    _allTexts() {
      return [this.loginField, this.password];
    },
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    loginErrors() {
      return this.$store.state.auth.loginErrorMessages;
    },
  },
  watch: {
    dialog: function () {
      if (this.dialog === false) {
        this.$router.push({ name: 'home' });
      }
    },
    _allTexts(inputField) {
      if (inputField[0] != '' && inputField[1] != '') {
        this.isPush = false; //ログインボタンの有効化
      } else {
        this.isPush = true; //ログインボタンの無効化
      }
    },
  },
  methods: {
    login: async function () {
      // データの作成
      var params = {
        loginField: this.loginField,
        password: this.password,
      };

      // ログイン処理
      await this.$store.dispatch('auth/login', params);

      if (this.apiStatus) {
        // ページ遷移
        this.$router.push({ name: 'home' });
      }
    },
  },
  created() {
    // エラーの初期化
    this.$store.commit('auth/setLoginErrorMessages', null);
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.login-logo {
  display: block;
  margin: 0 auto;
}

h2 {
  margin-bottom: 1em;
}

.place {
  text-align: center;
  margin-top: 19px;
}

.btn {
  display: block;
  margin: 0 auto;
}

.mt-3 {
  text-align: center;
}
</style>
