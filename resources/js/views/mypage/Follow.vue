<template>
  <div>
    <p>フォロー一覧</p>
    <v-list v-if="show === 'follow' && followers.length">
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
  </div>
</template>

<script>
export default {
  props: {
    username: String, // 表示するユーザー名
  },
  data() {
    return {
      user: null,
      show: null, //フォローの表示
      followers: [], //フォロー一覧
      profile: {
        dialog: false, // 追加ダイアログ制御
        username: null, // 表示するユーザー名
      },
    };
  },
  mounted() {
    this.showFollows();
  },
  methods: {
    showFollows: async function () {
      //ユーザーデータの取得
      // usernameが取れれば勝ち
      let response = await axios.get('/api/users/' + this.username);
      this.user = response.data;
      console.log(this.user);

      // フォロー一覧の表示
      let responseFollow = await axios.get('/api/users/' + this.user.id + '/follows');
      this.followers = responseFollow.data;
      this.show = 'follow';
    },
  },
};
</script>
