<template>
  <v-container>
    <v-data-table :headers="headers" :items="users" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>お問い合わせ</v-toolbar-title>
        </v-toolbar>
      </template>

      <template v-slot:[`item.inquiry`]="{ item }">
        <v-icon small class="mr-2" @click="openInquiry(item)">mdi-help-circle</v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getInquiryUsers()">再読み込み</v-btn>
      </template>
    </v-data-table>

    <!-- 問い合わせ -->
    <beautiful-chat
      :open="openInquiry"
      :close="closeInquiry"
      :onMessageWasSent="submitInquiry"
      :colors="inquiry.colors"
      :isOpen="inquiry.isOpen"
      :messageList="inquiry.messages"
      placeholder="回答を入力してください。"
      showCloseButton
      showHeader
      alwaysScrollToBottom
      :participants="[]"
    >
      <template v-slot:header>
        <div class="sc-header--title enabled font-weight-bold">
          {{ inquiry.user.handlename }} 様
        </div>
      </template>
      <template v-slot:system-message-body="{ message }"> [System]: {{ message.text }} </template>
    </beautiful-chat>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: 'ユーザー',
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
        { text: 'お問い合わせ', value: 'inquiry', sortable: false, align: 'center' },
      ],

      inquiry: {
        isOpen: false, // 問い合わせモーダル制御
        user: {
          handlename: '', // エラー回避
        }, // 問い合わせ相手のユーザー
        messages: [], // 問い合わせ
        colors: {
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
      },

      editUserForm: {
        dialog: false,
        loading: false,
        index: -1,
        data: {},
        validation: {
          valid: false,
          handlenameRules: [(v) => !!v || '表示名は必須項目です。'],
          emailRules: [(v) => !!v || 'メールアドレスは必須項目です。'],
        },
      },
    };
  },
  methods: {
    /**
     * 問い合わせたユーザーの取得
     */
    getInquiryUsers: async function () {
      var response = await this.$http.get(this.$endpoint('inquiries'));
      this.users = response.data;
    },

    /**
     * 問い合わせのオープン
     *
     * @param Object  user 対応するユーザー
     */
    openInquiry: async function (user) {
      this.inquiry.user = user;
      // 問い合わせの取得
      var response = await this.$http.get(this.$endpoint('inquiryShow', [this.inquiry.user.id]));
      this.inquiry.messages = response.data;
      this.inquiry.isOpen = true;
    },

    /**
     * 問い合わせのクローズ
     */
    closeInquiry: function () {
      this.inquiry.isOpen = false;
    },

    /**
     * 問い合わせの送信
     *
     * @param Object message 送信データ
     */
    submitInquiry: async function (message) {
      // 問い合わせの送信
      var response = await this.$http.post(this.$endpoint('inquiryPost'), {
        user_id: this.inquiry.user.id,
        author: 'support',
        type: 'text',
        data: { text: message.data.text },
      });
      // データの更新
      this.inquiry.messages = response.data;
    },

    /**
     * ユーザーデータの編集
     *
     * @param Object  user  編集するユーザー
     */
    editUser: function (user) {
      this.editUserForm.index = this.users.indexOf(user);
      this.editUserForm.data = Object.assign({}, user);
      this.editUserForm.dialog = true;
    },

    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.editUserForm.dialog = false;
      this.editUserForm.loading = false;
      this.$nextTick(() => {
        this.$refs.editUserForm.reset();
        this.editUserForm.index = -1;
      });
    },

    /**
     * 編集データの保存
     */
    submit: async function () {
      if (this.$refs.editUserForm.validate()) {
        this.editUserForm.loading = true;

        var input = new FormData();
        input.append('username', this.editUserForm.data.username);
        input.append('email', this.editUserForm.data.email);
        input.append('handlename', this.editUserForm.data.handlename);

        // ユーザーデータ保存処理
        var response = await this.$http.post(
          this.$endpoint('userUpdate', [this.editUserForm.data.id]),
          input
        );

        if (response.status === OK) {
          this.$store.dispatch('alert/show', {
            type: 'success',
            message: 'ユーザーデータが更新されました。',
          });

          if (this.editUserForm.index > -1) {
            Object.assign(this.users[this.editUserForm.index], this.editUserForm.data);
          } else {
            this.users.push(this.editUserForm);
          }

          this.close();
        } else {
          this.$store.dispatch('alert/show', {
            type: 'error',
            message: 'エラーが発生しました。',
          });

          this.editUserForm.loading = false;
        }
      }
    },
  },
  created() {
    this.getInquiryUsers();
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
