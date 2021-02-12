<template>
  <v-container>
    <h1>
      <span class="text-h4 ml-2 mr-10">管理画面</span>
      <span class="text-h6 ml-10">{{ authUser.handlename }}様 ご利用ありがとうございます。</span>
    </h1>

    <v-container mt-10>
      <!-- ローディング画面 -->
      <v-overlay z-index="205" v-if="loading">
        <v-row justify="center">
          <v-progress-circular indeterminate size="50"></v-progress-circular>
        </v-row>
        <p class="text-h5 mt-12 text-center">データの送信中です。</p>
        <p class="text-body-2 text-center">
          画像のアップロードには時間がかかる場合があります．．．
        </p>
      </v-overlay>

      <!-- ファイル -->
      <h3>イベント一覧のアップロード</h3>
      <input type="file" @change="submitEvent" accept="image/png" ref="input" />

      <p class="text-body-1 mt-5">
        カレンダーは<a
          href="https://m136363.freecalend.com"
          target="_blank"
          rel="noopener noreferrer"
          >こちら</a
        >（ID：cloto / PW：cloto_no_calendar）
      </p>
    </v-container>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: '管理画面',
      };
    },
  },
  data() {
    return {
      loading: false,
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * イベント一覧画像の送信
     *
     * @param event 入力イベント
     */
    submitEvent: async function (event) {
      if (event.target.files[0]) {
        this.loading = true;

        var input = new FormData();
        input.append('event', event.target.files[0]);

        await axios.post('/api/admin/events', input);

        this.$refs.input.value = '';
        this.loading = false;
      }
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
</style>
