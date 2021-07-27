<template>
  <v-container>
    <h3 class="my-4">一斉メール</h3>

    <v-textarea
      v-model="newsletter.message"
      :disabled="newsletter.loading"
      placeholder="全体一斉送信"
      rows="5"
      solo
    ></v-textarea>
    <v-btn color="primary" :loading="newsletter.loading" @click="submit()" class="mb-12">
      送信する
    </v-btn>
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
      newsletter: {
        loading: false, // ローディング制御
        message: '', // 全体一斉送信メッセージ
      },
    };
  },
  methods: {
    /**
     * 問い合わせの送信
     */
    submit: async function () {
      if (!this.newsletter.loading) {
        this.newsletter.loading = true;

        // 問い合わせの送信
        let response = await axios.post('/api/admin/newsletter', {
          author: 'support',
          type: 'text',
          data: { text: this.newsletter.message },
        });

        if (response.status === OK) {
          this.newsletter.message = '';
        }

        this.newsletter.loading = false;
      }
    },
  },
};
</script>
