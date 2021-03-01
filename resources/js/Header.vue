<template>
  <v-app-bar app dark height="64px" v-if="!isSmartphone">
    <v-app-bar-nav-icon @click.stop="$emit('open-drawer')" v-if="authCheck" />

    <router-link :to="{ name: 'index' }">
      <img :src="$storage('system') + 'header_logo.svg'" />
    </router-link>

    <span class="mt-4 mr-3 text-h4 font-weight-bold">α1.0</span>

    <v-btn
      text
      x-large
      class="font-weight-bold"
      href="https://spark.adobe.com/page/Z34f2zfDFQnUU"
      target="_blank"
    >
      使い方とQ&A
    </v-btn>

    <v-spacer></v-spacer>

    <v-btn
      text
      x-large
      class="font-weight-bold"
      :to="{ name: 'map' }"
      v-if="!authCheck && $route.name !== 'map'"
    >
      入場
    </v-btn>

    <v-btn
      depressed
      color="primary"
      :to="{ name: 'room', params: { roomId: authUser.seat.room_id } }"
      v-if="authCheck && authUser.seat && $route.name !== 'room'"
    >
      教室へ戻る
    </v-btn>

    <!-- ステータス -->
    <v-select
      v-model="status"
      :items="statuses"
      :color="color"
      :item-color="color"
      class="ml-9 mt-5"
      @change="updateStatus(status)"
      v-if="authCheck"
    >
      <template v-slot:selection="{ item }">
        <span :class="color + '--text'">{{ item.text }}</span>
      </template>
    </v-select>

    <!-- 通知音ボタン -->
    <v-btn
      color="white"
      icon
      class="mx-6"
      @click="$store.dispatch('alert/switchSound')"
      v-if="authCheck"
    >
      <v-icon large>
        {{ $store.getters['alert/isSoundOn'] ? 'mdi-volume-high' : 'mdi-volume-off' }}
      </v-icon>
    </v-btn>
  </v-app-bar>

  <v-app-bar app dark height="64px" v-else>
    <img :src="$storage('system') + 'header_logo.svg'" />
  </v-app-bar>
</template>

<script>
export default {
  data() {
    return {
      status: null, // 現在のステータス
      statuses: [
        // ステータス一覧
        { text: '雑談OK', value: 'free' },
        { text: '自習中', value: 'busy' },
        { text: '離席中', value: 'away' },
      ],
    };
  },
  computed: {
    isSmartphone() {
      if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
        return true;
      } else {
        return false;
      }
    },
    authCheck() {
      return this.$store.getters['auth/check'];
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
    color() {
      var color;
      switch (this.status) {
        case 'free':
          color = 'green';
          break;

        case 'busy':
          color = 'red';
          break;

        case 'away':
          color = 'grey';
          break;
      }

      return color;
    },
  },
  watch: {
    authCheck: async function (check, oldCheck) {
      // ログインまたはリロード時
      if (check && !oldCheck) {
        // ステータスの更新
        await this.updateStatus(this.authUser.status || 'free');
        this.status = this.authUser.status;
      }
    },
  },
  methods: {
    /**
     * ステータス更新処理
     *
     * @param String  status  ステータス
     */
    updateStatus: async function (status) {
      await axios.post('/api/status/' + status);
      await this.$store.dispatch('auth/syncAuthUser');
    },
  },
};
</script>

<style lang="scss" scoped>
img {
  max-height: 64px;
  padding: 10px;
}

a:hover {
  text-decoration: none;
}

.v-select {
  max-width: 150px;

  span {
    margin-left: 10px;
    font-size: 20px;
    font-weight: bold;
  }
}
</style>
