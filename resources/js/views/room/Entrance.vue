<template>
  <div>{{ rooms }}</div>
</template>

<script>
export default {
  data() {
    return {
      rooms: '',
    };
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('roomIndex'));
    this.rooms = response.data;
  },
};
</script>

<style></style>
