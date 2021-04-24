<template>
  <v-dialog v-model="dialog" @click:outside="$emit('close', null)" width="1000">
    <v-card class="headline grey darken-2 text-center px-2" v-if="post">
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', null)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>

        <v-row justify="center" class="mt-2">
          <v-card rounded="xl" min-height="154" width="800" class="mb-4 text-left">
            <pre class="px-6 py-2 text-body-1" v-html="$formatStr(post.body)"></pre>
          </v-card>
        </v-row>
      </v-container>

      <!-- コメント欄 -->
      <CommentContainer
        item-type="post"
        :item-id="post.id"
        :comments="post.comments"
        @update="getPost()"
      />
    </v-card>
  </v-dialog>
</template>

<script>
import CommentContainer from '@/components/commons/CommentContainer';

export default {
  components: {
    CommentContainer,
  },
  props: {
    postId: Number, // 表示する投稿ID
  },
  data() {
    return {
      dialog: false,
      post: null, // 表示する投稿
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    postId: function (postId) {
      if (postId) {
        // データの取得
        this.getPost();
        this.dialog = true;
      } else {
        // データの初期化
        this.dialog = false;
        this.post = null;
      }
    },
  },
  methods: {
    /**
     * 投稿データの取得
     */
    getPost: async function () {
      let response = await axios.get('/api/posts/' + this.postId);
      this.post = response.data;
    },
  },
};
</script>

<style lang="scss" scoped>
pre {
  white-space: pre-wrap;
}

#comment-form {
  width: 60%;
}

#favorite-count {
  font-size: 0.8rem;
}
</style>
