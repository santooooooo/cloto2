<template>
  <v-container>
    <h3>ユーザー一覧</h3>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: '管理画面',
      };
    },
  },
  data() {
    return {
      users: null,
    };
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('users'));
    this.users = response.data;
    console.log(this.users);
  },
};
</script>
