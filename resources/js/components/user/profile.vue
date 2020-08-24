<template>
  <div class="user-profile">
    <!-- プロフィール欄 -->
    <div class="user-profile__content card">
      <div class="row">
        <!-- アイコンとユーザー名 -->
        <div class="user-profile__user col-md-5">
          <img
            :src="'/storage/user/icon/' + user.icon"
            class="rounded-circle"
            width="100"
            height="100"
          />
          <p class="user-profile__user--handlename">{{ user.handlename }}</p>
          <p class="user-profile__user--username">{{ '@' + user.username }}</p>
        </div>

        <div class="col-md-7">
          <div class="user-profile__button">
            <!-- マイページの場合 -->
            <a href="#" class="btn btn-cloto-primary" v-if="user.user_id == authId">編集する</a>
          </div>
          <!-- ボタン類 -->
          <div class="user-profile__sns-container" v-if="sns || user.web">
            <a
              class="user-profile__sns--twitter"
              :href="'https://twitter.com/' + sns.twitter"
              target="_blank"
              v-if="sns.twitter"
            >
              <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a
              class="user-profile__sns--github"
              :href="'https://github.com/' + sns.github"
              target="_blank"
              v-if="sns.github"
            >
              <i class="fab fa-github fa-2x"></i>
            </a>
            <a
              class="user-profile__sns--qiita"
              :href="'https://qiita.com/' + sns.qiita"
              target="_blank"
              v-if="sns.qiita"
            >
              <i class="fa fa-search fa-2x"></i>
            </a>
            <a class="user-profile__sns--web" :href="user.web" target="_blank" v-if="user.web">
              <i class="fas fa-link fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="user-profile__introduction" v-if="user.introduction">
        <p>{{ user.introduction }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
      authId: "",
      sns: {},
    };
  },
  mounted() {
    var endpoint = this.$endpoint("user_show", [this.$route.params.username]);

    this.$http.get(endpoint).then((response) => {
      this.user = response.data.user;
      this.authId = response.data.authId;

      if (this.user.sns) {
        this.sns = JSON.parse(this.user.sns);
      }
    });
  },
};
</script>