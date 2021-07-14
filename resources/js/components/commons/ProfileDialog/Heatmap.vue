<template>
  <calendar-heatmap
    :values="[
      { date: '2020-9-20', count: 8 },
      { date: '2020-9-21', count: 7 },
      { date: '2020-9-22', count: 5 },
      { date: '2020-9-23', count: 3 },
    ]"
    :max="8"
    :end-date="Date()"
    :range-color="['#ebedf0', '#dae2ef', '#c0ddf9', '#73b3f3', '#3886e1', '#17459e']"
    tooltip-unit="kartes"
  ></calendar-heatmap>
</template>

<script>
import { CalendarHeatmap } from 'vue-calendar-heatmap';

export default {
  props: {
    mapData: {
      type: Promise,
      required: true,
    },
  },
  components: {
    CalendarHeatmap,
  },
};
</script>

