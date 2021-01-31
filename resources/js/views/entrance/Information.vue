<template>
  <v-layout id="information">
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>

    <v-img :src="$storage('system') + 'information.png'" @load="isLoading = false"></v-img>
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
  height: calc(100vh - 64px);
  background-color: white;
}
</style>
