<template>
  <v-container fluid class="mt-4">
    <v-row>
      <!-- 目次 -->
      <ContentTable :contents="contents" />

      <v-col cols="8" id="content">
        <!-- タイトル -->
        <div class="mb-4 pa-4">
          <h1 class="text-h4 text-center mb-12">{{ title }}</h1>
          <p class="text-body-2 mx-6">このコンテンツの説明</p>
        </div>

        <!-- コンテンツ1 -->
        <v-container fluid class="mb-12" id="buy">
          <h2 class="text-h4 font-weight-bold mb-10">
            <span class="pl-3 grey lighten-3">ダミー1</span>
          </h2>

          <p class="mb-8">ダミー</p>
          <p class="mb-8">
            ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
          </p>
          <p>ダミー</p>
        </v-container>

        <!-- コンテンツ2 -->
        <v-container fluid class="mb-12" id="suggest">
          <h2 class="text-h4 font-weight-bold mb-10">
            <span class="pl-3 grey lighten-3">ダミー2</span>
          </h2>

          <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
          <v-row>
            <v-col cols="6">
              <p class="mb-8">ダミー</p>
            </v-col>
            <v-col cols="6">
              <v-img
                max-width="90%"
                max-height="60vh"
                :src="filePath + '1.png'"
                class="mb-10"
              ></v-img>
            </v-col>
          </v-row>

          <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
          <v-row>
            <v-col cols="6">
              <p class="mb-8">ダミー</p>
            </v-col>
            <v-col cols="6">
              <v-img
                max-width="90%"
                max-height="60vh"
                :src="filePath + '2.png'"
                class="mb-10"
              ></v-img>
            </v-col>
          </v-row>
        </v-container>

        <!-- コンテンツ3 -->
        <v-container fluid class="mb-12" id="cut">
          <h2 class="text-h4 font-weight-bold mb-10">
            <span class="pl-3 grey lighten-3">ダミー3</span>
          </h2>

          <p class="mb-8">ダミー</p>
          <p class="mb-8">ダミー</p>
          <p>ダミー</p>
        </v-container>

        <v-row justify="center" class="mb-4">
          <v-btn dark color="primary" @click="$emit('next')">完了（次へ進む）</v-btn>
        </v-row>
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
     //               <v-container fluid class="mb-12" id="">
    //           <h2 class="text-h4 font-weight-bold mb-10">
    //             <span class="pl-3 grey lighten-3"></span>
    //           </h2>
    // <v-row justify="center" class="mt-10">
    //        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
    //      </v-row>
    //         </v-container>
    return {
      title: 'こんてんつ7', // コンテンツタイトル
      contents: [
        { id: '#buy', title: '0-1. ダミー1', activeStart: 0, activeEnd: 596 },
        { id: '#suggest', title: '0-2. ダミー2', activeStart: 596, activeEnd: 1130 },
        { id: '#cut', title: '0-3. ダミー3', activeStart: 1130, activeEnd: 99999 },
      ], // 目次データ

      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>
