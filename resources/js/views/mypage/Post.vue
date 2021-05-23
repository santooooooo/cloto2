<template>
  <v-container fluid id="post">
    <!-- ローディング -->
    <v-progress-linear indeterminate absolute height="10" v-if="loading"></v-progress-linear>

    <vue-masonry-wall :items="posts" :options="{ width: width, padding: 8 }" @append="getPosts">
      <template v-slot:default="{ item }">
        <v-card :width="width - 50" class="mx-auto pa-3">
          <PostContainer :post="item" @delete="deletePost($event)" />
        </v-card>
      </template>
    </vue-masonry-wall>
    <v-row justify="center">
      <p class="text-h5 my-12" v-if="stopGetting">これ以上データはありません。</p>
    </v-row>
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
      // 表示データから削除
      this.posts.forEach((item) => {
        if (item.id === post.id) {
          item.user.id = null;
          item.body = '削除済み';
        }
      });
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
}
</style>
