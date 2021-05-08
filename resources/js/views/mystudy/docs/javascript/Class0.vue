<template>
  <v-container class="mt-4" fluid id="content-container">
    <v-row>
      <v-col cols="2" class="p-0 border-right pr-2">
        <h1 class="font-weight-bold text-h5 mb-2 text-center green">入門期</h1>
        <h2 class="text-h6 font-weight-bolder green pl-2">Class 0</h2>
        <!-- 目次 -->
        <ul class="p-0 pl-2">
          <li class="my-6 grey--text content-subtext" v-scroll-to="{ el: '#buy', offset: -80 }">
            0-1. ダミー1
          </li>
          <li class="my-6 grey--text content-subtext" v-scroll-to="{ el: '#suggest', offset: -80 }">
            0-2. ダミー2
          </li>
          <li class="my-6 grey--text content-subtext" v-scroll-to="{ el: '#cut', offset: -80 }">
            0-3. ダミー3
          </li>
        </ul>
      </v-col>

      <v-col cols="10">
        <h1 class="mb-12 text-center">クラス2以降、ここにコースタイトル反映</h1>
        <!-- タイトル -->
        <div class="mb-8 pa-4">
          <h1 class="text-center text-h4 font-weight-bold">{{ title }}</h1>
          <p class="text-body-2 mx-6 mt-6 mb-0">ダミー</p>
        </div>

        <!-- コンテンツ1 -->
        <v-container fluid class="mb-12" id="buy">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">ダミー1</span>
          </h4>

          <p class="mb-8">ダミー</p>
          <p class="mb-8">
            ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
          </p>
          <p>ダミー</p>
        </v-container>

        <!-- コンテンツ2 -->
        <v-container fluid class="mb-12" id="suggest">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">ダミー2</span>
          </h4>

          <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
          <v-row>
            <v-col cols="6">
              <p class="mb-8">ダミー</p>
            </v-col>
            <v-col cols="6">
              <v-img
                max-height="300"
                max-width="400"
                src="https://picsum.photos/id/11/500/300"
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
                max-height="300"
                max-width="400"
                src="https://picsum.photos/id/11/500/300"
                class="mb-10"
              ></v-img>
            </v-col>
          </v-row>
        </v-container>

        <!-- コンテンツ3 -->
        <v-container fluid class="mb-12" id="cut">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">ダミー3</span>
          </h4>

          <p class="mb-8">ダミー</p>
          <p class="mb-8">ダミー</p>
          <p>ダミー</p>
        </v-container>

        <!-- 次へ進むボタン -->
        <v-col class="text-center">
          <v-btn
            color="blue"
            class="text-white"
            @click="dialog = true"
          >
          <!-- <v-btn
            color="blue"
            class="text-white"
            :to="{ name: 'javascript-1' }"
            @click="dialog = true"
          > -->
            完了（次へ進む）
          </v-btn>
          <KartePostDialog @close="dialog = $event" v-if="dialog" />
        </v-col>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import KartePostDialog from '@/components/mystudy/ContentKartePostDialog';

export default {
  head: {
    title() {
      return {
        inner: this.title,
      };
    },
  },
  components: {
    KartePostDialog
  },
  data() {
    return {
      title: 'Class 0', // コンテンツタイトル
      dialog: false
    };
  },
};
</script>

<style lang="scss" scoped>
ul {
  list-style: none;
  & > li {
    cursor: pointer;
  }
}

.content-subtext {
  font-size: 0.8rem;
}

@media (min-width: 768px) {
  .container-md,
  .container-sm,
  .container {
    max-width: 1280px !important;
  }
}
</style>
