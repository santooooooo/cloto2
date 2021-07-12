<template>
  <v-container>
    <h3 class="my-4">一斉メール</h3>

    <v-textarea
      v-model="broadcast.message"
      :disabled="broadcast.loading"
      placeholder="全体一斉送信"
      rows="5"
      solo
    ></v-textarea>
    <v-btn color="primary" :loading="broadcast.loading" @click="submit()" class="mb-12">
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
      broadcast: {
        loading: false, // ローディング制御
        message: '', // 全体一斉送信メッセージ
      },
    };
  },
  methods: {
    /**
     * 問い合わせの送信
     *
     * @param {Object} message - 送信データ
     */
    submit: async function (message = null) {
      if (message) {
        // 個別送信
        if (!this.loading) {
          this.loading = true;

          // 問い合わせの送信
          await axios.post('/api/admin/inquiries', {
            user_id: this.user.id,
            author: 'support',
            type: 'text',
            data: { text: message.data.text },
          });

          this.loading = false;
        }
      } else {
        // 全体一斉送信
        if (!this.broadcast.loading) {
          this.broadcast.loading = true;

          // 問い合わせの送信
          let response = await axios.post('/api/admin/inquiries', {
            author: 'support',
            type: 'text',
            data: { text: this.broadcast.message },
          });

          if (response.status === OK) {
            this.broadcast.message = '';
          }

          this.broadcast.loading = false;
        }
      }

      // データの更新
      this.getUsers();
    },
  },
};
</script>
