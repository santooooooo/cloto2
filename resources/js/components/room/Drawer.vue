<template>
  <v-navigation-drawer absolute permanent white>
    <v-list-item two-line class="px-3">
      <!-- <router-link :to="{ name: 'index' }">
        <img :src="$storage('system') + 'header-logo.svg'" />
      </router-link> -->
    </v-list-item>

    <v-list nav>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title
            ><p class="roomName">{{ roomName }} 教室</p></v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-list-item :to="{ name: 'home' }">
        <!-- <v-list-item-icon>
          <v-icon>mdi-home-city</v-icon>
        </v-list-item-icon> -->
        <v-list-item-content>
          <v-list-item-title class="roomWork">目標入力</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item :to="{ name: 'home' }">
        <v-list-item-content>
          <v-list-item-titlec lass="roomWork">カルテ記入</v-list-item-titlec>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <div class="pa-2">
      <v-btn block color="error" @click="$emit('leaveRoom')">退席</v-btn>
    </div>
  </v-navigation-drawer>
</template>

<script>
export default {
  props: {
    roomName: String,
  },

  computed: {
    authCheck() {
      return this.$store.getters['auth/check'];
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {},
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.roomName {
  font-size: 28px;
  color: rgb(255, 201, 20);
  padding-bottom: 0%;
  font-weight: bold;
}
.roomWork {
  font-weight: bold;
}
</style>
