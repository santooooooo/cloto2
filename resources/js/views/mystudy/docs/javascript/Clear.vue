<template>
  <v-container fluid id="content">
    <!-- タイトル -->
    <div class="mb-12 pa-4">
      <h1 class="text-h3 text-center">{{ title }}</h1>
      <p class="text-body-2 mx-6">このコンテンツの説明</p>
    </div>

    <!-- コンテンツ1 -->
    <h2 class="text-h4 font-weight-bold">
      <span>ダミー1</span>
    </h2>
    <v-container fluid>
      <p class="mb-8">ダミー</p>
      <p class="mb-8">
        ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
      </p>
      <p>ダミー</p>
    </v-container>

    <!-- コンテンツ2 -->
    <h2 class="text-h4 font-weight-bold">
      <span>ダミー2</span>
    </h2>
    <v-container fluid>
      <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
      <v-row>
        <v-col cols="6">
          <p class="mb-8">ダミー</p>
        </v-col>
        <v-col cols="6">
          <v-img max-width="90%" max-height="60vh" :src="filePath + '1.png'" class="mb-10"></v-img>
        </v-col>
      </v-row>

      <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
      <v-row>
        <v-col cols="6">
          <p class="mb-8">ダミー</p>
        </v-col>
        <v-col cols="6">
          <v-img max-width="90%" max-height="60vh" :src="filePath + '2.png'" class="mb-10"></v-img>
        </v-col>
      </v-row>
    </v-container>

    <!-- コンテンツ3 -->
    <h2 class="text-h4 font-weight-bold">
      <span>ダミー3</span>
    </h2>
    <v-container fluid>
      <p class="mb-8">ダミー</p>
      <p class="mb-8">ダミー</p>
      <p>ダミー</p>
    </v-container>

    <v-row justify="center">
      <v-btn color="blue" class="text-white" :to="{ name: 'home' }">みんなを助けに行く</v-btn>
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
      title: 'クリア', // コンテンツタイトル
      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>
