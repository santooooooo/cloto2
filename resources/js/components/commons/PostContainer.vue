<template>
  <v-container class="d-block">
    <v-row no-gutters justify="end" v-if="post.user.id === authUser.id">
      <v-btn icon x-small @click="deletePost(post)">
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </v-row>

    <div id="post" @click="$store.dispatch('dialog/open', { type: 'post', id: post.id })">
      <!-- 内容 -->
      <pre class="text-body-2" v-html="$formatStr(post.body)"></pre>

      <!-- 投稿日時 -->
      <p class="mt-6 mb-0 text-right small">
        {{ $moment(post.created_at).format('MM/DD HH:mm') }}
      </p>
    </div>

    <!-- 投稿削除確認ダイアログ -->
    <v-dialog v-model="deleteForm.dialog" max-width="500px" persistent>
      <v-card class="headline grey darken-2 text-center pa-2">
        <v-card-title>
          <span class="headline white--text">削除しますか？</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-card-text class="pa-1 white--text">
              {{ deleteForm.data.body }}
            </v-card-text>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey" :loading="deleteForm.loading" @click="deleteSubmit()"> 削除 </v-btn>
          <v-btn color="error" :loading="deleteForm.loading" @click="deleteForm.dialog = false">
            キャンセル
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    post: Object, // 表示する投稿
  },
  data() {
    return {
      deleteForm: {
        dialog: false,
        loading: false,
        data: {},
      }, // 削除データ
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 投稿の削除
     *
     * @param {Object} post - 削除する投稿
     */
    deletePost: function (post) {
      this.deleteForm.data = post;
      this.deleteForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deleteForm.loading = true;

      // 投稿削除処理
      let response = await axios.delete('/api/posts/' + this.deleteForm.data.id);

      if (response.status === OK) {
        // 表示データから削除
        this.$emit('delete', this.deleteForm.data);
        this.deleteForm.dialog = false;
      }

      this.deleteForm.loading = false;
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
