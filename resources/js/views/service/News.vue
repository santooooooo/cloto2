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
      <v-tabs
        v-model="selected"
        background-color="grey darken-3"
        class="white--text pt-13"
        color="amber accent-3"
        grow
        dark
      >
        <v-tab v-for="tab in tabs" :key="tab">
          {{ tab.title }}
        </v-tab>
      </v-tabs>

      <v-tabs-items v-model="selected">
        <v-tab-item v-for="tab in tabs" :key="tab.id">
          <!-- イベント情報 -->
          <v-card v-if="tab.id === 1" color="basil" flat>
            <h3 class="text-center pa-2 font-weight-bold">{{ tab.title }}</h3>
            <v-row>
              <v-col cols="3">
                <div class="mx-auto">
                  <v-card height="500px" class="headline grey lighten-5 text-center px-2">
                    <v-card-text class="pa-2 title font-weight-bold">
                      イベント絞り込み
                    </v-card-text>
                    <v-text-field
                      solo
                      label="Prepend inner"
                      prepend-inner-icon="mdi-map-marker"
                    ></v-text-field>
                  </v-card>
                </div>
              </v-col>

              <v-col cols="3">
                <div class="mx-auto">
                  <h2 class="mt-12 text-center text-h5 font-weight-bold">
                    プログラミング学習者が集まる
                  </h2>
                  <h2 class="text-center text-h5 font-weight-bold">オンラインコミュニティ</h2>
                  <p class="mt-12 text-center text-body-1">
                    プログラミング学習に取り組む方々の<br />
                    集まるコミュニティを創り<br />
                    学習するプログラミン言語によって<br />
                    フロアを分けます。
                  </p>
                </div>
              </v-col>
              <v-col cols="3">
                <div class="mx-auto">
                  <h2 class="mt-12 text-center text-h5 font-weight-bold">
                    プログラミング学習者が集まる
                  </h2>
                  <h2 class="text-center text-h5 font-weight-bold">オンラインコミュニティ</h2>
                  <p class="mt-12 text-center text-body-1">
                    プログラミング学習に取り組む方々の<br />
                    集まるコミュニティを創り<br />
                    学習するプログラミン言語によって<br />
                    フロアを分けます。
                  </p>
                </div>
              </v-col>
              <v-col cols="3">
                <div class="mx-auto">
                  <h2 class="mt-12 text-center text-h5 font-weight-bold">
                    プログラミング学習者が集まる
                  </h2>
                  <h2 class="text-center text-h5 font-weight-bold">オンラインコミュニティ</h2>
                  <p class="mt-12 text-center text-body-1">
                    プログラミング学習に取り組む方々の<br />
                    集まるコミュニティを創り<br />
                    学習するプログラミン言語によって<br />
                    フロアを分けます。
                  </p>
                </div>
              </v-col>
            </v-row>
          </v-card>
          <!-- 掲示板 -->
          <v-card v-if="tab.id === 2" color="basil" flat>
            <h3 class="text-center pa-2 font-weight-bold">{{ tab.title }}</h3>
            <v-col v-for="(board, i) in boardData" :key="i" cols="12">
              <v-card>
                <v-card-text>{{ board.date }} </v-card-text>

                <v-card-text class="headline font-weight-bold text-center">
                  {{ board.title }}
                </v-card-text>
                <v-row justify="center" class="ma-1 pa-3">
                  <v-btn color="primary">応募する</v-btn>
                </v-row>
              </v-card>
            </v-col>
          </v-card>
          <!-- お知らせ -->
          <v-card v-if="tab.id === 3" color="basil" flat>
            <h3 class="text-center pa-2 font-weight-bold">{{ tab.title }}</h3>
            <v-list>
              <template v-for="(news, index) in newsData">
                <v-divider></v-divider>
                <v-list-item :key="news.title">
                  <v-row justify="center">
                    {{ news.title }}
                  </v-row>
                </v-list-item>
              </template>
            </v-list>
          </v-card>

          <v-card v-if="tab.id === 3" class="mt-10" color="basil" flat>
            <h3 class="text-center pt-2">プレスリリース</h3>
            <v-list>
              <template v-for="(news, index) in newsData">
                <v-divider></v-divider>
                <v-list-item :key="news.title">
                  <v-row justify="center">
                    {{ news.title }}
                  </v-row>
                </v-list-item>
              </template>
            </v-list>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
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
      selected: null,
      // items: ['イベント情報', '掲示板', 'お知らせ'],
      tabs: [
        {
          id: 1,
          title: 'イベント情報',
        },
        {
          id: 2,
          title: '掲示板',
        },
        {
          id: 3,
          title: 'お知らせ',
        },
      ],
      boardData: [
        {
          id: 1,
          to: '',
          title: 'HP制作案件の　募集です',
          body: 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
          date: '2020/08/17',
        },
        {
          id: 2,
          to: '',
          title: 'HP制作案件の　募集です',
          body: 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
          date: '2020/08/18',
        },
        {
          id: 3,
          to: '',
          title: 'HP制作案件の　募集です',
          body: 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
          date: '2020/08/19',
        },
      ],
      newsData: [
        {
          id: 1,
          link: 'https://u25.billage.space/archive/20200817/',
          title: '関西若手起業家',
          date: '2020/08/17',
          tag: 'イベント',
        },
        {
          id: 2,
          link: 'http://www.ritsumei.ac.jp/research/vc/',
          title: '立命館大学学生ベンチャーコンテストに参加',
          date: '2020/12/6',
          tag: 'イベント',
        },
      ],
    };
  },
  methods: {
    // newsLink: function (link) {
    //   location.href = link;
    // },
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
