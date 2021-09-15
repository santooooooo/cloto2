<template>
  <div class="p-3">
    <p class="font-weight-bold text-center" style="color: orange">カルテ投稿ランキング</p>
    <v-tabs color="orange" centered>
      <v-tab @click="category = 'week'">week</v-tab>
      <v-tab @click="category = 'month'">month</v-tab>
      <v-tab @click="category = 'all'">all</v-tab>
    </v-tabs>
    <v-list>
      <div v-for="user in ranking" :key="user.username">
        <v-subheader
          @click="$store.dispatch('dialog/open', { type: 'user', username: user.username })"
          style="cursor: pointer"
        >
          <v-list-item-avatar v-if="user.id === 1"
            ><v-icon color="rgba(219,180,0)">mdi-medal</v-icon></v-list-item-avatar
          >
          <v-list-item-avatar v-if="user.id === 2"
            ><v-icon color="rgba(201,202,202)">mdi-medal</v-icon></v-list-item-avatar
          >
          <v-list-item-avatar v-if="user.id === 3"
            ><v-icon color="rgba(196,112,34)">mdi-medal</v-icon></v-list-item-avatar
          >
          <v-list-item-avatar style="font-size: 1.2rem" v-if="user.id > 3">{{
            user.id
          }}</v-list-item-avatar>
          <v-list-item-avatar><img :src="$storage('icon') + user.icon" /></v-list-item-avatar>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title v-html="user.handleName"></v-list-item-title>
              <v-list-item-subtitle>@{{ user.username }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item-title
            ><span class="font-weight-bold">{{ user.kartes }}</span> カルテ</v-list-item-title
          >
        </v-subheader>
        <v-divider></v-divider>
      </div>
    </v-list>
  </div>
</template>
<script>
export default {
  data() {
    return {
      rank: {
        week: [], // 一週間のランキングのデータ
        month: [], // 一か月のランキングのデータ
        all: [], // 通算のランキングのデータ
      },
      category: 'week', // 表示するランキングの指定
    };
  },
  computed: {
    ranking: function () {
      switch (this.category) {
        // 一週間のランキングのデータを表示
        case 'week':
          // サーバーの負荷を下げるために、既にデータがある場合はサーバーへリクエストを送らないようにしている
          if (this.rank.week.length !== 0) {
            return this.rank.week;
          }
          this.getWeekData();
          return this.rank.week;

        // 一か月のランキングのデータを表示
        case 'month':
          if (this.rank.month.length !== 0) {
            return this.rank.month;
          }
          this.getMonthData();
          return this.rank.month;

        // 通算のランキングのデータを表示
        case 'all':
          if (this.rank.all.length !== 0) {
            return this.rank.all;
          }
          this.getAllData();
          return this.rank.all;

        // this.categoryに想定外の値が送られた場合、何も返さない
        default:
          return;
      }
    },
  },
  methods: {
    // 一週間のランキングのデータを取得
    getWeekData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      // ランキングに必要なデータの取得とデータの加工
      let id = 0; // ユーザーの順位を表す

      for (const username in response.data) {
        let userInfo = await axios.get('/api/users/' + username);
        let icon = userInfo.data.icon;
        let handleName = userInfo.data.handlename;
        const data = {
          id: id + 1,
          username: username,
          kartes: response.data[username],
          icon: icon,
          handleName: handleName,
        };
        this.rank.week.push(data);
        id += 1;
      }
    },
    // 一か月のランキングのデータを取得
    getMonthData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      let id = 0;

      for (const username in response.data) {
        let userInfo = await axios.get('/api/users/' + username);
        let icon = userInfo.data.icon;
        let handleName = userInfo.data.handlename;
        const data = {
          id: id + 1,
          username: username,
          kartes: response.data[username],
          icon: icon,
          handleName: handleName,
        };
        this.rank.month.push(data);
        id += 1;
      }
    },
    // 通算のランキングのデータを取得
    getAllData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      let id = 0;

      for (const username in response.data) {
        let userInfo = await axios.get('/api/users/' + username);
        let icon = userInfo.data.icon;
        let handleName = userInfo.data.handlename;
        const data = {
          id: id + 1,
          username: username,
          kartes: response.data[username],
          icon: icon,
          handleName: handleName,
        };
        this.rank.all.push(data);
        id += 1;
      }
    },
  },
};
</script>
