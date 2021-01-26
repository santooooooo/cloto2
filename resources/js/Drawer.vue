<template>
  <v-navigation-drawer app dark temporary :value="value" @input="$emit('input', $event)">
    <v-list-item two-line class="px-3" v-if="authUser">
      <v-list-item-avatar>
        <img :src="$storage('icon') + authUser.icon" />
      </v-list-item-avatar>

      <v-list-item-content>
        <v-list-item-title>{{ authUser.handlename }}</v-list-item-title>
        <v-list-item-subtitle>{{ '@' + authUser.username }}</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list nav>
      <v-list-item exact :to="{ name: 'entrance' }">
        <v-list-item-icon>
          <v-icon>mdi-home-city</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>フロア案内</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact :to="{ name: 'mypage' }">
        <v-list-item-icon>
          <v-icon>mdi-account</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>マイページ</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <template v-slot:append>
      <div class="pa-2">
        <v-btn block @click="$emit('logout')">ログアウト</v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false,
    },
  },
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

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
