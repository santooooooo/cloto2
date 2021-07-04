<template>
  <v-dialog v-model="dialog" width="650" persistent v-if="dialog">
    <v-form ref="editProfileForm" v-model="editProfileForm.validation.valid" lazy-validation>
      <v-card class="headline grey darken-2 text-center px-2">
        <v-container>
          <!-- 目標 -->
          <v-card-text class="pa-1 white--text">目標</v-card-text>
          <v-textarea
            v-model="editProfileForm.data.vision"
            placeholder="がんばる"
            maxlength="200"
            rows="3"
            counter
            solo
            rounded
            class="pa-2"
          ></v-textarea>

          <!-- アイコン -->
          <ImageInput
            :no-change-crop-ratio="true"
            ratio-x="1"
            ratio-y="1"
            @input="editProfileForm.data.icon = $event"
          />

          <v-row>
            <v-col>
              <!-- ユーザー名 -->
              <v-card-text class="pa-1 white--text">ユーザー名</v-card-text>
              <v-text-field
                v-model="editProfileForm.data.username"
                :rules="editProfileForm.validation.usernameRules"
                label="ユーザー名"
                solo
                rounded
                disabled
                class="pa-2"
              ></v-text-field>
            </v-col>

            <v-col>
              <!-- アカウント名 -->
              <v-card-text class="pa-1 white--text">表示名</v-card-text>
              <v-text-field
                v-model="editProfileForm.data.handlename"
                :rules="editProfileForm.validation.handlenameRules"
                label="表示名"
                solo
                rounded
                class="pa-2"
              ></v-text-field>
            </v-col>
          </v-row>

          <!-- メールアドレス -->
          <v-card-text class="pa-1 white--text">メールアドレス</v-card-text>
          <v-text-field
            v-model="editProfileForm.data.email"
            :rules="editProfileForm.validation.emailRules"
            label="メールアドレス"
            solo
            rounded
            disabled
            class="pa-2"
          ></v-text-field>

          <!-- Twitter -->
          <v-row>
            <v-col>
              <v-card-text class="pa-1 white--text">Twitter</v-card-text>
              <v-text-field
                v-model="editProfileForm.data.sns.twitter"
                placeholder="@以降を入力 例：CLOTO_JP"
                solo
                rounded
                class="pa-2"
              >
              </v-text-field>
            </v-col>

            <!-- GitHub -->
            <v-col>
              <v-card-text class="pa-1 white--text">GitHub</v-card-text>
              <v-text-field
                v-model="editProfileForm.data.sns.github"
                placeholder="GitHub 例：CLOTO_JP"
                solo
                rounded
                class="pa-2"
              >
              </v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <!-- Qiita -->
            <v-col>
              <v-card-text class="pa-1 white--text">Qiita</v-card-text>
              <v-text-field
                v-model="editProfileForm.data.sns.qiita"
                placeholder="Qiita 例：CLOTO_JP"
                solo
                rounded
                class="pa-2"
              >
              </v-text-field>
            </v-col>

            <!-- ホームページ -->
            <v-col>
              <v-card-text class="pa-1 white--text">Webサイト</v-card-text>
              <v-text-field
                v-model="editProfileForm.data.web"
                placeholder="Webサイト 例：https://cloto.jp"
                solo
                rounded
                class="pa-2"
              >
              </v-text-field>
            </v-col>
          </v-row>

          <!-- 自己紹介 -->
          <v-card-text class="pa-1 white--text">自己紹介</v-card-text>
          <v-textarea
            solo
            name="introduction"
            rounded
            rows="3"
            class="pa-1"
            v-model="editProfileForm.data.introduction"
          ></v-textarea>

          <!-- ボタン -->
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="close()" depressed class="mt-3 mr-8 white--text" color="error">
              閉じる
            </v-btn>

            <v-btn
              @click="submit()"
              :loading="editProfileForm.loading"
              :disabled="!editProfileForm.validation.valid"
              depressed
              class="mt-3 ml-8 white--text"
              color="#f6bf00"
            >
              更新
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-form>
  </v-dialog>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  data() {
    return {
      dialog: false,
      editProfileForm: {
        loading: false,
        data: {},
        validation: {
          valid: false,
          usernameRules: [(v) => !!v || 'ユーザネームは必須項目です。'],
          handlenameRules: [(v) => !!v || '表示名は必須項目です。'],
          emailRules: [
            (v) => !!v || 'メールアドレスは必須項目です。',
            (v) => {
              const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return pattern.test(v) || 'メールアドレスが無効です。';
            },
          ],
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
    /**
     * 編集ダイアログのクローズ
     */
    close: function () {
      this.$refs.editProfileForm.reset();
      this.$emit('close', false);
    },

    /**
     * 編集データの保存
     */
    submit: async function () {
      if (this.$refs.editProfileForm.validate()) {
        this.editProfileForm.loading = true;

        let sns = {};
        if (this.editProfileForm.data.sns.twitter) {
          sns.twitter = this.editProfileForm.data.sns.twitter;
        }
        if (this.editProfileForm.data.sns.github) {
          sns.github = this.editProfileForm.data.sns.github;
        }
        if (this.editProfileForm.data.sns.qiita) {
          sns.qiita = this.editProfileForm.data.sns.qiita;
        }

        let input = new FormData();
        input.append('_method', 'patch');
        input.append('vision', this.editProfileForm.data.vision || '');
        input.append('username', this.editProfileForm.data.username);
        input.append('email', this.editProfileForm.data.email);
        input.append('handlename', this.editProfileForm.data.handlename);
        input.append('icon', this.editProfileForm.data.icon);
        input.append('sns', JSON.stringify(sns));
        input.append('web', this.editProfileForm.data.web || '');
        input.append('introduction', this.editProfileForm.data.introduction || '');

        // ユーザーデータ保存処理
        let response = await axios.post('/api/user', input);

        if (response.status === OK) {
          // ユーザーデータの同期
          await this.$store.dispatch('auth/syncAuthUser');

          this.$refs.editProfileForm.reset();

          this.dialog = false;
          this.$emit('close', false);
        } else {
          this.editProfileForm.loading = false;
        }
      }
    },
  },

  mounted() {
    this.editProfileForm.data = Object.assign({}, this.authUser);
    this.dialog = true;
  },
};
</script>
