<template>
  <v-app-bar app dark>
    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <v-spacer></v-spacer>

    <v-app-bar-nav-icon @click.stop="$emit('show-drawer')" />
  </v-app-bar>
</template>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 15px 0;
}
</style>