<template>
  <v-col cols="2" class="p-0 border-right">
    <div class="position-fixed">
      <h1 class="font-weight-bold text-h5 text-center green px-5">
        {{ period }}
      </h1>
      <h2 class="text-h6 font-weight-bolder green pl-2">{{ className }}</h2>

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
    className: String,
    contents: Array,
  },
  data() {
    return {
      scrollY: 0, // スクロール位置
    };
  },
  methods: {
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
