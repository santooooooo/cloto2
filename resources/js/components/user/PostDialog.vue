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

        <v-container class="grey lighten-1">
          <h1 class="white--text text-left border-bottom">コメント一覧</h1>
          <v-row v-for="comment in post.comments" :key="comment.id">
            <span class="pl-4">{{ comment.body }}</span>

            <v-btn
              icon
              :color="comment.favorite_id_by_auth_user ? 'red' : 'gray'"
              @click="favorite(comment)"
            >
              <v-icon>mdi-heart</v-icon>
            </v-btn>
            <span id="favorite-count">{{ comment.favorites_count }}</span>

            <v-btn
              @click="deleteComment(comment)"
              v-if="comment.user.id === authUser.id"
              class="ml-auto mr-2 red white--text mb-2"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>
        </v-container>
      </v-container>
    </v-card>

    <!-- 投稿削除確認ダイアログ -->
    <DeleteCommentForm :deleteCommentForm="deleteCommentForm" />
  </v-dialog>
</template>

<script>
import { OK } from '@/consts/status';
import DeleteCommentForm from '@/components/user/DeleteConfirmDialog';

export default {
  props: {
    postId: Number, // 表示する投稿ID
  },
  components: {
    DeleteCommentForm,
  },
  data() {
    return {
      dialog: false,
      post: null, // 表示する投稿
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
     * いいね処理
     *
     * @param {Object} comment - いいねするコメント
     */
    favorite: async function (comment) {
      if (!comment.favorite_id_by_auth_user) {
        // いいね処理
        let response = await axios.post('/api/favorites', { comment_id: comment.id });

        if (response.status === OK) {
          // IDの追加とカウントアップ
          comment.favorite_id_by_auth_user = response.data;
          comment.favorites_count += 1;
        }
      } else {
        // いいね解除処理
        let response = await axios.delete('/api/favorites/' + comment.favorite_id_by_auth_user);

        if (response.status === OK) {
          // IDの削除とカウントダウン
          comment.favorite_id_by_auth_user = null;
          comment.favorites_count -= 1;
        }
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

#favorite-count {
  font-size: 0.8rem;
}
</style>
