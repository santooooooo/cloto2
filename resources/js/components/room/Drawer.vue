<template>
  <v-card flat tile class="ma-0" width="250">
    <v-list nav>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h4 font-weight-bold"
            >Room {{ roomName }}</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-card v-if="authUser.tasks.length" class="ma-2 pa-3 grey darken-1 text-center">
      <v-container>
        <v-card-text class="pa-1 white--text whitefont-weight-bold">プロジェクト</v-card-text>

        <v-card class="pa-1">{{ authUser.tasks[0].project.name }}</v-card>

        <v-card-text class="pa-1 white--text whitefont-weight-bold">タスク</v-card-text>

        <v-card class="pa-1">{{ authUser.tasks[0].body }}</v-card>

        <v-btn color="mt-5 yellow darken-1" @click="$emit('open-karte-dialog', true)">
          <span class="white--text">カルテ記入</span>
        </v-btn>
      </v-container>
    </v-card>

    <div class="pa-2">
      <v-btn block color="error" :disabled="!authUser.tasks.length" @click="$emit('leave-room')"
        >退席</v-btn
      >
    </div>
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
* {
  font-weight: bold;
}
</style>
