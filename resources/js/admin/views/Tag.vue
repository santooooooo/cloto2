<template>
  <v-container>
    <v-data-table :headers="headers" :items="tags" sort-by="name" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>タグ一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <span>編集ボタンからタグを変更できます。</span>
          <v-spacer></v-spacer>

          <!-- タグ編集ダイアログ -->
          <v-dialog v-model="editTagForm.dialog" max-width="500px" persistent>
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">新規作成</v-btn>
            </template>

            <v-form ref="editTagForm" v-model="editTagForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <!-- 内容 -->
                    <v-card-text class="pa-1 white--text">内容</v-card-text>
                    <v-text-field
                      v-model="editTagForm.data.name"
                      :rules="editTagForm.validation.nameRules"
                      label="内容"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error" :loading="editTagForm.loading" @click="close()">
                    キャンセル
                  </v-btn>
                  <v-btn color="success" :loading="editTagForm.loading" @click="submit()">
                    保存
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>

          <!-- タグ削除確認ダイアログ -->
          <v-dialog v-model="deleteTagForm.dialog" max-width="500px" persistent>
            <v-card class="headline grey darken-2 text-center pa-2">
              <v-card-title>
                <span class="headline white--text">本当に削除しますか？</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <!-- 内容 -->
                  <v-card-text class="pa-1 white--text">
                    {{ deleteTagForm.data.name }}
                  </v-card-text>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="error"
                  :loading="deleteTagForm.loading"
                  @click="deleteTagForm.dialog = false"
                >
                  キャンセル
                </v-btn>
                <v-btn color="success" :loading="deleteTagForm.loading" @click="deleteSubmit()">
                  削除
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editTag(item)">mdi-pencil</v-icon>
        <v-icon small class="ml-2" @click="deleteTag(item)">mdi-delete</v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getTags()">再読み込み</v-btn>
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
        inner: 'タグ',
      };
    },
  },
  data() {
    return {
      tags: [], // タグ一覧
      headers: [
        { text: '内容', value: 'name' },
        { text: '編集', value: 'actions', sortable: false, align: 'center' },
      ],
      editTagForm: {
        dialog: false,
        loading: false,
        index: -1,
        data: {},
        validation: {
          valid: false,
          nameRules: [(v) => !!v || '内容は必須項目です。'],
        },
      },
      deleteTagForm: {
        dialog: false,
        loading: false,
        data: {},
      },
    };
  },
  computed: {
    formTitle() {
      return this.editTagForm.index === -1 ? '新規作成' : '編集';
    },
  },
  methods: {
    /**
     * タグの取得
     */
    getTags: async function () {
      let response = await axios.get('/api/admin/tags');
      this.tags = response.data;
    },

    /**
     * タグの編集
     *
     * @param {Object} tag - 編集するタグ
     */
    editTag: function (tag) {
      this.editTagForm.index = this.tags.indexOf(tag);
      this.editTagForm.data = Object.assign({}, tag);
      this.editTagForm.dialog = true;
    },

    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.editTagForm.dialog = false;
      this.editTagForm.loading = false;
      this.$nextTick(() => {
        this.$refs.editTagForm.reset();
        this.editTagForm.index = -1;
      });
    },

    /**
     * 編集データの保存
     */
    submit: async function () {
      if (this.$refs.editTagForm.validate()) {
        this.editTagForm.loading = true;

        if (this.editTagForm.index > -1) {
          // タグ更新処理
          let response = await axios.post('/api/admin/tags/' + this.editTagForm.data.id, {
            _method: 'patch',
            name: this.editTagForm.data.name,
          });

          if (response.status === OK) {
            Object.assign(this.tags[this.editTagForm.index], this.editTagForm.data);
            this.close();
          } else {
            this.editTagForm.loading = false;
          }
        } else {
          // タグ作成処理
          let response = await axios.post('/api/admin/tags', {
            name: this.editTagForm.data.name,
          });

          if (response.status === OK) {
            this.getTags();
            this.close();
          } else {
            this.editTagForm.loading = false;
          }
        }
      }
    },

    /**
     * タグの削除
     *
     * @param {Object} tag - 削除するタグ
     */
    deleteTag: function (tag) {
      this.deleteTagForm.data = Object.assign({}, tag);
      this.deleteTagForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deleteTagForm.loading = true;

      // タグ削除処理
      let response = await axios.delete('/api/admin/tags/' + this.deleteTagForm.data.id);

      if (response.status === OK) {
        this.getTags();
        this.deleteTagForm.dialog = false;
      }

      this.deleteTagForm.loading = false;
    },
  },
  created() {
    this.getTags();
  },
};
</script>
