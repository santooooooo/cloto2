<template>
  <v-container>
    <h1 class="text-h4">タイムライン</h1>

    <v-row>
      <v-spacer></v-spacer>
      <v-col
        v-for="karte in kartes"
        :key="karte.id"
        cols="12"
        sm="6"
        md="4"
        @click="showData(karte)"
      >
        <v-card :ripple="true" class="btn text-left">
          <v-card-actions class="white justify-center d-block">
            <v-img
              max-width="300"
              class="mx-auto my-2 rounded-xl"
              contain
              :src="$karte(karte, authUser.username) + karte.image"
              v-if="karte.image"
            ></v-img>

            <v-row align="center">
              <v-col
                class="d-flex"
                cols="4"
                sm="2"
                md="10"
                @click="showProfile(karte.user.username)"
              >
                <!-- ユーザーアイコン -->
                <v-avatar>
                  <v-img
                    :src="$storage('icon') + authUser.icon"
                    contain
                    max-width="50"
                    max-height="50"
                  >
                  </v-img>
                </v-avatar>
                <!-- ユーザー名 -->
                <div class="ml-3">
                  <p class="content m-0 p-0 text-truncate">{{ karte.user.username }}</p>
                  <p class="content m-0 p-0 text-truncate text-secondary">
                    @{{ karte.user.username }}
                  </p>
                </div>
              </v-col>
            </v-row>

            <!-- タグ -->
            <v-chip class="ml-0" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
              {{ tag.name }}
            </v-chip>

            <!-- 活動時間 -->
            <p class="content">{{ karte.activity_time.slice(0, 5) }}</p>

            <!-- 活動内容 -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on">
                  <p class="content text-truncate">{{ karte.body }}</p>
                </div>
              </template>
              <span>{{ karte.body }}</span>
            </v-tooltip>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <ProfileDialog
      :username="profile.username"
      @close="profile.dialog = $event"
      v-if="profile.dialog"
    />
    <KarteDialog :karte="karte" @close="karte = null" />
  </v-container>
</template>

<script>
import KarteDialog from '@/components/mypage/KarteDialog';
import ProfileDialog from '@/components/timeline/ProfileDialog';

export default {
  data() {
    return {
      kartes: null, //カルテ一覧
      karte: null, // 詳細を表示するカルテ
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
      isKarte: true, //カルテとユーザープロフィールの表示の制御
    };
  },
  components: {
    KarteDialog,
    ProfileDialog,
  },
  async created() {
    var response = await axios.get('/api/kartes');
    this.kartes = response.data;
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    showData: function (info) {
      setTimeout(this.showKarte(info, this.isKarte), 10);
      this.isKarte = true;
    },
    showKarte: function (info, isKarte) {
      if (isKarte) {
        this.karte = info;
      }
    },
    showProfile: function (username) {
      this.isKarte = false;
      this.profile.dialog = true;
      this.profile.username = username;
    },
  },
};
</script>

<style lang="scss" scoped>
h1 {
  position: relative;
  padding: 1rem 2rem;
  border-bottom: 6px solid #094;

  &:before {
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 20%;
    height: 6px;
    content: '';
    background: #00cc5b;
  }
}

tbody {
  tr {
    cursor: pointer;

    .content {
      width: 100px;
      margin: 0;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
  }
}
</style>
