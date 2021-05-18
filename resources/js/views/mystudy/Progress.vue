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

    <!-- コンテンツ一覧 -->
    <h5 class="text-h5 text-center">コンテンツ一覧</h5>
    <v-row class="mb-12" justify="center">
      <v-btn
        depressed
        color="success"
        class="ma-4"
        v-for="content in contents"
        :key="content"
        :disabled="content > authUser.roadmaps[0].in_progress"
        :to="{ name: 'docs', params: { roadName: 'javascript', class: content } }"
      >
        Class {{ content }}
      </v-btn>
    </v-row>

    <!-- カルテ -->
    <vue-masonry-wall :items="kartes" :options="{ width: width, padding: 8 }">
      <template v-slot:default="{ item }">
        <v-card :width="width - 50" class="mx-auto pa-3">
          <KarteContainer :karte="item" />
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
      contents: [...Array(11).keys()], // コンテンツ一覧
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
    if (this.authUser.roadmaps.length) {
      let response = await axios.get('/api/roadmaps/' + this.authUser.roadmaps[0].id);
      this.kartes = response.data.kartes;
    }
  },
};
</script>

<style lang="scss" scoped>
p {
  line-height: 2.5em;
}
</style>
