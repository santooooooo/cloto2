<template>
  <v-card class="mx-auto" width="250" min-height="100vh" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">{{ roomName }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <!-- <v-card v-if="authUser.tasks.length" class="ma-2 pa-3 grey darken-1 text-center">
        <v-container>
          <v-card-text class="pa-1 white--text font-weight-bold">プロジェクト</v-card-text>

          <v-card class="pa-1">{{ authUser.tasks[0].project.name }}</v-card>

          <v-card-text class="pa-1 white--text font-weight-bold">タスク</v-card-text>

          <v-card class="pa-1">{{ authUser.tasks[0].body }}</v-card>

          <v-btn depressed color="mt-5 yellow darken-1" @click="$emit('input-karte')">
            <span class="white--text">カルテ記入</span>
          </v-btn>
        </v-container>
      </v-card> -->

      <!-- 着席前 -->
      <div class="pa-2" v-if="!authUser.seat">
        <v-btn block depressed color="success" @click="$router.push({ name: 'entrance' })">
          退室
        </v-btn>
      </div>

      <!-- 着席後 -->
      <div class="pa-2" v-else>
        <v-btn block depressed color="error" @click="$emit('leave-room')">退席</v-btn>

        <v-btn block depressed color="#f6bf00" dark @click="$emit('input-karte')" class="mt-3">
          カルテ記入
        </v-btn>
      </div>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
export default {
  props: {
    roomName: String,
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
