<template>
  <nav class="nav navbar navbar-expand-md navbar-light shadow-sm">
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


<style lang="scss" scoped>
@import "~/_variables";

.nav {
  background-color: $main-color;
  height: 50px;
  padding: 0 15px;
  font-weight: bold;

  &__logo {
    img {
      height: 40px;
      padding: 5px 0;
    }
  }

  &__item {
    margin: 0 15px;
    border: 0.5px solid $black;
    border-radius: 5px;
  }

  &__link {
    &--usericon {
      padding: 5px 0 5px 20px;
    }

    &--username {
      padding: 5px 20px 5px 0;
      color: $black;

      &:hover {
        color: $black;
        text-decoration: none;
      }
    }
  }

  &__notification-btn {
    line-height: 40px;
    color: $white;

    &--active {
      color: $red;

      animation: jump 0.3s ease infinite alternate;
      @keyframes jump {
        0% {
          transform: translateY(0px);
        }
        100% {
          transform: translateY(-10px);
        }
      }
    }
  }

  &__dropdown-menu {
    top: 100%;
    z-index: 1000;
    min-width: 5rem;
    padding: 5px;
    font-size: 0.9rem;
    color: $black;
    text-align: left;
    list-style: none;
    background-clip: padding-box;
    border-radius: 5px;

    &--notification {
      left: auto;
      right: 10px;
    }
  }

  &__read-btn {
    text-align: center;
    margin-bottom: 0.5em;
  }
}

.navbar-expand-md .navbar-nav .nav-link {
  padding: 5px 20px;
}

.navbar-expand-md .navbar-nav .nav-link {
  color: $black;
}
</style>