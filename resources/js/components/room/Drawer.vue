<template>
  <v-card class="mx-auto" width="250" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">Room {{ roomName }}</v-list-item-title>
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

      <div class="pa-2">
        <v-btn
          block
          class="mb-3"
          depressed
          color="#f6bf00"
          dark
          :disabled="!authUser.seat"
          @click="$emit('input-karte')"
        >
          カルテ記入
        </v-btn>
        <v-btn block depressed color="error" :disabled="!authUser.seat" @click="$emit('leave-room')"
          >退席</v-btn
        >
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
