<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    persistent
    no-click-animation
    transition="dialog-bottom-transition"
  >
    <v-toolbar dark height="64px">
      <v-spacer></v-spacer>
      <v-btn depressed dark color="success" class="ml-3" @click="close()">
        自習室に戻る
        <v-icon class="white--text ml-2">mdi-export</v-icon>
      </v-btn>
    </v-toolbar>

    <div id="container" ref="container">
      <div v-if="authUser.seat.media">
        <!-- 画像 -->
        <img
          :src="$storage('media') + authUser.seat.media.data"
          class="media"
          v-if="authUser.seat.media.type === 'image'"
        />

        <!-- ビデオ -->
        <video
          controls
          :src="$storage('media') + authUser.seat.media.data"
          class="media"
          v-else-if="authUser.seat.media.type === 'video'"
        ></video>

        <!-- テキスト -->
        <v-card flat class="media overflow-y-auto" v-else-if="authUser.seat.media.type === 'text'">
          <pre class="text-body-1">{{ authUser.seat.media.data }}</pre>
        </v-card>
      </div>
    </div>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      dialog: true,
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    close: function () {
      this.$emit('close');
      this.dialog = false;
    },
  },
  mounted() {
    // 背景の設定
    this.$refs.container.style.backgroundImage =
      'url("' + this.$storage('seat') + 'seat_' + this.authUser.seat.id + '.png")';
  },
};
</script>

<style lang="scss" scoped>
#container {
  background-size: cover;
  height: calc(100vh - 64px);
  position: relative;

  .media {
    max-width: 60%;
    max-height: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    pre {
      margin: 1em;
      white-space: pre-wrap;
    }
  }
}
</style>
