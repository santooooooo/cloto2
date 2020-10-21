<template>
  <v-dialog persistent v-model="dialog" width="600">
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="white" class="mb-0" v-if="!user"></v-progress-linear>

    <v-card color="grey darken-1" dark>
      <v-container>
        <v-btn class="ma-auto" color="grey lighten-1" dark>
          <v-icon dark @click="close()"> mdi-arrow-left </v-icon>
        </v-btn>
        <v-row class="text-center" justify="center">
          <v-col cols="12" sm="6">
            <v-avatar size="102"><img :src="$storage('icon') + user.icon" /></v-avatar>
            <p class="profile__user--handlename">{{ user.handlename }}</p>
            <p class="profile__user--username">{{ '@' + user.username }}</p>

            <div class="profile__sns-container" v-if="sns || user.web">
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
          </v-col>
          <v-col cols="12" sm="6">
            <v-card-text class="pa-2" min-height="240" color="grey darken-1" dark>
              {{ user.introduction }}
            </v-card-text>
          </v-col>
        </v-row>

        <v-tabs class="pa-0" fixed-tabs background-color="grey lighten-1" dark>
          <v-tab> Projects </v-tab>
          <v-tab> TO Do </v-tab>
          <v-tab> Record </v-tab>
        </v-tabs>
      </v-container>
    </v-card>
  </v-dialog>
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

.introduction {
  background-color: $light-gray;
  margin: 0 auto;
  background-color: $light-gray;
  width: 500px;
  border: none;
  border-radius: 30px;
}

.profile__sns--twitter {
  color: $twitter-color;
}

.profile__sns--github {
  color: $github-color;
}

.profile__sns--qiita {
  color: $qiita-color;
  padding-bottom: 0px;
  margin-bottom: 0px;
}
.profile__user--handlename {
  font-size: 2em;
  padding-bottom: 0px;
  margin-bottom: 0px;
}
</style>
