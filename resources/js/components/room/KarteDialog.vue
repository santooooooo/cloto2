<template>
  <!-- カルテ記入ダイアログ -->
  <v-container ma-0 pa-0>
    <!-- <v-dialog persistent v-model="dialog" v-if="authUser.tasks[0]" width="1000"> -->
    <v-dialog persistent v-model="dialog" v-if="authUser.seat" width="1000">
      <v-form ref="karteForm" v-model="karteForm.validation.valid" lazy-validation>
        <v-card class="headline grey darken-2 text-center px-2">
          <v-container>
            <!-- <v-card-text class="pa-2 white--text text-h4 font-weight-bold">
              {{ authUser.tasks[0].body }}
            </v-card-text> -->

            <v-row justify="center" align="center" class="mt-2">
              <input type="time" v-model="karteForm.activityTime" class="grey darken-2 mr-4" />

              <v-btn bense small depressed color="success" class="ml-4" @click="getTechnology()">
                技術タグ入力
              </v-btn>
            </v-row>

            <v-row justify="center">
              <v-chip class="ma-3" v-for="technologyId in technology.inputIds" :key="technologyId">
                {{ technology.data[technologyId].name }}
              </v-chip>
            </v-row>

            <v-row justify="center">
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  活動内容<span class="red--text">*</span>
                </v-card-text>
                <v-textarea
                  v-model="karteForm.body"
                  :rules="karteForm.validation.bodyRules"
                  solo
                  rounded
                  rows="6"
                  auto-grow
                ></v-textarea>

                <v-card-text class="pa-2 white--text title font-weight-bold">
                  参考文献
                </v-card-text>
                <v-textarea
                  v-model="karteForm.reference"
                  solo
                  rounded
                  rows="1"
                  label="https://develop.cloto.jp"
                  auto-grow
                ></v-textarea>
              </v-col>

              <v-col>
                <v-card-text class="pa-0 white--text title font-weight-bold"> 画像 </v-card-text>

                <InputImage @input="karteForm.image = $event" />
              </v-col>
            </v-row>

            <v-row>
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  達成したこと
                </v-card-text>
                <v-textarea
                  v-model="karteForm.achieve"
                  solo
                  rounded
                  rows="6"
                  auto-grow
                ></v-textarea>
              </v-col>

              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  できなかったこと
                </v-card-text>
                <v-textarea
                  v-model="karteForm.trouble"
                  solo
                  rounded
                  rows="6"
                  auto-grow
                ></v-textarea>
              </v-col>
            </v-row>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                @click="submit()"
                :loading="karteForm.loading"
                :disabled="!karteForm.validation.valid"
                depressed
                class="mt-3 white--text"
                color="#f6bf00"
              >
                追加
              </v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-container>
        </v-card>
      </v-form>
    </v-dialog>

    <!-- 技術タグ入力ダイアログ -->
    <v-dialog persistent v-model="technology.dialog" width="600" height="600">
      <v-card class="headline grey darken-2 text-center">
        <v-container>
          <v-row>
            <v-btn
              depressed
              small
              @click="technology.dialog = false"
              class="ml-3"
              dark
              color="grey lighten-1"
            >
              <v-icon dark>mdi-arrow-left</v-icon> 戻る
            </v-btn>
          </v-row>

          <v-card-text>
            <h2 class="pa-2 white--text title font-weight-bold mb-2 text-center">使用技術タグ</h2>

            <!-- ローディング -->
            <v-skeleton-loader type="table-row@6" v-if="technology.loading"></v-skeleton-loader>

            <v-chip-group
              active-class="white--text"
              v-model="technology.inputIds"
              column
              multiple
              v-else
            >
              <v-chip
                filter
                v-for="technology in technology.data"
                :key="technology.id"
                :value="technology.id"
              >
                {{ technology.name }}
              </v-chip>
            </v-chip-group>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              depressed
              @click="inputTechnology(technology.inputIds)"
              class="mt-3"
              color="#f6bf00"
              dark
            >
              追加
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-dialog>

    <!-- 継続確認ダイアログ -->
    <v-dialog v-model="confirmDialog" width="600" persistent>
      <v-card class="headline grey darken-2 text-center px-2">
        <v-container>
          <v-card-text class="pa-2 white--text title font-weight-bold">
            続けて自習されますか？
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text color="grey lighten-5" @click="$emit('continue-study')">はい</v-btn>
            <v-btn text color="grey lighten-5" @click="$emit('leave-room')">いいえ</v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    confirm: Boolean, // 自習継続の確認
  },
  data() {
    return {
      dialog: true,
      karteForm: {
        body: '', // やったこと
        achieve: '', // 達成できたこと
        trouble: '', // つまづいたこと
        reference: '', // 参考文献
        image: '', // 画像
        activityTime: '00:00', // 活動時間
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '活動内容は必須項目です。'],
        },
      },
      technology: {
        dialog: false, // 技術タグ入力ダイアログの制御
        data: '', // 技術タグデータ
        inputIds: [], // 選択済データ
        loading: false,
      },
      confirmDialog: false, // 自習継続の確認
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 技術タグの取得
     */
    getTechnology: async function () {
      this.technology.loading = true;
      this.technology.dialog = true;

      var response = await this.$http.get(this.$endpoint('technologies'));
      this.technology.data = response.data;

      this.technology.loading = false;
    },

    /**
     * 技術タグの入力決定
     *
     * @param Array technologyIds 入力された技術タグのID
     */
    inputTechnology: function (technologyIds) {
      this.karteForm.technology = technologyIds;
      this.technology.dialog = false;
    },

    submit: async function () {
      if (this.$refs.karteForm.validate()) {
        this.karteForm.loading = true;

        var input = new FormData();
        // input.append('task_id', this.authUser.tasks[0].id);
        input.append('task_id', 1);
        input.append('body', this.karteForm.body);
        input.append('achieve', this.karteForm.achieve);
        input.append('trouble', this.karteForm.trouble);
        input.append('reference', this.karteForm.reference);
        input.append('image', this.karteForm.image);
        input.append('activity_time', this.karteForm.activityTime);
        input.append('technologies', this.technology.inputIds);

        // カルテ保存処理
        var response = await this.$http.post(this.$endpoint('kartePost'), input);

        if (response.status === OK) {
          this.$store.dispatch('alert/show', {
            type: 'success',
            message: 'カルテが保存されました。',
          });

          this.dialog = false;
        } else {
          this.$store.dispatch('alert/show', {
            type: 'error',
            message: 'エラーが発生しました。',
          });

          this.karteForm.loading = false;
        }

        // 自習継続の確認
        if (this.confirm) {
          this.confirmDialog = true;
        } else {
          this.$emit('leave-room');
        }
      }
    },
  },
};
</script>
