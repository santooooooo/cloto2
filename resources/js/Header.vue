<template>
  <v-app-bar app dark>
    <div class="iconPosition">
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
              leave();
              $emit('logout');
            "
          >
            <v-list-item-title>ログアウト</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>
    <v-spacer></v-spacer>

    <router-link :to="{ name: 'preRegister' }" v-if="!isRelease">
      <v-btn depressed color="primary" class="btn font-weight-bold">新規登録</v-btn>
    </router-link>
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
    leave: async function () {
      if (this.authUser.seat_id != null) {
        var endpoint = '';
        endpoint = this.$endpoint('seatLeave');
        await this.$http.post(endpoint);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.btn {
  margin-right: 10px;
}
.iconPosition {
  margin-left: 95%;
}
</style>
