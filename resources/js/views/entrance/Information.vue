<template>
  <v-layout ref="information" id="information">
    <img :src="$storage('system') + 'event.png'" />
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

  img {
    max-width: 60%;
    max-height: 70%;
    position: absolute;
    top: 10px;
    right: 10px;
  }
}
</style>
