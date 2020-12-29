<template>
  <beautiful-chat
    :open="open"
    :close="close"
    :onMessageWasSent="submit"
    :colors="colors"
    :isOpen="isOpen"
    :participants="[
      {
        id: 'support',
        name: 'サポートチーム',
        imageUrl: $storage('system') + 'logo.svg',
      },
    ]"
    :messageList="messages"
    placeholder="ご質問を入力してください。"
    showCloseButton
    showHeader
    alwaysScrollToBottom
  >
    <template v-slot:header>
      <div class="sc-header--title enabled font-weight-bold">お問い合わせ</div>
    </template>

    <template v-slot:system-message-body="{ message }"> [System]: {{ message.text }} </template>
  </beautiful-chat>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false, // 表示制御
      messages: [], // メッセージ一覧
      colors: {
        // 色設定
        messageList: {
          bg: '#ffffff',
        },
        sentMessage: {
          bg: '#f6bf00',
          text: '#000000',
        },
        receivedMessage: {
          bg: '#696969',
          text: '#ffffff',
        },
        userInput: {
          bg: '#f4f2e9',
          text: '#212121',
        },
        header: {
          bg: '#ff0000',
          text: '#ffffff',
        },
        launcher: {
          bg: '#ff0000',
        },
      },
    };
  },
  methods: {
    /**
     * 問い合わせのオープン
     */
    open: async function () {
      // 問い合わせの取得
      var response = await this.$http.get(this.$endpoint('inquiryShow'));
      this.messages = response.data;

      // 現在時刻の取得
      var date = new Date();

      // 2桁で時間を取得
      var hour = String(date.getHours());
      if (hour.length === 1) {
        hour = '0' + hour;
      }

      // 2桁で分数を取得
      var minute = String(date.getMinutes());
      if (minute.length === 1) {
        minute = '0' + minute;
      }

      // 現在時刻
      var now = hour + '時' + minute + '分';

      // 挨拶メッセージの追加
      this.messages.unshift(
        {
          author: 'support',
          type: 'text',
          data: { meta: now, text: 'はじめまして！' },
        },
        {
          author: 'support',
          type: 'text',
          data: { meta: now, text: 'CLOTOをご利用いただきありがとうございます。' },
        },
        {
          author: 'support',
          type: 'text',
          data: { meta: now, text: '何かお困りごとがありますか？' },
        }
      );

      this.isOpen = true;
    },

    /**
     * 問い合わせのクローズ
     */
    close: function () {
      this.isOpen = false;
    },

    /**
     * 問い合わせの送信
     *
     * @param Object message 送信データ
     */
    submit: async function (message) {
      // 問い合わせの送信
      var response = await this.$http.post(this.$endpoint('inquiryPost'), {
        author: 'user',
        type: 'text',
        data: { text: message.data.text },
      });
      // データの更新
      this.messages = response.data;
    },
  },
};
</script>
