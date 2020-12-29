<template>
  <v-container>
    <v-data-table :headers="headers" :items="rooms" sort-by="roomname" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>部屋一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <span>編集ボタンから時間割を確認できます。</span>

          <!-- 部屋データ編集ダイアログ -->
          <v-dialog v-model="editRoomForm.dialog" max-width="500px" persistent>
            <v-form ref="editRoomForm" v-model="editRoomForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">編集</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <!-- 部屋名 -->
                    <v-card-text class="pa-1 white--text">部屋名</v-card-text>
                    <v-text-field
                      v-model="editRoomForm.data.name"
                      :rules="editRoomForm.validation.nameRules"
                      label="部屋名"
                      solo
                      rounded
                      class="pa-2"
                    ></v-text-field>

                    <!-- 時間割 -->
                    <v-list-item v-for="(time, index) in editRoomForm.data.timetable" :key="index">
                      <v-text-field
                        v-model="time.separate"
                        label="コマ開始時刻"
                        readonly
                        solo
                        rounded
                        @click="editTimetable(index, time.separate)"
                      ></v-text-field>

                      <v-select
                        v-model="time.status"
                        :items="status"
                        label="状態"
                        solo
                        rounded
                        class="pa-2"
                      ></v-select>
                    </v-list-item>

                    <!-- 時間入力ダイアログ -->
                    <v-dialog v-model="timePicker.dialog" width="290px">
                      <v-time-picker
                        v-if="timePicker.dialog"
                        v-model="timePicker.time"
                        full-width
                        @click:minute="setTimetable()"
                      ></v-time-picker>
                    </v-dialog>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error" :loading="editRoomForm.loading" @click="close()">
                    キャンセル
                  </v-btn>
                  <v-btn color="success" :loading="editRoomForm.loading" @click="submit()">
                    保存
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small @click="editRoom(item)">mdi-pencil</v-icon>
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
        inner: '部屋',
      };
    },
  },
  data() {
    return {
      rooms: [],
      status: ['study', 'break'],
      timePicker: {
        dialog: false,
        index: null,
        time: null,
      },
      search: '',
      headers: [
        { text: '部屋名', value: 'name' },
        { text: '編集', value: 'actions', sortable: false, align: 'center' },
      ],
      editRoomForm: {
        dialog: false,
        loading: false,
        index: -1,
        data: {},
        validation: {
          valid: false,
          nameRules: [(v) => !!v || '部屋名は必須項目です。'],
          emailRules: [(v) => !!v || 'メールアドレスは必須項目です。'],
        },
      },
    };
  },
  methods: {
    /**
     * 部屋データの取得
     */
    getRooms: async function () {
      var response = await this.$http.get(this.$endpoint('rooms'));
      this.rooms = response.data;
    },

    /**
     * 部屋データの編集
     *
     * @param Object  room  編集する部屋
     */
    editRoom: function (room) {
      this.editRoomForm.index = this.rooms.indexOf(room);
      this.editRoomForm.data = Object.assign({}, room);

      // 時間割データの最適化
      // オブジェクトを配列化
      var sortedTimetable = [];
      Object.keys(this.editRoomForm.data.timetable).forEach((key) => {
        sortedTimetable.push({ separate: key, status: this.editRoomForm.data.timetable[key] });
      });

      // 時刻の小さい順に並べ替える
      sortedTimetable.sort((a, b) => {
        let comparison = 0;
        if (a.separate > b.separate) {
          comparison = 1;
        } else if (a.separate < b.separate) {
          comparison = -1;
        }
        return comparison;
      });

      this.editRoomForm.data.timetable = sortedTimetable;

      this.editRoomForm.dialog = true;
    },

    /**
     * 時刻データの編集
     *
     * @param Number  index 時間割に対する時刻のインデックス（表示データの更新で使用）
     * @param String  time  時刻
     */
    editTimetable: function (index, time) {
      this.timePicker.index = index;
      this.timePicker.time = time;
      this.timePicker.dialog = true;
    },

    /**
     * 時刻データのセット
     */
    setTimetable: function () {
      // 入力されたデータをセット
      this.editRoomForm.data.timetable[this.timePicker.index].separate = this.timePicker.time;
      this.timePicker.dialog = false;
    },

    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.editRoomForm.dialog = false;
      this.editRoomForm.loading = false;
      this.$nextTick(() => {
        this.$refs.editRoomForm.reset();
        this.editRoomForm.index = -1;
      });
    },

    /**
     * 編集データの保存
     */
    submit: async function () {
      if (this.$refs.editRoomForm.validate()) {
        this.editRoomForm.loading = true;

        // 時間割データの最適化
        // 時刻の小さい順に並べ替える
        this.editRoomForm.data.timetable.sort((a, b) => {
          let comparison = 0;
          if (a.separate > b.separate) {
            comparison = 1;
          } else if (a.separate < b.separate) {
            comparison = -1;
          }
          return comparison;
        });

        var timetable = {};
        this.editRoomForm.data.timetable.forEach((data) => {
          timetable[data.separate] = data.status;
        });

        var input = new FormData();
        input.append('name', this.editRoomForm.data.name);
        input.append('timetable', JSON.stringify(timetable));

        // ユーザーデータ保存処理
        var response = await this.$http.post(
          this.$endpoint('roomUpdate', [this.editRoomForm.data.id]),
          input
        );

        if (response.status === OK) {
          this.$store.dispatch('alert/show', {
            type: 'success',
            message: 'ユーザーデータが更新されました。',
          });

          if (this.editRoomForm.index > -1) {
            this.rooms[this.editRoomForm.index].timetable = timetable;
          } else {
            this.rooms.push(this.editRoomForm);
          }

          this.close();
        } else {
          this.$store.dispatch('alert/show', {
            type: 'error',
            message: 'エラーが発生しました。',
          });

          this.editRoomForm.loading = false;
        }
      }
    },
  },
  created() {
    this.getRooms();
  },
};
</script>
