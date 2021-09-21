<template>
  <v-container>
    <v-form
      ref="answerForm"
      v-model="answerForm.validation.valid"
      lazy-validation
      id="answer-form"
      class="mx-auto my-6"
    >
      <v-textarea
        v-model="answerForm.body"
        :rules="answerForm.validation.bodyRules"
        :maxlength="answerForm.max"
        :disabled="answerForm.loading"
        append-icon="mdi-send"
        placeholder="回答"
        counter
        solo
        auto-grow
        rows="1"
        @click:append="submit()"
      ></v-textarea>
    </v-form>

    <v-container v-if="answers.length">
      <v-card class="my-2" v-for="answer in answers" :key="answer.id">
        <v-card-actions class="d-block">
          <!-- 内容 -->
          <pre class="ml-3 text-body-1 text-left" v-html="$formatStr(answer.body)"></pre>

          <!-- 投稿日時 -->
          <p class="mt-6 mb-0 mr-4 text-right text-body-2">
            {{ $moment(answer.created_at).format('MM/DD HH:mm') }}
          </p>
        </v-card-actions>

        <v-row class="mt-3">
          <v-col
            cols="8"
            class="pointer"
            @click="
              $store.dispatch('dialog/open', { type: 'user', username: answer.user.username })
            "
          >
            <v-row>
              <!-- ユーザーアイコン -->
              <v-col cols="3" class="my-auto text-center">
                <v-avatar
                  size="40"
                  :style="{ 'box-shadow': '0 0 0 3px ' + $statusColor(answer.user.status) }"
                >
                  <img :src="$storage('icon') + answer.user.icon" />
                </v-avatar>
              </v-col>

              <!-- ユーザー名 -->
              <v-col cols="9" class="my-auto text-start">
                <p class="mb-0 text-body-1 text-truncate">{{ answer.user.handlename }}</p>
                <p class="mb-0 text-body-2 text-truncate">@{{ answer.user.username }}</p>
              </v-col>
            </v-row>
          </v-col>

          <v-col cols="3" class="my-auto text-right">
            <!-- スターボタン -->
            <v-btn icon :color="answer.star_id_by_auth_user ? 'red' : 'gray'" @click="star(answer)">
              <v-icon>mdi-star</v-icon>
              <span>{{ answer.stars_count }}</span>
            </v-btn>
          </v-col>

          <v-spacer></v-spacer>
        </v-row>
      </v-card>
    </v-container>

    <!-- 回答削除確認ダイアログ -->
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
    questionId: Number, // 回答が紐付いているアイテムのID
    answers: Array, // 回答一覧
  },

  data() {
    return {
      answerForm: {
        body: '', // 内容
        max: 1000, // 最大長
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '内容が無いようです。'],
        },
      },
      deleteForm: {
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
     * 回答の投稿
     */
    submit: async function () {
      if (this.$refs.answerForm.validate()) {
        this.answerForm.loading = true;

        let response = await axios.post('/api/answers', {
          question_id: this.questionId,
          body: this.answerForm.body,
        });

        if (response.status === OK) {
          // 回答データの更新
          this.$emit('update');
          this.$refs.answerForm.reset();
        }

        this.answerForm.loading = false;
      }
    },

    /**
     * 回答の削除
     *
     * @param {Object} answer - 削除する回答
     */
    deleteAnswer: function (answer) {
      this.deleteForm.data = answer;
      this.deleteForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deleteForm.loading = true;

      let response = await axios.delete('/api/answers/' + this.deleteForm.data.id);

      if (response.status === OK) {
        // 回答データの更新
        this.$emit('update');
        this.deleteForm.dialog = false;
      }

      this.deleteForm.loading = false;
    },

    /**
     * スター処理
     *
     * @param {Object} answer - スターする回答
     */
    star: async function (answer) {
      if (!answer.star_id_by_auth_user) {
        // スター処理
        let response = await axios.post('/api/stars', { answer_id: answer.id });

        if (response.status === OK) {
          // IDの追加とカウントアップ
          answer.star_id_by_auth_user = response.data;
          answer.stars_count += 1;
        }
      } else {
        // スター解除処理
        let response = await axios.delete('/api/stars/' + answer.star_id_by_auth_user);

        if (response.status === OK) {
          // IDの削除とカウントダウン
          answer.star_id_by_auth_user = null;
          answer.stars_count -= 1;
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

.pointer {
  cursor: pointer;
}
</style>
