<template>
  <v-card class="mx-auto" width="250" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item color="success" :to="{ name: 'entrance' }">
          <v-list-item-content>
            <v-list-item-title class="text-h5 font-weight-bold">施設案内</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list nav dense>
        <v-list-item-group color="success">
          <v-list-item
            v-for="floor in floors.slice().reverse()"
            :key="floor.id"
            class="mb-4"
            :to="{ name: 'floor', params: { roomId: floor.id } }"
          >
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">
                {{ floor.name }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>

      <div class="pa-2" v-if="$route.name === 'floor'">
        <v-btn
          depressed
          block
          color="#f6bf00"
          dark
          :to="{ name: 'room', params: { roomId: $route.params.roomId } }"
          :disabled="authUser.seat !== null"
        >
          入室
        </v-btn>
      </div>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn depressed block color="error" :to="{ name: 'map' }">施設一覧に戻る</v-btn>
        </div>
      </template>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
export default {
  props: {
    floors: Array,
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
