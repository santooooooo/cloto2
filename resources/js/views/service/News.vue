<template>
  <div fluid class="index">
    <v-container class="upper">
      <v-container>
        <Carousel></Carousel>
        <v-row justify="center" class="mt-12">
          <router-link :to="{ name: 'preRegister' }">
            <v-btn x-large color="primary" class="font-weight-bold">新規登録</v-btn>
          </router-link>
        </v-row>
      </v-container>
    </v-container>
    <v-container class="content ma-auto">
      <v-col v-for="(news, i) in newsData" :key="i" cols="12">
        <v-card @click="newsLink(news.link)">
          <v-card-text
            >{{ news.date }} <span class="font-weight-light">{{ news.tag }}</span></v-card-text
          >

          <v-card-text class="headline font-weight-bold"> {{ news.text }} </v-card-text>
        </v-card>
      </v-col>
    </v-container>
  </div>
</template>

<script>
import Carousel from '@/components/service/Carousel';

export default {
  components: {
    Carousel,
  },
  data() {
    return {
      newsData: [
        {
          id: 1,
          link: 'https://u25.billage.space/archive/20200817/',
          text: '関西若手起業家ピッチコンテストに参加',
          date: '2020/08/17',
          tag: 'イベント',
        },
        {
          id: 2,
          link: 'http://www.ritsumei.ac.jp/research/vc/',
          text: '立命館大学学生ベンチャーコンテストに参加',
          date: '2020/12/6',
          tag: 'イベント',
        },
      ],
    };
  },
  methods: {
    newsLink: function (link) {
      location.href = link;
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.index {
  background-color: $light-gray;
  .upper {
    max-width: 100%;
    background-color: $primary;
    color: $white;
    position: relative;
  }
  .content {
  }
}
</style>
