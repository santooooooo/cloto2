<template>
  <v-navigation-drawer app dark fixed permanent>
    <v-list-item two-line class="px-3">
      <!-- <router-link :to="{ name: 'index' }">
        <img :src="$storage('system') + 'header-logo.svg'" />
      </router-link> -->
      
    </v-list-item>

    <v-divider></v-divider>

    <v-list nav>
      <v-list-item :to="{ name: 'home' }">
        <!-- <v-list-item-icon>
          <v-icon>mdi-home-city</v-icon>
        </v-list-item-icon> -->
        <v-list-item-content>
          <v-list-item-title>目標入力</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item :to="{ name: 'home' }">
        <v-list-item-content>
          <v-list-item-title>カルテ記入</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>


    <template v-slot:append>
      <div class="pa-2">
        <!-- <v-btn block @click="$emit('logout')">ログアウト</v-btn> -->
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
export default {
  computed: {
    authCheck() {
      return this.$store.getters['auth/check'];
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>
