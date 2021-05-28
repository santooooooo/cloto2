<template>
  <v-list nav dense class="ma-4" v-if="authUser && authUser.roadmaps.length">
    <v-list-item-group color="#f6bf00">
      <v-list-item
        class="mb-4"
        :style="{
          'background-color': $periodColor(
            0 <= authUser.roadmaps[0].in_progress ? 'introduction' : ''
          ),
        }"
      >
        <v-list-item-content>
          <v-list-item-title class="text-center white--text">
            <span class="text-body-2 font-weight-bold pr-2">入門期</span>
            <small v-if="authUser.roadmaps[0].in_progress == 0">取り組み中</small>
            <small v-else-if="0 < authUser.roadmaps[0].in_progress">解放済</small>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item
        class="mb-4"
        :style="{
          'background-color': $periodColor(1 <= authUser.roadmaps[0].in_progress ? 'beginner' : ''),
        }"
      >
        <v-list-item-content>
          <v-list-item-title class="text-center white--text">
            <span class="text-body-2 font-weight-bold pr-2">素人期</span>
            <small v-if="authUser.roadmaps[0].in_progress < 1">未開放</small>
            <small
              v-else-if="
                1 <= authUser.roadmaps[0].in_progress && authUser.roadmaps[0].in_progress <= 3
              "
            >
              取り組み中
            </small>
            <small v-else-if="3 < authUser.roadmaps[0].in_progress">解放済</small>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item
        class="mb-4"
        :style="{
          'background-color': $periodColor(
            4 <= authUser.roadmaps[0].in_progress ? 'intermediate' : ''
          ),
        }"
      >
        <v-list-item-content>
          <v-list-item-title class="text-center white--text">
            <span class="text-body-2 font-weight-bold pr-2">苦労人前期</span>
            <small v-if="authUser.roadmaps[0].in_progress < 4">未開放</small>
            <small
              v-else-if="
                4 <= authUser.roadmaps[0].in_progress && authUser.roadmaps[0].in_progress <= 6
              "
            >
              取り組み中
            </small>
            <small v-else-if="6 < authUser.roadmaps[0].in_progress">解放済</small>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item
        class="mb-4"
        :style="{
          'background-color': $periodColor(7 <= authUser.roadmaps[0].in_progress ? 'advanced' : ''),
        }"
      >
        <v-list-item-content>
          <v-list-item-title class="text-center white--text">
            <span class="text-body-2 font-weight-bold pr-2">苦労人後期</span>
            <small v-if="authUser.roadmaps[0].in_progress < 7">未開放</small>
            <small
              v-else-if="
                7 <= authUser.roadmaps[0].in_progress && authUser.roadmaps[0].in_progress <= 10
              "
            >
              取り組み中
            </small>
            <small v-else-if="10 < authUser.roadmaps[0].in_progress">解放済</small>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item
        class="mb-4"
        :style="{
          'background-color': $periodColor(11 <= authUser.roadmaps[0].in_progress ? 'expert' : ''),
        }"
      >
        <v-list-item-content>
          <v-list-item-title class="text-center white--text">
            <span class="text-body-2 font-weight-bold pr-2">玄人期</span>
            <small v-if="authUser.roadmaps[0].in_progress < 11">未開放</small>
            <small v-else-if="11 <= authUser.roadmaps[0].in_progress">取り組み中</small>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>

<style lang="scss" scoped>
.v-list-item {
  cursor: default;
}
</style>
