<template>
  <v-dialog persistent v-model="dialog" width="600">
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="white" class="mb-0" v-if="!user"></v-progress-linear>

    <v-card   align-center v-else>
      <v-container>
        <v-row class="text-center" justify="center">
          <v-col>
            <v-avatar size="52"><img :src="$storage('icon') + user.icon" /></v-avatar>
            <p>{{ user.handlename }}</p>
                <div class="introduction">
                  <p>{{ user.introduction }}</p>
                </div>
       
          </v-col>
          <v-col cols="3" sm="3">
            <div v-if="sns || user.web">
              <a :href="'https://twitter.com/' + sns.twitter" target="_blank" v-if="sns.twitter">
                <i class="fab fa-twitter fa-2x"></i>
              </a>
              <a :href="'https://github.com/' + sns.github" target="_blank" v-if="sns.github">
                <i class="fab fa-github fa-2x"></i>
              </a>
              <a :href="'https://qiita.com/' + sns.qiita" target="_blank" v-if="sns.qiita">
                <i class="fa fa-search fa-2x"></i>
              </a>
              <a :href="user.web" target="_blank" v-if="user.web">
                <i class="fas fa-link fa-2x"></i>
              </a>
            </div>

          </v-col>
        </v-row>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="close()"> close </v-btn>
        </v-card-actions>
      </v-container>
    </v-card>
  </v-dialog>

  <!-- <div class="profile"> -->
  <!-- プロフィール欄 -->
  <!-- <div class="profile__content card">
        <div class="row"> -->
  <!-- アイコンとユーザー名 -->
  <!-- <div class="profile__user col-md-5">
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
            <div class="profile__button"> -->
  <!-- マイページの場合 -->
  <!-- <router-link
                class="btn btn-cloto-primary"
                :to="{
                  name: 'profileEdit',
                  params: { username: $store.getters['auth/user'].username },
                }"
                v-if="user.id == $store.getters['auth/user'].id"
                >編集する</router-link
              >

                    <v-btn color="yellow darken-1" @click="profileDialog = false">
        <span class="white--text">CLOSE</span>
      </v-btn>
            </div> -->
  <!-- ボタン類 -->
  <!-- <div class="profile__sns-container" v-if="sns || user.web">
              <a
                class="profile__sns--twitter"
                :href="'https://twitter.com/' + sns.twitter"
                target="_blank"
                v-if="sns.twitter"
              >
                <i class="fab fa-twitter fa-2x"></i>
              </a>
              <a
                class="profile__sns--github"
                :href="'https://github.com/' + sns.github"
                target="_blank"
                v-if="sns.github"
              >
                <i class="fab fa-github fa-2x"></i>
              </a>
              <a
                class="profile__sns--qiita"
                :href="'https://qiita.com/' + sns.qiita"
                target="_blank"
                v-if="sns.qiita"
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
    </div> -->
</template>

<script>
export default {
  props: {
    userId: Number,
  },
  data() {
    return {
      dialog: true,
      user: null,
      sns: null,
    };
  },
  methods: {
    close: function () {
      this.dialog = false;
      this.$emit('close', false);
    },
  },
  async mounted() {
    /**
     * ユーザーデータの取得
     */
    var response = await this.$http.get(this.$endpoint('userShow', [this.userId]));
    this.user = response.data;

    if (this.user.sns) {
      this.sns = JSON.parse(this.user.sns);
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.introduction{
    background-color: $light-gray;
    margin: 0 auto;
    background-color: $light-gray;
    width: 500px;
    border: none;
    border-radius: 30px;
}
</style>


