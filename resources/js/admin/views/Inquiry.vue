<template>
  <v-container>
    <v-data-table
      :headers="headers"
      :items="users"
      sort-by="last_date"
      sort-desc
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>お問い合わせ</v-toolbar-title>
        </v-toolbar>
      </template>

      <template v-slot:[`item.inquiry`]="{ item }">
        <v-icon small :color="item.replied ? 'black' : 'red'" @click="open(item)">
          mdi-email
        </v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getUsers()">再読み込み</v-btn>
      </template>
    </v-data-table>

    <!-- 問い合わせ -->
    <beautiful-chat
      :open="open"
      :close="close"
      :onMessageWasSent="submit"
      :colors="colors"
      :isOpen="isOpen"
      :participants="[
        {
          id: 'user',
          name: user.handlename,
          imageUrl: $storage('icon') + user.icon,
        },
      ]"
      :messageList="messages"
      placeholder="回答を入力してください。"
      showCloseButton
      showHeader
      alwaysScrollToBottom
    >
      <template v-slot:header>
        <div class="sc-header--title enabled font-weight-bold">{{ user.handlename }} 様</div>
      </template>
    </beautiful-chat>
  </v-container>
</template>

<script>
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
      users: [],
      search: '',
      headers: [
        { text: 'ユーザー名', value: 'username' },
        { text: '表示名', value: 'handlename' },
        { text: 'メールアドレス', value: 'email' },
        { text: '最終日時', value: 'last_date' },
        { text: '回答', value: 'inquiry', sortable: false, align: 'center' },
      ],

      isOpen: false, // 表示制御
      isLoading: false, // ローディング制御
      user: {}, // 問い合わせ相手
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
     * 問い合わせたユーザーの取得
     */
    getUsers: async function () {
      var response = await axios.get('/api/admin/inquiries');
      this.users = response.data;
    },

    /**
     * 問い合わせのオープン
     *
     * @param Object  user 対応するユーザー
     */
    open: async function (user) {
      this.user = user;
      // 問い合わせの取得
      var response = await axios.get('/api/admin/inquiries/' + this.user.id);
      this.messages = response.data;

      // 投稿者の変換
      this.messages.forEach((message) => {
        message.author = this.setAuthor(message.author);
      });

      // 問い合わせイベントの受信開始
      Echo.channel('user.' + this.user.id).listen('InquiryPosted', (event) => {
        this.messages.push({
          author: this.setAuthor(event.author),
          type: event.type,
          data: event.data,
        });

        // データの更新
        this.getUsers();
      });

      this.isOpen = true;
      // データの更新
      this.getUsers();
    },

    /**
     * 問い合わせのクローズ
     */
    close: function () {
      // 問い合わせイベントの受信終了
      Echo.leave('user.' + this.user.id);

      this.isOpen = false;
      // データの更新
      this.getUsers();
    },

    /**
     * 問い合わせの送信
     *
     * @param Object message 送信データ
     */
    submit: async function (message) {
      if (!this.isLoading) {
        this.isLoading = true;

        // 問い合わせの送信
        await axios.post('/api/admin/inquiries', {
          user_id: this.user.id,
          author: 'support',
          type: 'text',
          data: { text: message.data.text },
        });

        this.isLoading = false;

        // データの更新
        this.getUsers();
      }
    },

    /**
     * 投稿者の設定
     *
     * @param   String  author  投稿者
     * @returns String  show    変換済みの投稿者
     */
    setAuthor: function (author) {
      var show;
      switch (author) {
        case 'user':
          show = 'user';
          break;

        case 'support':
          show = 'me';
          break;
      }

      return show;
    },
  },
  created() {
    this.getUsers();
  },
};
</script>

<style lang="scss">
// オープンボタンの非表示化
.sc-launcher {
  display: none;
}

.sc-chat-window {
  z-index: 4;
}
</style>
