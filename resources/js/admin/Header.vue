<template>
  <v-app-bar app dark>
    <v-spacer></v-spacer>

    <v-btn color="error" @click="$emit('logout')">ログアウト</v-btn>
  </v-app-bar>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 10px;
}
</style>
