<template>
  <div>
    <v-btn @click="category = 'week'">week</v-btn>
    <v-btn @click="category = 'month'">month</v-btn>
    <v-btn @click="category = 'all'">all</v-btn>
    <v-list>
      <v-list-item v-for="rank in ranking" :key="rank.username">
        <v-list-item-title
          @click="$store.dispatch('dialog/open', { type: 'user', username: rank.username })"
        >
          <v-avatar size="100"><img :src="$storage('icon') + userIcon(rank.username)" /></v-avatar>
          <p>{{ rank.username }}</p>
          <p>{{ rank.kartes }}</p>
        </v-list-item-title>
      </v-list-item>
    </v-list>
  </div>
</template>
<script>
export default {
  data() {
    return {
      rank: {
        week: null,
        month: null,
        all: null,
      },
      category: 'week',
      icon: null,
    };
  },
  computed: {
    ranking: function () {
      switch (this.category) {
        case 'week':
          this.getWeekData();
          return this.rank.week;
        case 'month':
          this.getMonthData();
          return this.rank.month;
        case 'all':
          this.getAllData();
          return this.rank.all;
        default:
          return;
      }
    },
    userIcon: function () {
      return function (username) {
        this.getUserIcon(username);
        return this.icon;
      };
    },
  },
  methods: {
    getWeekData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      this.rank.week = Object.keys(response.data).map((k) => ({
        username: k,
        kartes: response.data[k],
      }));
    },
    getMonthData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      this.rank.month = Object.keys(response.data).map((k) => ({
        username: k,
        kartes: response.data[k],
      }));
    },
    getAllData: async function () {
      let response = await axios.get('/api/timeline/rank?category=' + this.category);
      this.rank.all = Object.keys(response.data).map((k) => ({
        username: k,
        kartes: response.data[k],
      }));
    },
    getUserIcon: async function (username) {
      let response = await axios.get('/api/users/' + username);
      this.icon = response.data.icon;
    },
  },
};
</script>
