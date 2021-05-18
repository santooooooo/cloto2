<template>
  <v-container fluid id="post">
    <!-- ローディング -->
    <v-progress-linear indeterminate absolute height="10" v-if="loading"></v-progress-linear>

    <vue-masonry-wall :items="posts" :options="{ width: width, padding: 8 }" @append="getPosts">
      <template v-slot:default="{ item }">
        <v-card :width="width - 50" class="mx-auto pa-3">
          <PostContainer :post="item" @delete="deletePost(item)" />
        </v-card>
      </template>
    </vue-masonry-wall>
    <v-row justify="center">
      <p class="text-h5 my-12" v-if="stopGetting">これ以上データはありません。</p>
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
          <v-btn color="grey" :loading="deletePostForm.loading" @click="deleteSubmit()">
            削除
          </v-btn>
          <v-btn
            color="error"
            :loading="deletePostForm.loading"
            @click="deletePostForm.dialog = false"
          >
            キャンセル
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { OK, NOT_FOUND } from '@/consts/status';

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
      loading: true, // ローディング制御
      page: 1, // ページング制御
      stopGetting: false, // データ取得の終了制御
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

    width() {
      return (this.$windowWidth - 250) / 3;
    },
  },

  methods: {
    /**
     * 投稿データの取得
     */
    getPosts: async function () {
      if (!this.loading && !this.stopGetting) {
        this.loading = true;

        let response = await axios.get(
          '/api/posts/user/' + this.authUser.id + '?page=' + this.page
        );

        if (response.status === OK) {
          // データを追加
          this.posts = this.posts.concat(response.data);

          // ページの更新
          this.page += 1;
        } else if (response.status === NOT_FOUND) {
          // データ取得の終了
          this.stopGetting = true;
        }

        this.loading = false;
      }
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
        // 表示データから削除
        this.posts.forEach((post) => {
          if (post.id === this.deletePostForm.data.id) {
            post.user.id = null;
            post.body = '削除済み';
          }
        });
        this.deletePostForm.dialog = false;
      }

      this.deletePostForm.loading = false;
    },
  },

  async created() {
    await this.getPosts();
    this.loading = false;
  },
};
</script>

<style lang="scss" scoped>
#post {
  max-width: 100%;

  .v-progress-linear {
    top: 0;
  }

  .v-card {
    pre {
      white-space: pre-wrap;
    }
  }
}
</style>
