<template>
  <v-layout ref="information" id="information">
    <img :src="$storage('system') + 'events.png'" />
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
    max-height: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
}
</style>
