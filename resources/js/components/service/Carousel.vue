<template>
  <div>
    <v-list style="height: 90%" class="text-center" color="grey darken-3"
      ><v-list-item-content>
        <v-list-item-title class="text-white"
          >プログラミング学習者向けバーチャル学習施設CLOTO</v-list-item-title
        >
      </v-list-item-content></v-list
    >
    <v-carousel hide-delimiters>
      <!-- height="autoを挙動がおかしくなる" -->
      <v-carousel-item v-for="(page, i) in pages" :key="i" :src="page.image">
        <v-row style="height: 87%" align="center" justify="center">
          <div style="width: 100%" class="display-3 text-center">
            <p class="mb-0 font-weight-bold">{{ page.title }}</p>
            <v-btn :to="{ name: page.to }">{{ page.btnText }}</v-btn>
          </div>
        </v-row>
        <v-row
          class="grey darken-3 pl-16 pr-16 pt-1 pb-1"
          align="center"
          justify="center"
          style="height: 13%"
        >
          <div>{{ page.body }}</div>
        </v-row>
      </v-carousel-item>
    </v-carousel>
  </div>
</template>
<script>
export default {
  data() {
    return {
      pages: [
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          title: 'オンライン学習施設',
          body: 'CLOTOとは学習目的学習内容ごとに分けられた部屋が複数ある自習施設です。',
          btnText: '登録',
          to: 'register',
        },
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: '自習室',
          body: '自習室では、同じ時間に、同じ学習に取り組んでいる仲間が表示されています',
          btnText: 'ログイン',
          to: 'login',
        },
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          title: '休憩室',
          body: '学校の時間割のように、CLOTO全体にも定期的に自習時間の間に休憩時間が訪れます。',
          btnText: 'ログイン',
          to: 'login',
        },
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          title: 'メンタリングルーム',
          body:
            'CLOTOでは段階的に2種類のメンタリング機能を用意し、みなさんの技術的課題のサポートをします。',
          btnText: 'ログイン',
          to: 'login',
        },
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: 'カルテ・ポートフォリオ',
          body: 'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。',
          btnText: 'ログイン',
          to: 'login',
        },
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: 'イベントルーム',
          body: 'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。',
          btnText: 'ログイン',
          to: 'login',
        },
        {
          image: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: 'イベントルーム',
          body: 'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。',
          btnText: 'ログイン',
          to: 'login',
        },
      ],
    };
  },
};
</script>
