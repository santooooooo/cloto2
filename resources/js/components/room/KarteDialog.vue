<template>
  <!-- カルテ記入ダイアログ -->
  <v-container ma-0 pa-0>
    <v-dialog persistent v-model="dialog" v-if="authUser.seat" width="1000">
      <v-form ref="karteForm" v-model="karteForm.validation.valid" lazy-validation>
        <v-card class="headline grey darken-2 text-center px-2">
          <v-container>
            <v-row justify="end">
              <v-btn
                fab
                x-small
                depressed
                color="error"
                class="mr-4"
                :disabled="karteForm.loading"
                @click="$emit('close', false)"
              >
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-row>

            <v-row justify="center" align="center" class="mt-2">
              <input type="time" v-model="karteForm.activityTime" class="grey darken-2 mr-4" />

              <v-btn
                bense
                small
                depressed
                color="success"
                class="ml-4"
                @click="getTag()"
                :disabled="karteForm.loading"
              >
                タグ入力
              </v-btn>
            </v-row>

            <v-row justify="center">
              <v-chip class="ma-3" v-for="tagId in tag.inputIds" :key="tagId">
                {{ getSelectedTagName(tagId) }}
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
                  :disabled="karteForm.loading"
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
                  :disabled="karteForm.loading"
                  solo
                  rounded
                  rows="1"
                  label="https://cloto.jp"
                  auto-grow
                ></v-textarea>
              </v-col>

              <v-col>
                <v-card-text class="pa-0 white--text title font-weight-bold"> 画像 </v-card-text>

                <ImageInput output-type="png" @input="karteForm.image = $event" />
              </v-col>
            </v-row>

            <v-row>
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  達成したこと
                </v-card-text>
                <v-textarea
                  v-model="karteForm.achieve"
                  :disabled="karteForm.loading"
                  solo
                  rounded
                  rows="6"
                  auto-grow
                ></v-textarea>
              </v-col>

              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  次の課題
                </v-card-text>
                <v-textarea
                  v-model="karteForm.challenge"
                  :disabled="karteForm.loading"
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

    <!-- タグ入力ダイアログ -->
    <v-dialog persistent v-model="tag.dialog" width="600" height="600">
      <v-card class="headline grey darken-2 text-center">
        <v-container>
          <v-card-text>
            <h2 class="pa-2 white--text title font-weight-bold mb-2 text-center">タグ</h2>

            <!-- ローディング -->
            <v-skeleton-loader type="table-row@6" v-if="tag.loading"></v-skeleton-loader>

            <v-chip-group active-class="white--text" v-model="tag.inputIds" column multiple v-else>
              <v-chip filter v-for="tag in tag.data" :key="tag.id" :value="tag.id">
                {{ tag.name }}
              </v-chip>
            </v-chip-group>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed @click="inputTag(tag.inputIds)" class="mt-3" color="#f6bf00" dark>
              保存
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
            <v-btn text color="grey lighten-5" @click="$emit('leave-room')">いいえ</v-btn>
            <v-btn text color="grey lighten-5" @click="$emit('continue-study')">はい</v-btn>
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
        challenge: '', // 次の課題
        reference: '', // 参考文献
        image: '', // 画像
        activityTime: '00:00', // 活動時間
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '活動内容は必須項目です。'],
        },
      },
      tag: {
        dialog: false, // タグ入力ダイアログの制御
        data: '', // タグデータ
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
     * タグの取得
     */
    getTag: async function () {
      this.tag.loading = true;
      this.tag.dialog = true;

      var response = await axios.get('/api/tags');
      this.tag.data = response.data;

      this.tag.loading = false;
    },

    /**
     * タグの入力決定
     *
     * @param Array tagIds 入力されたタグのID
     */
    inputTag: function (tagIds) {
      this.karteForm.tag = tagIds;
      this.tag.dialog = false;
    },

    /**
     * 選択済みタグの表示
     *
     * @param   Number  tagId 入力されたタグのID
     * @returns String  タグ名
     */
    getSelectedTagName(tagId) {
      return this.tag.data.filter((item) => {
        return item.id === tagId;
      })[0].name;
    },

    submit: async function () {
      if (this.$refs.karteForm.validate()) {
        this.karteForm.loading = true;

        var input = new FormData();
        input.append('activity_time', this.karteForm.activityTime);
        input.append('tags', this.tag.inputIds);
        input.append('body', this.karteForm.body);
        input.append('achieve', this.karteForm.achieve);
        input.append('challenge', this.karteForm.challenge);
        input.append('reference', this.karteForm.reference);
        input.append('image', this.karteForm.image);

        // カルテ保存処理
        var response = await axios.post('/api/kartes', input);

        if (response.status === OK) {
          this.$store.dispatch('alert/success', 'カルテが保存されました。');

          this.dialog = false;
        } else {
          this.$store.dispatch('alert/error');

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
