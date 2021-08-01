<template>
  <v-container>
    <h3 class="my-4">一斉メール</h3>

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

      <v-btn color="primary" :loading="newsletterForm.loading" @click="submit()" class="mb-12">
        送信する
      </v-btn>
    </v-form>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: 'お問い合わせ',
      };
    },
  },
  data() {
    return {
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
  methods: {
    /**
     * ニュースレターの送信
     */
    submit: async function () {
      if (this.$refs.newsletterForm.validate()) {
        this.newsletterForm.loading = true;

        // 問い合わせの送信
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
  },
};
</script>
