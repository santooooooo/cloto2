<template>
  <div>
    <p>フォロー一覧</p>
    <v-list v-if="show === 'follower' && followers.length">
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

    <!-- 追加プロフィールダイアログ -->
    <ProfileDialog
      :username="profile.username"
      @close="profile.dialog = $event"
      v-if="profile.dialog"
    />
  </div>
</template>

<script>
import ProfileDialog from '@/components/user/ProfileDialog';

export default {
  components: {
    ProfileDialog,
  },

  data() {
    return {
      user: null,
      show: null, //フォロワーの表示
      followers: [], //フォロワー一覧
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
  },

  mounted() {
    //マウントしてフォローされている人を表示する
    this.showFollowers();
  },

  methods: {
    showFollowers: async function () {
      // computedで取得したユーザーデータをuser dataに入れる
      this.user = this.authUser;

      //ユーザーデータの取得
      let response = await axios.get('/api/users/' + this.user.username);
      this.user = response.data;

      // フォロワー一覧の表示
      let responseFollow = await axios.get('/api/users/' + this.user.id + '/followers');
      this.followers = responseFollow.data;
      this.show = 'follower';
    },
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
    },
  },
};
</script>
