<template>
  <v-dialog v-model="dialog" @click:outside="$emit('close', false)" width="600">
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
            <v-row class="mt-2 text-body-2" justify="center">
              登録日：{{ $moment(user.created_at).format('YYYY年MM月DD日') }}
            </v-row>

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

        <v-row justify="center">
          <v-card light flat width="80%" class="mx-6 text-center">
            <v-card-text class="pt-3 pl-3 pb-0 black--text"
              >いまやっていること
              <small v-if="user.seat">in {{ user.room.name }}</small>
              <small v-else>未着席</small>
            </v-card-text>

            <pre class="ma-3 text-body-1">{{ user.in_progress || '集中しています！' }}</pre>
          </v-card>
        </v-row>

        <v-row class="my-6" justify="center">
          <v-spacer></v-spacer>

          <v-col md="3" class="select pa-0" @click="showFollows()">
            <v-card class="py-4" :color="color" :elevation="show === 'follow' ? 1 : 3">
              <p class="text-center">フォロー</p>
              <p class="text-center mb-0">{{ user.follows_count }}</p>
            </v-card>
          </v-col>

          <v-spacer></v-spacer>

          <v-col md="3" class="select pa-0" @click="showFollowers()">
            <v-card class="py-4" :color="color" :elevation="show === 'follower' ? 1 : 3">
              <p class="text-center">フォロワー</p>
              <p class="text-center mb-0">{{ user.followers_count }}</p>
            </v-card>
          </v-col>

          <v-spacer></v-spacer>

          <v-col md="3" class="select pa-0" @click="showKartes()">
            <v-card class="py-4" :color="color" :elevation="show === 'karte' ? 1 : 3">
              <p class="text-center">カルテ</p>
              <p class="text-center mb-0"><v-icon>mdi-chevron-down</v-icon></p>
            </v-card>
          </v-col>

          <v-spacer></v-spacer>
        </v-row>

        <!-- フォロー/フォロワー一覧 -->
        <v-list
          :color="color"
          v-if="(show === 'follow' || show === 'follower') && followers.length"
        >
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

        <v-list
          :color="color"
          v-if="(show === 'follow' || show === 'follower') && !followers.length"
        >
          <v-list-item>
            <span class="mx-auto">誰よりも早くフォローしよう！</span>
          </v-list-item>
        </v-list>

        <!-- カルテ一覧 -->
        <v-list :color="color" v-if="show === 'karte' && kartes.length">
          <v-list-item
            v-for="karte in kartes"
            :key="karte.id"
            @click="$store.dispatch('dialog/openKarte', karte.id)"
          >
            <v-img
              max-width="80"
              height="40"
              contain
              class="mr-4 my-2"
              :src="karte.path + karte.image"
              v-if="karte.image"
            ></v-img>
            <v-sheet
              color="grey lighten-2"
              width="80"
              height="40"
              class="mr-4 my-2"
              v-else
            ></v-sheet>

            <v-list-item-content class="text-truncate">
              {{ karte.body }}
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list :color="color" v-if="show === 'karte' && !kartes.length">
          <v-list-item>
            <span class="mx-auto">まだカルテがないようです．．．</span>
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
export default {
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
      kartes: [], // カルテ一覧
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
      return this.$classColor(this.user.roadmaps.length ? this.user.roadmaps[0].in_progress : '');
    },
  },

  methods: {
    /**
     * フォロー処理
     */
    follow: async function () {
      this.loading = true;

      let response = await axios.post('/api/users/' + this.user.id + '/follow');
      this.user = response.data;

      this.loading = false;
    },

    /**
     * フォロー一覧の表示
     */
    showFollows: async function () {
      let response = await axios.get('/api/users/' + this.user.id + '/follows');
      this.followers = response.data;
      this.show = 'follow';
    },

    /**
     * フォロワー一覧の表示
     */
    showFollowers: async function () {
      let response = await axios.get('/api/users/' + this.user.id + '/followers');
      this.followers = response.data;
      this.show = 'follower';
    },

    /**
     * カルテ一覧の表示
     */
    showKartes: async function () {
      let response = await axios.get('/api/kartes/user/' + this.user.id);
      this.kartes = response.data;
      this.show = 'karte';
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
    // ユーザーデータの取得
    let response = await axios.get('/api/users/' + this.username);
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

.select {
  cursor: pointer;
}
</style>
