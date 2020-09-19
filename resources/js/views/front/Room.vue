<template>
  <div>
    <canvas :width="roomWidth" :height="roomHight" id="room"></canvas>
    <v-card class="mx-auto" max-width="344" outlined>
      <h1>{{ this.room.name }}教室</h1>
      <v-btn id="seat1" @click="seatAction(1, 'sit')">着席</v-btn>
      <v-btn id="seat2" @click="seatAction(2, 'sit')">着席</v-btn>
      <v-btn id="seat3" @click="seatAction(3, 'sit')">着席</v-btn>
      <v-btn @click="seatAction(1, 'leave')">離席</v-btn>
      <v-btn @click="seatAction(2, 'break')">休憩</v-btn>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      canvas: {},
      room: [], // 教室データ

      roomWidth: 900,
      roomHight: 600,

      circleArea1: [300, 500],
      circleArea2: [500, 500], //中心座標

      ellipseArea: [750, 500],

      triangleArea: [100, 100],

      //仕切りのx,y座標
      partition1: [200, 50, 200, 350],
      partition2: [300, 350, 550, 350],
      partition3: [600, 350, 850, 350],
      //部屋の仕切り　の始点x,y座標
      boxArea1: [50, 200],
      boxArea2: [50, 300],

      boxSize1: [100, 50],
      boxSize2: [100, 50],

      boxPartition1: [200, 400, 900, 400],
      boxPartition2: [200, 400, 200, 600],
      boxPartition3: [400, 400, 400, 600],
      boxPartition4: [600, 400, 600, 600],

      tableSize: 50,
      partitionThick: 8, //仕切りの厚さ
      boxPartitionThick: 2, //休憩室仕切りの厚さ
      iconSize: 50,
    };
  },
  methods: {
    /**
     * 教室の同期
     */
    syncRoom: async function () {
      var response = await this.$http.get(this.$endpoint('GET:roomShow', [this.$route.params.id]));

      // セクションのループ
      response.data.sections.forEach((section, sectionIndex) => {
        // 座席のループ
        section.seats.forEach((seat, seatIndex) => {
          if (this.room.length === 0) {
            // 初回取得
            if (section.id <= 6) {
              // section 1~6 の描画
              this.drawTable(seat.id, section.role, seat.position, seat.status);
            }
          } else if (seat.status !== this.room.sections[sectionIndex].seats[seatIndex].status) {
            // 現在の状態から変化があれば再描画
            this.changeColor(seat.status, seat.id);
          }
        });
      });

      // データの更新
      this.room = response.data;
    },

    /**
     * キャンバスクリックイベント
     */
    clickEvent: function () {
      var clickObject = this.canvas.getActiveObject();
      console.log(clickObject);

      if (clickObject) {
        // フロントの状態を変更
        this.changeStatus(clickObject, 'sitting');
        // データベースへ状態を保存
        this.seatAction(clickObject.id, 'sit');
      }
    },

    /**
     * 座席の状態の変更
     *
     * @param Object  clickObject クリックされた座席
     * @param String  status  状態
     */
    changeStatus: function (clickObject, status) {
      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          break;

        case 'leave':
          var color = '#ffffff';
          break;

        case 'break':
          var color = '#000000';
          break;
      }

      clickObject.set({ fill: color });

      console.log(this.$storage('icon') + this.$store.getters['auth/user'].icon);

      var icon = new Image();
      icon.src = this.$storage('icon') + this.$store.getters['auth/user'].icon;

      this.canvas.add(
        new fabric.Image(icon, {
          left: 10,
          top: 10,
          scaleX: this.iconSize / icon.naturalWidth,
          scaleY: this.iconSize / icon.naturalHeight,
          clipPath: new fabric.Circle({
            scaleX: icon.naturalWidth / this.iconSize,
            scaleY: icon.naturalHeight / this.iconSize,
            radius: this.iconSize / 2,
            originX: 'center',
            originY: 'center',
          }),
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * アイコンの配置
     *
     * @param Object  clickObject クリックされた座席
     */
    putIcon: function (clickObject, icon) {
      this.canvas.add(icon);
    },

    /**
     * 座席状態の変更
     *
     * @param Number  seatId  変更する座席
     * @param String  status  状態
     */
    seatAction: function (seatId, status) {
      switch (status) {
        case 'sit':
          var endpoint = this.$endpoint('POST:seatSit', [seatId]);
          break;

        case 'leave':
          var endpoint = this.$endpoint('POST:seatLeave', [seatId]);
          break;

        case 'break':
          var endpoint = this.$endpoint('POST:seatBreak', [seatId]);
          break;
      }

      this.$http.post(endpoint);
    },

    /**
     * テーブルの描画
     *
     * @param Number  seatId    描画する座席
     * @param String  role      座席の役割
     * @param JSON    position  描画位置
     * @param String  status    座席状態
     */
    drawTable: function (seatId, role, position, status) {
      var position = JSON.parse(position);
      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          break;

        case 'leave':
          var color = '#ffffff';
          break;

        case 'break':
          var color = '#000000';
          break;
      }

      this.canvas.add(
        new fabric.Rect({
          id: seatId,
          role: role,
          fill: color,
          stroke: 'black',
          left: position.left,
          top: position.top,
          width: this.tableSize,
          height: this.tableSize,
          strokeWidth: 4,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * 長方形テーブルの描画
     *
     * @param Array  position [x始点, y始点]
     * @param Array  size [box幅, box高さ]
     */
    drawBox: function (position, size) {
      this.canvas.add(
        new fabric.Rect({
          fill: '#FF0000',
          left: position[0],
          top: position[1],
          width: size[0],
          height: size[1],
          strokeWidth: 4,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * 区切りの描画
     *
     * @param Array  position [x始点, y始点, x終点, y終点]
     * @param Number  thick  区切りの太さ
     */
    drawPartition: function (position, thick) {
      this.canvas.add(
        new fabric.Line(position, {
          fill: 'red',
          stroke: 'red',
          strokeWidth: 10,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * 円の描画
     *
     * @param Array  position [x始点, y始点]
     * @param Number radius 半径
     */
    drawCircle: function (position, radius) {
      this.canvas.add(
        new fabric.Circle({
          fill: '#FF0000',
          left: position[0],
          top: position[1],
          originX: 'center',
          originY: 'center',
          angle: 2 * Math.PI,
          radius: radius,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * 楕円の描画
     *
     * @param Array  position [x始点, y始点]
     * @param Number radius 長半径
     */
    drawEllipse: function (position, radius) {
      this.canvas.add(
        new fabric.Ellipse({
          fill: 'red',
          left: position[0],
          top: position[1],
          originX: 'center',
          originY: 'center',
          strokeWidth: 100,
          rx: radius,
          ry: 40,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * 三角形の描画
     *
     * @param Array  position [x始点, y始点]
     */
    drawTriangle: function (position) {
      this.canvas.add(
        new fabric.Triangle({
          fill: 'red',
          left: position[0],
          top: position[1],
          originX: 'center',
          originY: 'center',
          width: 100,
          height: 87,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },
  },
  mounted() {
    this.canvas = new fabric.Canvas('room');
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'floor.png',
      this.canvas.renderAll.bind(this.canvas)
    );
    this.canvas.on('mouse:down', this.clickEvent);

    // 初回取得
    this.syncRoom();

    // 同期開始
    // setInterval(this.syncRoom, 10000);

    this.drawPartition(this.partition1, this.partitionThick);
    this.drawPartition(this.partition2, this.partitionThick);
    this.drawPartition(this.partition3, this.partitionThick);

    this.drawPartition(this.boxPartition1, this.boxPartitionThick);
    this.drawPartition(this.boxPartition2, this.boxPartitionThick);
    this.drawPartition(this.boxPartition3, this.boxPartitionThick);
    this.drawPartition(this.boxPartition4, this.boxPartitionThick);

    //丸テーブル
    this.drawCircle(this.circleArea1, 50);
    this.drawCircle(this.circleArea2, 50);

    //楕円テーブル
    this.drawEllipse(this.ellipseArea, 100);

    //三角形テーブル
    this.drawTriangle(this.triangleArea);

    //休憩テーブル（四角）
    this.drawBox(this.boxArea1, this.boxSize1);
    this.drawBox(this.boxArea2, this.boxSize2);
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

canvas {
  border: 7px solid $gray;
  margin: 0 auto;
}

.login-logo {
  margin-right: 1em;
}
</style>
