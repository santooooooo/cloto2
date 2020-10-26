<template>
  <div>
    <Profile :userName="$route.params.username"></Profile>
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
