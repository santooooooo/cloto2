<template>
  <v-container class="d-block">
    <v-row no-gutters justify="end" v-if="post.user.id === authUser.id">
      <v-btn icon x-small @click="$emit('delete')">
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </v-row>

    <div id="post" @click="showPost(post.id)">
      <!-- 内容 -->
      <pre class="text-body-2" v-html="$formatStr(post.body)"></pre>

      <!-- 投稿日時 -->
      <p class="mt-6 mb-0 text-right small">
        {{ $moment(post.created_at).format('MM/DD HH:mm') }}
      </p>
    </div>

    <PostDialog :postId="showPostId" @close="showPostId = $event" />
  </v-container>
</template>

<script>
export default {
  props: {
    post: Object, // 表示する投稿
  },
  data() {
    return {
      showPostId: null, // 詳細を表示する投稿ID
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 投稿の詳細表示
     *
     * @param {Number} postId - 詳細を表示する投稿ID
     */
    showPost: function (postId) {
      if (postId) {
        this.showPostId = postId;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
#post {
  cursor: pointer;

  pre {
    white-space: pre-wrap;
  }
}
</style>
