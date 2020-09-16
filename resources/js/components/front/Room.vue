<template>
  <canvas :width="roomWidth" :height="roomHight" ref="canvas"></canvas>
</template>

<script>
export default {
  data() {
    return {
      roomWidth: 900,
      roomHight: 600,
      //テーブルのx,y座標
      tableArea1: [300, 50],
      tableArea2: [600, 50],
      tableArea3: [300, 150],
      tableArea4: [600, 150],
      tableArea5: [300, 250], //始点
      tableArea6: [600, 250],

      circleArea1: [300, 500],
      circleArea2: [500, 500], //中心座標

      ellipseArea: [750, 1000],

      triangleArea1: [100, 50],
      triangleArea2: [100, 300],

      //仕切りのx,y座標
      partition1: [200, 50],
      partition2: [300, 350],
      partition3: [600, 350],
      //部屋の仕切り　の始点x,y座標
      boxArea1: [50, 200],
      boxArea2: [50, 300],
      // boxArea3: [600, 400],

      boxSize1: [100, 50],
      boxSize2: [100, 50],

      boxPartition1: [200, 400],
      boxPartition2: [400, 400],
      boxPartition3: [600, 400],
      boxPartition4: [200, 400],

      tableSize: 50,
      partitionThick: 8, //仕切りの厚さ
      boxPartitionThick: 2, //休憩室仕切りの厚さ
    };
  },
  methods: {
    drawTable: function (base) {
      var ctx = this.$refs.canvas.getContext('2d');

      ctx.rect(base[0], base[1], this.tableSize, this.tableSize);
      ctx.lineWidth = 2;
      ctx.strokeStyle = 'red';
      ctx.stroke();

      // for (var i = 0; i < num; i++) {
      //   ctx.fillStyle = 'black';
      //   ctx.fillRect(base[0], base[1], this.tableSize, this.tableSize);
      //   base[0] += this.tableSize;
      // }
    },

    drawBox: function (base, size) {
      var ctx = this.$refs.canvas.getContext('2d');
      ctx.fillStyle = 'grey';
      ctx.rect(base[0], base[1], size[0], size[1]);
      ctx.lineWidth = 2;
      ctx.stroke();
    },

    drawPartition: function (base, length, thick, mode) {
      var ctx = this.$refs.canvas.getContext('2d');

      ctx.fillStyle = 'gray';
      if (mode === 'vertical') {
        ctx.fillRect(base[0], base[1], thick, length);
      } else if (mode === 'side') {
        ctx.fillRect(base[0], base[1], length, thick);
      }
    },

    drawCircle: function (base, Radius) {
      var ctx = this.$refs.canvas.getContext('2d');
      ctx.fillStyle = 'green'; // 塗りつぶしの色
      // パスの開始
      ctx.beginPath();
      ctx.arc(base[0], base[1], Radius, 0, 2 * Math.PI, false);
      // arc(中心のx座標, 中心のy座標, 半径, 開始角度, 終了角度, 描く方向);
      // 描画
      ctx.fill();
    },

    drawEllipse: function (base, Radius) {
      var ctx = this.$refs.canvas.getContext('2d');
      ctx.beginPath();
      ctx.fillStyle = '#0ff';
      ctx.scale(1, 0.5);
      ctx.arc(base[0], base[1], Radius, 0, 2 * Math.PI, false);
      ctx.fill();
      ctx.scale(1, 2);
    },

    drawTriangle: function (base) {
      var ctx = this.$refs.canvas.getContext('2d');

      ctx.beginPath();
      ctx.moveTo(base[0], base[1]); //最初の点の場所
      ctx.lineTo(base[0] - 50, base[1] + 80); //2番目の点の場所
      ctx.lineTo(base[0] + 50, base[1] + 80); //3番目の点の場所
      ctx.closePath(); //三角形の最後の線 closeさせる
      ctx.strokeStyle = 'rgb(0,0,0)'; //枠線の色
      ctx.stroke();
    },
  },

  mounted() {
    var ctx = this.$refs.canvas.getContext('2d');

    for (var i = 0; i <= 4; i++) {
      this.drawTable(this.tableArea1);
      this.drawTable(this.tableArea2);
      this.drawTable(this.tableArea3);
      this.drawTable(this.tableArea4);
      this.drawTable(this.tableArea5);
      this.drawTable(this.tableArea6);
      this.tableArea1[0] += this.tableSize;
      this.tableArea2[0] += this.tableSize;
      this.tableArea3[0] += this.tableSize;
      this.tableArea4[0] += this.tableSize;
      this.tableArea5[0] += this.tableSize;
      this.tableArea6[0] += this.tableSize;
    }

    this.drawPartition(this.partition1, 300, this.partitionThick, 'vertical');
    this.drawPartition(this.partition2, 250, this.partitionThick, 'side');
    this.drawPartition(this.partition3, 250, this.partitionThick, 'side');

    this.drawPartition(this.boxPartition1, 200, this.boxPartitionThick, 'vertical');
    this.drawPartition(this.boxPartition2, 200, this.boxPartitionThick, 'vertical');
    this.drawPartition(this.boxPartition3, 200, this.boxPartitionThick, 'vertical');
    this.drawPartition(this.boxPartition4, 900, this.boxPartitionThick, 'side');

    //丸テーブル
    this.drawCircle(this.circleArea1, 50);
    this.drawCircle(this.circleArea2, 50);

    //楕円テーブル
    this.drawEllipse(this.ellipseArea, 100);

    //三角形テーブル
    this.drawTriangle(this.triangleArea1);

    //休憩テーブル（四角）

    this.drawBox(this.boxArea1, this.boxSize1);
    this.drawBox(this.boxArea2, this.boxSize2);

    var img01 = new Image();
    img01.src = this.$storage('system') + 'logo.svg';

    this.$refs.canvas.onmousedown = function (e) {
      var rect = e.target.getBoundingClientRect();

      var mx = e.clientX - rect.left;
      var my = e.clientY - rect.top;

      if (10 <= mx && mx <= 60) {
        if (10 <= my && my <= 60) {
          ctx.fillStyle = 'red';
          ctx.fillRect(10, 10, 50, 50);
          ctx.drawImage(img01, 10, 10, 10, 10);
        }
      }

      //赤の領域内クリックの場合
      if (70.424 <= mx && mx <= 120.425) {
        if (10 <= my && my <= 60) {
          alert('赤');
        }
      }

      //緑の領域内クリックの場合
      if (130 <= mx && mx <= 180) {
        if (10 <= my && my <= 60) {
          alert('緑');
        }
      }
    };
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
