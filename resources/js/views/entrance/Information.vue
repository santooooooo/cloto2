<template>
  <v-layout ref="information" id="information">
    <v-sheet color="white">
      <img :src="$storage('system') + 'event.png?' + Math.random().toString(32).substring(2)" />
      <p class="text-h5 ma-2">
        今月のイベント一覧は<a
          href="https://freecalend.com/open/mem136363_nopopon"
          target="_blank"
          rel="noopener noreferrer"
          >こちら</a
        >
      </p>
    </v-sheet>
  </v-layout>
</template>

<script>
export default {
  mounted() {
    this.$refs.information.style.backgroundImage =
      'url("' + this.$storage('system') + 'information.png")';
  },
};
</script>

<style lang="scss" scoped>
#information {
  height: calc(100vh - 64px);
  background-size: cover;
  position: relative;

  .v-sheet {
    max-width: 50%;
    max-height: 60%;
    position: absolute;
    top: 0px;
    left: 0px;

    img {
      max-width: 100%;
    }
  }
}
</style>
