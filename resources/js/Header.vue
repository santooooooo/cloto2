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
      :to="{ name: 'login' }"
      v-if="!authCheck && $route.name !== 'login'"
    >
      ログイン
    </v-btn>

    <v-btn
      depressed
      color="primary"
      :to="{ name: 'room', params: { roomId: authUser.room.id } }"
      v-if="authCheck && authUser.seat && $route.name !== 'room'"
    >
      ルームへ戻る
    </v-btn>

    <!-- ステータス -->
    <v-select
      v-model="status"
      :items="statuses"
      :color="$statusColor(status)"
      :item-color="$statusColor(status)"
      class="ml-9 mt-5"
      @change="updateStatus(status)"
      v-if="authCheck"
    >
      <template v-slot:selection="{ item }">
        <span :class="$statusColor(status) + '--text'">{{ item.text }}</span>
      </template>
    </v-select>

    <!-- 通知音ボタン -->
    <v-btn icon class="mx-6" @click="$store.dispatch('alert/switchSound')" v-if="authCheck">
      <v-icon large>
        {{ $store.getters['alert/isSoundOn'] ? 'mdi-music-note' : 'mdi-music-note-off' }}
      </v-icon>
    </v-btn>

    <!-- 通知一覧ボタン -->
    <div v-if="authCheck">
      <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-badge
            color="#f6bf00"
            offset-x="43"
            offset-y="23"
            :content="authUser.unread_notifications_count"
          >
            <v-btn icon v-bind="attrs" v-on="on" class="mr-6">
              <v-icon large>mdi-bell</v-icon>
            </v-btn>
          </v-badge>
        </template>
        <v-list dense>
          <div v-for="notification in authUser.notifications" :key="notification.id">
            <v-list-item
              v-if="notification.type === 'UserFollowed'"
              @click="showProfile(notification.username)"
            >
              <v-list-item-title>
                {{ notification.message }}
              </v-list-item-title>
            </v-list-item>
          </div>
        </v-list>
      </v-menu>

      <ProfileDialog
        :username="profile.username"
        @close="profile.dialog = $event"
        v-if="profile.dialog"
      />
    </div>
  </v-app-bar>

  <v-app-bar app dark height="64px" v-else>
    <img :src="$storage('system') + 'header_logo.svg'" />
  </v-app-bar>
</template>

<script>
import ProfileDialog from '@/components/commons/ProfileDialog';

export default {
  components: {
    ProfileDialog,
  },

  data() {
    return {
      status: null, // 現在のステータス
      statuses: [
        // ステータス一覧
        { text: '雑談OK', value: 'free' },
        { text: '自習中', value: 'busy' },
        { text: '離席中', value: 'away' },
      ],
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
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
     * @param {String} status - ステータス
     */
    updateStatus: async function (status) {
      await axios.post('/api/status/' + status);
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * プロフィールの表示
     *
     * @param {String} username - プロフィールを表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
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
