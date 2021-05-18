<template>
  <v-container class="d-block">
    <div class="pointer" @click="showKarte(karte.id)">
      <v-img
        max-height="300"
        class="mx-auto my-2 rounded-xl"
        contain
        eager
        :src="karte.path + karte.image"
        v-if="karte.image"
      ></v-img>

      <!-- タグ -->
      <v-chip class="ma-1" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
        {{ tag.name }}
      </v-chip>

      <!-- 活動時間 -->
      <p
        :class="['text-body-2', 'font-weight-bold', karte.image || karte.tags.length ? 'mt-6' : '']"
      >
        活動時間：{{ karte.activity_time.slice(0, 5) }}
      </p>

      <!-- 活動内容 -->
      <pre class="text-body-2" v-html="$formatStr(karte.body)"></pre>

      <!-- 投稿日時 -->
      <p class="mt-6 mb-0 text-right small">
        {{ $moment(karte.created_at).format('MM/DD HH:mm') }}
      </p>
    </div>

    <KarteDialog :karteId="showKarteId" @close="showKarteId = $event" />
  </v-container>
</template>

<script>
export default {
  props: {
    karte: Object, // 表示するカルテ
  },
  data() {
    return {
      showKarteId: null, // 詳細を表示するカルテID
    };
  },
  methods: {
    /**
     * カルテの詳細表示
     *
     * @param {Number} karteId - 詳細を表示するカルテID
     */
    showKarte: function (karteId) {
      if (karteId) {
        this.showKarteId = karteId;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.pointer {
  cursor: pointer;
}
</style>
