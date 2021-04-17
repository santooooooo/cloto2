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

        <v-row v-for="comment in post.comments" :key="comment.id">
          <span>{{ comment.body }}</span>
          <v-btn @click="deleteComment(comment)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>
      </v-container>
    </v-card>

    <v-form
      ref="commentForm"
      v-model="commentForm.validation.valid"
      lazy-validation
      id="comment-form"
      class="mx-auto my-6"
    >
      <v-textarea
        v-model="commentForm.body"
        :rules="commentForm.validation.bodyRules"
        :maxlength="commentForm.max"
        :disabled="commentForm.loading"
        append-icon="mdi-send"
        placeholder="コメント"
        counter
        solo
        auto-grow
        rows="1"
        @click:append="submit()"
      ></v-textarea>
    </v-form>

    <!-- 投稿削除確認ダイアログ -->
    <v-dialog v-model="deleteCommentForm.dialog" max-width="500px" persistent>
      <v-card class="headline grey darken-2 text-center pa-2">
        <v-card-title>
          <span class="headline white--text">削除しますか？</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-card-text class="pa-1 white--text">
              {{ deleteCommentForm.data.body }}
            </v-card-text>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            :loading="deleteCommentForm.loading"
            @click="deleteCommentForm.dialog = false"
          >
            キャンセル
          </v-btn>
          <v-btn color="success" :loading="deleteCommentForm.loading" @click="deleteSubmit()">
            削除
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-dialog>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    postId: Number, // 表示する投稿
  },
  data() {
    return {
      dialog: false,
      post: null, // 表示するデータ
      commentForm: {
        body: '', // 内容
        max: 200, // 最大長
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '内容が無いようです。'],
        },
      },
      deleteCommentForm: {
        dialog: false,
        loading: false,
        data: {},
      },
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    postId: function (data) {
      if (data) {
        // データの取得
        this.getPost();
        this.dialog = true;
      } else {
        this.dialog = false;
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

    /**
     * コメントの投稿
     */
    submit: async function () {
      if (this.$refs.commentForm.validate()) {
        this.commentForm.loading = true;

        let response = await axios.post('/api/comments', {
          post_id: this.postId,
          body: this.commentForm.body,
        });

        if (response.status === OK) {
          await this.getPost();
          this.$refs.commentForm.reset();
        }

        this.commentForm.loading = false;
      }
    },

    /**
     * コメントの削除
     *
     * @param {Object} comment - 削除するコメント
     */
    deleteComment: function (comment) {
      this.deleteCommentForm.data = comment;
      this.deleteCommentForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deleteCommentForm.loading = true;

      let response = await axios.delete('/api/comments/' + this.deleteCommentForm.data.id);

      if (response.status === OK) {
        await this.getPost();
        this.deleteCommentForm.dialog = false;
        this.deleteCommentForm.loading = false;
      } else {
        this.deleteCommentForm.loading = false;
      }
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
</style>
