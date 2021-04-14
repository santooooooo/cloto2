<template>
  <v-layout class="overflow-y-auto" id="information" ref="information">
    <v-container fluid>
      <!-- イベント案内 -->
      <v-sheet color="white" width="100%" max-height="40%">
        <img
          :src="$storage('system') + 'event.png?' + Math.random().toString(32).substring(2)"
          id="event"
        />
        <p class="text-h5 ma-2">
          今月のイベント一覧は<a
            href="https://freecalend.com/open/mem136363_nopopon"
            target="_blank"
            rel="noopener noreferrer"
            >こちら</a
          >
        </p>
      </v-sheet>

      <!-- タイムライン -->
      <Timeline />
    </v-container>
  </v-layout>
</template>

<script>
import Timeline from '@/components/home/Timeline';

export default {
  components: {
    Timeline,
  },
  mounted() {
    this.$refs.information.style.backgroundImage =
      'url("' + this.$storage('system') + 'information.png")';
  },
};
</script>

<style lang="scss" scoped>
#information {
  height: calc(100vh - 64px);
  background-size: cover;

  #event {
    max-width: 100%;
  }
}
</style>
