<template>
  <v-navigation-drawer class="drawer" absolute permanent color="grey lighten-3">
    <!-- <router-link :to="{ name: 'index' }">
        <img :src="$storage('system') + 'header-logo.svg'" />
      </router-link> -->

    <v-list nav>
      <v-list-item>
        <v-list-item-content> </v-list-item-content>
      </v-list-item>
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
          <v-list-item-title class="roomWork">カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="roomWork">カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="roomWork">カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="roomWork">カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <template v-slot:append>
      <div class="pa-2">
        <v-btn block @click="$emit('leaveRoom')">退席</v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      group: null,
    };
  },
  watch: {
    group() {
      this.drawer = false;
    },
  },
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
.drawer {
  // box-shadow: 0 10px 25px 0 rgba(0, 0, 0, .5);
}

.roomName {
  font-size: 28px;
  color: rgb(255, 201, 20);
  padding-bottom: 0%;
  font-weight: bold;
}

.roomWork {
  width: 100%;
}

.roomWork:hover {
  /*ホバーしたとき*/
  font-weight: bolder;
}
</style>
