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
          <!-- 回答数 -->
          <span class="mx-3 small">
            <v-icon>mdi-message-text</v-icon>
            {{ question.answers_count }}
          </span>
        </v-row>

        <v-row justify="center" class="mt-2">
          <p class="text-body-1">{{ question.title }}</p>

          <v-card-text class="pa-2 white--text title font-weight-bold">質問内容</v-card-text>
          <v-card rounded="xl" min-height="154" width="90%" class="mb-4 text-left">
            <pre class="px-6 py-2 text-body-1" v-html="$formatStr(question.body)"></pre>
          </v-card>

          <v-card-text class="pa-2 white--text title font-weight-bold">試したこと</v-card-text>
          <v-card rounded="xl" min-height="154" width="90%" class="mb-4 text-left">
            <pre class="px-6 py-2 text-body-1" v-html="$formatStr(question.tried)"></pre>
          </v-card>
        </v-row>
      </v-container>

      <!-- 回答欄 -->
      <AnswerContainer
        :question-id="question.id"
        :answers="question.answers"
        @update="getQuestion()"
      />
    </v-card>
  </v-dialog>
</template>

<script>
import AnswerContainer from '@/components/commons/AnswerContainer';

export default {
  components: {
    AnswerContainer,
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
