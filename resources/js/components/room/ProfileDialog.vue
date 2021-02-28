<template>
  <v-dialog persistent v-model="dialog" width="600">
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="white" class="mb-0" v-if="!profile"></v-progress-linear>

    <v-card :color="color" dark v-else>
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', false)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>

        <v-row class="text-center" justify="center">
          <v-col class="pr-0" align-self="center">
            <v-avatar size="100"><img :src="$storage('icon') + profile.icon" /></v-avatar>
            <v-row class="text-h5 mt-2" justify="center">{{ profile.handlename }}</v-row>
            <v-row class="text-body-2" justify="center">{{ '@' + profile.username }}</v-row>

            <v-row class="mt-3" justify="center" v-if="profile.sns || profile.web">
              <v-btn
                icon
                color="#00acee"
                :href="'https://twitter.com/' + profile.sns.twitter"
                target="_blank"
                v-if="profile.sns.twitter"
              >
                <v-icon>mdi-twitter</v-icon>
              </v-btn>

              <v-btn
                icon
                color="#000000"
                :href="'https://github.com/' + profile.sns.github"
                target="_blank"
                v-if="profile.sns.github"
              >
                <v-icon>mdi-github</v-icon>
              </v-btn>

              <v-btn
                icon
                :href="'https://qiita.com/' + profile.sns.qiita"
                target="_blank"
                v-if="profile.sns.qiita"
              >
                <v-avatar size="20" color="white">
                  <v-img :src="$storage('system') + 'qiita.png'"></v-img>
                </v-avatar>
              </v-btn>

              <v-btn icon color="#ffffff" :href="profile.web" target="_blank" v-if="profile.web">
                <v-icon>mdi-home</v-icon>
              </v-btn>
            </v-row>

            <v-row class="mt-3" justify="center" v-if="profile.id !== authUser.id">
              <v-btn
                :color="!profile.following ? 'primary' : 'error'"
                :loading="loading"
                @click="follow()"
              >
                {{ !profile.following ? 'フォロー' : 'フォロー解除' }}
              </v-btn>
            </v-row>

            <p class="mt-3 mb-0" v-if="profile.followed">フォローされています</p>
          </v-col>

          <v-col class="pl-0">
            <v-card light flat class="mr-2 overflow-y-auto" min-height="240" max-height="400">
              <pre class="ma-3 text-body-1"
                >{{ profile.introduction ? profile.introduction : '自己紹介が未記入です' }}
              </pre>
            </v-card>
          </v-col>
        </v-row>

        <v-row justify="center" v-if="profile.in_progress">
          <v-card light flat class="mx-6">
            <v-card-text class="pt-3 pl-3 pb-0">いまやっていること</v-card-text>
            <pre class="ma-3 text-body-1">{{ profile.in_progress }}</pre>
          </v-card>
        </v-row>

        <v-row class="mt-3" justify="center">
          <v-spacer></v-spacer>

          <v-col
            md="3"
            @click="show_follows()"
            :style="{ 'background-color': show === 'follows' ? '#909090' : '#808080' }"
          >
            <p class="text-center">フォロー</p>
            <p class="text-center mb-0">{{ profile.follows_count }}</p>
          </v-col>

          <v-spacer></v-spacer>

          <v-col
            md="3"
            @click="show_followers()"
            :style="{ 'background-color': show === 'followers' ? '#909090' : '#808080' }"
          >
            <p class="text-center">フォロワー</p>
            <p class="text-center mb-0">{{ profile.followers_count }}</p>
          </v-col>

          <v-spacer></v-spacer>
        </v-row>

        <v-list class="grey darken-1" v-if="show && users.length">
          <v-list-item v-for="user in users" :key="user.id">
            <v-list-item-avatar>
              <v-img :src="$storage('icon') + user.icon"></v-img>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>
                {{ user.handlename }}
                <small>@{{ user.username }}</small>
              </v-list-item-title>
              <v-list-item-subtitle>
                {{ user.introduction || '自己紹介が入力されていません。' }}
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list class="grey darken-1" v-if="show && !users.length">
          <v-list-item>
            <span class="mt-6 mx-auto">誰よりも早くフォローしよう！</span>
          </v-list-item>
        </v-list>
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
      profile: null, // 表示するプロフィール
      show: null, // フォロー/フォロワーどちらを表示するか
      users: [], // フォロー/フォロワー一覧
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },

    color() {
      var color;
      if (this.profile.type === 'pro') {
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

      var response = await axios.post('/api/users/' + this.profile.id + '/follow', {
        _method: 'patch',
      });
      this.profile = response.data;

      this.loading = false;
    },

    /**
     * フォロー一覧の表示
     */
    show_follows: async function () {
      var response = await axios.get('/api/users/' + this.profile.id + '/follows');
      this.users = response.data;
      this.show = 'follows';
    },

    /**
     * フォロワー一覧の表示
     */
    show_followers: async function () {
      var response = await axios.get('/api/users/' + this.profile.id + '/followers');
      this.users = response.data;
      this.show = 'followers';
    },
  },

  async created() {
    /**
     * ユーザーデータの取得
     */
    var response = await axios.get('/api/users/' + this.username);
    this.profile = response.data;
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
