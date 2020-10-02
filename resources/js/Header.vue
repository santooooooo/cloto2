<template>
  <v-app-bar app dark>
    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <v-spacer></v-spacer>

    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" v-if="isRelease" />

    <router-link :to="{ name: 'preRegister' }" v-else>
      <v-btn depressed color="primary" class="btn font-weight-bold">新規登録</v-btn>
    </router-link>
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
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
