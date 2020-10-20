<template>
  <v-overlay z-index="4">
    <v-layout>
      <v-flex class="flex-column mr-12">
        <v-col>
          <v-avatar size="100">
            <img :src="chatParticipants[0].imageUrl" />
          </v-avatar>
        </v-col>

        <v-col>
          <v-avatar size="100">
            <img :src="chatParticipants[0].imageUrl" />
          </v-avatar>
        </v-col>
      </v-flex>

      <v-flex>
        <beautiful-chat
          :open="enterLounge"
          :close="leaveLounge"
          :onMessageWasSent="onMessageWasSent"
          :colors="chatColors"
          :isOpen="isLoungeEnter"
          :messageList="messageList"
          :participants="chatParticipants"
          :showCloseButton="true"
          :showEmoji="true"
          :showHeader="false"
          :alwaysScrollToBottom="true"
        >
          <template v-slot:user-avatar="{ message, user }">
            <div v-if="message.data.type === 'text' && user && user.name">
              {{ user.name.toUpperCase()[0] }}
            </div>
          </template>
          <template v-slot:system-message-body="{ message }">
            [System]: {{ message.text }}
          </template>
        </beautiful-chat>

        <v-row justify="center">
          <v-btn color="error" class="mt-12" @click="leaveLounge()" v-if="isLoungeEnter"
            >自習室に戻る</v-btn
          >
        </v-row>
      </v-flex>

      <v-flex class="flex-column ml-12">
        <v-col>
          <v-avatar size="100">
            <img :src="chatParticipants[0].imageUrl" />
          </v-avatar>
        </v-col>

        <v-col>
          <v-avatar size="100">
            <img :src="chatParticipants[0].imageUrl" />
          </v-avatar>
        </v-col>
      </v-flex>
    </v-layout>
  </v-overlay>
</template>

<script>
export default {
  props: {
    loungeId: Number,
  },
  data() {
    return {
      syncTimer: null, // 同期制御
      chatParticipants: [], // チャット参加者
      messageList: [], // メッセージデータ
      isLoungeEnter: false, // チャットモーダル制御

      chatColors: {
        // beautiful-chatの色設定
        header: {
          bg: '#D32F2F',
          text: '#fff',
        },
        launcher: {
          bg: '#D32F2F',
        },
        messageList: {
          bg: '#fff',
        },
        sentMessage: {
          bg: '#F44336',
          text: '#fff',
        },
        receivedMessage: {
          bg: '#eaeaea',
          text: '#222222',
        },
        userInput: {
          bg: '#fff',
          text: '#212121',
        },
      },
    };
  },
  methods: {
    /**
     * 休憩室データの取得
     *
     * @param Number  loungeId   入室している休憩室ID
     */
    getLounge: async function (loungeId) {
      var response = await this.$http.get(this.$endpoint('chatShow', [loungeId]));
      this.chatParticipants = response.data.chatParticipants;
      this.messageList = response.data.messageList;
    },

    /**
     * 休憩室へ入室
     */
    enterLounge: function () {
      this.isLoungeEnter = true;
    },

    /**
     * 休憩室から退室
     */
    leaveLounge: function () {
      this.isLoungeEnter = false;

      this.$emit('leave-lounge');

      // 同期停止
      clearInterval(this.syncTimer);
      this.syncTimer = null;
    },

    /**
     * メッセージの送信
     */
    onMessageWasSent: function (message) {
      this.$http.post(this.$endpoint('chatPost'), message);

      // 一時的に描画するためリストへ追加
      this.messageList = [...this.messageList, Object.assign({}, message, { id: Math.random() })];
    },
  },
  async mounted() {
    // 初回取得
    await this.getLounge(this.loungeId);

    this.enterLounge();

    // 同期開始
    this.syncTimer = setInterval(() => {
      this.getLounge(this.loungeId);
    }, 3000);
  },
  destroyed() {
    // 休憩室退出時にはタイマーを解除
    if (this.syncTimer !== null) {
      clearInterval(this.syncTimer);
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';
</style>

<style lang="scss">
/* beautiful-chatのスタイル */
.sc-launcher {
  // チャットオープンアイコンの無効化
  display: none;
}

.sc-chat-window {
  // チャットの中央寄せ
  position: static !important;

  width: 60vw !important;

  .sc-user-input {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .sc-message {
    width: 90%;
  }
}
</style>
