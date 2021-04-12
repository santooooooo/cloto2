<template>
  <v-container>
    <v-tabs color="#f6bf00">
      <v-tab class="font-weight-bold" @click="showFollows()">フォロー</v-tab>
      <v-tab class="font-weight-bold" @click="showFollowers()">フォロワー</v-tab>
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
        inner: 'フォロー&フォロワー',
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
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * フォロー一覧の表示
     */
    showFollows: async function () {
      let response = await axios.get('/api/users/' + this.authUser.id + '/follows');
      this.followers = response.data;
    },

    /**
     * フォロワー一覧の表示
     */
    showFollowers: async function () {
      let response = await axios.get('/api/users/' + this.authUser.id + '/followers');
      this.followers = response.data;
    },

    /**
     * プロフィールの表示
     *
     * @param {String} username - プロフィールを表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
    },
  },
  created() {
    this.showFollows();
  },
};
</script>
