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
      <v-list class="rounded-lg text-center">
        <v-list-item-group color="grey">
          <v-list-item v-for="news in newsData" :key="news.id">
            <v-list-item-content class="ma-5" @click="newsLink(news.link)">
              <v-list-item-title v-text="news.date"></v-list-item-title>
              <v-list-item-title v-text="news.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
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
          tag: 'event',
        },
        {
          id: 2,
          link: 'http://www.ritsumei.ac.jp/research/vc/',
          text: '立命館大学学生ベンチャーコンテストに参加',
          date: '2020/12/6',
          tag: 'event',
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
