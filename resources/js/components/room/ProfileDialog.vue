<template>
  <v-dialog persistent v-model="dialog" width="600">
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="white" class="mb-0" v-if="!user"></v-progress-linear>

    <v-card :color="color" dark v-else>
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', false)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>

        <v-row class="text-center" justify="center">
          <v-col class="pr-0" align-self="center">
            <v-avatar size="100"><img :src="$storage('icon') + user.icon" /></v-avatar>
            <v-row class="text-h5 mt-2" justify="center">{{ user.handlename }}</v-row>
            <v-row class="text-body-2" justify="center">{{ '@' + user.username }}</v-row>

            <v-row class="mt-3" justify="center" v-if="user.sns || user.web">
              <v-btn
                icon
                color="#00acee"
                :href="'https://twitter.com/' + user.sns.twitter"
                target="_blank"
                v-if="user.sns.twitter"
              >
                <v-icon>mdi-twitter</v-icon>
              </v-btn>

              <v-btn
                icon
                color="#000000"
                :href="'https://github.com/' + user.sns.github"
                target="_blank"
                v-if="user.sns.github"
              >
                <v-icon>mdi-github</v-icon>
              </v-btn>

              <v-btn
                icon
                :href="'https://qiita.com/' + user.sns.qiita"
                target="_blank"
                v-if="user.sns.qiita"
              >
                <v-avatar size="20" color="white">
                  <v-img :src="$storage('system') + 'qiita.png'"></v-img>
                </v-avatar>
              </v-btn>

              <v-btn icon color="#ffffff" :href="user.web" target="_blank" v-if="user.web">
                <v-icon>mdi-home</v-icon>
              </v-btn>
            </v-row>

            <v-row class="mt-3" justify="center" v-if="followStatus">
              <v-btn
                :color="!followStatus.following ? 'primary' : 'error'"
                :loading="loading"
                @click="follow()"
              >
                {{ !followStatus.following ? 'フォロー' : 'フォロー解除' }}
              </v-btn>
            </v-row>

            <p class="mt-3 mb-0" v-if="followStatus && followStatus.followed">
              フォローされています
            </p>
          </v-col>

          <v-col class="pl-0">
            <v-card light flat class="mr-2 overflow-y-auto" min-height="240" max-height="400">
              <pre class="ma-3 text-body-1"
                >{{ user.introduction ? user.introduction : '自己紹介が未記入です' }}
              </pre>
            </v-card>
          </v-col>
        </v-row>

        <v-row justify="center" v-if="user.in_progress">
          <v-card light flat class="mx-6">
            <v-card-text class="pt-3 pl-3 pb-0">いまやっていること</v-card-text>
            <pre class="ma-3 text-body-1">{{ user.in_progress }}</pre>
          </v-card>
        </v-row>

        <v-row class="mt-3" justify="center">
          <v-spacer></v-spacer>

          <v-col md="3" style="background-color: red">
            <p class="text-center">フォロー</p>
            <p class="text-center mb-0">{{ follows.length }}</p>
          </v-col>

          <v-spacer></v-spacer>

          <v-col md="3">
            <p class="text-center">フォロワー</p>
            <p class="text-center mb-0">{{ followers.length }}</p>
          </v-col>

          <v-spacer></v-spacer>
        </v-row>
      </v-container>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    username: String, // 表示するユーザー名
  },
  data() {
    return {
      dialog: true,
      loading: false,
      user: null,
      followStatus: null,
      follows: [],
      followers: [],
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
    color() {
      var color;
      if (this.user.type === 'pro') {
        color = 'green darken-2';
      } else {
        color = 'grey darken-1';
      }

      return color;
    },
  },
  methods: {
    /**
     * フォロー処理
     */
    follow: async function () {
      this.loading = true;

      var response = await axios.post('/api/followers/' + this.user.id + '/follow');
      this.followStatus = response.data;

      this.loading = false;
    },
  },
  async created() {
    /**
     * ユーザーデータの取得
     */
    var response = await axios.get('/api/users/' + this.username);
    this.user = response.data;

    /**
     * フォロー関係の取得
     */
    if (this.username !== this.authUser.username) {
      var response = await axios.get('/api/followers/' + this.user.id + '/follow');
      this.followStatus = response.data;
    }

    /**
     * フォローの取得
     */
    var response = await axios.get('/api/follows');
    this.follows = response.data;

    /**
     * フォロワーの取得
     */
    var response = await axios.get('/api/followers');
    this.followers = response.data;
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}

pre {
  white-space: pre-wrap;
}
</style>
