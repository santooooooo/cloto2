<script>
import { Bar } from 'vue-chartjs';

export default {
  extends: Bar,
  props: {
    graphData: {
      type: Promise,
      required: true,
    },
  },
  data() {
    return {
      // グラフに表示するデータ
      data: {
        labels: [],
        datasets: [
          {
            label: 'タグ別のカルテのパーセンテージ',
            data: [],
            backgroundColor: [],
          },
        ],
      },
      // グラフのオプション
      options: {
        responsive: true,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                //max: 100,
              },
            },
          ],
        },
      },
      // 親コンポーネントから渡されるオブジェクトの取得に使用
      propsObject: null,
    };
  },
  methods: {
    // 親コンポーネントから渡されたPromiseオブジェクトのvalueプロパティの値を取得
    getData: async function () {
      let promiseData = null;
      await this.graphData.then(function (value) {
        promiseData = value;
      });
      this.propsObject = promiseData;
    },
    // グラフにデータをセット
    setData: function () {
      let count = 0;
      for (const key in this.propsObject) {
        // データが10以上ある場合は、上位10データをセット
        if (count < 10) {
          this.data.labels.push(key);
          this.data.datasets[0].data.push(this.propsObject[key]);
          this.data.datasets[0].backgroundColor.push('rgba(255,202,43,0.5)');
        }
        count++;
      }

      // もしデータが10以下の場合は、グラフのデータの見栄えをよくするためにdata.datasets[0].dataに空のデータをセット
      if (this.data.datasets[0].data.length < 10) {
        const datasetsLength = this.data.datasets[0].data.length;
        for (let i = 0; i < 10 - datasetsLength; i++) {
          this.data.labels.push('');
          this.data.datasets[0].data.push(0);
        }
      }
    },
  },
  mounted: async function () {
    // 親コンポーネントから渡されるオブジェクトの取得
    await this.getData();

    // グラフにデータをセット
    this.setData();

    // グラフの描画
    this.renderChart(this.data, this.options);
  },
};
</script>
