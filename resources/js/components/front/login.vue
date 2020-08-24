<template>
  <div class="welcome-form card justify-content-center">
    <!-- エラーメッセージ -->
    <div class="alert alert-danger" v-if="error" v-text="error"></div>

    <!-- ログインフォーム -->
    <div class="form-group row">
      <input type="text" class="form-control" v-model="login" placeholder="ユーザー名 または メールアドレス" />
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
            @click="submit"
          >ログイン</button>
        </div>
        <div class="mt-3">
          <router-link :to="{ name: 'register' }">新規登録はこちら</router-link>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      error: "",
      login: "",
      password: "",
      remember: false,
      isButtonDisabled: true,
    };
  },
  watch: {
    login: function () {
      this.error = "";
      this.changeButton();
    },
    password: function () {
      this.error = "";
      this.changeButton();
    },
  },
  methods: {
    changeButton: function () {
      if (this.login && this.password) {
        this.isButtonDisabled = false;
      } else {
        this.isButtonDisabled = true;
      }
    },
    submit: function () {
      var endpoint = this.$endpoint("login");
      var params = {
        login: this.login,
        password: this.password,
        remember: this.remember,
      };

      this.$http
        .post(endpoint, params)
        .then((response) => {
          location.href = this.$endpoint("index");
        })
        .catch((response) => {
          this.error = response.response.data.errors.login[0];
        });
    },
  },
};
</script>


<style lang="scss" scoped>
@import "~/_variables";

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

    input[type="text"],
    input[type="password"] {
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