<template>
  <div>
    <profile></profile>
    <div class="container mt-3 mb-3">This is test.</div>
  </div>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: this.$route.params.username,
      };
    },
  },
};
</script>

<style>
</style>