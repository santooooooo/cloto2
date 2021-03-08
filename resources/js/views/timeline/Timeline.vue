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
        @click="showKarte = karte"
      >
        <v-card :ripple="true" class="btn text-left" :loading="loading">
          <v-card-actions class="white justify-center d-block">
            <v-img
              max-width="300"
              class="mx-auto my-2 rounded-xl"
              contain
              :src="$karte(karte, authUser.username) + karte.image"
              v-if="karte.image"
            ></v-img>

            <v-row align="center">
              <v-col class="d-flex" cols="4" sm="2" md="10">
                <!-- ユーザーアイコン -->
                <v-avatar>
                  <v-img :src="$storage('icon') + authUser.icon" contain max-width="50"> </v-img>
                </v-avatar>
                <!-- ユーザー名 -->
                <v-tooltip max-width="300" top>
                  <template v-slot:activator="{ on, attrs }">
                    <div v-bind="attrs" v-on="on">
                      <p class="content m-3 text-truncate">{{ karte.user.username }}</p>
                    </div>
                  </template>
                  <span>{{ karte.user.username }}</span>
                </v-tooltip>
              </v-col>
            </v-row>

            <!-- 活動内容 -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on">
                  <p class="content text-truncate">{{ karte.body }}</p>
                </div>
              </template>
              <span>{{ karte.body }}</span>
            </v-tooltip>

            <!-- 活動時間 -->
            <p class="content">{{ karte.activity_time.slice(0, 5) }}</p>

            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on" v-if="karte.achieve">
                  <p class="content text-truncate">{{ karte.achieve }}</p>
                </div>

                <div v-else>
                  <p class="content">未入力</p>
                </div>
              </template>
              <span>{{ karte.achieve }}</span>
            </v-tooltip>

            <!-- 次の課題 -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on" v-if="karte.challenge">
                  <p class="content text-truncate">{{ karte.challenge }}</p>
                </div>

                <div v-else>
                  <p class="content">未入力</p>
                </div>
              </template>
              <span>{{ karte.challenge }}</span>
            </v-tooltip>

            <!-- 参考文献 -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on" v-if="karte.reference">
                  <p class="content text-truncate">{{ karte.reference }}</p>
                </div>

                <div v-else>
                  <p class="content">未入力</p>
                </div>
              </template>
              <span>{{ karte.reference }}</span>
            </v-tooltip>

            <!-- タグ -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on" v-if="karte.tags.length">
                  <v-chip class="ma-2" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
                    {{ tag.name }}
                  </v-chip>
                </div>

                <div v-else>
                  <p class="content">タグなし</p>
                </div>
              </template>
              <v-chip class="ma-2" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
                {{ tag.name }}
              </v-chip>
            </v-tooltip>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <KarteDialog :karte="showKarte" @close="showKarte = $event" />
  </v-container>
</template>

<script>
import KarteDialog from '@/components/mypage/KarteDialog';

export default {
  data() {
    return {
      loading: false, // ローディング制御
      kartes: null, //カルテ一覧
      showKarte: null, // 詳細を表示するカルテ
    };
  },
  components: {
    KarteDialog,
  },
  async created() {
    this.loading = true;

    var response = await axios.get('/api/kartes');
    this.kartes = response.data;
    console.log(this.kartes);

    this.loading = false;
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
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
