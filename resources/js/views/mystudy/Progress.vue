<template>
  <v-container>
    <h1 class="font-weight-bold mt-4">あなたの「独学」を支援するCLOTOの「マイスタディ」</h1>
    <v-container class="mt-8" fluid>
      <v-row>
        <v-col cols="4" class="pr-4">
          <p class="font-weight-black">「マイスタディ」では、</p>
          <p class="font-weight-black">右の図のような6つのコースと</p>
          <p class="font-weight-black">それぞれに12段階のクラスで構成された</p>
          <p class="font-weight-black">学習ロードマップに基づいて、</p>
            <p class="font-weight-black mb-12">学習を進めていきます。</p>
          <p class="font-weight-black">「マイスタディ」と「コミュニティ」を</p>
          <p class="font-weight-black">利用しながら独学を進め、</p>
          <p class="font-weight-black">「玄人」を目指しましょう。</p>
          <v-col>
              <v-btn color="blue" class="white--text mt-2 w-75" :to="{ name: 'javascript-0' }">
                独学で学ぶ
              </v-btn>
          </v-col>
        </v-col>
        <v-col cols="8" class="text-center">
          <!-- 入れる図によって、max-height,max-widthを変える-->
          <v-img
            max-height="1200"
            max-width="800"
            src="https://picsum.photos/id/11/500/300"
            class="mb-10"
          ></v-img>
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
        inner: 'マイスタディ',
      };
    },
  },
};
</script>

<style lang="scss" scoped>

</style>