<template>
  <v-layout id="information">
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>

    <v-container>
      <v-img
        :src="$storage('system') + 'information.png'"
        cover
        class="mx-auto"
        max-width="700px"
        @load="isLoading = false"
      ></v-img>
    </v-container>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      isLoading: true, // ロードの制御
    };
  },
};
</script>

<style lang="scss" scoped>
#information {
  min-height: 100vh;
  background-color: white;
}
</style>
