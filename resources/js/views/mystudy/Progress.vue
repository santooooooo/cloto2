<template>
  <v-container>
    <h1 class="font-weight-bold mt-4">あなたの「独学」を支援するCLOTOの「マイスタディ」</h1>
    <v-container class="my-8" fluid>
      <v-row>
        <v-col cols="4" class="pr-4 font-weight-black">
          <p>
            「マイスタディ」では、<br />
            右の図のような6つのコースと<br />
            それぞれに12段階のクラスで構成された<br />
            学習ロードマップに基づいて、<br />
            学習を進めていきます。
          </p>

          <p class="mt-12">
            「マイスタディ」と「コミュニティ」を<br />
            利用しながら独学を進め、<br />「玄人」を目指しましょう。
          </p>

          <v-col>
            <v-btn
              color="blue"
              class="white--text mt-2 w-75"
              :loading="loading"
              @click="startRoad()"
            >
              独学で学ぶ
            </v-btn>
          </v-col>
        </v-col>
        <v-col cols="8">
          <v-img
            max-height="1200"
            max-width="800"
            src="https://picsum.photos/id/11/500/300"
            class="mx-auto mb-10"
          ></v-img>
        </v-col>
      </v-row>
    </v-container>

    <!-- カルテ -->
    <vue-masonry-wall :items="kartes" :options="{ width: width, padding: 8 }">
      <template v-slot:default="{ item }">
        <v-card :width="width - 50" class="mx-auto pa-3">
          <v-card-actions class="d-block" v-if="item.activity_time">
            <v-img
              max-height="300"
              class="mx-auto my-2 rounded-xl"
              contain
              eager
              :src="item.path + item.image"
              v-if="item.image"
            ></v-img>

            <!-- タグ -->
            <v-chip class="ma-1" v-for="tag in item.tags" :key="tag.id" :value="tag.id">
              {{ tag.name }}
            </v-chip>

            <!-- 活動時間 -->
            <p
              :class="[
                'text-body-2',
                'font-weight-bold',
                item.image || item.tags.length ? 'mt-6' : '',
              ]"
            >
              活動時間：{{ item.activity_time.slice(0, 5) }}
            </p>

            <!-- 活動内容 -->
            <pre class="text-body-2" v-html="$formatStr(item.body)"></pre>

            <!-- 投稿日時 -->
            <p class="mt-6 mb-0 text-right small">
              {{ $moment(item.created_at).format('MM/DD HH:mm') }}
            </p>
          </v-card-actions>
        </v-card>
      </template>
    </vue-masonry-wall>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: 'マイスタディ',
      };
    },
  },
  data() {
    return {
      loading: false, // ローディング制御
      kartes: [], // ロードマップのカルテ一覧
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
    width() {
      return (this.$windowWidth - 250) / 3;
    },
  },
  methods: {
    /**
     * ロードの開始
     */
    startRoad: async function () {
      this.loading = true;

      if (this.authUser.roadmaps.length) {
        // ロード開始済み
        this.$router.push({
          name: 'docs',
          params: { roadName: 'javascript', class: this.authUser.roadmaps[0].in_progress },
        });
      } else {
        // ロード開始処理
        let response = await axios.post('/api/roadmaps');

        if (response.status === OK) {
          this.$router.push({ name: 'docs', params: { roadName: 'javascript', class: 0 } });
        }
      }

      this.loading = false;
    },
  },
  async created() {
    // ロードマップとカルテ一覧を取得
    let response = await axios.get('/api/roadmaps/' + this.authUser.roadmaps[0].id);
    this.kartes = response.data.kartes;
  },
};
</script>

<style lang="scss" scoped>
p {
  line-height: 2.5em;
}
</style>
