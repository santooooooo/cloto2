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

    <!-- <v-card v-if="isSitting" class="headline ma-2 pa-3 grey darken-1 text-center">
      <v-card-text class="pa-2 white--text title whitefont-weight-bold"> ex_project </v-card-text>
      <v-card-text class="pa-2 white--text title whitefont-weight-bold"> ex_todo </v-card-text>
      <v-btn color="yellow darken-1" @click="$emit('open-karte-dialog', true)">
        <span class="white--text">カルテ記入</span>
      </v-btn>
    </v-card> -->

    <v-card v-if="isSitting" class="ma-2 pa-3 grey darken-1 text-center">
      <v-container>
        <v-card-text class="pa-1 white--text whitefont-weight-bold"> プロジェクト </v-card-text>

        <v-card class="pa-1"> CLOTO </v-card>

        <v-card-text class="pa-1 white--text whitefont-weight-bold"> タスク </v-card-text>

        <v-card class="pa-1"> ログイン機能の実装 </v-card>

        <v-btn color="mt-5 yellow darken-1" @click="$emit('open-karte-dialog', true)">
          <span class="white--text">カルテ記入</span>
        </v-btn>
      </v-container>
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
