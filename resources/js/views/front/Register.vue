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
                  <h2>
                    <b>新規登録</b>
                  </h2>
                  <v-text-field
                    v-model="username"
                    prepend-icon="fas fa-user"
                    label="ユーザー名"
                  ></v-text-field>
                  <v-text-field
                    v-model="email"
                    prepend-icon="fas fa-envelope"
                    label="メールアドレス"
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="fas fa-lock "
                    :append-icon="show1 ? 'far fa-eye' : 'far fa-eye-slash'"
                    :type="show1 ? 'text' : 'password'"
                    v-model="password"
                    label="パスワード"
                    @click:append="show1 = !show1"
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="fas fa-lock "
                    :append-icon="show1 ? 'far fa-eye' : 'far fa-eye-slash'"
                    :type="show1 ? 'text' : 'passwordConfirmation'"
                    v-model="passwordConfirmation"
                    label="パスワード再入力"
                    @click:append="show1 = !show1"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-form>

          <v-row justify="center">
            <button
              v-on:click="login()"
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
      <!-- <div class="welcome-form card justify-content-center" id="register">
        <form method="POST" :action="$endpoint('POST:register')">
          <div class="form-group row">
            <input
              type="text"
              class="form-control"
              name="username"
              v-model="username"
              v-bind:class="changeFormClass(0)"
              placeholder="ユーザー名"
            />
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[0] === Empty"
            >
              {{ errorUsername }}
            </div>
            <div class="welcome-form__feedback--valid valid-feedback" v-if="statuses[0] === Valid">
              ええやん！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[0] === InValid"
            >
              英数字の組み合わせを入力してください！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[0] === TooShort"
            >
              もっと長く！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[0] === TooLong"
            >
              もっと短く～
            </div>
          </div>

          <div class="form-group row">
            <input
              type="email"
              class="form-control"
              name="email"
              v-model="email"
              v-bind:class="changeFormClass(1)"
              placeholder="メールアドレス"
            />
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[1] === Empty"
            >
              {{ errorEmail }}
            </div>
            <div class="welcome-form__feedback--valid valid-feedback" v-if="statuses[1] === Valid">
              ええやん！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[1] === InValid"
            >
              メールアドレスを入力してください！
            </div>
          </div>

          <div class="form-group row">
            <input
              type="password"
              class="form-control"
              name="password"
              v-model="password"
              v-bind:class="changeFormClass(2)"
              placeholder="パスワード"
            />
            <div class="welcome-form__feedback--margin" v-if="statuses[2] === Empty">&nbsp;</div>
            <div class="welcome-form__feedback--valid valid-feedback" v-if="statuses[2] === Valid">
              ええやん！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[2] === InValid"
            >
              パスワードを入力してください！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[2] === TooShort"
            >
              もっと長く！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[2] === TooLong"
            >
              もっと短く～
            </div>
          </div>

          <div class="form-group row">
            <input
              type="password"
              class="form-control"
              name="password_confirmation"
              v-model="passwordConfirmation"
              v-bind:class="changeFormClass(3)"
              placeholder="パスワード（再入力）"
            />
            <div class="welcome-form__feedback--margin" v-if="statuses[3] === Empty">&nbsp;</div>
            <div class="welcome-form__feedback--valid valid-feedback" v-if="statuses[3] === Valid">
              ええやん！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[3] === InValid"
            >
              パスワードが異なります！
            </div>
          </div>

          <div class="form-group row">
            <input
              type="text"
              class="form-control"
              name="handlename"
              v-model="handlename"
              v-bind:class="changeFormClass(4)"
              placeholder="表示名"
            />
            <div class="welcome-form__feedback--margin" v-if="statuses[4] === Empty">&nbsp;</div>
            <div class="welcome-form__feedback--valid valid-feedback" v-if="statuses[4] === Valid">
              ええやん！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[4] === InValid"
            >
              使えない文字が入力されています！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[4] === TooShort"
            >
              もっと長く！
            </div>
            <div
              class="welcome-form__feedback--invalid invalid-feedback"
              v-if="statuses[4] === TooLong"
            >
              もっと短く～
            </div>
          </div>

          <div class="form-group row">
            <div>
              <div>
                <button
                  type="button"
                  
                  class="btn btn-cloto-primary"
                  v-bind:disabled="isButtonDisabled"
                  @click="register"
                  
                >
                  登録
                </button>
              </div>
              <div class="mt-3">
                <router-link :to="{ name: 'login' }">もう会員ですか？</router-link>
              </div>
            </div>
          </div>
        </form>
      </div>-->
    </v-dialog>
  </v-row>
</template>

<script>
import * as validate from '@/tools/validate';

export default {
  head: {
    title() {
      return {
        inner: '新規登録',
      };
    },
  },
  props: {
    errors: {
      type: Object,
    },
  },
  data() {
    return {
      errorUsername: '　',
      errorEmail: '　',
      Valid: validate.Valid,
      InValid: validate.InValid,
      Empty: validate.Empty,
      TooShort: validate.TooShort,
      TooLong: validate.TooLong,
      statuses: [validate.Empty, validate.Empty, validate.Empty, validate.Empty, validate.Empty],
      username: null,
      email: null,
      password: null,
      passwordConfirmation: null,
      handlename: null,
      isButtonDisabled: true,
      dialog: true,
      isPush: true,
    };
  },
  watch: {
    dialog: function () {
      if (this.dialog === false) {
        this.$router.push({ name: 'home' });
      }
    },
    username: function () {
      if (this.username) {
        this.statuses[0] = this.checkUserName();
      } else {
        this.statuses[0] = this.Empty;
      }

      this.checkErrors();
    },
    email: function () {
      if (this.email) {
        this.statuses[1] = this.checkEmail();
      } else {
        this.statuses[1] = this.Empty;
      }

      this.checkErrors();
    },
    password: function () {
      if (this.password) {
        this.statuses[2] = this.checkPassword();
      } else {
        this.statuses[2] = this.Empty;
      }

      // パスワードフォームが変化した場合，再確認フォームも確認する
      if (this.passwordConfirmation) {
        this.statuses[3] = this.checkPasswordConfirmation();
      } else {
        this.statuses[3] = this.Empty;
      }

      this.checkErrors();
    },
    passwordConfirmation: function () {
      if (this.passwordConfirmation) {
        this.statuses[3] = this.checkPasswordConfirmation();
      } else {
        this.statuses[3] = this.Empty;
      }

      this.checkErrors();
    },
    handlename: function () {
      if (this.handlename) {
        this.statuses[4] = this.checkHandleName();
      } else {
        this.statuses[4] = this.Empty;
      }

      this.checkErrors();
    },
  },
  computed: {
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    registerErrors() {
      return this.$store.state.auth.registerErrorMessages;
    },
  },
  methods: {
    register: async function () {
      // データの作成
      var params = {
        username: this.username,
        email: this.email,
        password: this.password,
        password_confirmation: this.passwordConfirmation,
        handlename: this.handlename,
      };

      // 新規登録処理
      await this.$store.dispatch('auth/register', params);

      if (this.apiStatus) {
        // ページ遷移
        this.$router.push({ name: 'home' });
      }
    },
    checkErrors: function () {
      if (validate.validErrors(this.statuses) === this.Valid) {
        // エラーが無くなればボタンを有効化
        this.isButtonDisabled = false;
      } else {
        // 1つでも存在する限り無効化
        this.isButtonDisabled = true;
      }
    },
    checkUserName: function () {
      return validate.validUserName(this.username);
    },
    checkEmail: function () {
      return validate.validEmail(this.email);
    },
    checkPassword: function () {
      return validate.validPassword(this.password);
    },
    checkPasswordConfirmation: function () {
      return validate.validPasswordConfirmation(this.password, this.passwordConfirmation);
    },
    checkHandleName: function () {
      return validate.validHandleName(this.handlename);
    },

    changeFormClass: function (index) {
      return validate.getFormClass(this.statuses[index]);
    },
  },
  mounted() {
    if (typeof this.errors !== 'undefined') {
      if (typeof this.errors.username !== 'undefined') {
        this.errorUsername = 'そのユーザー名は使われています(・o・)';
      }
      if (typeof this.errors.email !== 'undefined') {
        this.errorEmail = 'そのメールアドレスは使われています(ー_ー)!!';
      }
    }

    // エラーの初期化
    this.$store.commit('auth/setLoginErrorMessages', null);
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.welcome-form {
  width: 400px;
  height: 470px;
  margin: auto;
  background-color: $bg-color;
  border-radius: 30px;
  border: none;

  .form-group {
    margin: 10px 0;

    div {
      margin: 0 auto;
    }

    input[type='text'],
    input[type='email'],
    input[type='password'] {
      width: 250px;
      margin: 0 auto;
      border-radius: 30px;
    }
  }

  &__feedback {
    &--valid,
    &--invalid {
      display: block;
      font-size: 1em;
    }

    &--margin {
      width: 100%;
      margin-top: 0.25rem;
      font-size: 1em;
    }
  }
}
</style>
