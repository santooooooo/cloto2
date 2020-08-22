<template>
  <div class="welcome-form card justify-content-center">
    <form method="POST" action="/login">
      <div class="form-group row">
        <input
          type="text"
          class="form-control"
          name="login"
          v-model="login"
          placeholder="ユーザー名 または メールアドレス"
        />
        <div class="welcome-form__feedback--margin">&nbsp;</div>
      </div>

      <div class="form-group row">
        <input
          type="password"
          class="form-control"
          name="password"
          v-model="password"
          placeholder="パスワード"
        />
        <div class="welcome-form__feedback--margin">&nbsp;</div>
      </div>

      <div class="form-group row">
        <div class="custom-control custom-radio">
          <input class="custom-control-input" type="checkbox" name="remember" id="remember" />
          <label class="custom-control-label" for="remember">ログイン情報を記憶する</label>
        </div>
      </div>

      <div class="form-group row">
        <div>
          <div>
            <button
              type="submit"
              class="btn btn-cloto-primary"
              v-bind:disabled="isButtonDisabled"
            >ログイン</button>
          </div>
          <div class="mt-3">
            <router-link to="/register">新規登録はこちら</router-link>
          </div>
        </div>
      </div>

      <input type="hidden" name="_token" :value="csrf" />
    </form>
  </div>
</template>


<script>
export default {
  props: {
    errors: {
      type: Object,
    },
  },
  data() {
    return {
      login: null,
      password: null,
      isButtonDisabled: true,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  watch: {
    login: function () {
      this.changeButton();
    },
    password: function () {
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
  },
  mounted() {
    if (typeof this.errors !== "undefined") {
      if (typeof this.errors.login !== "undefined") {
        alert(this.errors.login);
      }
    }
  },
};
</script>


<style lang="scss" scoped>
.welcome-form {
  width: 400px;
  height: 360px;
  margin: auto;
  background-color: #f4f4f4;
  border-radius: 30px;
  border: none;

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