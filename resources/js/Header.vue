<template>
  <v-app-bar app dark>
    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <v-spacer></v-spacer>

    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" v-if="APP_RELEASE" />
    <v-btn depressed color="primary" class="btn font-weight-bold" v-else>覗いてみる</v-btn>
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    APP_RELEASE() {
      return Number(process.env.MIX_APP_RELEASE);
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 15px 0;
}

.btn {
  margin-right: 10px;
}
</style>
