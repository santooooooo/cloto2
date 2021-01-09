<template>
  <v-container>
    <v-data-table :headers="headers" :items="users" sort-by="username" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>ユーザー一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <span>編集ボタンからユーザーデータを変更できます。</span>

          <!-- ユーザー編集ダイアログ -->
          <v-dialog v-model="editUserForm.dialog" max-width="500px" persistent>
            <v-form ref="editUserForm" v-model="editUserForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">編集</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <!-- アカウント名 -->
                    <v-card-text class="pa-1 white--text">表示名</v-card-text>
                    <v-text-field
                      v-model="editUserForm.data.handlename"
                      :rules="editUserForm.validation.handlenameRules"
                      label="表示名"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>

                    <!-- メールアドレス -->
                    <v-card-text class="pa-1 white--text">メールアドレス</v-card-text>
                    <v-text-field
                      v-model="editUserForm.data.email"
                      :rules="editUserForm.validation.emailRules"
                      label="メールアドレス"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>

                    <!-- パスワード -->
                    <v-card-text class="pa-1 white--text">パスワード</v-card-text>
                    <v-text-field
                      v-model="editUserForm.password"
                      maxlength="64"
                      counter
                      label="パスワード（更新する場合のみ入力）"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error" :loading="editUserForm.loading" @click="close()">
                    キャンセル
                  </v-btn>
                  <v-btn color="success" :loading="editUserForm.loading" @click="submit()">
                    保存
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small @click="editUser(item)">mdi-pencil</v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getUsers()">再読み込み</v-btn>
      </template>
    </v-data-table>
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
        { text: '編集', value: 'actions', sortable: false, align: 'center' },
      ],
      editUserForm: {
        dialog: false,
        loading: false,
        index: -1,
        data: {},
        password: '',
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
     * ユーザーデータの取得
     */
    getUsers: async function () {
      var response = await this.$http.get('/api/admin/users');
      this.users = response.data;
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
        input.append('_method', 'patch');
        input.append('username', this.editUserForm.data.username);
        input.append('email', this.editUserForm.data.email);
        input.append('handlename', this.editUserForm.data.handlename);
        if (this.editUserForm.password !== '') {
          input.append('password', this.editUserForm.password);
        }

        // ユーザーデータ保存処理
        var response = await this.$http.post(
          '/api/admin/users/' + this.editUserForm.data.id,
          input
        );

        if (response.status === OK) {
          this.$store.dispatch('alert/success', 'ユーザーデータが更新されました。');

          if (this.editUserForm.index > -1) {
            Object.assign(this.users[this.editUserForm.index], this.editUserForm.data);
          } else {
            this.users.push(this.editUserForm);
          }

          this.close();
        } else {
          this.$store.dispatch('alert/error');

          this.editUserForm.loading = false;
        }
      }
    },
  },
  created() {
    this.getUsers();
  },
};
</script>
