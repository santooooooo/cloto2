<template>
  <v-dialog v-model="dialog" @click:outside="$emit('close', null)" width="1000">
    <v-card class="headline grey darken-2 text-center px-2" v-if="karte">
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', null)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>

        <v-row justify="center" align="center" class="mt-2">
          {{ karte.activity_time.slice(0, 5) }}
        </v-row>

        <v-row justify="center">
          <v-chip class="ma-3" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
            {{ tag.name }}
          </v-chip>
        </v-row>

        <v-row justify="center">
          <v-col>
            <v-card-text class="pa-2 white--text title font-weight-bold"> 活動内容 </v-card-text>
            <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
              <pre class="px-6 py-2 text-body-1">{{ karte.body }}</pre>
            </v-card>

            <v-card-text class="pa-2 white--text title font-weight-bold"> 参考文献 </v-card-text>
            <v-card rounded="xl" min-height="48" max-width="457" class="mb-4 text-left">
              <p
                class="px-6 py-2 text-body-1"
                v-html="karte.reference ? $formatStr(karte.reference) : ''"
              ></p>
            </v-card>
          </v-col>

          <v-col>
            <v-card-text class="pa-2 white--text title font-weight-bold"> 画像 </v-card-text>
            <v-img
              contain
              :src="karte.path + karte.image"
              class="mx-auto"
              v-if="karte.image"
            ></v-img>
            <v-sheet
              color="grey lighten-2"
              width="450"
              height="280"
              class="mx-auto"
              v-else
            ></v-sheet>
          </v-col>
        </v-row>

        <v-row class="mb-7">
          <v-col>
            <v-card-text class="pa-2 white--text title font-weight-bold">
              達成したこと
            </v-card-text>
            <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
              <pre class="px-6 py-2 text-body-1">{{ karte.achieve }}</pre>
            </v-card>
          </v-col>

          <v-col>
            <v-card-text class="pa-2 white--text title font-weight-bold"> 次の課題 </v-card-text>
            <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
              <pre class="px-6 py-2 text-body-1">{{ karte.challenge }}</pre>
            </v-card>
          </v-col>
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

          <v-row v-for="comment in karte.comments" :key="comment.id">
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
  </v-dialog>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    karteId: Number, // 表示するカルテID
  },
  data() {
    return {
      dialog: false,
      karte: null, // 表示するカルテ
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
    karteId: function (karteId) {
      if (karteId) {
        // データの取得
        this.getKarte();
        this.dialog = true;
      } else {
        // データの初期化
        this.dialog = false;
        this.karte = null;
      }
    },
  },
  methods: {
    /**
     * カルテデータの取得
     */
    getKarte: async function () {
      let response = await axios.get('/api/kartes/' + this.karteId);
      this.karte = response.data;
    },

    /**
     * コメントの投稿
     */
    submit: async function () {
      if (this.$refs.commentForm.validate()) {
        this.commentForm.loading = true;

        let response = await axios.post('/api/comments', {
          karte_id: this.karteId,
          body: this.commentForm.body,
        });

        if (response.status === OK) {
          await this.getKarte();
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
        await this.getKarte();
        this.deleteCommentForm.dialog = false;
        this.deleteCommentForm.loading = false;
      } else {
        this.deleteCommentForm.loading = false;
      }
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
