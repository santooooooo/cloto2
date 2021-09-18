<template>
  <v-dialog v-model="dialog" @click:outside="close()" width="1000">
    <v-card class="headline grey darken-2 text-center px-2" v-if="question">
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="close()">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>
        <v-row justify="center">
          <!-- コメント数 -->
          <span class="mx-3 small">
            <v-icon>mdi-message-text</v-icon>
            {{ question.comments_count }}
          </span>

          <!-- いいね数 -->
          <span class="mx-3 small">
            <v-icon>mdi-heart</v-icon>
            {{ question.favorites_count }}
          </span>
        </v-row>

        <v-row justify="center" class="mt-2">
          <v-card rounded="xl" min-height="154" width="800" class="mb-4 text-left">
            <pre class="px-6 py-2 text-body-1" v-html="$formatStr(question.body)"></pre>
          </v-card>
        </v-row>
      </v-container>

      <!-- コメント欄 -->
      <CommentContainer
        item-type="question"
        :item-id="question.id"
        :comments="question.comments"
        @update="getQuestion()"
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

  data() {
    return {
      dialog: false,
      question: null, // 表示する投稿
    };
  },

  computed: {
    questionId() {
      return this.$store.getters['dialog/questionId'];
    },
  },

  watch: {
    questionId: function (questionId) {
      // 値がセットされたらオープン
      if (questionId) {
        this.open();
      }
    },
  },

  methods: {
    /**
     * ダイアログのオープン
     */
    open: async function () {
      await this.getQuestion();
      this.dialog = true;
    },

    /**
     * ダイアログのクローズ
     */
    close: function () {
      this.dialog = false;
      this.$store.dispatch('dialog/close', 'question');
    },

    /**
     * 投稿データの取得
     */
    getQuestion: async function () {
      let response = await axios.get('/api/questions/' + this.questionId);
      this.question = response.data;
    },
  },
};
</script>

<style lang="scss" scoped>
pre {
  white-space: pre-wrap;
}
</style>
