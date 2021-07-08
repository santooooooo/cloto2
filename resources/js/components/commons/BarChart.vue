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
      data: {
        labels: [],
        datasets: [
          {
            label: 'タグ別のカルテの割合',
            data: [],
            backgroundColor: [],
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
      propsObject: null,
    };
  },
  methods: {
    getData: async function () {
      let promiseData = null;
      await this.graphData.then(function (value) {
        promiseData = value;
      });
      this.propsObject = promiseData;
    },
    setData: function () {
      for (const key in this.propsObject) {
        this.data.labels.push(key);
        this.data.datasets[0].data.push(this.propsObject[key]);
        this.data.datasets[0].backgroundColor.push('rgba(255,202,43,0.5)');
      }
    },
  },
  mounted: async function () {
    await this.getData();

    this.setData();

    this.renderChart(this.data, this.options);
  },
};
</script>
