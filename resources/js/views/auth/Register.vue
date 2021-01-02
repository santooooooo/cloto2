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
                :src="$storage('system') + 'logo.svg'"
                class="mx-auto mb-4"
                width="35"
                height="35"
                v-if="!registerErrors"
              ></v-img>

              <!-- タイトル -->
              <h2 class="mb-6 text-h4 font-weight-bold text-center">新規登録</h2>

              <!-- フォーム -->
              <v-form ref="registerForm" v-model="registerForm.validation.valid" lazy-validation>
                <v-text-field
                  v-model="registerForm.username"
                  :rules="registerForm.validation.usernameRules"
                  label="ユーザー名"
                  placeholder="cloto_jp"
                  maxlength="16"
                  counter
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.email"
                  :rules="registerForm.validation.emailRules"
                  label="メールアドレス"
                  placeholder="email@cloto.jp"
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.password"
                  :rules="registerForm.validation.passwordRules"
                  label="パスワード"
                  :append-icon="registerForm.showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="registerForm.showPassword ? 'text' : 'password'"
                  maxlength="64"
                  counter
                  @click:append="registerForm.showPassword = !registerForm.showPassword"
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.passwordConfirmation"
                  :rules="registerForm.validation.passwordConfirmationRules"
                  label="パスワード再入力"
                  type="password"
                  maxlength="64"
                  counter
                ></v-text-field>

                <v-text-field
                  v-model="registerForm.handlename"
                  :rules="registerForm.validation.handlenameRules"
                  label="表示名"
                  placeholder="CLOTOくん"
                  maxlength="16"
                  counter
                ></v-text-field>

                <v-row justify="center" class="mt-4">
                  <v-btn
                    :loading="registerForm.loading"
                    :disabled="!registerForm.validation.valid"
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
        loading: false,
        validation: {
          valid: false,
          usernameRules: [
            (v) => !!v || 'ユーザー名は必須項目です。',
            (v) => (v && v.length >= 4) || '4文字以上で入力してください。',
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
            (v) => (v && v.length >= 8) || '8文字以上で入力してください。',
          ],
          passwordConfirmationRules: [
            (v) => !!v || 'パスワードの再入力は必須項目です。',
            (v) => (v && v === this.registerForm.password) || 'パスワードが一致しません。',
          ],
          handlenameRules: [(v) => !!v || '表示名は必須項目です。'],
        },
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
      // ダイアログが閉じたらリダイレクト
      if (this.dialog === false) {
        this.$router.push({ name: 'index' });
      }
    },
  },
  methods: {
    register: async function () {
      if (this.$refs.registerForm.validate()) {
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
          this.$router.push({ name: 'entrance' });
        } else {
          this.registerForm.loading = false;
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
