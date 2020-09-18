<template>
  <div>
    <canvas :width="roomWidth" :height="roomHight" ref="canvas" id="room"></canvas>
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
      canvas: '',
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
              var position = JSON.parse(seat.position);
              this.drawTable(seat.id, [position.left, position.top]);
            }
            // this.clickEvent();
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
      // this.canvas = new fabric.Canvas('room');
      console.log(this.canvas);
      this.canvas.on('mouse:down', function () {
        var clickObject = this.canvas.getActiveObject();
        console.log(clickObjct);
        clickObject.set({ left: 20, top: 50 });
      });

      // var rect = event.target.getBoundingClientRect();

      // // キャンバス上でのクリック座標
      // var mx = event.clientX - rect.left;
      // var my = event.clientY - rect.top;

      // // セクションのループ
      // this.room.sections.forEach((section) => {
      //   // 座席のループ
      //   section.seats.forEach((seat) => {
      //     var position = JSON.parse(seat.position);

      //     if (position.left < mx && mx < position.left + this.tableSize) {
      //       if (position.top < my && my < position.top + this.tableSize) {
      //         console.log(seat.id);

      //         var img01 = new Image();
      //         img01.src = this.$storage('system') + 'logo.svg';

      //         // if (10 <= mx && mx <= 60) {
      //         //   if (10 <= my && my <= 60) {
      //         //     ctx.fillStyle = 'red';
      //         //     ctx.fillRect(10, 10, 50, 50);
      //         //     ctx.drawImage(img01, 10, 10, 10, 10);
      //         //   }
      //         // }
      //       }
      //     }
      //   });
      // });
    },

    /**
     * 座席の描画
     *
     * @param Number  seat_id 描画する座席
     * @param String  status  状態
     */
    changeColor: function (seat_id, status) {
      switch (status) {
        case 'sitting':
          $('#seat' + seat_id).css('color', 'red');
          break;

        case 'break':
          $('#seat' + seat_id).css('color', 'blue');
          break;

        default:
          $('#seat' + seat_id).css('color', 'white');
          break;
      }
    },

    /**
     * 座席状態の変更
     *
     * @param Number  seat_id 変更する座席
     * @param String  status  状態
     */
    seatAction: function (seat_id, status) {
      switch (status) {
        case 'sit':
          var endpoint = this.$endpoint('POST:seatSit', [seat_id]);
          break;

        case 'leave':
          var endpoint = this.$endpoint('POST:seatLeave', [seat_id]);
          break;

        case 'break':
          var endpoint = this.$endpoint('POST:seatBreak', [seat_id]);
          break;
      }

      this.$http.post(endpoint);

      // フロントと同期
      this.syncRoom();
    },

    /**
     * テーブルの描画
     *
     * @param Number  seat_id 変更する座席
     * @param Array  position[x始点, y始点]
     */
    drawTable: function (seatId, position) {
      this.canvas.add(
        new fabric.Rect({
          id: seatId,
          fill: '#FF0000',
          left: position[0],
          top: position[1],
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
     * @param Array  position[x始点, y始点]
     * @param Array  size[box幅, box高さ]
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
     * @param Array  position[x始点, y始点, x終点, y終点]
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
     * @param Array  position[x始点, y始点]
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
     * @param Array  position[x始点, y始点]
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
     * @param Array  position[x始点, y始点]
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
    console.log(this.canvas);
    this.canvas.on('mouse:down', function () {
      var clickObject = this.canvas.getActiveObject();
      console.log(clickObjct);
      clickObject.set({ left: 20, top: 50 });
    });

    // 初回取得
    this.syncRoom();
    // this.$refs.canvas.onmousedown = this.clickEvent;

    // 同期開始
    // setInterval(this.syncRoom, 10000);

    var ctx = this.$refs.canvas.getContext('2d');

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
