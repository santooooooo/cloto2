<template>
  <v-col cols="4" class="px-0">
    <div class="position-fixed border-right pr-4">
      <h1
        class="rounded font-weight-bold text-h5 text-center white--text px-5 py-1"
        :style="{
          'background-color': $periodColor(period),
        }"
      >
        {{ getPeriodName(period) }}
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

      <ul class="pl-2 overflow-y-auto" id="contents-list">
        <li
          v-for="content in contents"
          :key="content.id"
          v-scroll-to="{ el: content.id, offset: -80 }"
          :class="[
            'my-6 pa-2 grey--text',
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
    period: String, // 期間名
    contents: Array, // 目次データ
  },
  data() {
    return {
      scrollY: 0, // スクロール位置
    };
  },
  computed: {
    currentClass() {
      return Number(this.$route.params.class);
    },
  },
  methods: {
    /**
     * 期の表示名の取得
     *
     * @param {String} period - 期
     * @return {String} 表示名
     */
    getPeriodName: function (period) {
      let name;
      switch (period) {
        case 'introduction':
          name = '入門期';
          break;

        case 'beginner':
          name = '素人期';
          break;

        case 'intermediate':
          name = '苦労人前期';
          break;

        case 'advanced':
          name = '苦労人後期';
          break;

        case 'expert':
          name = '玄人期';
          break;
      }

      return name;
    },
    /**
     * スクロールイベントの設定
     */
    setupScrollEvent: function () {
      // スクロール位置の取得
      this.scrollY = window.scrollY;
      console.log(this.scrollY);
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
#contents-list {
  list-style: none;
  font-size: 0.6rem;
  max-height: 500px;
  line-height: 1.2;

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
