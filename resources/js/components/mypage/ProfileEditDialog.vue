<template>
  <v-dialog v-model="dialog" width="650" persistent>
    <v-form ref="profileUpdateForm" v-model="profileUpdateForm.validation.valid" lazy-validation>
      <v-card class="headline grey darken-2 text-center px-2">
        <v-container>
          <!-- アイコン -->
          <InputImage
            :no-change-crop-ratio="true"
            ratio-x="1"
            ratio-y="1"
            @input="profileUpdateForm.icon = $event"
          />

          <v-row>
            <v-col>
              <!-- ユーザー名 -->
              <v-card-text class="pa-1 white--text">ユーザー名</v-card-text>
              <v-text-field
                v-model="profileUpdateForm.username"
                :rules="profileUpdateForm.validation.usernameRules"
                label="ユーザー名"
                solo
                rounded
                class="pa-2"
              ></v-text-field>
            </v-col>

            <v-col>
              <!-- アカウント名 -->
              <v-card-text class="pa-1 white--text">アカウント名</v-card-text>
              <v-text-field
                v-model="profileUpdateForm.handlename"
                :rules="profileUpdateForm.validation.accountRules"
                label="アカウント名"
                solo
                rounded
                class="pa-2"
              ></v-text-field>
            </v-col>
          </v-row>

          <!-- メールアドレス -->
          <v-card-text class="pa-1 white--text">メールアドレス</v-card-text>
          <v-text-field
            v-model="profileUpdateForm.email"
            label="メールアドレス"
            solo
            rounded
            class="pa-2"
          ></v-text-field>

          <!-- Twitter -->
          <v-row>
            <v-col>
              <v-card-text class="pa-1 white--text">Twitter</v-card-text>
              <v-text-field
                v-model="profileUpdateForm.twitter"
                placeholder="Twitter 例：CLOTO_JP"
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
                v-model="profileUpdateForm.github"
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
                v-model="profileUpdateForm.qiita"
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
                v-model="profileUpdateForm.web"
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
            v-model="profileUpdateForm.introduction"
          ></v-textarea>

          <!-- ボタン -->
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              @click="$emit('close', false)"
              depressed
              class="mt-3 mr-8 white--text"
              color="error"
            >
              閉じる
            </v-btn>

            <v-btn
              @click="submit()"
              :loading="profileUpdateForm.loading"
              :disabled="!profileUpdateForm.validation.valid"
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
  head: {
    title() {
      return {
        inner: this.$route.params.username + ' - ' + '編集',
      };
    },
  },
  data() {
    return {
      dialog: true,
      profileUpdateForm: {
        username: '',
        email: '',
        handlename: '',
        icon: '',
        twitter: '',
        github: '',
        qiita: '',
        web: '',
        introduction: '',
        loading: false,
        validation: {
          valid: false,
          usernameRules: [(v) => !!v || 'ユーザネームは必須項目です。'],
          accountRules: [(v) => !!v || 'アカウント名は必須項目です。'],
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
      if (this.$refs.profileUpdateForm.validate()) {
        this.profileUpdateForm.loading = true;

        var input = new FormData();
        input.append('username', this.profileUpdateForm.username);
        input.append('email', this.profileUpdateForm.email);
        input.append('handlename', this.profileUpdateForm.handlename);
        input.append('icon', this.profileUpdateForm.icon);
        input.append(
          'twitter',
          this.profileUpdateForm.twitter ? this.profileUpdateForm.twitter : ''
        );
        input.append('github', this.profileUpdateForm.github ? this.profileUpdateForm.github : '');
        input.append('qiita', this.profileUpdateForm.qiita ? this.profileUpdateForm.qiita : '');
        input.append('web', this.profileUpdateForm.web ? this.profileUpdateForm.web : '');
        input.append(
          'introduction',
          this.profileUpdateForm.introduction ? this.profileUpdateForm.introduction : ''
        );

        // ユーザーデータ保存処理
        var response = await this.$http.post(this.$endpoint('profileUpdate'), input);

        if (response.status === OK) {
          this.$store.dispatch('alert/show', {
            type: 'success',
            message: 'ユーザーデータが更新されました。',
          });

          // ユーザーデータの同期
          await this.$store.dispatch('auth/syncAuthUser');

          this.dialog = false;
          this.$emit('close', false);
        } else {
          this.$store.dispatch('alert/show', {
            type: 'error',
            message: 'エラーが発生しました。',
          });

          this.profileUpdateForm.loading = false;
        }
      }
    },
  },

  mounted() {
    Object.assign(this.profileUpdateForm, this.authUser);
  },
};
</script>

<style lang="scss" scoped></style>
