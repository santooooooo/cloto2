import { ANNOUNCE_SOUND } from '@/consts/sound'; import Call from '@/components/room/Call';
<template>
  <v-container>
    <h1 class="font-weight-bold mt-4">あなたの「独学」を支援するCLOTOの「マイスタディ」</h1>
    <v-container class="mt-8" fluid>
      <v-row>
        <v-col cols="4">
          <p>「マイスタディ」では右の図のような6つのコースと</p>
          <p>それぞれに12段階のクラスで構成された</p>
          <p>学習ロードマップに基づいて学習を進めていきます</p>
          <p>「マイスタディ」と「コミュニティ」を</p>
          <p>利用しながら独学を進め</p>
          <p>「玄人」を目指しましょう</p>
          <v-container>
            <v-col>
              <v-btn color="blue" class="white--text mb-2" :to="{ name: 'sample' }">
                最初から開始する
              </v-btn>
            </v-col>
            <v-col>
              <v-btn color="blue" class="white--text mb-2" :to="{ name: 'sample' }">
                続きから開始する
              </v-btn>
            </v-col>
          </v-container>
        </v-col>
        <v-col cols="8" class="text-center">
          <v-img
            max-height="300"
            max-width="400"
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

<style lang="scss" scoped></style>
