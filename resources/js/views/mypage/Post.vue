<template>
  <v-container>
    <v-row v-masonry="'post'" item-selector=".item">
      <v-col
        v-masonry-tile
        class="item"
        v-for="post in posts"
        :key="post.id"
        xs="6"
        sm="6"
        md="4"
        lg="3"
        xl="3"
      >
        <v-card class="pa-3">
          <v-card-actions class="d-block">
            <v-row no-gutters justify="end">
              <v-btn icon x-small @click="deletePost(post)">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-row>

            <!-- 内容 -->
            <pre class="mb-0 text-body-2" v-html="$formatStr(post.body)"></pre>

            <!-- 投稿日時 -->
            <p class="mt-6 mb-0 text-right small">
              {{ $moment(post.created_at).format('MM/DD HH:mm') }}
            </p>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

    <!-- 投稿削除確認ダイアログ -->
    <v-dialog v-model="deletePostForm.dialog" max-width="500px" persistent>
      <v-card class="headline grey darken-2 text-center pa-2">
        <v-card-title>
          <span class="headline white--text">削除しますか？</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-card-text class="pa-1 white--text">
              {{ deletePostForm.data.body }}
            </v-card-text>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            :loading="deletePostForm.loading"
            @click="deletePostForm.dialog = false"
          >
            キャンセル
          </v-btn>
          <v-btn color="success" :loading="deletePostForm.loading" @click="deleteSubmit()">
            削除
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: 'つぶやき',
      };
    },
  },

  data() {
    return {
      posts: [], // 投稿一覧
      deletePostForm: {
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

  methods: {
    /**
     * 投稿データの取得
     */
    getPosts: async function () {
      let response = await axios.get('/api/posts/' + this.authUser.id);
      this.posts = response.data;
    },

    /**
     * 投稿の削除
     *
     * @param {Object} post - 削除する投稿
     */
    deletePost: function (post) {
      this.deletePostForm.data = post;
      this.deletePostForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deletePostForm.loading = true;

      // 投稿削除処理
      let response = await axios.delete('/api/posts/' + this.deletePostForm.data.id);

      if (response.status === OK) {
        await this.getPosts();
        this.deletePostForm.dialog = false;
        this.deletePostForm.loading = false;
      } else {
        this.deletePostForm.loading = false;
      }
    },
  },

  created() {
    this.getPosts();
  },

  updated() {
    // DOMへ適用後に整列
    this.$redrawVueMasonry('post');
  },
};
</script>

<style lang="scss" scoped>
.v-card {
  pre {
    white-space: pre-wrap;
  }
}
</style>
