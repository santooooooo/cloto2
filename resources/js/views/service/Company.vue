<template>
  <div fluid class="index">
    <v-container class="upper">
      <v-container>
        <v-row justify="center" class="mt-12">
          <h2>創る、繋がる、好きになる</h2>
        </v-row>
        <div style="text-align:center" class="mt-12">
          <p>Vision</p>
          <h3>世界の学習プラットフォームになる。</h3>
          <p>Mission</p>   
          <h3>学びを多様化し、人々の想像力と新結合で地球を豊かにする。</h3>
        </div>
      </v-container>
    </v-container>
    <v-container class="content">
      <v-row justify="center">
        <v-row class="mt-12 pa-16">
          <v-col>
            <v-img eager width="400" :src="$storage('system') + 'top.svg'"></v-img>
          </v-col>

          <v-col align-self="center">
            <span class="name text-left ma-3">立花 慶人</span>
            <span>Yoshihito Tachibana</span>

            <p class="ma-3 text-left position">CEO/デザイン</p>
            <v-spacer></v-spacer>
            <p class="ma-3 text-left introduction">
              早稲田早稲田早稲田早稲田早稲田早稲田早稲田<br />
              早稲田早稲田早稲田早稲田早稲田早稲田早稲田<br />
              早稲田早稲田早稲田早稲田早稲田早稲田早稲田<br />
              早稲田早稲田早稲田早稲田早稲田早稲田早稲田<br />
            </p>

            <p></p
          ></v-col>
        </v-row>

        <v-row class="mt-6 pa-16">
          <v-col>
            <v-img eager width="400" :src="$storage('system') + 'top.svg'"></v-img>
          </v-col>

          <v-col align-self="center">
            <span class="name text-left ma-3">藤井 まめす</span>
            <span>Atsuhiro Fujii</span>

            <p class="ma-3 text-left position">企画/プロジェクトマネジメント</p>
            <v-spacer></v-spacer>
            <p class="ma-3 text-left introduction">
              まめすまめすまめすまめすまめすまめす<br />
              まめすまめすまめすまめすまめすまめす<br />
              まめすまめすまめすまめすまめすまめす<br />
              まめすまめすまめすまめすまめすまめす<br />
            </p>

            <p></p
          ></v-col>
        </v-row>

        <!-- <v-card justify="center" class="text-center mt-16">
          <v-row no-gutters>
            <v-card-title class="mx-auto">料金体系</v-card-title>
          </v-row>
          <v-data-table
            :headers="headers"
            :items="desserts"
            :items-per-page="5"
            class="elevation-1"
          ></v-data-table>
        </v-card> -->
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
  .upper {
    max-width: 100%;
    height: 700px;
    background-color: $primary;
    color: $white;
    position: relative;
  }

  .name {
    font-size: 25px;
    font-weight: 600;
  }
  .introduction {
    color: grey;
    font-size: 17px;
  }
}
</style>
