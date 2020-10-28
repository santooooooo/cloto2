<template>
  <div class="profile">
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="blue" class="mb-0" v-if="!user"></v-progress-linear>

    <!-- プロフィール欄 -->
    <div class="profile__content card" v-else>
      <div class="row">
        <!-- アイコンとユーザー名 -->
        <div class="profile__user col-md-5">
          <img
            :src="$storage('icon') + user.icon"
            class="rounded-circle"
            width="100"
            height="100"
          />
          <p class="profile__user--handlename">{{ user.handlename }}</p>
          <p class="profile__user--username">{{ '@' + user.username }}</p>
        </div>

        <div class="col-md-7">
          <div class="profile__button">
            <!-- マイページの場合 -->
            <router-link
              class="btn btn-cloto-primary"
              :to="{
                name: 'profileEdit',
                params: { username: $store.getters['auth/user'].username },
              }"
              v-if="user.id == $store.getters['auth/user'].id"
              >編集する</router-link
            >
          </div>
          <!-- ボタン類 -->
          <div class="profile__sns-container" v-if="user.sns || user.web">
            <a
              class="profile__sns--twitter"
              :href="'https://twitter.com/' + user.sns.twitter"
              target="_blank"
              v-if="user.sns.twitter"
            >
              <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a
              class="profile__sns--github"
              :href="'https://github.com/' + user.sns.github"
              target="_blank"
              v-if="user.sns.github"
            >
              <i class="fab fa-github fa-2x"></i>
            </a>
            <a
              class="profile__sns--qiita"
              :href="'https://qiita.com/' + user.sns.qiita"
              target="_blank"
              v-if="user.sns.qiita"
            >
              <i class="fa fa-search fa-2x"></i>
            </a>
            <a class="profile__sns--web" :href="user.web" target="_blank" v-if="user.web">
              <i class="fas fa-link fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="profile__introduction" v-if="user.introduction">
        <p>{{ user.introduction }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    userName: String,
  },
  data() {
    return {
      user: null,
    };
  },
  async mounted() {
    /**
     * ユーザーデータの取得
     */
    var response = await this.$http.get(this.$endpoint('userShow', [this.userName]));
    this.user = response.data;
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.profile {
  padding: 1em 0;
  background-color: $white;
  font-size: 14px;
  font-weight: 900;

  &__content {
    margin: 0 auto;
    background-color: $light-gray;
    width: 500px;
    border: none;
    border-radius: 30px;
  }

  &__user {
    height: 170px;
    margin-top: 1em;
    text-align: center;
    font-weight: bold;

    &--handlename {
      text-align: center;
      margin-top: 1em;
      margin-bottom: 0;
    }

    &--username {
      text-align: center;
    }
  }

  &__button {
    height: 60px;
    margin-top: 2em;
    text-align: center;
  }

  &__sns-container {
    height: 30px;
    margin-bottom: 2em;
    text-align: center;

    div {
      margin: 0 auto;
    }
  }

  %__sns {
    margin: 0 1em;
  }

  &__sns {
    @extend %__sns;

    &--twitter {
      @extend %__sns;

      color: $twitter-color;

      &:hover {
        color: $twitter-color;
      }
    }

    &--github {
      @extend %__sns;

      color: $github-color;

      &:hover {
        color: $github-color;
      }
    }

    &--qiita {
      @extend %__sns;

      color: $qiita-color;

      &:hover {
        color: $qiita-color;
      }
    }

    &--web {
      @extend %__sns;

      color: $black;

      &:hover {
        color: $black;
      }
    }
  }

  &__introduction {
    margin: 1em;
    padding: 0.5em;
    text-align: center;
    background-color: $white;
    border-radius: 30px;

    p {
      margin: 0;
    }
  }
}
</style>
