<template>
  <v-container>
    <!-- ローディング画面 -->
    <v-overlay z-index="205" v-if="editMediaForm.loading">
      <v-row justify="center">
        <v-progress-circular indeterminate size="50"></v-progress-circular>
      </v-row>
      <p class="text-h5 mt-12 text-center">データの送信中です。</p>
      <p class="text-body-2 text-center">
        メディアのアップロードには時間がかかる場合があります．．．
      </p>
    </v-overlay>

    <v-data-table :headers="headers" :items="rooms" sort-by="roomname" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>部屋一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <span>編集ボタンからメディア視聴ブースで再生するメディアを変更できます。</span>

          <!-- 座席選択ダイアログ -->
          <v-dialog v-model="seats.dialog" max-width="400px" persistent>
            <v-card class="headline grey darken-2 text-center pa-2">
              <v-card-title>
                <span class="headline white--text">編集</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-list-item-group>
                    <v-list-item v-for="seat in seats.data" :key="seat.id">
                      <v-card-text class="pa-1 white--text" @click="editMedia(seat.id)">
                        {{ seat.name }}
                      </v-card-text>
                    </v-list-item>
                  </v-list-item-group>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="success" @click="seats.dialog = false">終了</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <!-- メディア編集ダイアログ -->
          <v-dialog v-model="editMediaForm.dialog" max-width="500px" persistent>
            <v-form ref="editMediaForm" v-model="editMediaForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">編集</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row justify="center">
                      <!-- ファイル -->
                      <v-card-text class="pa-1 white--text">ファイル</v-card-text>
                      <input
                        type="file"
                        :disabled="editMediaForm.removeMedia || editMediaForm.text !== ''"
                        @change="inputFile"
                        accept="image/jpeg, image/png, video/*"
                        class="pa-2 mb-5"
                        style="overflow: hidden"
                        v-if="editMediaForm.dialog"
                      />

                      <!-- テキスト -->
                      <v-card-text class="pa-1 white--text">テキスト</v-card-text>
                      <v-textarea
                        v-model="editMediaForm.text"
                        :disabled="editMediaForm.removeMedia || editMediaForm.file !== null"
                        label="テキスト"
                        rows="6"
                        solo
                        class="pa-2"
                      ></v-textarea>
                    </v-row>

                    <v-row justify="center">
                      <v-checkbox v-model="editMediaForm.removeMedia">
                        <template v-slot:label>
                          <span class="white--text">メディアを削除する</span>
                        </template>
                      </v-checkbox>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error" :loading="editMediaForm.loading" @click="close()">
                    キャンセル
                  </v-btn>
                  <v-btn color="success" :loading="editMediaForm.loading" @click="submit()">
                    保存
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small @click="selectSeat(item)">mdi-pencil</v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getRooms()">再読み込み</v-btn>
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
        inner: 'メディア',
      };
    },
  },
  data() {
    return {
      rooms: [],
      headers: [
        { text: '部屋名', value: 'name' },
        { text: '編集', value: 'actions', sortable: false, align: 'center' },
      ],
      seats: {
        dialog: false, // 座席一覧ダイアログ制御
        data: [], // 座席一覧
      },
      editMediaForm: {
        dialog: false,
        loading: false,
        seatId: null, // 編集する座席ID
        file: null, // ファイル
        text: '', // テキスト
        removeMedia: 0, // メディアの削除
        validation: {
          valid: false,
        },
      },
    };
  },
  methods: {
    /**
     * 部屋データの取得
     */
    getRooms: async function () {
      var response = await axios.get('/api/admin/rooms');
      this.rooms = response.data;
    },

    /**
     * 座席の選択
     *
     * @param Object  room  選択した部屋
     */
    selectSeat: function (room) {
      // メディア視聴席のみ取り出し
      this.seats.data = [];
      room.sections.forEach((section) => {
        section.seats.forEach((seat) => {
          if (seat.role === 'media') {
            this.seats.data.push(seat);
          }
        });
      });

      this.seats.dialog = true;
    },

    /**
     * 座席のメディアデータの編集
     *
     * @param Object  seatId  編集する座席ID
     */
    editMedia: function (seatId) {
      // 入力値の初期化
      this.editMediaForm.removeMedia = 0;
      this.editMediaForm.file = null;
      this.editMediaForm.text = '';

      this.editMediaForm.seatId = seatId;
      this.editMediaForm.dialog = true;
    },

    /**
     * ファイルの入力
     *
     * @param event 入力イベント
     */
    inputFile: function (event) {
      this.editMediaForm.file = event.target.files[0];
    },

    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.editMediaForm.dialog = false;
      this.editMediaForm.loading = false;
      this.$refs.editMediaForm.reset();
    },

    /**
     * 編集データの保存
     */
    submit: async function () {
      if (this.$refs.editMediaForm.validate()) {
        this.editMediaForm.loading = true;

        var input = new FormData();
        input.append('_method', 'patch');
        input.append('remove_media', this.editMediaForm.removeMedia);
        if (!this.editMediaForm.removeMedia) {
          if (this.editMediaForm.text !== '') {
            // テキストが入力されている場合
            input.append('text', this.editMediaForm.text);
          } else {
            if (this.editMediaForm.file !== null) {
              // ファイルが入力されている場合
              input.append('file', this.editMediaForm.file);
            }
          }
        }

        // 座席データ保存処理
        var response = await axios.post('/api/admin/seats/' + this.editMediaForm.seatId, input);

        if (response.status === OK) {
          this.$store.dispatch('alert/success', 'メディアが更新されました。');

          this.close();
        } else {
          this.$store.dispatch('alert/error');

          this.editMediaForm.loading = false;
        }
      }
    },
  },
  created() {
    this.getRooms();
  },
};
</script>
