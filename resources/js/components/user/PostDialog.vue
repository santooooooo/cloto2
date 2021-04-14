<template>
  <v-dialog v-model="dialog" @click:outside="$emit('close', null)" width="1000">
    <v-card class="headline grey darken-2 text-center px-2" v-if="post">
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', null)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>

        <v-row justify="center">
          <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
            <pre class="px-6 py-2 text-body-1" v-html="$formatStr(post.body)"></pre>
          </v-card>
        </v-row>
      </v-container>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    post: Object, // 表示する投稿
  },
  data() {
    return {
      dialog: false,
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    post: function (data) {
      if (data) {
        this.dialog = true;
      } else {
        this.dialog = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
pre {
  white-space: pre-wrap;
}
</style>
