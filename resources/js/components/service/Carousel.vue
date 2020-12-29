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
      <v-carousel-item v-for="(image, i) in images" :key="i" :src="image.src">
        <v-row style="height: 87%" align="center" justify="center">
          <div class="display-3">{{ image.title }}</div>
        </v-row>
        <v-row
          class="grey darken-3 pl-16 pr-16 pt-1 pb-1"
          align="center"
          justify="center"
          style="height: 13%"
        >
          <div>{{ image.subtitle }}</div>
        </v-row>
        <!-- <v-list class="text-center" color="grey darken-3"
          ><v-list-item-content>
            <v-list-item-title class="text-white">{{ image.subtitle }}</v-list-item-title>
          </v-list-item-content></v-list
        > -->
      </v-carousel-item>
    </v-carousel>
  </div>
</template>
<script>
export default {
  data() {
    return {
      imageIndex: 0,
      images: [
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          title: 'オンライン学習施設',
          subtitle: 'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: '自習室',
          subtitle: '自習室では、同じ時間に、同じ学習に取り組んでいる仲間が表示されています',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          title: '休憩室',
          subtitle: '学校の時間割のように、CLOTO全体にも定期的に自習時間の間に休憩時間が訪れます。',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          title: 'メンタリングルーム',
          subtitle:
            'CLOTOでは段階的に2種類のメンタリング機能を用意し、みなさんの技術的課題のサポートをします。',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: 'カルテ・ポートフォリオ',
          subtitle: 'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: 'イベントルーム',
          subtitle: 'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          title: 'イベントルーム',
          subtitle:
            'CLOTOとは学習目的、学習内容ごとに分けられた部屋が複数ある自習施設です。aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        },
      ],
    };
  },
};
</script>
