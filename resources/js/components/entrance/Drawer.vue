<template>
  <v-card class="mx-auto" width="250" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">フロア案内</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list nav dense>
        <v-list-item-group color="#f6bf00">
          <v-list-item class="mb-4" :to="{ name: 'entrance' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">施設案内</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            v-for="(floor, index) in floors"
            :key="floor.id"
            class="mb-4"
            :to="{ name: 'floor', params: { roomId: floor.id } }"
            @click="emitClick"
          >
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">
                {{ index + 1 }}F {{ floor.name }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
export default {
  props: {
    floors: Array,
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
