<template>
  <canvas :width="roomWidth" :height="roomHight" ref="canvas"></canvas>
</template>

<script>
export default {
  data() {
    return {
      roomWidth: 900,
      roomHight: 600,
      area1: [250, 50],
      area2: [600, 50],
      area3: [250, 150],
      area4: [600, 150],
      area5: [250, 250],
      area6: [600, 250],
      partition1: [200, 50],
      partition2: [250, 400],
      partition3: [600, 400],

      tableSize: 50,
      partitionThick: 8,
    };
  },
  methods: {
    drawTable: function (base, num) {
      var ctx = this.$refs.canvas.getContext('2d');

      for (var i = 0; i < num; i++) {
        ctx.fillStyle = 'blue';
        ctx.fillRect(base[0], base[1], this.tableSize, this.tableSize);
        base[0] += this.tableSize;
      }
    },

    drawPartition: function (base, length, mode) {
      var ctx = this.$refs.canvas.getContext('2d');

      ctx.fillStyle = 'gray';
      if (mode === 'vertical') {
        ctx.fillRect(base[0], base[1], this.partitionThick, length);
      } else if (mode === 'side') {
        ctx.fillRect(base[0], base[1], length, this.partitionThick);
      }
    },
  },
  mounted() {
    var ctx = this.$refs.canvas.getContext('2d');

    this.drawTable(this.area1, 5);
    this.drawTable(this.area2, 5);
    this.drawTable(this.area3, 5);
    this.drawTable(this.area4, 5);
    this.drawTable(this.area5, 5);
    this.drawTable(this.area6, 5);

    this.drawPartition(this.partition1, 300, 'vertical');
    this.drawPartition(this.partition2, 250, 'side');
    this.drawPartition(this.partition3, 250, 'side');

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

<style>
canvas {
  border: 1px solid #000;
  margin: 0 auto;
}

.login-logo {
  margin-right: 1em;
}
</style>
