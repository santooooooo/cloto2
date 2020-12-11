<template>
  <v-layout>
    <v-flex id="main">
      <!-- 教室 -->
      <!-- <v-img :src="$storage('system') + 'room.png'" cover class="mx-auto" max-width="700px"></v-img> -->
      <v-col>
        <v-row no-gutters align="center" justify="center" id="room">
          <canvas :width="roomWidth" :height="roomHight" id="canvas"></canvas>
        </v-row>
        <router-link :to="{ name: 'room', params: { roomId: $route.params.roomId } }">
          <v-btn color="yellow" class="my-2" block>入室</v-btn>
        </router-link>
      </v-col>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      canvas: '', // キャンバスエリア
      roomData: '', // 教室データ
      roomWidth: 650, // 教室サイズ
      roomHight: 400, // 教室サイズ
      iconSize: 30, // アイコンサイズ
    };
  },
  async mounted() {
    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('canvas', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas -
      this.canvas.setBackgroundImage(
        this.$storage('system') + 'room.png',
        this.canvas.renderAll.bind(this.canvas)
      );

    // クリックエリアの設定
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

          // ログインユーザーが座っており，座席が休憩室にある場合
          if (seat.id === this.authUser.seat_id && section.role === 'lounge') {
            this.enterLounge(section.id);
          }
        }
      });
    });
  },
  methods: {
    /**
     * 教室データの取得
     */
    getRoom: async function () {
      var response = await this.$http.get(this.$endpoint('roomShow', [this.$route.params.roomId]));
      console.log(response.data.roomData);
      this.roomData = response.data.roomData;
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
};
</script>

<style></style>
