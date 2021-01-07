<template>
  <v-card class="mx-auto" width="250" min-height="100vh" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">フロア案内</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list nav dense>
        <v-list-item-group color="success">
          <v-list-item class="mb-4" :to="{ name: 'entrance' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">施設案内</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            v-for="(floor, index) in floors.slice().reverse()"
            :key="floor.id"
            class="mb-4"
            :to="{ name: 'floor', params: { roomId: floor.id } }"
          >
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">
                {{ floors.length - index }}F {{ floor.name }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>

      <div class="pa-2">
        <!-- 未着席時 -->
        <v-btn
          depressed
          block
          color="#f6bf00"
          :to="{ name: 'room', params: { roomId: $route.params.roomId } }"
          v-if="$route.name === 'floor' && !sitRoom"
        >
          入室
        </v-btn>

        <!-- 着席中 -->
        <v-btn
          depressed
          block
          color="error"
          :to="{ name: 'room', params: { roomId: sitRoom } }"
          v-if="sitRoom"
        >
          着席中の教室に戻る
        </v-btn>
      </div>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
export default {
  props: {
    floors: Array,
  },
  data() {
    return {
      sitRoom: null, // 着席中の部屋
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('roomAuthSit'));
    this.sitRoom = response.data;
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
