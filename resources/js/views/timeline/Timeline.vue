<template>
  <v-container>
    <h1 class="text-h4">タイムライン</h1>

    <v-row>
      <v-col v-for="karte in kartes.slice().reverse()" :key="karte.id" sm="6" md="4">
        <v-card width="400" class="mx-auto pa-3">
          <v-card-actions class="d-block" @click="showKarte = karte">
            <v-img
              width="300"
              height="200"
              class="mx-auto my-2 rounded-xl"
              contain
              :src="karte.path + karte.image"
              v-if="karte.image"
            ></v-img>
            <v-sheet
              max-width="300"
              height="200"
              class="mx-auto my-2 rounded-xl"
              color="grey lighten-2"
              v-else
            ></v-sheet>

            <!-- タグ -->
            <v-chip class="ma-1" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
              {{ tag.name }}
            </v-chip>

            <!-- 投稿日時 -->
            <p class="mt-6 mb-0 text-right small">{{ formatDateTime(karte.created_at) }}</p>

            <!-- 活動時間 -->
            <p class="text-body-2 font-weight-bold">{{ karte.activity_time.slice(0, 5) }}</p>

            <!-- 活動内容 -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on">
                  <p class="mb-0 text-body-2 text-truncate">{{ karte.body }}</p>
                </div>
              </template>
              <span>{{ karte.body }}</span>
            </v-tooltip>
          </v-card-actions>

          <v-divider></v-divider>

          <v-row no-gutters align="end" class="mt-3" @click="showProfile(karte.user.username)">
            <!-- ユーザーアイコン -->
            <v-avatar size="50">
              <img :src="$storage('icon') + karte.user.icon" />
            </v-avatar>

            <!-- ユーザー名 -->
            <div class="ml-3">
              <p class="mb-0 text-body-1">{{ karte.user.username }}</p>
              <p class="mb-0 text-body-2">@{{ karte.user.username }}</p>
            </div>
          </v-row>
        </v-card>
      </v-col>
    </v-row>

    <KarteDialog :karte="showKarte" @close="showKarte = null" />
    <ProfileDialog
      :username="profile.username"
      @close="profile.dialog = $event"
      v-if="profile.dialog"
    />
  </v-container>
</template>

<script>
import KarteDialog from '@/components/mypage/KarteDialog';
import ProfileDialog from '@/components/timeline/ProfileDialog';

export default {
  data() {
    return {
      kartes: [], // カルテ一覧
      showKarte: null, // 詳細を表示するカルテ
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
    };
  },
  components: {
    KarteDialog,
    ProfileDialog,
  },
  methods: {
    /**
     * プロフィールの表示
     *
     * @param {String} username - プロフィールを表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
    },

    /**
     * 日時のフォーマット
     *
     * @param {String} timestamp - フォーマットする日時
     * @return {String} フォーマット後の日時
     */
    formatDateTime: function (timestamp) {
      let dateTime = new Date(timestamp);

      let month = String(dateTime.getMonth() + 1);
      let day = String(dateTime.getDate());

      // 2桁で時間を取得
      let hour = String(dateTime.getHours());
      if (hour.length === 1) {
        hour = '0' + hour;
      }
      // 2桁で分数を取得
      let minute = String(dateTime.getMinutes());
      if (minute.length === 1) {
        minute = '0' + minute;
      }

      return month + '/' + day + ' ' + hour + ':' + minute;
    },
  },
  async created() {
    let response = await axios.get('/api/kartes');
    this.kartes = response.data;
  },
};
</script>

<style lang="scss" scoped>
h1 {
  position: relative;
  padding: 1rem 2rem;
  border-bottom: 6px solid #ca9f01;

  &:before {
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 20%;
    height: 6px;
    content: '';
    background: #f6bf00;
  }
}

.v-card {
  cursor: pointer;
}
</style>
