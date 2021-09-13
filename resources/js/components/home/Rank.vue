<template>
  <div>
    <v-btn @click="category = 'week'">week</v-btn>
    <v-btn @click="category = 'month'">month</v-btn>
    <v-btn @click="category = 'all'">all</v-btn>
    <h2>{{ ranking }}</h2>
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
  },
  methods: {
    getWeekData: async function () {
      const response = await axios.get('/api/timeline/rank?category=' + this.category);
      this.rank.week = response.data;
    },
    getMonthData: async function () {
      const response = await axios.get('/api/timeline/rank?category=' + this.category);
      this.rank.month = response.data;
    },
    getAllData: async function () {
      const response = await axios.get('/api/timeline/rank?category=' + this.category);
      this.rank.all = response.data;
    },
  },
};
</script>
