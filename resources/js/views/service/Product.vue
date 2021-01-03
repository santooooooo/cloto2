<template>
  <div fluid class="index">
    <Carousel></Carousel>
    <!-- <v-row justify="center" class="mt-12">
      <router-link :to="{ name: 'preRegister' }">
        <v-btn x-large color="primary" class="font-weight-bold">新規登録</v-btn>
      </router-link>
    </v-row> -->

    <h3 class="text-center mt-16">製品紹介</h3>

    <v-container class="content mt-8">
      <h2 class="text-center mt-2">ベータ版</h2>
      <v-row justify="center">
        <v-row class="productInfo mt-6">
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
      </v-row>
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
      background-color: yellow;
      width: 70%;
    }
  }
}
</style>
