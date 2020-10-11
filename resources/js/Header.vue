<template>
  <v-app-bar app dark>
    <router-link :to="{ name: 'index' }" v-if="!isRelease">
      <img :src="$storage('system') + 'header-logo.svg'" />
    </router-link>

    <div v-else>
      <v-menu bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn icon v-bind="attrs" v-on="on">
            <v-row justify="space-around">
              <v-avatar>
                <img :src="$storage('icon') + authUser.icon" alt="アイコン" />
              </v-avatar>
            </v-row>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            @click="$router.push({ name: 'userPage', params: { username: authUser.username } })"
          >
            <v-list-item-title>プロフィール</v-list-item-title>
          </v-list-item>
          <v-list-item
            @click="
              $emit('leave');
              $emit('logout');
            "
          >
            <v-list-item-title>ログアウト</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>

    <v-spacer></v-spacer>

    <v-btn
      depressed
      small
      color="#00acee"
      class="font-weight-bold"
      target="_blank"
      href="https://twitter.com/cloto_jp"
      v-if="!isRelease"
      ><v-icon>mdi-twitter</v-icon>cloto_jp</v-btn
    >
  </v-app-bar>
</template>

<script>
export default {
  computed: {
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {
    // leave: async function () {
    //   if (this.authUser.seat_id != null) {
    //     var endpoint = '';
    //     endpoint = this.$endpoint('seatLeave');
    //     await this.$http.post(endpoint);
    //   }
    // },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 15px 0;
}

a:hover {
  text-decoration: none;
}
.iconPosition {
  margin-left: 95%;
}
</style>
