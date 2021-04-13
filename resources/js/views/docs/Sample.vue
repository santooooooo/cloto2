<template>
  <v-container>
    <!-- コンテンツタイトル -->
    <v-col class="grey lighten-2 my-8">
      <h1 class="mb-0 font-weight-bold">野菜炒めを作るよ</h1>
      <v-subheader>塩コショウが効いた本格派</v-subheader>
    </v-col>

    <!-- コンテンツの内容 -->
    <v-container>
      <v-row>
        <!-- 左レイアウト -->
        <v-col cols="4">
          <!-- パンくずリスト -->
          <v-breadcrumbs :items="items" class="pl-0"></v-breadcrumbs>

          <!-- 目次、全体概要 -->
          <p>
            <a href="" class="grey--text">食材を買う</a>
          </p>
          <p>
            <a href="" class="grey--text">食材を買う</a>
          </p>
          <p>
            <a href="" class="grey--text">食材を買う</a>
          </p>
          <p>
            <a href="" class="grey--text">食材を買う</a>
          </p>
        </v-col>

        <!-- 右レイアウト -->
        <v-col cols="8">
          <!-- コンテンツ　画像なし -->
          <v-container fluid class="mb-12">
            <h3 class="text-h4 font-weight-bold text-left-border mb-10">
              <span class="pl-3 grey lighten-3">食材を買う</span>
            </h3>
            <p class="mb-8">何を買おうかな</p>
            <p class="mb-8">
              人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、
            </p>
            <p class="mb-8">こんなもんかな</p>
          </v-container>

          <!-- コンテンツ　画像あり -->
          <v-container fluid class="mb-12">
            <h3 class="text-h4 font-weight-bold text-left-border mb-10">
              <span class="pl-3 grey lighten-3">おすすめの食材</span>
            </h3>
            <h4 class="mb-8 font-weight-bold">1.岩塩</h4>
            <p class="mb-8">普通の塩には戻れない</p>
            <!-- Vuetifyのサンプル画像を使ってます　サイズ調整はmax-〇〇で -->
            <v-img
              max-height="300"
              max-width="400"
              src="https://picsum.photos/id/11/500/300"
            ></v-img>
          </v-container>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: 'さんぷる',
      };
    },
  },
  data() {
    return {
        //パンくずリストのアイテム
      items: [
        // hrefプロパティを追加すれば、リンクが足せる　https://vuetifyjs.com/ja/components/breadcrumbs/#slots
        { text: '目次' },
        { text: '料理' },
        { text: '野菜炒め' },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

// コンテンツタイトル左の線
.text-left-border {
  border-left: 6px solid $dark-blue;
}
</style>
