<template>
  <v-col cols="2" class="p-0 border-right">
    <div class="position-fixed">
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

      <ul class="ml-2 p-0">
        <li
          v-for="content in contents"
          :key="content.id"
          v-scroll-to="{ el: content.id, offset: -80 }"
          :class="[
            'my-6 pa-2 grey--text content',
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
    period: String,
    contents: Array,
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
     * 期の名前の取得
     *
     * @param {String} period - 期
     * @return {String} 色
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

  & > li {
    cursor: pointer;
  }
}

.content {
  &:hover {
    background: rgb(152, 201, 247);
    color: white !important;
    border-radius: 4%;
  }
}

.active {
  background: rgb(207, 204, 204, 0.6);
  border-radius: 4%;
  box-shadow: 0 0 2px black;
}
</style>
