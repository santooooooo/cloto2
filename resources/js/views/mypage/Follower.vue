<template>
  <v-container>
    <v-tabs slider-color="yellow" color="yellow">
      <v-tab @click="showFollows()">フォロー</v-tab>
      <v-tab @click="showFollowers()">フォロワー</v-tab>
    </v-tabs>

    <v-list v-if="followers.length">
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
    <p v-else>まだ誰もいないようです。</p>

    <!-- プロフィールダイアログ -->
    <ProfileDialog
      :username="profile.username"
      @close="profile.dialog = $event"
      v-if="profile.dialog"
    />
  </v-container>
</template>

<script>
import ProfileDialog from '@/components/user/ProfileDialog';

export default {
  head: {
    title() {
      return {
        inner: this.$route.name === 'follows' ? 'フォロー一覧' : 'フォロワー一覧',
      };
    },
  },
  components: {
    ProfileDialog,
  },
  data() {
    return {
      followers: [], // フォロー/フォロワー一覧
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
    };
  },
  mounted() {
    this.showFollows()// ページ開いた際には、フォロー欄を表示
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * プロフィールの表示
     *
     * @param {String} username - プロフィールを表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
    },
    showFollows: async function () {
          let response = await axios.get('/api/users/' + this.authUser.id + '/' + 'follows'); //フォロー一覧の取得
          this.followers = response.data;
      },
    showFollowers: async function () {
          let response = await axios.get('/api/users/' + this.authUser.id + '/' + 'followers');//フォロワー一覧の取得
          this.followers = response.data;
    },
  },
};
</script>
