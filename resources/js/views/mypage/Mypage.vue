<template>
  <v-layout>
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
