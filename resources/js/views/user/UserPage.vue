<template>
  <div>
    <Profile :userName="$route.params.username"></Profile>

    <div class="container mt-3 mb-3">This is test.</div>
  </div>
</template>

<script>
import Profile from '@/components/user/Profile';

export default {
  head: {
    title() {
      return {
        inner: this.$route.params.username,
      };
    },
  },
  components: {
    Profile,
  },
};
</script>

<style></style>
