<template>
  <v-col cols="4" class="px-0">
    <div class="position-fixed border-right pr-4">
      <h1
        class="rounded font-weight-bold text-h5 text-center white--text px-5 py-1"
        :style="{
          'background-color': $periodColor(currentPeriod()),
        }"
      >
        {{ currentPeriod(true) }}
      </h1>
      <h2
        class="rounded text-h6 font-weight-bolder white--text pl-2 py-1"
        :style="{
          'background-color': $classColor(currentClass),
        }"
      >
        <span v-if="currentClass <= 10">Class {{ currentClass }}</span>
        <span v-else>Clear</span>
      </h2>

      <ul class="px-2 overflow-y-auto">
        <li
          v-for="content in contents"
          :key="content.id"
          v-scroll-to="{ el: content.id, offset: -80 }"
          :class="[
            'my-1 pa-2 small grey--text',
            content.activeStart <= scrollY && scrollY < content.activeEnd ? 'active' : '',
          ]"
        >
          {{ content.title }}
        </li>
      </ul>
    </div>
  </v-col>
</template>

<script>
export default {
  props: {
    contents: Array, // 目次データ
  },
  data() {
    return {
      scrollY: 0, // スクロール位置
    };
  },
  computed: {
    currentClass() {
      // 現在閲覧中のクラス
      return Number(this.$route.params.class);
    },
  },
  methods: {
    /**
     * 現在閲覧中の期
     *
     * @param {Boolean} show - 画面表示するか
     * @return {String} 名前または表示名
     */
    currentPeriod: function (show = false) {
      return this.$periodName(this.currentClass, show);
    },
    /**
     * スクロールイベントの設定
     */
    setupScrollEvent: function () {
      // スクロール位置の取得
      this.scrollY = window.scrollY;
    },
  },
  mounted() {
    window.addEventListener('scroll', this.setupScrollEvent);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.setupScrollEvent);
  },
};
</script>

<style lang="scss" scoped>
ul {
  list-style: none;
  max-height: calc(80vh - 110px);

  li {
    cursor: pointer;

    &:hover {
      background: #98c9f7;
      border-radius: 4px;
      color: #ffffff !important;
    }
  }

  .active {
    background: #cfcccc;
    border-radius: 4px;
    box-shadow: 0 0 2px #000000;
  }
}
</style>
