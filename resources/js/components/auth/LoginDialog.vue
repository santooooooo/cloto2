<template>
  <v-dialog v-model="dialog" max-width="440" @click:outside="$emit('close', false)">
    <v-card>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col>
              <!-- エラーメッセージ -->
              <v-alert type="error" v-if="loginErrors">
                <span v-for="(message, index) in loginErrors.userParam" :key="index">
                  {{ message }}
                </span>
              </v-alert>

              <!-- ロゴ -->
              <v-img
                :src="$storage('system') + 'logo.svg'"
                class="mx-auto mb-4"
                width="35"
                height="35"
                v-if="!loginErrors"
              ></v-img>

              <!-- タイトル -->
              <h2 class="mb-6 text-h4 font-weight-bold text-center">ログイン</h2>

              <!-- フォーム -->
              <v-form ref="loginForm" v-model="loginForm.validation.valid" lazy-validation>
                <v-text-field
                  v-model="loginForm.userParam"
                  :rules="loginForm.validation.userParamRules"
                  label="ユーザー名 または メールアドレス"
                  @keydown.enter="login()"
                ></v-text-field>

                <v-text-field
                  v-model="loginForm.password"
                  :rules="loginForm.validation.passwordRules"
                  label="パスワード"
                  :append-icon="loginForm.showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="loginForm.showPassword ? 'text' : 'password'"
                  @click:append="loginForm.showPassword = !loginForm.showPassword"
                  @keydown.enter="login()"
                ></v-text-field>

                <v-row justify="center" class="mt-4">
                  <v-btn
                    :loading="loginForm.loading"
                    :disabled="!loginForm.validation.valid"
                    @click="login()"
                    color="info"
                    class="font-weight-bold"
                    >ログイン
                  </v-btn>
                </v-row>
              </v-form>
            </v-col>
          </v-row>
        </v-container>

        <!-- 新規登録画面へのリンク -->
        <v-row justify="center">
          アカウントをお持ちでない方は
          <a class="blue--text" @click="$emit('open-register-dialog', true)">こちら</a>
        </v-row>
      </v-card-text>
    </v-card>
  </v-dialog>
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
  props: {
    isOpen: Boolean,
  },
  data() {
    return {
      dialog: false,
      loginForm: {
        userParam: '',
        password: '',
        showPassword: false,
        loading: false,
        validation: {
          valid: false,
          userParamRules: [(v) => !!v || '必須項目です。'],
          passwordRules: [(v) => !!v || 'パスワードは必須項目です。'],
        },
      },
    };
  },
  computed: {
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    loginErrors() {
      return this.$store.state.auth.loginErrorMessages;
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    isOpen: function (open) {
      if (open) {
        this.dialog = true;
      } else {
        this.dialog = false;
      }
    },
  },
  methods: {
    login: async function () {
      if (this.$refs.loginForm.validate()) {
        this.loginForm.loading = true;

        // ログイン処理
        await this.$store.dispatch('auth/login', {
          userParam: this.loginForm.userParam,
          password: this.loginForm.password,
        });

        if (this.apiStatus) {
          if (this.authUser.email_verified_at === null) {
            // 未認証時のリダイレクト
            window.location.pathname = '/email/verify';
          } else {
            // ページ遷移
            this.$router.push({ name: 'home' });
          }
        } else {
          this.loginForm.loading = false;
        }
      }
    },
  },
  created() {
    // エラーの初期化
    this.$store.commit('auth/setLoginErrorMessages', null);
  },
};
</script>
