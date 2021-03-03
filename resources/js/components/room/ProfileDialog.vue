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

            <v-row class="mt-3" justify="center" v-if="user.id !== authUser.id">
              <v-btn
                :color="!user.following ? 'primary' : 'error'"
                :loading="loading"
                @click="follow()"
              >
                {{ !user.following ? 'フォロー' : 'フォロー解除' }}
              </v-btn>
            </v-row>

            <p class="mt-3 mb-0" v-if="user.followed">フォローされています</p>
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

          <v-col
            md="3"
            @click="showFollows()"
            :style="{ 'background-color': show === 'follows' ? '#909090' : '#808080' }"
          >
            <p class="text-center">フォロー</p>
            <p class="text-center mb-0">{{ user.follows_count }}</p>
          </v-col>

          <v-spacer></v-spacer>

          <v-col
            md="3"
            @click="showFollowers()"
            :style="{ 'background-color': show === 'followers' ? '#909090' : '#808080' }"
          >
            <p class="text-center">フォロワー</p>
            <p class="text-center mb-0">{{ user.followers_count }}</p>
          </v-col>

          <v-spacer></v-spacer>
        </v-row>

        <v-list class="grey darken-1" v-if="show && followers.length">
          <v-list-item
            v-for="follower in followers"
            :key="follower.id"
            @click="showProfile(follower.username)"
          >
            <v-list-item-avatar>
              <v-img :src="$storage('icon') + follower.icon"></v-img>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>
                {{ follower.handlename }}
                <small>@{{ follower.username }}</small>
              </v-list-item-title>
              <v-list-item-subtitle>
                {{ follower.introduction || '自己紹介が入力されていません。' }}
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list class="grey darken-1" v-if="show && !followers.length">
          <v-list-item>
            <span class="mt-6 mx-auto">誰よりも早くフォローしよう！</span>
          </v-list-item>
        </v-list>
      </v-container>
    </v-card>

    <!-- 追加プロフィールダイアログ -->
    <ProfileDialog
      :username="profile.username"
      @close="profile.dialog = $event"
      v-if="profile.dialog"
    />
  </v-dialog>
</template>

<script>
import ProfileDialog from '@/components/room/ProfileDialog';

export default {
  name: 'ProfileDialog',
  components: {
    ProfileDialog,
  },

  props: {
    username: String, // 表示するユーザー名
  },

  data() {
    return {
      dialog: true,
      loading: false,
      user: null, // 表示するプロフィール
      show: null, // フォロー/フォロワーどちらを表示するか
      followers: [], // フォロー/フォロワー一覧
      profile: {
        dialog: false, // 追加ダイアログ制御
        username: null, // 表示するユーザー名
      },
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

      var response = await axios.post('/api/users/' + this.user.id + '/follow', {
        _method: 'patch',
      });
      this.user = response.data;

      this.loading = false;
    },

    /**
     * フォロー一覧の表示
     */
    showFollows: async function () {
      var response = await axios.get('/api/users/' + this.user.id + '/follows');
      this.followers = response.data;
      this.show = 'follows';
    },

    /**
     * フォロワー一覧の表示
     */
    showFollowers: async function () {
      var response = await axios.get('/api/users/' + this.user.id + '/followers');
      this.followers = response.data;
      this.show = 'followers';
    },

    /**
     * 追加ダイアログの表示
     *
     * @param {String} username - 表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
    },
  },

  async created() {
    /**
     * ユーザーデータの取得
     */
    var response = await axios.get('/api/users/' + this.username);
    this.user = response.data;
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
