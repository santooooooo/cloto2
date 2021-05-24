<template>
  <!-- カルテ記入ダイアログ -->
  <v-container ma-0 pa-0>
    <v-dialog persistent v-model="dialog" width="1000">
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
                  参考サイトや公開物のURL<span class="red--text" v-if="roadmapId">*</span>
                </v-card-text>
                <v-textarea
                  v-model="karteForm.reference"
                  :rules="karteForm.validation.referenceRules"
                  :disabled="karteForm.loading"
                  solo
                  rounded
                  rows="1"
                  label="https://cloto.jp"
                  auto-grow
                  v-if="roadmapId"
                ></v-textarea>
                <v-textarea
                  v-model="karteForm.reference"
                  :disabled="karteForm.loading"
                  solo
                  rounded
                  rows="1"
                  label="https://cloto.jp"
                  auto-grow
                  v-else
                ></v-textarea>
              </v-col>

              <v-col>
                <v-card-text class="pa-0 white--text title font-weight-bold">
                  画像<span class="red--text" v-if="roadmapId">*</span>
                </v-card-text>

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
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    roadmapId: Number, // カルテを紐付けるロードマップID
  },
  data() {
    return {
      dialog: true,
      karteForm: {
        body: '', // やったこと
        achieve: '', // 達成できたこと
        challenge: '', // 次の課題
        reference: '', // 参考文献
        image: null, // 画像
        activityTime: '00:00', // 活動時間
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '活動内容は必須項目です。'],
          referenceRules: [(v) => !!v || '参考サイトや公開物のURLは必須項目です。'],
        },
      },
      tag: {
        dialog: false, // タグ入力ダイアログの制御
        data: '', // タグデータ
        inputIds: [], // 選択済データ
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
     * タグの取得
     */
    getTag: async function () {
      this.tag.loading = true;
      this.tag.dialog = true;

      let response = await axios.get('/api/tags');
      this.tag.data = response.data;

      this.tag.loading = false;
    },

    /**
     * タグの入力決定
     *
     * @param {Array} tagIds - 入力されたタグのID
     */
    inputTag: function (tagIds) {
      this.karteForm.tag = tagIds;
      this.tag.dialog = false;
    },

    /**
     * 選択済みタグの表示
     *
     * @param {Number} tagId - 入力されたタグのID
     * @return {String} タグ名
     */
    getSelectedTagName: function (tagId) {
      return this.tag.data.filter((item) => {
        return item.id === tagId;
      })[0].name;
    },

    /**
     * カルテの投稿
     */
    submit: async function () {
      // バリデーション
      let validate = this.$refs.karteForm.validate();
      if (this.roadmapId && this.karteForm.image === null) {
        // ロードマップへの紐付け時には画像の入力が必須
        validate = false;
        this.$store.dispatch('alert/error', '画像は必須です！');
      }

      if (validate) {
        this.karteForm.loading = true;

        let input = new FormData();
        input.append('roadmap_id', this.roadmapId || '');
        input.append('activity_time', this.karteForm.activityTime);
        input.append('tags', this.tag.inputIds);
        input.append('body', this.karteForm.body);
        input.append('achieve', this.karteForm.achieve);
        input.append('challenge', this.karteForm.challenge);
        input.append('reference', this.karteForm.reference);
        input.append('image', this.karteForm.image);

        // カルテ保存処理
        let response = await axios.post('/api/kartes', input);

        if (response.status === OK) {
          let tweet;
          if (this.roadmapId) {
            // ロードマップへの紐付け後
            tweet =
              '【' +
              this.$periodName(this.authUser.roadmaps[0].in_progress, true) +
              ' / Class ' +
              this.authUser.roadmaps[0].in_progress +
              '】をクリアしました🎉🎉🎉\n\n' +
              this.karteForm.body;

            // 次のクラスへ
            this.$emit('next-class');
          } else {
            tweet = this.karteForm.body;
          }

          if (window.location.hostname === 'cloto.jp') {
            // 本番サーバでのみツイート
            let url =
              'https://twitter.com/intent/tweet?text=' +
              encodeURIComponent(
                this.substr(tweet, 216) + '\n\n#今日の積み上げ\n#CLOTO\n@cloto_jp\ncloto.jp'
              );
            window.open(url, 'Tweet', 'width=650, height=470');
          }

          this.$emit('close', false);
        } else {
          this.karteForm.loading = false;
        }
      }
    },

    /**
     * 文字列のバイト切り出し
     *
     * @param {String} text - 切り出すテキスト
     * @param {Number} byte - バイト数
     * @return {String} 切り出し後のテキスト
     */
    substr: function (text, byte) {
      let texts = text.split('');
      let count = 0;
      let str = '';

      for (let i = 0; i < texts.length; i++) {
        // バイト数の加算
        let char = escape(texts[i]);
        if (char.length < 4) {
          count += 1;
        } else {
          count += 2;
        }

        if (count > byte) {
          return str + '...';
        } else {
          str += text.charAt(i);
        }
      }

      return text;
    },
  },
};
</script>
