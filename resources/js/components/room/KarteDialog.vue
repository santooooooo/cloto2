<template>
  <!-- カルテ記入ダイアログ -->
  <v-dialog persistent scrollable v-model="dialog" width="600">
    <v-form ref="karteForm" v-model="karteForm.validation.valid" lazy-validation>
      <v-card class="headline pa-1 grey darken-1 text-center">
        <v-card-text class="pa-1 white--text title whitefont-weight-bold">
          {{ taskBody }}
        </v-card-text>

        <v-row class="text-center m-1" justify="center">
          <v-col cols="12" sm="6" margin-bottom="30px">
            <h6>活動時間</h6>
            <input class="form-control" type="time" v-model="karteForm.activityTime" />
          </v-col>
          <v-col cols="12" sm="6" margin-bottom="30px">
            <h6>使用言語</h6>

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

        <!-- <v-card height="200" class="m-2 rounded-xl">
        <v-btn class="mt-15" color="yellow darken-1">
          <span class="white--text">画像を選択</span>　
        </v-btn>
      </v-card> -->

        <!-- <div class="m-3 p-1"> -->

        <!-- <v-textarea
              auto-grow
              rounded
              filled
              rows="1"
              color="black"
            background-color="white"
            label="#html #css"
            ></v-textarea> -->

        <v-row class="text-center m-1" justify="center">
          <v-col cols="12" sm="6" margin-bottom="30px">
            <h6>活動内容</h6>
            <v-textarea
              v-model="karteForm.body"
              :rules="karteForm.validation.bodyRules"
              rounded
              filled
              rows="3"
              color="black"
              background-color="white"
            ></v-textarea>

            <h6>参考文献</h6>

            <v-textarea
              v-model="karteForm.reference"
              solo
              rounded
              rows="1"
              label="https://develop.cloto.jp/"
              auto-grow
            ></v-textarea>
          </v-col>
          <v-col cols="12" sm="6" margin-bottom="30px">
            <v-card height="200" class="m-2 rounded-xl">
              <image-drop-upload @input="karteForm.image = $event"></image-drop-upload>
              <!-- <v-btn class="mt-15" color="yellow darken-1">
              <span class="white--text">画像を選択</span>　
            </v-btn> -->
            </v-card>
          </v-col>
        </v-row>

        <h6>達成したこと</h6>
        <v-textarea v-model="karteForm.achieve" solo rounded rows="1" auto-grow></v-textarea>

        <h6>つまづいたこと</h6>
        <v-textarea v-model="karteForm.trouble" solo rounded rows="1" auto-grow></v-textarea>

        <v-row justify="center">
          <v-dialog v-model="continueDialog" max-width="140" persistent>
            <v-card center>
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
          this.continueDialog = true;
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
