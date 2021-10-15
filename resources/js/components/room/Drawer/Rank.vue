<template>
  <div class="mt-5">
    <p class="font-weight-bold text-center" style="color: orange">累計着席時間ランキング</p>
    <v-list max-height="100">
      <div v-for="user in showRank" :key="user.id">
        <v-subheader
          @click="$store.dispatch('dialog/open', { type: 'user', username: user.username })"
          style="cursor: pointer"
        >
          <v-list-item-avatar size="20" v-if="user.id === 1"
            ><v-icon color="rgba(219,180,0)">mdi-medal</v-icon></v-list-item-avatar
          >
          <v-list-item-avatar size="20" v-if="user.id === 2"
            ><v-icon color="rgba(201,202,202)">mdi-medal</v-icon></v-list-item-avatar
          >
          <v-list-item-avatar size="20" v-if="user.id === 3"
            ><v-icon color="rgba(196,112,34)">mdi-medal</v-icon></v-list-item-avatar
          >
          <v-list-item-avatar size="20" v-if="user.id > 3">{{ user.id }}</v-list-item-avatar>
          <v-list-item-avatar size="30"
            ><img :src="$storage('icon') + user.icon"
          /></v-list-item-avatar>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title style="font-size: 0.8rem;">{{ user.handleName }}</v-list-item-title>
              <v-list-item-subtitle style="font-size: 0.8rem">@{{ user.username }}</v-list-item-subtitle>
              <v-list-item-title style="font-size: 1rem" class="ml-15"
                ><span class="font-weight-bold">{{ Math.floor(user.time / 60) }}</span>
                h</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
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
      rank: [], // ランキングのデータ
    };
  },
  computed: {
    showRank() {
      // 既にデータがある際はサーバーからデータを取るのではなく、そのデータを返す
      if (this.rank.length !== 0) {
        return this.rank;
      }
      // サーバーからランキングのデータを取得
      this.getData();
      return this.rank;
    },
  },
  methods: {
    getData: async function () {
      // ランキングに必要なデータの取得とデータの加工
      let response = await axios.get('/api/drawer/rank');
      let id = 0; // ユーザーの順位を表す

      for (const user in response.data) {
        const data = {
          id: id + 1,
          username: response.data[user].username,
          icon: response.data[user].icon,
          handleName: response.data[user].handlename,
          time: response.data[user].sitting_time,
        };
        this.rank.push(data);
        id += 1;
      }
    },
  },
};
</script>
