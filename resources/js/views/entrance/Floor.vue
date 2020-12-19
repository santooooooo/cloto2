<template>
  <v-layout class="floor">
    <v-flex>
      <!-- ローディング画面 -->
      <v-overlay :value="isLoading">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>

      <v-row justify="center" class="py-5">
        <canvas :width="roomWidth" :height="roomHight" id="canvas"></canvas>
      </v-row>

      <v-row justify="center">
        <v-btn
          depressed
          color="#f6bf00"
          :to="{ name: 'room', params: { roomId: $route.params.roomId } }"
          class="font-weight-bold"
          :disabled="isDisabled"
          >入室</v-btn
        >
      </v-row>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      canvas: '', // キャンバスエリア
      isLoading: false, // ロードの制御
      roomData: '', // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },

    // 入室無効化制御
    isDisabled() {
      // 着席中
      if (this.authUser.seat) {
        // 着席中の座席のある部屋以外は入室禁止
        if (this.authUser.seat.section.room_id !== this.$route.params.roomId) {
          // 無効化
          return true;
        }
      }

      return false;
    },
  },

  watch: {
    '$route.params.roomId': async function (val) {
      // 着席中のユーザーを更新
      await this.setUser();
    },
  },

  methods: {
    /**
     * 着席中のユーザーの設定
     */
    setUser: async function () {
      this.isLoading = true;

      // 現在描画されているユーザーを削除
      this.canvas.getObjects().forEach((object) => {
        this.canvas.remove(object);
      });

      // 座席の設定
      await this.getRoom();
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
              radius: this.iconSize / 2,
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
            this.putIcon(seat.position.x, seat.position.y, seat.user);
          }
        });

        this.isLoading = false;
      });
    },

    /**
     * 教室データの取得
     */
    getRoom: async function () {
      var response = await this.$http.get(this.$endpoint('roomShow', [this.$route.params.roomId]));
      this.roomData = response.data;
    },

    /**
     * アイコンの配置
     *
     * @param Number x 配置される座席のx座標
     * @param Number y 配置される座席のy座標
     * @param Object  user  描画するユーザー
     */
    putIcon: function (x, y, user) {
      new fabric.Image.fromURL(this.$storage('icon') + user.icon, (icon) => {
        icon.set({
          userId: user.id,
          left: x,
          top: y,
          originX: 'center',
          originY: 'center',
          scaleX: this.iconSize / icon.width,
          scaleY: this.iconSize / icon.height,
          clipPath: new fabric.Circle({
            scaleX: icon.width / this.iconSize,
            scaleY: icon.height / this.iconSize,
            radius: this.iconSize / 2,
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
    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('canvas', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'room.png',
      this.canvas.renderAll.bind(this.canvas)
    );

    await this.setUser();
  },
};
</script>

<style lang="scss" scoped>
.floor {
  min-height: 100vh;
  background-color: #ffe89a;
}
</style>
