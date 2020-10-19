<template>
  <v-navigation-drawer absolute permanent color="grey lighten-3">
    <v-list nav>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h4 font-weight-bold"
            >Room {{ roomName }}</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>

      <v-list-item @click="$emit('open-project-dialog', true)">
        <v-list-item-content>
          <v-list-item-title>プロジェクト</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item @click="$emit('open-karte-dialog', true)">
        <v-list-item-content>
          <v-list-item-title>カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <div class="pa-2">
      <v-btn block color="error" @click="$emit('leave-room')">退席</v-btn>
    </div>
  </v-navigation-drawer>
</template>

<script>
export default {
  props: {
    roomName: String,
  },
};
</script>

<style lang="scss" scoped>
* {
  font-weight: bold;
}
</style>
