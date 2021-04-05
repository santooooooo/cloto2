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
        imageUrl: $storage('system') + 'inquiry_icon.png',
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
import { OK } from '@/consts/status';
import { RECEIVE_INQUIRY_SOUND } from '@/consts/sound';

export default {
  data() {
    return {
      isOpen: false, // 表示制御
      loading: false, // ローディング制御
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
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 問い合わせのオープン
     */
    open: function () {
      this.isOpen = true;
    },

    /**
     * 問い合わせのクローズ
     */
    close: function () {
      this.isOpen = false;
    },

    /**
     * 問い合わせチャットの送信
     *
     * @param {Object} message - 送信データ
     */
    submit: async function (message) {
      if (!this.loading) {
        this.loading = true;

        // 問い合わせの送信
        let response = await axios.post('/api/inquiries', {
          author: 'user',
          type: 'text',
          data: { text: message.data.text },
        });

        if (response.status === OK) {
          // Slack通知
          this.$slack(
            '問い合わせチャットBot',
            ':speech_balloon:',
            this.authUser.handlename + '様が問い合わせチャットを送信しました。'
          );
        }

        this.loading = false;
      }
    },

    /**
     * 投稿者の設定
     *
     * @param {String} author - 投稿者
     * @return {String} 変換済みの投稿者
     */
    setAuthor: function (author) {
      let show;
      switch (author) {
        case 'user':
          show = 'me';
          break;

        case 'support':
          show = 'support';
          break;
      }

      return show;
    },
  },

  async created() {
    // 問い合わせの取得
    let response = await axios.get('/api/inquiries');
    this.messages = response.data;

    // 投稿者の変換
    this.messages.forEach((message) => {
      message.author = this.setAuthor(message.author);
    });

    // 挨拶メッセージの追加
    this.messages.unshift(
      {
        author: 'support',
        type: 'text',
        data: {
          text: process.env.MIX_APP_NAME + 'をご利用いただきありがとうございます！',
        },
      },
      {
        author: 'support',
        type: 'text',
        data: {
          text: '何かお困りのことがございましたら、このチャットからお気軽にお申し付けください！',
        },
      },
      {
        author: 'support',
        type: 'text',
        data: {
          text: '１営業日以内にお返事致します。',
        },
      }
    );

    // ログイン時に自動展開
    this.open();

    // 問い合わせイベントの受信開始
    Echo.channel('user.' + this.authUser.id).listen('InquiryPosted', (event) => {
      this.messages.push({
        author: this.setAuthor(event.author),
        type: event.type,
        data: event.data,
      });

      // 通知
      if (!this.isOpen) {
        if (this.$store.getters['alert/isSoundOn']) {
          RECEIVE_INQUIRY_SOUND.play();
        }
        const inquiry = document.getElementsByClassName('sc-launcher')[0];
        inquiry.classList.add('notification');
      }
    });
  },
};
</script>

<style lang="scss">
// 通知
.notification {
  animation: scaleChange 3s infinite ease-out;
  transform-origin: 50% 50%;
  animation-play-state: running;

  .sc-open-icon {
    top: 0px;
    left: 0px;
  }

  @keyframes scaleChange {
    0% {
      transform: scale(0.8, 0.8);
    }
    5% {
      transform: scale(1.2, 1.2);
    }
    10% {
      transform: scale(1, 1);
    }
    15% {
      transform: scale(1.1, 1.1);
    }
    20% {
      transform: scale(1, 1);
    }
    100% {
      transform: scale(1, 1);
    }
  }
}
</style>
