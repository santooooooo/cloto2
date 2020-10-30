<template>
  <!-- カルテ記入ダイアログ -->
  <!-- <v-dialog persistent scrollable v-model="dialog" width="1000"> -->
  <v-dialog persistent v-model="dialog" width="1000">
    <v-form ref="karteForm" v-model="karteForm.validation.valid" lazy-validation>
      <v-card class="headline pa-1 grey darken-1 text-center">
        <v-card-text class="pa-1 white--text title whitefont-weight-bold">
          {{ taskBody }}
        </v-card-text>

        <v-row class="text-center m-1" justify="center">
          <v-col cols="12" sm="6">
            <v-card-text class="white--text title whitefont-weight-bold"> 活動時間 </v-card-text>
            <input class="form-control" type="time" v-model="karteForm.activityTime" />
          </v-col>
          <v-col cols="12" sm="6">
            <v-card-text class="white--text title whitefont-weight-bold"> 使用言語 </v-card-text>

            <v-textarea
              v-model="karteForm.technologies"
              solo
              rounded
              rows="1"
              label="#html #css"
              auto-grow
            ></v-textarea>
          </v-col>
        </v-row>

        <v-row class="text-center m-1" justify="center">
          <v-col cols="12" sm="6" margin-bottom="30px">
            <!-- <v-card-text class="white--text title whitefont-weight-bold"> 活動内容 </v-card-text> -->
            <!-- <v-card-text class="red--text title whitefont-weight-bold">
              活動内容(必須)
            </v-card-text> -->

            <v-card-text class="danger--text headline font-weight-bold">
              活動内容(必須)
            </v-card-text>

            <v-textarea
              v-model="karteForm.body"
              :rules="karteForm.validation.bodyRules"
              rounded
              filled
              rows="8"
              color="black"
              background-color="white"
            ></v-textarea>
          </v-col>
          <v-col cols="12" sm="6">
            <v-card-text class="white--text title whitefont-weight-bold"> 画像 </v-card-text>
            <v-card height="230" class="m-1 rounded-xl">
              <image-drop-upload @input="karteForm.image = $event"></image-drop-upload>
            </v-card>
          </v-col>
        </v-row>

        <v-card-text class="white--text title whitefont-weight-bold"> 達成したこと </v-card-text>
        <v-textarea v-model="karteForm.achieve" solo rounded rows="1" auto-grow></v-textarea>

        <v-card-text class="white--text title whitefont-weight-bold">
          できなかったこと
        </v-card-text>
        <v-textarea v-model="karteForm.trouble" solo rounded rows="1" auto-grow></v-textarea>

        <v-card-text class="white--text title whitefont-weight-bold"> 参考文献 </v-card-text>

        <v-textarea
          v-model="karteForm.reference"
          solo
          rounded
          rows="1"
          label="https://develop.cloto.jp/"
          auto-grow
        ></v-textarea>

        <v-row justify="center">
          <v-dialog v-model="continueDialog" v-if="this.authUser.seat" width="600" persistent>
            <!-- <v-card center>
              <v-btn
                color="green darken-1"
                text
                @click="(continueDialog = false), $emit('open-project-dialog', true)"
              >
                続行
              </v-btn>
              <v-btn
                color="green darken-1"
                text
                @click="continueDialog = false"
                :to="{ name: 'home' }"
              >
                終了
              </v-btn>
            </v-card> -->
            <v-card class="headline grey lighten-1 text-center">
              <v-card-text class="pa-2 white--text title whitefont-weight-bold">
                続けて自習されますか？
              </v-card-text>
              <v-btn
                color="grey lighten-5"
                text
                @click="(continueDialog = false), $emit('open-project-dialog', true)"
              >
                はい
              </v-btn>
              <v-btn color="grey lighten-5" text @click="(continueDialog = false), $emit('leave')">
                いいえ
              </v-btn>
            </v-card>
          </v-dialog>
        </v-row>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            depressed
            color="#f6bf00"
            :loading="karteForm.loading"
            :disabled="!karteForm.validation.valid"
            @click="submit()"
            class="white--text"
          >
            追加
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-dialog>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    taskId: Number,
    taskBody: String,
  },
  data() {
    return {
      dialog: true,
      continueDialog: false,
      karteForm: {
        dialog: false,
        body: '', // やったこと
        achieve: '', // 達成できたこと
        trouble: '', // つまづいたこと
        reference: '', // 参考文献
        image: '', // 画像
        activityTime: '00:00', // 活動時間
        technologies: '保存処理未接続', // タグ
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '活動内容は必須項目です。'],
        },
      },
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    submit: async function () {
      if (this.$refs.karteForm.validate()) {
        this.karteForm.loading = true;

        var input = new FormData();
        input.append('taskId', this.taskId);
        input.append('body', this.karteForm.body);
        input.append('achieve', this.karteForm.achieve);
        input.append('trouble', this.karteForm.trouble);
        input.append('reference', this.karteForm.reference);
        input.append('image', this.karteForm.image);
        input.append('activityTime', this.karteForm.activityTime);
        input.append('technologies', this.karteForm.technologies);

        // カルテ保存処理
        var response = await this.$http.post(this.$endpoint('kartePost'), input);

        if (response.status === OK) {
          // フォームの初期化
          this.$refs.karteForm.reset();
          this.karteForm.loading = false;

          this.dialog = false;
          if (this.authUser.seat !== null) {
            //退席ボタン経由のカルテsubmitは確認モーダルは出さない sitting状態のカルテ記入のみ確認
            this.continueDialog = true;
          }
        }

        // // 結果表示
        // // this.karteForm.loading = false;
        // // this.karteForm.message = response.data;
        // // this.karteForm.snackbar = true;
      }
    },
  },
};
</script>

<style></style>
