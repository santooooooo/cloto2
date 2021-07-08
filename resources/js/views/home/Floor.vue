<template>
  <v-layout id="floor" :style="!authUser.seat ? 'cursor: pointer' : ''" @click="enterRoom()">
    <v-flex>
      <!-- ローディング画面 -->
      <v-overlay :value="loading">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>

      <v-row no-gutters justify="center">
        <div id="canvas-container" v-dragscroll>
          <canvas :width="roomWidth" :height="roomHeight" id="canvas"></canvas>
        </div>
      </v-row>
    </v-flex>
  </v-layout>
</template>

<script>
import { NOT_FOUND } from '@/consts/status';

export default {
  data() {
    return {
      canvas: null, // キャンバスエリア
      loading: false, // ローディング制御
      roomData: {}, // 教室データ
      roomWidth: 2160, // 教室サイズ
      roomHeight: 1200, // 教室サイズ
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },

  watch: {
    $windowWidth: function (windowWidth) {
      // ウィンドウリサイズ時に拡大率を変更
      if (this.canvas) {
        let zoom = (windowWidth - 260) / this.roomWidth;
        this.setZoom(zoom);
      }
    },
  },

  methods: {
    /**
     * 教室の設定
     */
    setRoom: async function () {
      this.loading = true;

      // 教室データの取得
      let response = await axios.get('/api/rooms/' + this.$route.params.roomId);
      this.roomData = response.data;

      /**
       * キャンバスの設定
       */
      this.canvas = new fabric.Canvas('canvas', {
        preserveObjectStacking: true, // オブジェクトの重なり順の固定
      });
      this.canvas.selection = false; // エリア選択の無効化
      this.canvas.setBackgroundImage(
        this.$storage('room') + 'room_' + this.roomData.id + '.png',
        this.canvas.renderAll.bind(this.canvas)
      );
      if (!this.authUser.seat) {
        this.canvas.defaultCursor = 'pointer';
      }

      // サイズの設定（横幅MAX）
      let zoom = (this.$windowWidth - 260) / this.roomWidth;
      this.setZoom(zoom);

      // 座席の設定
      this.roomData.sections.forEach((section) => {
        section.seats.forEach((seat) => {
          if (seat.status == 'break') {
            this.canvas.add(
              new fabric.Circle({
                fill: '#FF0000',
                opacity: 0.3,
                left: seat.position.x,
                top: seat.position.y,
                originX: 'center',
                originY: 'center',
                radius: seat.size / 2,
                strokeWidth: 1,
                hasControls: false, // 図形周囲のコントロールボタンの無効化
                hasBorders: false, // 図形周囲のボーダーの無効化
                lockMovementX: true, // 横移動の禁止
                lockMovementY: true, // 縦移動の禁止
                hoverCursor: 'default', // カーソルの変更を禁止
              })
            );
          }

          // 誰かが座っている時
          if (seat.status !== null && seat.status != 'break') {
            this.setUser(seat);
          }
        });
      });

      this.loading = false;
    },

    /**
     * ユーザーの設置
     *
     * @param {Object} seat - 着席している座席
     */
    setUser: function (seat) {
      // 念の為ユーザーの存在確認
      if (seat.user) {
        fabric.Image.fromURL(this.$storage('icon') + seat.user.icon, (img) => {
          let status = new fabric.Circle({
            originX: 'center',
            originY: 'center',
            width: 10,
            height: 10,
            radius: seat.size / 2,
            strokeWidth: 10,
            stroke: this.$statusColor(seat.user.status),
          });

          let icon = img.set({
            originX: 'center',
            originY: 'center',
            scaleX: seat.size / img.width,
            scaleY: seat.size / img.height,
            clipPath: new fabric.Circle({
              originX: 'center',
              originY: 'center',
              scaleX: img.width / seat.size,
              scaleY: img.height / seat.size,
              radius: seat.size / 2,
            }),
          });

          let userObject = new fabric.Group([status, icon], {
            left: seat.position.x,
            top: seat.position.y,
            originX: 'center',
            originY: 'center',
            hoverCursor: !this.authUser.seat ? 'pointer' : 'cursor',
            selectable: false, // 図形の選択を禁止
          });

          // 描画
          this.canvas.add(userObject);
        });
      }
    },

    /**
     * 拡大の適用
     *
     * @param {Number} zoom - 拡大率
     */
    setZoom: function (zoom) {
      this.canvas.setZoom(zoom);
      this.canvas.setWidth(this.roomWidth * zoom);
      this.canvas.setHeight(this.roomHeight * zoom);
    },

    /**
     * 入室
     */
    enterRoom: function () {
      if (!this.authUser.seat) {
        this.$router.push({ name: 'room', params: { roomId: this.$route.params.roomId } });
      }
    },
  },

  async mounted() {
    await this.setRoom();
  },

  beforeRouteEnter: async (to, from, next) => {
    const response = await axios.get('/api/rooms/' + to.params.roomId);
    if (response.status === NOT_FOUND) {
      next({ path: '/404' });
    } else {
      next();
    }
  },
};
</script>

<style lang="scss" scoped>
#floor {
  background-image: url('/storage/system/room_background.jpg');
  background-size: cover;

  #canvas-container {
    height: calc(100vh - 64px);
    margin-right: 250px;
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

    &::-webkit-scrollbar {
      display: none;
    }
  }
}
</style>
