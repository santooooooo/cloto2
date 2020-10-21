<template>
  <v-overlay opacity="0.7" z-index="4">
    <!-- 新着メッセージ通知 -->
    <v-row
      justify="center"
      class="mb-3"
      :style="{ visibility: notification ? 'visible' : 'hidden' }"
    >
      <a @click="scrollToBottom()">
        <v-badge inline :value="true" color="red" content="↓ 新着メッセージ"></v-badge>
      </a>
    </v-row>

    <v-layout>
      <!-- 参加者一覧：左 -->
      <v-flex class="flex-column mr-12">
        <v-col v-for="(participant, index) in leftSide" :key="index">
          <v-avatar size="100">
            <img :src="participant.imageUrl" />
          </v-avatar>
        </v-col>

        <v-col>
          <v-avatar size="100" class="v-avatar__spacer">
            <!-- スペーサー -->
          </v-avatar>
        </v-col>
      </v-flex>

      <!-- チャット -->
      <v-flex>
        <beautiful-chat
          :open="enterLounge"
          :close="leaveLounge"
          :onMessageWasSent="onMessageWasSent"
          :colors="chatColors"
          :isOpen="isLoungeEnter"
          :messageList="messageList"
          :participants="chatParticipants"
          :showEmoji="true"
          :showHeader="false"
        >
          <template v-slot:user-avatar="{ message, user }">
            <div v-if="message.data.type === 'text' && user && user.name">
              {{ user.name.toUpperCase()[0] }}
            </div>
          </template>
        </beautiful-chat>

        <v-btn fixed dark bottom right x-large color="error" class="ma-10" @click="leaveLounge()">
          自習室に戻る
        </v-btn>
      </v-flex>

      <!-- 参加者一覧：右 -->
      <v-flex class="flex-column ml-12">
        <v-col v-for="(participant, index) in rightSide" :key="index">
          <v-avatar size="100">
            <img :src="participant.imageUrl" />
          </v-avatar>
        </v-col>

        <v-col>
          <v-avatar size="100" class="v-avatar__spacer">
            <!-- スペーサー -->
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
      chatArea: '', // チャットエリア
      syncTimer: null, // 同期制御
      chatParticipants: [], // チャット参加者
      messageList: [], // メッセージデータ
      notification: false, // 新着通知
      isLoungeEnter: false, // チャットのダイアログ制御
      profileDialog: false, // プロフィールのダイアログ制御
      profileUserId: null, // プロフィールを表示するユーザーID

      chatColors: {
        // beautiful-chatの色設定
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
          bg: '#ffffff',
          text: '#212121',
        },

        // 以下は使用しないが定義上必要
        header: {
          bg: '',
          text: '',
        },
        launcher: {
          bg: '',
        },
      },
    };
  },
  computed: {
    leftSide() {
      return this.chatParticipants.filter((participant, index) => {
        return index % 2 === 0;
      });
    },
    rightSide() {
      return this.chatParticipants.filter((participant, index) => {
        return index % 2 === 1;
      });
    },
  },
  watch: {
    /**
     * メッセージ追加時
     */
    'messageList.length': function () {
      if (!this.isBottom()) {
        this.notification = true;
      }
    },
  },
  methods: {
    /**
     * 末尾までスクロールされているか
     */
    isBottom() {
      return this.chatArea.scrollTop === this.chatArea.scrollHeight - this.chatArea.clientHeight
        ? true
        : false;
    },

    /**
     * スクロールイベント
     */
    scrollEvent: function () {
      // 末尾に達したら通知を削除
      if (this.isBottom()) {
        this.notification = false;
      }
    },

    /**
     * チャットを末尾までスクロール
     */
    scrollToBottom: function () {
      this.chatArea.scrollTop = this.chatArea.scrollHeight;
    },

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

      // スクロールイベントの設定
      this.chatArea = document.getElementsByClassName('sc-message-list')[0];
      this.chatArea.addEventListener('scroll', this.scrollEvent);
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

.v-avatar {
  cursor: pointer;

  &__spacer {
    cursor: default;
  }
}
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

  .sc-message-list {
    padding-left: 10px;

    // hover時のみスクロールバーを表示
    overflow-y: hidden;
    padding-right: 10px;
    &:hover {
      overflow-y: scroll;
      padding-right: 0;
    }

    .sc-message {
      width: 90%;
    }
  }
}
</style>
