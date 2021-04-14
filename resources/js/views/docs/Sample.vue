<template>
  <v-container class="mt-4">
    <v-row>
      <v-col cols="4">
        <div class="mt-8 index">
          <!-- 目次 -->
          <ol>
            <li class="my-6 grey--text" @click="$emit('scroll-to-anchor-point', 'buy')">
              食材を買う
            </li>
            <li class="my-6 grey--text" @click="$emit('scroll-to-anchor-point', 'suggest')">
              おすすめの食材
            </li>
            <li class="my-6 grey--text" @click="$emit('scroll-to-anchor-point', 'cut')">
              食材を切る
            </li>
          </ol>
        </div>
      </v-col>

      <v-col cols="8">
        <!-- タイトル -->
        <div class="grey lighten-2 mb-8 pa-4">
          <h1 class="text-h4 font-weight-bold">{{ title }}</h1>
          <p class="text-body-2 mx-6 mt-6 mb-0">塩コショウが効いた本格派</p>
        </div>

        <!-- コンテンツ1 -->
        <v-container fluid class="mb-12" ref="buy">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">食材を買う</span>
          </h4>

          <p class="mb-8">何を買おうかな</p>
          <p class="mb-8">
            人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、人参、キャベツ、
          </p>
          <p>こんなもんかな</p>
        </v-container>

        <!-- コンテンツ2 -->
        <v-container fluid class="mb-12" ref="suggest">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">おすすめの食材</span>
          </h4>

          <h5 class="text-h5 font-weight-bold mb-8">1.岩塩</h5>
          <p class="mb-8">普通の塩には戻れない</p>
          <v-img
            max-height="300"
            max-width="400"
            src="https://picsum.photos/id/11/500/300"
            class="mb-10"
          ></v-img>

          <h5 class="text-h5 font-weight-bold mb-8">2.おいしい水</h5>
          <p class="mb-8">普通の水には戻れない</p>
          <v-img max-height="400" max-width="500" src="https://picsum.photos/id/11/500/300"></v-img>
        </v-container>

        <!-- コンテンツ3 -->
        <v-container fluid class="mb-12" ref="cut">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">食材を切る</span>
          </h4>

          <p class="mb-8">何から切る？</p>
          <p class="mb-8">人参、と見せかけてキャベツ</p>
          <p>どっちゃでもええ</p>
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: this.title,
      };
    },
  },
  data() {
    return {
      title: '野菜炒めを作るよ', // コンテンツタイトル
    };
  },
};
</script>
