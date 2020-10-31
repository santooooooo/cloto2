<template>
  <v-layout>
      <Drawer />

      <v-flex>
        <router-view />
        <!-- <Profile :userName="$route.params.username"></Profile> -->
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

<style></style>
