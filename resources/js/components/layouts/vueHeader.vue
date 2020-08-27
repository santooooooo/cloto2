<template>
  <nav class="nav navbar navbar-expand-md navbar-light shadow-sm" id="navbar">
    <router-link class="nav__logo" :to="{ name: 'home' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto" v-if="$root.AuthCheck()">
        <li class="dropdown">
          <a
            class="nav__link--username dropdown-toggle"
            data-toggle="dropdown"
            href="#"
            role="button"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <img
              :src="$storage('icon') + $root.AuthUser.icon"
              class="rounded-circle"
              width="30"
              height="30"
            />
            {{ $root.AuthUser.username }}
          </a>

          <div class="nav__dropdown-menu dropdown-menu">
            <router-link
              class="dropdown-item"
              :to="{ name: 'userPage', params: { username: $root.AuthUser.username }}"
            >マイページ</router-link>
            <button type="button" class="dropdown-item" @click="logout">ログアウト</button>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto" v-else>
        <li class="nav__item">
          <router-link class="nav-link" :to="{ name: 'register' }">新規登録</router-link>
        </li>

        <li class="nav__item">
          <router-link class="nav-link" :to="{ name: 'login' }">ログイン</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  methods: {
    logout: function () {
      this.$http.post(this.$endpoint("POST:logout")).then((response) => {
        // ログインユーザーの同期
        this.$root.SyncAuthUser();
        // トップページへリダイレクト
        if (this.$route.path != this.$router.resolve({ name: "home" }).href) {
          this.$router.push({ name: "home" });
        }
      });
    },
  },
};
</script>

<style>
</style>