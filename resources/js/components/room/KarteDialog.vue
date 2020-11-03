<template>
  <!-- カルテ記入ダイアログ -->
  <v-container ma-0 pa-0>
    <v-dialog persistent v-model="dialog" v-if="authUser.tasks[0]" width="1000">
      <v-form ref="karteForm" v-model="karteForm.validation.valid" lazy-validation>
        <v-card class="headline title grey darken-1 text-center">
          <v-container>
            <!-- <h3>{{ authUser.tasks[0].body }}</h3> -->
            <v-card-title class="pa-2 text-center white--text text-h4 font-weight-bold">
              {{ authUser.tasks[0].body }}
            </v-card-title>
            <input class="grey darken-1" type="time" v-model="karteForm.activityTime" />

            <v-btn class="ma-2" bense small depressed color="success" @click="getTechnology()">
              <!-- <v-icon left>fas fa-edit</v-icon> -->
              技術タグ入力
            </v-btn>

            <v-chip class="ma-1" v-for="techId in karteForm.technologies" :key="techId">
              {{ technologies.data[techId].name }}
            </v-chip>

            <v-row class="text-center m-0" justify="center">
              <v-col class="ma-0" cols="12" sm="7">
                <v-card-text class="pa-0 white--text headline font-weight-bold">
                  活動内容<span class="red--text">*</span>
                </v-card-text>

                <v-textarea
                  class="ma-0"
                  v-model="karteForm.body"
                  :rules="karteForm.validation.bodyRules"
                  rounded
                  filled
                  rows="6"
                  color="black"
                  background-color="white"
                ></v-textarea>

                <v-card-text class="pa-0 white--text title whitefont-weight-bold">
                  参考文献
                </v-card-text>

                <v-textarea
                  v-model="karteForm.reference"
                  solo
                  rounded
                  rows="1"
                  label="https://develop.cloto.jp/"
                  auto-grow
                ></v-textarea>
              </v-col>
              <v-col cols="12" sm="5">
                <v-card-text class="pa-0 white--text title whitefont-weight-bold">
                  画像
                </v-card-text>
                <v-card height="290" class="m-1 rounded-xl">
                  <image-drop-upload @input="karteForm.image = $event"></image-drop-upload>
                </v-card>
              </v-col>

              <v-col cols="12" sm="6"
                ><v-card-text class="pa-0 white--text title whitefont-weight-bold">
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
              <v-col cols="12" sm="6"
                ><v-card-text class="pa-0 white--text title whitefont-weight-bold">
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

            <v-row justify="center">
              <v-dialog v-model="continueDialog" v-if="confirm" width="600" persistent>
                <v-card class="headline grey lighten-1 text-center">
                  <v-card-text class="pa-2 white--text title whitefont-weight-bold">
                    続けて自習されますか？
                  </v-card-text>
                  <v-btn
                    color="grey lighten-5"
                    text
                    @click="$emit('open-project-dialog', true), $emit('close', false)"
                  >
                    はい
                  </v-btn>
                  <v-btn color="grey lighten-5" text @click="$emit('leave'), $emit('close', false)">
                    いいえ
                  </v-btn>
                </v-card>
              </v-dialog>
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
    <v-dialog persistent v-model="technologies.dialog" width="600" height="600">
      <v-card class="headline grey darken-2 text-center">
        <v-container>
          <v-row>
            <v-btn
              depressed
              small
              @click="technologies.dialog = false"
              class="ml-3"
              dark
              color="grey lighten-1"
            >
              <v-icon dark>mdi-arrow-left</v-icon> 戻る
            </v-btn>
          </v-row>

          <v-card-text>
            <h2 class="pa-2 white--text title whitefont-weight-bold mb-2 text-center">
              使用技術タグ
            </h2>

            <!-- ローディング -->
            <v-skeleton-loader type="table-row@6" v-if="technologies.loading"></v-skeleton-loader>

            <v-chip-group
              active-class="white--text"
              v-model="technologies.inputs"
              column
              multiple
              v-else
            >
              <v-chip filter v-for="technology in technologies.data" :key="technology.id">
                {{ technology.name }}
              </v-chip>
            </v-chip-group>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              depressed
              @click="inputTechnology(technologies.inputs)"
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
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    confirm: Boolean, //退席するか自習を続けるかの確認モーダルの制御
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
        technologies: [], // タグ
        // selectTechnologies: [], //選択されたタグ　表示用
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '活動内容は必須項目です。'],
        },
      },
      technologies: {
        dialog: false, // 技術タグ入力ダイアログの制御
        data: '', // 技術タグデータ
        inputs: [], // 選択済データ
        loading: false,
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
     * 技術タグの取得
     */
    getTechnology: async function () {
      this.technologies.loading = true;
      this.technologies.dialog = true;

      var response = await this.$http.get(this.$endpoint('technologyIndex'));
      this.technologies.data = response.data;

      console.log(this.technologies.data);

      this.technologies.loading = false;
    },

    /**
     * 技術タグの入力決定
     *
     * @param Array technologyIds 入力された技術タグのID
     */
    inputTechnology: function (technologyIds) {
      this.karteForm.technologies = technologyIds;
      this.technologies.dialog = false;
    },

    submit: async function () {
      if (this.$refs.karteForm.validate()) {
        this.karteForm.loading = true;

        var input = new FormData();
        input.append('task_id', this.authUser.tasks[0].id);
        input.append('body', this.karteForm.body);
        input.append('achieve', this.karteForm.achieve);
        input.append('trouble', this.karteForm.trouble);
        input.append('reference', this.karteForm.reference);
        input.append('image', this.karteForm.image);
        input.append('activity_time', this.karteForm.activityTime);
        // input.append('technologies', this.karteForm.technologies);

        // カルテ保存処理
        var response = await this.$http.post(this.$endpoint('kartePost'), input);

        if (response.status === OK) {
          // フォームの初期化
          this.$refs.karteForm.reset();
          this.karteForm.loading = false;

          this.dialog = false;
        }

        if (!this.confirm) {
          //確認モーダルが不要の場合
          this.$emit('leave');
          this.$emit('close');
          this.$emit('continue-dialog', true); //初期化
        } else {
          //確認モーダルが必要なとき
          this.continueDialog = true;
        }

        // // 結果表示
        // // this.karteForm.loading = false;
        // // this.karteForm.message = response.data;
        // // this.karteForm.snackbar = true;
      }
      console.log(this.karteForm.technologies);
    },
  },
};
</script>
