<template>
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
        <v-btn color="grey" :loading="deleteCommentForm.loading" @click="deleteSubmit()">
          削除
        </v-btn>
        <v-btn
          color="error"
          :loading="deleteCommentForm.loading"
          @click="deleteCommentForm.dialog = false"
        >
          キャンセル
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ['deleteCommentForm'],
  methods: {
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

<style></style>
