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
          <v-dialog v-model="editSeatForm.dialog" max-width="800px" persistent>
            <v-form ref="editSeatForm" v-model="editSeatForm.validation.valid" lazy-validation>
              <v-card class="headline grey darken-2 text-center pa-2">
                <v-card-title>
                  <span class="headline white--text">編集</span>
                </v-card-title>
                <v-card-text>
                  <span class="white--text">1席ごとにデータを保存してください。</span>
                </v-card-text>

                <v-card-text>
                  <v-container>
                    <!-- 区画 -->
                    <v-list-group
                      v-for="(section, sectionIndex) in editSeatForm.data.sections"
                      :key="section.id"
                    >
                      <template v-slot:activator>
                        <v-list-item-title class="white--text">
                          区画 {{ section.id }}
                        </v-list-item-title>
                      </template>

                      <!-- 座席 -->
                      <v-list-item>
                        <v-row>
                          <v-spacer></v-spacer>
                          <v-col md="2" align-self="center">
                            <span class="white--text">サイズ</span>
                          </v-col>
                          <v-col md="3" align-self="center">
                            <span class="white--text">x座標</span>
                          </v-col>
                          <v-col md="3" align-self="center">
                            <span class="white--text">y座標</span>
                          </v-col>
                          <v-spacer></v-spacer>
                        </v-row>
                      </v-list-item>
                      <v-list-item v-for="(seat, seatIndex) in section.seats" :key="seat.id">
                        <v-row>
                          <v-col md="2" align-self="center">
                            <span class="white--text">座席 {{ seat.id }}</span>
                          </v-col>

                          <v-col md="2">
                            <v-text-field
                              v-model="
                                editSeatForm.data.sections[sectionIndex].seats[seatIndex].size
                              "
                              :rules="editSeatForm.validation.sizeRules"
                              label="サイズ"
                              solo
                              rounded
                              class="pa-2"
                            ></v-text-field>
                          </v-col>

                          <v-col md="3">
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
                          </v-col>

                          <v-col md="3">
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
                          </v-col>

                          <v-col md="2" align-self="center">
                            <v-btn
                              small
                              text
                              color="success"
                              :loading="editSeatForm.loading"
                              @click="
                                submit(
                                  seat.id,
                                  editSeatForm.data.sections[sectionIndex].seats[seatIndex].size,
                                  editSeatForm.data.sections[sectionIndex].seats[seatIndex].position
                                )
                              "
                            >
                              保存
                            </v-btn>
                          </v-col>
                        </v-row>
                      </v-list-item>
                    </v-list-group>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="success" :loading="editSeatForm.loading" @click="close()">
                    終了
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small @click="editSeat(item)">mdi-pencil</v-icon>
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
        inner: '座席',
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
      editSeatForm: {
        dialog: false,
        loading: false,
        data: {},
        validation: {
          valid: false,
          sizeRules: [
            (v) => !!v || 'サイズは必須項目です。',
            (v) => {
              const pattern = /^\d*$/;
              return pattern.test(v) || '数値を入力してください。';
            },
          ],
          positionRules: [
            (v) => !!v || '座標は必須項目です。',
            (v) => {
              const pattern = /^\d*$/;
              return pattern.test(v) || '数値を入力してください。';
            },
          ],
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
     * 座席データの編集
     *
     * @param Object  room  編集する部屋
     */
    editSeat: async function (room) {
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
        // データの更新
        this.getRooms();
      });
    },

    /**
     * 編集データの保存
     *
     * @param Number  seatId    更新する座席ID
     * @param Number  size      サイズ
     * @param Object  position  座標
     */
    submit: async function (seatId, size, position) {
      if (this.$refs.editSeatForm.validate()) {
        this.editSeatForm.loading = true;

        // 座席データ保存処理
        var response = await this.$http.post(this.$endpoint('seatUpdate', [seatId]), {
          size: size,
          position: position,
        });

        if (response.status === OK) {
          this.$store.dispatch('alert/success', '座席データが更新されました。');
        } else {
          this.$store.dispatch('alert/error');
        }

        this.editSeatForm.loading = false;
      }
    },
  },
  created() {
    this.getRooms();
  },
};
</script>
