<template>
  <v-dialog v-model="dialog" max-width="440">
    <v-card>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col>
              <!-- エラーメッセージ -->
              <v-alert type="error" v-if="registerErrors">
                <span v-if="registerErrors.username">
                  <span v-for="msg in registerErrors.username" :key="msg">{{ msg }}</span>
                </span>
                <span v-if="registerErrors.email">
                  <span v-for="msg in registerErrors.email" :key="msg">{{ msg }}</span>
                </span>
              </v-alert>

              <!-- ロゴ -->
              <v-img
                :src="$storage('system') + 'logo.png'"
                class="mx-auto mb-4"
                width="35"
                height="35"
                v-if="!registerErrors"
              ></v-img>

              <!-- タイトル -->
              <h2 class="mb-6 text-h4 font-weight-bold text-center">新規登録</h2>

              <!-- フォーム -->
              <v-form ref="form" v-model="registerFormValidation.valid" lazy-validation>
                <v-text-field
                  v-model="registerForm.username"
                  :rules="registerFormValidation.usernameRules"
                  label="ユーザー名"
                  counter="16"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.email"
                  :rules="registerFormValidation.emailRules"
                  label="メールアドレス"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.password"
                  :rules="registerFormValidation.passwordRules"
                  label="パスワード"
                  :append-icon="registerForm.showPassword ? 'far fa-eye' : 'far fa-eye-slash'"
                  :type="registerForm.showPassword ? 'text' : 'password'"
                  class="input-group--focused"
                  counter="64"
                  @click:append="registerForm.showPassword = !registerForm.showPassword"
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.passwordConfirmation"
                  :rules="registerFormValidation.passwordConfirmationRules"
                  label="パスワード再入力"
                  :append-icon="
                    registerForm.showPasswordConfirmation ? 'far fa-eye' : 'far fa-eye-slash'
                  "
                  :type="registerForm.showPasswordConfirmation ? 'text' : 'password'"
                  counter="64"
                  @click:append="
                    registerForm.showPasswordConfirmation = !registerForm.showPasswordConfirmation
                  "
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.handlename"
                  :rules="registerFormValidation.handlenameRules"
                  label="表示名"
                  counter="16"
                ></v-text-field>

                <v-row justify="center" class="mt-4">
                  <v-btn
                    :loading="registerForm.loading"
                    :disabled="!registerFormValidation.valid"
                    @click="register()"
                    color="info"
                    class="font-weight-bold"
                    >登録
                  </v-btn>
                </v-row>
              </v-form>
            </v-col>
          </v-row>
        </v-container>

        <!-- ログイン画面へのリンク -->
        <v-row justify="center">
          既にアカウントはお持ちの方は
          <router-link :to="{ name: 'login' }">こちら</router-link>
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
        inner: '新規登録',
      };
    },
  },
  data() {
    return {
      dialog: true,
      registerForm: {
        username: '',
        email: '',
        password: '',
        passwordConfirmation: '',
        handlename: '',
        showPassword: false,
        showPasswordConfirmation: false,
        loading: false,
      },
      registerFormValidation: {
        valid: false,
        usernameRules: [
          (v) => !!v || 'ユーザー名は必須項目です。',
          (v) => v.length >= 4 || '4文字以上で入力してください。',
          (v) => v.length <= 16 || '16文字以下で入力してください。',
        ],
        emailRules: [
          (v) => !!v || 'メールアドレスは必須項目です。',
          (v) => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return pattern.test(v) || 'メールアドレスが無効です。';
          },
        ],
        passwordRules: [
          (v) => !!v || 'パスワードは必須項目です。',
          (v) => v.length >= 8 || '8文字以上で入力してください。',
          (v) => v.length <= 64 || '64文字以下で入力してください。',
        ],
        passwordConfirmationRules: [
          (v) => !!v || 'パスワードの再入力は必須項目です。',
          (v) => v === this.registerForm.password || 'パスワードが一致しません。',
        ],
        handlenameRules: [
          (v) => !!v || '表示名は必須項目です。',
          (v) => v.length <= 16 || '16文字以下で入力してください。',
        ],
      },
    };
  },
  computed: {
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    registerErrors() {
      return this.$store.state.auth.registerErrorMessages;
    },
  },
  watch: {
    dialog: function () {
      // モーダルが閉じたらリダイレクト
      if (this.dialog === false) {
        this.$router.push({ name: 'index' });
      }
    },
  },
  methods: {
    register: async function () {
      if (this.$refs.form.validate()) {
        this.registerForm.loading = true;

        // データの作成
        var input = {
          username: this.registerForm.username,
          email: this.registerForm.email,
          password: this.registerForm.password,
          password_confirmation: this.registerForm.passwordConfirmation,
          handlename: this.registerForm.handlename,
        };

        // 新規登録処理
        await this.$store.dispatch('auth/register', input);

        if (this.apiStatus) {
          // ページ遷移
          this.$router.push({ name: 'home' });
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
