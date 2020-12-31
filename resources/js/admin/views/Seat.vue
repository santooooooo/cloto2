<template>
  <v-container>
    <v-data-table :headers="headers" :items="rooms" sort-by="roomname" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>部屋一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <span>編集ボタンから座席の位置を変更できます。</span>

          <!-- 部屋データ編集ダイアログ -->
          <v-dialog v-model="editSeatForm.dialog" max-width="700px" persistent>
            <v-form ref="editSeatForm" v-model="editSeatForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">編集</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <!-- 座席位置 -->
                    <v-list-group
                      v-for="(section, sectionIndex) in editSeatForm.data.sections"
                      :key="section.id"
                    >
                      <template v-slot:activator>
                        <v-list-item-title class="white--text">
                          区画 {{ section.id }}
                        </v-list-item-title>
                      </template>

                      <v-list-item
                        sub-group
                        v-for="(seat, seatIndex) in section.seats"
                        :key="seat.id"
                      >
                        <v-card-text class="white--text">座席 {{ seat.id }}</v-card-text>
                        <v-text-field
                          v-model="
                            editSeatForm.data.sections[sectionIndex].seats[seatIndex].position.x
                          "
                          :rules="editSeatForm.validation.positionRules"
                          label="x座標"
                          solo
                          rounded
                          class="pa-2"
                        ></v-text-field>

                        <v-text-field
                          v-model="
                            editSeatForm.data.sections[sectionIndex].seats[seatIndex].position.y
                          "
                          :rules="editSeatForm.validation.positionRules"
                          label="y座標"
                          solo
                          rounded
                          class="pa-2"
                        ></v-text-field>

                        <v-btn
                          small
                          text
                          color="success"
                          :loading="editSeatForm.loading"
                          @click="submit()"
                        >
                          保存
                        </v-btn>
                      </v-list-item>
                    </v-list-group>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="error" :loading="editSeatForm.loading" @click="close()">
                    終了
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
      editSeatForm: {
        dialog: false,
        loading: false,
        index: -1,
        data: {},
        validation: {
          valid: false,
          positionRules: [(v) => !!v || '座標は必須項目です。'],
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
    editRoom: async function (room) {
      this.editSeatForm.index = this.rooms.indexOf(room);
      this.editSeatForm.data = Object.assign({}, room);

      this.editSeatForm.dialog = true;
    },

    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.editSeatForm.dialog = false;
      this.editSeatForm.loading = false;
      this.$nextTick(() => {
        this.$refs.editSeatForm.reset();
        this.editSeatForm.index = -1;
      });
    },

    /**
     * 編集データの保存
     *
     * @param Int     seatId    更新する座席ID
     * @param Object  position  座標
     */
    submit: async function (seatId, position) {
      if (this.$refs.editSeatForm.validate()) {
        this.editSeatForm.loading = true;

        var input = new FormData();
        input.append('position', JSON.stringify(position));

        // ユーザーデータ保存処理
        var response = await this.$http.post(this.$endpoint('seatUpdate', [seatId]), input);

        if (response.status === OK) {
          this.$store.dispatch('alert/show', {
            type: 'success',
            message: 'ユーザーデータが更新されました。',
          });

          this.close();
        } else {
          this.$store.dispatch('alert/show', {
            type: 'error',
            message: 'エラーが発生しました。',
          });

          this.editSeatForm.loading = false;
        }
      }
    },
  },
  created() {
    this.getRooms();
  },
};
</script>
