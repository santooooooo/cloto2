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

      <!-- <v-list-item @click="$emit('open-project-dialog', true)">
        <v-list-item-content>
          <v-list-item-title>プロジェクト</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      <!-- <v-list-item @click="$emit('open-karte-dialog', true)">
        <v-list-item-content>
          <v-list-item-title>カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->
    </v-list>

    <v-card class="headline pa-3 grey darken-1 text-center">
      <v-card-text class="pa-2 white--text title whitefont-weight-bold">
        選択されたproject
      </v-card-text>
      <v-card-text class="pa-2 white--text title whitefont-weight-bold">
        選択されたtodo
      </v-card-text>
      <v-btn color="yellow darken-1" @click="$emit('open-karte-dialog', true)">
        <span class="white--text">カルテ記入</span>
      </v-btn>
    </v-card>

    <div class="pa-2">
      <v-btn block color="error" :disabled="!isSitting" @click="$emit('leave-room')">退席</v-btn>
    </div>
  </v-card>
</template>

<script>
export default {
  props: {
    roomName: String,
    isSitting: Boolean,
  },
};
</script>

<style lang="scss" scoped>
* {
  font-weight: bold;
}
</style>
