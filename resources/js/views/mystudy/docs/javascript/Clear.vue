<template>
  <v-container fluid id="content">
    <div class="pa-4" id="cleardesc">
      <h1 class="text-h1 text-center">{{ title }}</h1>
    </div>

      <h2 class="font-weight-bold" style="display: none;">
        <span>
          
        クリアおめでとう！！
        </span>
        
        </h2>

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
      title: 'CLEAR', // コンテンツタイトル
      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>

<style lang="scss" scoped>
  @import '~/_variables';


      #cleardesc {
        background-color: #f6bf00;
        color: #ffffff;
        height: 80vh;
        position: relative;
        margin-bottom: 80px;
        & > h1 {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translateY(-50%) translateX(-50%);
        }
      }
      h2 {
        span {
          padding-left: 12px;
          border-left: 6px solid $dark-blue;
          background-color: #eeeeee;
        }
      }
</style>
