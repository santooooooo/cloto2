<template>
  <v-card class="mx-auto" max-width="344">
    <v-card-text>
      <v-form>
        <v-container>
          <v-row>
            <v-col>
              <v-text-field v-model="loginField" label="Username"></v-text-field>
              <v-text-field v-model="password" label="password"></v-text-field>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </v-card-text>

    <button v-on:click="login()" type="button" class="btn btn-cloto-primary">ログイン</button>

    <div class="mt-3">
      <router-link :to="{ name: 'register' }">Have not account</router-link>
    </div>
  </v-card>

  <!-- <div class="welcome-form card justify-content-center">
    <div class="alert alert-danger" v-if="error" v-text="error"></div>

    <div class="form-group row">
      <input type="text" class="form-control" v-model="loginField" placeholder="ユーザー名 または メールアドレス" />
      <div class="welcome-form__feedback--margin">&nbsp;</div>
    </div>

    <div class="form-group row">
      <input type="password" class="form-control" v-model="password" placeholder="パスワード" />
      <div class="welcome-form__feedback--margin">&nbsp;</div>
    </div>

    <div class="form-group row">
      <div class="custom-control custom-radio">
        <input class="custom-control-input" type="checkbox" v-model="remember" />
        <label class="custom-control-label" for="remember">ログイン情報を記憶する</label>
      </div>
    </div>

    <div class="form-group row">
      <div>
        <div>
          <button
            type="button"
            class="btn btn-cloto-primary"
            v-bind:disabled="isButtonDisabled"
            @click="login"
          >ログイン</button>
        </div>
        <div class="mt-3">
          <router-link :to="{ name: 'register' }">新規登録はこちら</router-link>
        </div>
      </div>
    </div>
  </div>-->
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
      isButtonDisabled: true,
      dialog: false,
    };
  },
  watch: {
    loginField: function () {
      this.error = '';
      this.changeButton();
    },
    password: function () {
      this.error = '';
      this.changeButton();
    },
  },
  methods: {
    changeButton: function () {
      if (this.loginField && this.password) {
        this.isButtonDisabled = false;
      } else {
        this.isButtonDisabled = true;
      }
    },
    login: async function () {
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

.welcome-form {
  width: 400px;
  height: 360px;
  margin: auto;
  background-color: $bg-color;
  border-radius: 30px;
  border: none;

  .alert {
    position: absolute;
    top: 0;
    width: 400px;
    border-radius: 30px 30px 0 0;
  }

  .form-group {
    margin: 10px 0;

    div {
      margin: 0 auto;
    }

    input[type='text'],
    input[type='password'] {
      width: 250px;
      margin: 0 auto;
      border-radius: 30px;
    }
  }

  &__feedback {
    &--margin {
      width: 100%;
      margin-top: 0.25rem;
      font-size: 1em;
    }
  }
}
</style>