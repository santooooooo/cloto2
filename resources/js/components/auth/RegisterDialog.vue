<template>
  <v-dialog v-model="dialog" max-width="440" @click:outside="$emit('close', false)">
    <v-card>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col>
              <!-- エラーメッセージ -->
              <v-alert type="error" v-if="registerErrors">
                <p class="mb-0" v-if="registerErrors.username">
                  <span v-for="(message, index) in registerErrors.username" :key="index">
                    {{ message }}
                  </span>
                </p>
                <p class="mb-0" v-if="registerErrors.email">
                  <span v-for="(message, index) in registerErrors.email" :key="index">
                    {{ message }}
                  </span>
                </p>
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

                <!-- <p class="ma-4">
                  当サービスを利用する前に、<br />
                  必ず<a
                    class="blue--text"
                    href="https://forms.gle/Lt714ek8fGBAmZzT9"
                    target="_blank"
                    rel="noopener noreferrer"
                    >アンケート</a
                  >にご回答ください。
                </p>
                <v-checkbox
                  label="回答しました"
                  v-model="registerForm.checkbox"
                  :rules="registerForm.validation.checkboxRules"
                ></v-checkbox> -->

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
          <a class="blue--text" @click="$emit('close', false)">こちら</a>
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
  props: {
    isOpen: Boolean,
  },
  data() {
    return {
      dialog: false,
      registerForm: {
        username: '',
        email: '',
        password: '',
        passwordConfirmation: '',
        handlename: '',
        // checkbox: false,
        showPassword: false,
        loading: false,
        validation: {
          valid: false,
          usernameRules: [
            (v) => !!v || 'ユーザー名は必須項目です。',
            (v) => (v && v.length >= 4) || '4文字以上で入力してください。',
            (v) => {
              const pattern = /^(?=.*?[a-z0-9])[a-z0-9_]{4,16}$/;
              return pattern.test(v) || '使用可能な文字：a~z, 0~9, _';
            },
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
          // checkboxRules: [
          //   (v) =>
          //     !!v ||
          //     'アンケートにご回答いただかないと、当サービスのご利用ができません。また、記入漏れなどの不備があった際には、運営より連絡を差し上げる場合がございます。',
          // ],
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
    isOpen: function (open) {
      if (open) {
        this.dialog = true;
      } else {
        this.dialog = false;
      }
    },
  },
  methods: {
    register: async function () {
      if (this.$refs.registerForm.validate()) {
        this.registerForm.loading = true;

        // 新規登録処理
        await this.$store.dispatch('auth/register', {
          username: this.registerForm.username,
          email: this.registerForm.email,
          password: this.registerForm.password,
          password_confirmation: this.registerForm.passwordConfirmation,
          handlename: this.registerForm.handlename,
        });

        if (this.apiStatus) {
          // Slack通知
          this.$slack(
            '新規登録Bot',
            ':tada:',
            this.registerForm.handlename + '様が新規登録しました！'
          );

          // ページ遷移
          window.location.pathname = '/email/verify';
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
