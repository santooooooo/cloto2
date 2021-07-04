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
        labels: ['First', 'Second'],
        datasets: [
          {
            label: 'Test Bar',
            data: [10, 20],
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
      let test = null;
      await this.graphData.then(function (value) {
        test = value;
      });
      this.result = test;
    },
  },
  mounted: async function () {
    await this.getData();
    console.log(this.result);
    this.renderChart(this.data, this.options);
  },
};
</script>
