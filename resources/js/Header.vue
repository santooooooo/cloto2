<template>
  <v-app-bar app dark>
    <v-spacer></v-spacer>

    <router-link :to="{ name: 'preRegister' }" v-if="!isRelease" >
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
.btn {
  margin-right: 10px;
}
</style>
