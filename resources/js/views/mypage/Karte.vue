<template>
  <v-container>
    <v-card max-width="1080" tile class="ma-5" :loading="loading">
      <v-simple-table headers-length:5>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">画像</th>
              <th class="text-left">活動内容</th>
              <th class="text-left">活動時間</th>
              <th class="text-left">達成したこと</th>
              <th class="text-left">次の課題</th>
              <th class="text-left">参考文献</th>
              <th class="text-left">タグ</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="karte in kartes" :key="karte.id" @click="showKarte = karte">
              <!-- 画像 -->
              <td>
                <v-img
                  max-width="120"
                  class="mx-auto my-2"
                  contain
                  :src="karte.path + karte.image"
                  v-if="karte.image"
                />

                <v-sheet
                  color="grey lighten-2"
                  width="120"
                  height="120"
                  class="mx-auto my-2"
                  v-else
                ></v-sheet>
              </td>

              <!-- 活動内容 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on">
                    <p class="content">{{ karte.body }}</p>
                  </td>
                </template>
                <span>{{ karte.body }}</span>
              </v-tooltip>

              <!-- 活動時間 -->
              <td>
                <p class="content">{{ karte.activity_time.slice(0, 5) }}</p>
              </td>

              <!-- 達成したこと -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.achieve">
                    <p class="content">{{ karte.achieve }}</p>
                  </td>

                  <td v-else>
                    <p class="content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.achieve }}</span>
              </v-tooltip>

              <!-- 次の課題 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.challenge">
                    <p class="content">{{ karte.challenge }}</p>
                  </td>

                  <td v-else>
                    <p class="content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.challenge }}</span>
              </v-tooltip>

              <!-- 参考文献 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.reference">
                    <p class="content">{{ karte.reference }}</p>
                  </td>

                  <td v-else>
                    <p class="content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.reference }}</span>
              </v-tooltip>

              <!-- タグ -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.tags.length">
                    <p class="content">タグ{{ karte.tags.length }}個</p>
                  </td>

                  <td v-else>
                    <p class="content">タグなし</p>
                  </td>
                </template>

                <v-chip class="ma-2" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
                  {{ tag.name }}
                </v-chip>
              </v-tooltip>
            </tr>
          </tbody>
        </template>
      </v-simple-table>

      <v-card-text class="text-center" v-if="!loading && !kartes.length">未投稿</v-card-text>
    </v-card>

    <!-- カルテ表示ダイアログ -->
    <KarteDialog :karte="showKarte" @close="showKarte = $event" />
  </v-container>
</template>

<script>
import KarteDialog from '@/components/user/KarteDialog';

export default {
  head: {
    title() {
      return {
        inner: 'カルテ',
      };
    },
  },
  components: {
    KarteDialog,
  },
  data() {
    return {
      loading: false, // ローディング制御
      kartes: null, // カルテ一覧
      showKarte: null, // 詳細を表示するカルテ
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  async created() {
    this.loading = true;

    let response = await axios.get('/api/kartes/' + this.authUser.id);
    this.kartes = response.data;

    this.loading = false;
  },
};
</script>

<style lang="scss" scoped>
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
