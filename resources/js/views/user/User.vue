<template>
  <v-layout>
    <Drawer />

    <v-flex>
      <router-view />
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/user/Drawer';

export default {
  head: {
    title() {
      return {
        inner: this.$route.params.username,
      };
    },
  },
  components: {
    Drawer,
  },
};
</script>
