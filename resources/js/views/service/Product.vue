<template>
  <div fluid class="index">
    <Carousel></Carousel>
    <!-- <v-row justify="center" class="mt-12">
      <router-link :to="{ name: 'preRegister' }">
        <v-btn x-large color="primary" class="font-weight-bold">新規登録</v-btn>
      </router-link>
    </v-row> -->

    <h3 class="text-center mt-16 font-weight-bold">製品紹介</h3>

    <v-container class="content mt-8 pa-0 mb-12">
      <v-card class="pa-0 pt-3 mr-0 ml-0 pb-3">
        <h2 class="text-center ma-5 font-weight-bold">ベータ版</h2>
        <v-card color="#f6bf00" class="pa-0 ma-0">
          <v-row>
            <v-col cols="6">
              <div class="mx-auto">
                <v-img
                  class="mx-auto mt-2"
                  width="500"
                  :src="$storage('system') + 'P3.svg'"
                ></v-img>
              </div>
            </v-col>

            <v-col cols="6">
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

        <v-card color="#f6bf00" class="pa-0 mt-6 ma-0">
          <v-row>
            <v-col cols="6">
              <div class="mx-auto">
                <v-img
                  class="mx-auto mt-2"
                  width="500"
                  :src="$storage('system') + 'P3.svg'"
                ></v-img>
              </div>
            </v-col>

            <v-col cols="6">
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

        <!-- <v-row justify="center">
        

        <v-row class="productInfo mt-12">
          <v-col>
            <v-img eager width="500" :src="$storage('system') + 'P3.svg'"></v-img>
          </v-col>

          <v-col align-self="center">
            <p class="text-center text-h6">
              好きな席を選んで着席！<br />
              自習開始です<br />
            </p>
          </v-col>
        </v-row>
        <v-row class="productInfo mt-12">
          <v-col>
            <v-img eager width="500" :src="$storage('system') + 'P3.svg'"></v-img>
          </v-col>
          <v-col align-self="center">
            <p class="text-center text-h6">
              好きな席を選んで着席！<br />
              自習開始です<br />
            </p>
          </v-col>
        </v-row>
      </v-row> -->
      </v-card>
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
      model: 0,
      colors: ['primary', 'secondary', 'yellow darken-2', 'red', 'orange'],
    };
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.index {
  background-color: $light-gray;
  .content {
    background: white;
    .productInfo {
      background-color: $primary;
      width: 70%;
    }
  }
}
</style>
