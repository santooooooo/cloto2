<template>
  <v-layout id="floor">
    <v-flex>
      <!-- ローディング画面 -->
      <v-overlay :value="isLoading">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>

      <v-row no-gutters justify="center">
        <div id="canvas-container" :style="canvasContainerStyle" v-dragscroll>
          <canvas :width="roomWidth" :height="roomHeight" id="canvas"></canvas>
        </div>
      </v-row>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      windowWidth: window.innerWidth, // ウィンドウの横幅
      windowHeight: window.innerHeight - 64, // ウィンドウの縦幅（ヘッダーを除く）
      canvas: '', // キャンバスエリア
      isLoading: false, // ロードの制御
      roomData: {}, // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHeight: 600, // 教室サイズ
    };
  },

  computed: {
    canvasContainerStyle() {
      return {
        height: this.windowHeight + 'px',
        'margin-top': this.windowHeight < this.roomHeight + 100 ? '0px' : '50px',
        'margin-right': this.windowWidth < this.roomWidth + 250 ? '250px' : '0px',
      };
    },
  },

  watch: {
    '$route.params.roomId': async function (val) {
      // 教室を更新
      await this.setRoom();
    },
  },

  methods: {
    /**
     * 教室の設定
     */
    setRoom: async function () {
      this.isLoading = true;

      // 教室データの取得
      var response = await this.$http.get(this.$endpoint('roomShow', [this.$route.params.roomId]));
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

      // 座席の設定
      this.roomData.sections.forEach((section, sectionIndex) => {
        section.seats.forEach((seat, seatIndex) => {
          var color = '';
          if (seat.status == 'break') {
            color = '#FF0000';
          }

          this.canvas.add(
            new fabric.Circle({
              seatId: seat.id,
              sectionId: section.id,
              role: section.role,
              fill: color,
              reservationId: seat.reservation_user_id,
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

          // 誰かが座っている時
          if (seat.status !== null && seat.status != 'break') {
            this.setUser(seat);
          }
        });

        this.isLoading = false;
      });
    },

    /**
     * アイコンの設置
     *
     * @param Object  seat  着席する座席
     */
    setUser: function (seat) {
      fabric.Image.fromURL(this.$storage('icon') + seat.user.icon, (icon) => {
        icon.set({
          userId: seat.user.id,
          left: seat.position.x,
          top: seat.position.y,
          originX: 'center',
          originY: 'center',
          scaleX: seat.size / icon.width,
          scaleY: seat.size / icon.height,
          clipPath: new fabric.Circle({
            scaleX: icon.width / seat.size,
            scaleY: icon.height / seat.size,
            radius: seat.size / 2,
            originX: 'center',
            originY: 'center',
          }),
          selectable: false, // 図形の選択を禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        });

        // 描画
        this.canvas.add(icon);
      });
    },
  },

  beforeRouteEnter: async (to, from, next) => {
    const response = await axios.get(`/api/room/${to.params.roomId}`);
    if (!Object.keys(response.data).length) {
      next({ path: '/404' });
    } else {
      next();
    }
  },

  async mounted() {
    await this.setRoom();

    // ウィンドウリサイズ時のイベント
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth;
      this.windowHeight = window.innerHeight - 64;
    });
  },
};
</script>

<style lang="scss" scoped>
#floor {
  min-height: 100vh;
  background-image: url('/storage/system/room_background.jpg');
  background-size: cover;

  #canvas-container {
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

    &::-webkit-scrollbar {
      display: none;
    }
  }
}
</style>
