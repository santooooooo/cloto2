<template>
  <div class="p-3">
    <p class="font-weight-bold">カルテ投稿ランキング</p>
    <v-tabs color="orange" centered>
      <v-tab @click="category = 'week'">week</v-tab>
      <v-tab @click="category = 'month'">month</v-tab>
      <v-tab @click="category = 'all'">all</v-tab>
    </v-tabs>
    <v-list>
      <div v-for="rank in ranking" :key="rank.username">
        <v-subheader
          @click="$store.dispatch('dialog/open', { type: 'user', username: rank.username })"
          style="cursor: pointer"
        >
          <b class="pr-2">{{ rank.id }}</b>
          <v-list-item-avatar><img :src="$storage('icon') + rank.icon" /></v-list-item-avatar>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title v-html="rank.handleName"></v-list-item-title>
              <v-list-item-subtitle>@{{ rank.username }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item-title
            ><span class="font-weight-bold">{{ rank.kartes }}</span> カルテ</v-list-item-title
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
      icon: null, // ランキングに表示するユーザーのアイコンのデータ
      handleName: null,
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
    // ランキングに表示されるユーザーのアイコンデータの表示
    userIcon: function () {
      return function (username) {
        this.getUserIcon(username);
        return this.icon;
      };
    },
    // ランキングに表示されるユーザーのアイコンデータの表示
    userHandleName: function () {
      return function (username) {
        this.getUserHandleName(username);
        return this.handleName;
      };
    },
  },
  methods: {
    // 一週間のランキングのデータを取得
    getWeekData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      // データを扱いやすい形へ加工
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
    },
  },
};
</script>
