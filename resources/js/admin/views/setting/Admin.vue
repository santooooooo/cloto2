<template>
  <v-container>
    <v-data-table :headers="headers" :items="admins" sort-by="email" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>管理者一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <span>編集ボタンから管理者データを変更できます。</span>

          <!-- 管理者編集ダイアログ -->
          <v-dialog v-model="editAdminForm.dialog" max-width="500px" persistent>
            <v-form ref="editAdminForm" v-model="editAdminForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">編集</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <!-- 管理者名 -->
                    <v-card-text class="pa-1 white--text">管理者名</v-card-text>
                    <v-text-field
                      v-model="editAdminForm.data.handlename"
                      :rules="editAdminForm.validation.handlenameRules"
                      label="管理者名"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>

                    <!-- メールアドレス -->
                    <v-card-text class="pa-1 white--text">メールアドレス</v-card-text>
                    <v-text-field
                      v-model="editAdminForm.data.email"
                      :rules="editAdminForm.validation.emailRules"
                      label="メールアドレス"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>

                    <!-- パスワード -->
                    <v-card-text class="pa-1 white--text">パスワード</v-card-text>
                    <v-text-field
                      v-model="editAdminForm.password"
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
                  <v-btn color="error" :loading="editAdminForm.loading" @click="close()">
                    キャンセル
                  </v-btn>
                  <v-btn color="success" :loading="editAdminForm.loading" @click="submit()">
                    保存
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>

          <!-- 管理者削除確認ダイアログ -->
          <v-dialog v-model="deleteAdminForm.dialog" max-width="500px" persistent>
            <v-card class="headline grey darken-2 text-center pa-2">
              <v-card-title>
                <span class="headline white--text">本当に削除しますか？</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <!-- 内容 -->
                  <v-card-text class="pa-1 white--text">
                    管理者名：{{ deleteAdminForm.data.handlename }}
                  </v-card-text>
                  <v-card-text class="pa-1 white--text">
                    メールアドレス：{{ deleteAdminForm.data.email }}
                  </v-card-text>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="error"
                  :loading="deleteAdminForm.loading"
                  @click="deleteAdminForm.dialog = false"
                >
                  キャンセル
                </v-btn>
                <v-btn color="success" :loading="deleteAdminForm.loading" @click="deleteSubmit()">
                  削除
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editAdmin(item)">mdi-pencil</v-icon>
        <v-icon small class="ml-2" @click="deleteAdmin(item)" :disabled="item.id === authUser.id">
          mdi-delete
        </v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getAdmins()">再読み込み</v-btn>
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
        inner: '管理者',
      };
    },
  },
  data() {
    return {
      admins: [],
      search: '',
      headers: [
        { text: '管理者名', value: 'handlename' },
        { text: 'メールアドレス', value: 'email' },
        { text: '編集', value: 'actions', sortable: false, align: 'center' },
      ],
      editAdminForm: {
        dialog: false,
        loading: false,
        index: -1,
        data: {},
        password: '',
        validation: {
          valid: false,
          handlenameRules: [(v) => !!v || '管理者名は必須項目です。'],
          emailRules: [(v) => !!v || 'メールアドレスは必須項目です。'],
        },
      },
      deleteAdminForm: {
        dialog: false,
        loading: false,
        data: {},
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
     * 管理者データの取得
     */
    getAdmins: async function () {
      var response = await axios.get('/api/admin/admins');
      this.admins = response.data;
    },

    /**
     * 管理者データの編集
     *
     * @param Object  admin  編集する管理者
     */
    editAdmin: function (admin) {
      this.editAdminForm.index = this.admins.indexOf(admin);
      this.editAdminForm.data = Object.assign({}, admin);
      this.editAdminForm.password = '';
      this.editAdminForm.dialog = true;
    },

    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.editAdminForm.dialog = false;
      this.editAdminForm.loading = false;
      this.$nextTick(() => {
        this.$refs.editAdminForm.reset();
        this.editAdminForm.index = -1;
      });
    },

    /**
     * 編集データの保存
     */
    submit: async function () {
      if (this.$refs.editAdminForm.validate()) {
        this.editAdminForm.loading = true;

        var input = new FormData();
        input.append('_method', 'patch');
        input.append('handlename', this.editAdminForm.data.handlename);
        input.append('email', this.editAdminForm.data.email);
        if (this.editAdminForm.password !== '') {
          input.append('password', this.editAdminForm.password);
        }

        // 管理者データ保存処理
        var response = await axios.post('/api/admin/admins/' + this.editAdminForm.data.id, input);

        if (response.status === OK) {
          this.$store.dispatch('alert/success', '管理者データが更新されました。');

          if (this.editAdminForm.index > -1) {
            Object.assign(this.admins[this.editAdminForm.index], this.editAdminForm.data);
          } else {
            this.admins.push(this.editAdminForm);
          }

          this.close();
        } else {
          this.$store.dispatch('alert/error');

          this.editAdminForm.loading = false;
        }
      }
    },

    /**
     * 管理者の削除
     *
     * @param Object  admin  削除する管理者
     */
    deleteAdmin: function (admin) {
      this.deleteAdminForm.data = Object.assign({}, admin);
      this.deleteAdminForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deleteAdminForm.loading = true;

      // 管理者削除処理
      var response = await axios.delete('/api/admin/admins/' + this.deleteAdminForm.data.id);

      if (response.status === OK) {
        this.$store.dispatch('alert/success', '管理者が削除されました。');
        this.getAdmins();
        this.deleteAdminForm.dialog = false;
        this.deleteAdminForm.loading = false;
      } else {
        this.$store.dispatch('alert/error');
        this.deleteAdminForm.loading = false;
      }
    },
  },
  created() {
    this.getAdmins();
  },
};
</script>
