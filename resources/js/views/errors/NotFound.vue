<template>
  <v-layout>
    <v-container justify="canter">
      <v-img :src="$storage('system') + '404.svg'" max-width="???" contain class="mx-auto"></v-img>
      <v-col align="center">
        <h5>お探しの場所はここではないようです、、、</h5>
        <router-link :to="{ name: 'index' }">
          <v-btn x-large class="font-weight-bold mt-8 mb-12 alter-btn-color">トップへ戻る</v-btn>
        </router-link>
      </v-col>
    </v-container>
  </v-layout>
</template>

<script>
export default {
  props: {
    floors: Array,
  },
};
</script>

<style lang="scss" scoped>
.alter-btn-color {
  background-color: #f6bf00 !important;
}
</style>
