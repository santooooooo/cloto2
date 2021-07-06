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
            label: 'Test Bar',
            data: [],
            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
          },
        ],
      },
      options: {
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
      result: null,
    };
  },
  methods: {
    getData: async function () {
      let data = null;
      await this.graphData.then(function (value) {
        data = value;
      });
      this.result = data;
    },
  },
  mounted: async function () {
    await this.getData();

    this.data.labels = ['php', 'JavaScript'];
    this.data.datasets[0].data[0] = this.result['php'];
    this.data.datasets[0].data[1] = this.result['JavaScript'];
    this.renderChart(this.data, this.options);
  },
};
</script>
