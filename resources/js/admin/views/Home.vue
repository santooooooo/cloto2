<template>
  <v-container>
    <h1>
      <span class="text-h4 ml-2 mr-10">管理画面</span>
      <span class="text-h6 ml-10">{{ authUser.handlename }}様 ご利用ありがとうございます。</span>
    </h1>

    <v-container mt-10>
      <!-- ローディング画面 -->
      <v-overlay z-index="205" v-if="loading">
        <v-row justify="center">
          <v-progress-circular indeterminate size="50"></v-progress-circular>
        </v-row>
        <p class="text-h5 mt-12 text-center">データの送信中です。</p>
        <p class="text-body-2 text-center">
          画像のアップロードには時間がかかる場合があります．．．
        </p>
      </v-overlay>

      <!-- ファイル -->
      <v-container>
        <h3>イベント情報のアップロード</h3>
        <p class="red--text">*推奨サイズ：11667 × 2000px（PNG）</p>
        <input type="file" @change="submitEvent" accept="image/png" ref="input" />

        <p class="text-body-1 mt-5">
          カレンダーは<a
            href="https://m136363.freecalend.com"
            target="_blank"
            rel="noopener noreferrer"
            >こちら</a
          >（ID：cloto / PW：cloto_no_calendar）
        </p>
      </v-container>

      <!-- 一斉メッセージ -->
      <v-container>
        <h3 class="my-4">一斉メッセージ</h3>

        <v-form ref="inquiryForm" v-model="inquiryForm.validation.valid" lazy-validation>
          <v-textarea
            v-model="inquiryForm.message"
            :rules="inquiryForm.validation.messageRules"
            :disabled="inquiryForm.loading"
            placeholder="メッセージ"
            rows="5"
            solo
          ></v-textarea>

          <v-btn color="primary" :loading="inquiryForm.loading" @click="submitInquiry()">
            送信する
          </v-btn>
        </v-form>
      </v-container>

      <!-- ニュースレター -->
      <v-container>
        <h3 class="my-4">ニュースレター</h3>

        <v-form ref="newsletterForm" v-model="newsletterForm.validation.valid" lazy-validation>
          <v-text-field
            v-model="newsletterForm.subject"
            :rules="newsletterForm.validation.subjectRules"
            :disabled="newsletterForm.loading"
            label="件名"
          ></v-text-field>
          <v-textarea
            v-model="newsletterForm.body"
            :rules="newsletterForm.validation.bodyRules"
            :disabled="newsletterForm.loading"
            placeholder="内容"
            rows="5"
            solo
          ></v-textarea>

          <v-btn color="primary" :loading="newsletterForm.loading" @click="submitNewsletter()">
            送信する
          </v-btn>
        </v-form>
      </v-container>
    </v-container>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: '管理画面',
      };
    },
  },
  data() {
    return {
      loading: false, // ローディング制御
      inquiryForm: {
        loading: false, // ローディング制御
        message: '', // メッセージ内容
        validation: {
          valid: false,
          messageRules: [(v) => !!v || 'メッセージは必須項目です。'],
        },
      },
      newsletterForm: {
        loading: false, // ローディング制御
        subject: '', // タイトル
        body: '', // メール内容
        validation: {
          valid: false,
          subjectRules: [(v) => !!v || '件名は必須項目です。'],
          bodyRules: [(v) => !!v || '内容は必須項目です。'],
        },
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
     * イベント一覧画像の送信
     *
     * @param {Event} event - 入力イベント
     */
    submitEvent: async function (event) {
      if (event.target.files[0]) {
        this.loading = true;

        let input = new FormData();
        input.append('event', event.target.files[0]);

        await axios.post('/api/admin/events', input);

        this.$refs.input.value = '';
        this.loading = false;
      }
    },
    /**
     * ニュースレターの送信
     */
    submitNewsletter: async function () {
      if (this.$refs.newsletterForm.validate()) {
        this.newsletterForm.loading = true;

        let response = await axios.post('/api/admin/newsletter', {
          subject: this.newsletterForm.subject,
          body: this.newsletterForm.body,
        });

        if (response.status === OK) {
          this.$refs.newsletterForm.reset();
        }

        this.newsletterForm.loading = false;
      }
    },
    /**
     * 一斉メッセージの送信
     */
    submitInquiry: async function () {
      if (this.$refs.inquiryForm.validate()) {
        this.inquiryForm.loading = true;

        let response = await axios.post('/api/admin/inquiries', {
          author: 'support',
          type: 'text',
          data: { text: this.inquiryForm.message },
        });

        if (response.status === OK) {
          this.$refs.inquiryForm.reset();
        }

        this.inquiryForm.loading = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
h1 {
  position: relative;
  padding: 1rem 2rem;
  border-bottom: 6px solid #094;

  &:before {
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 20%;
    height: 6px;
    content: '';
    background: #00cc5b;
  }
}
</style>
