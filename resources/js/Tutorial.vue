<template>
  <v-dialog persistent v-model="tutorial" width="80%">
    <v-card>
      <v-card-title class="text-h5 grey lighten-2">使い方を学ぼう！</v-card-title>

      <div class="text-center">
        <video controls autoplay muted :src="$storage('system') + 'tutorial.mp4'"></video>
      </div>

      <v-card-actions>
        <small class="red--text ml-4">
          ※この動画はマイスタディから学習を開始すると表示されなくなります。
        </small>

        <v-spacer></v-spacer>

        <v-btn color="primary" text @click="tutorial = false" :to="{ name: 'mystudy' }">
          使ってみる
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      tutorial: false,
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  created() {
    this.tutorial = this.authUser.roadmaps.length ? false : true;
  },
};
</script>

<style lang="scss" scoped>
video {
  max-width: 100%;
  max-height: 70vh;
}
</style>
