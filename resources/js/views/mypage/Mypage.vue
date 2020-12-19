<template>
  <v-layout id="mypage">
    <Drawer />

    <v-flex>
      <router-view />
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/mypage/Drawer';

export default {
  components: {
    Drawer,
  },
};
</script>

<style lang="scss" scoped>
#mypage {
  min-height: 100vh;
}
</style>
