<template>
  <v-dialog v-model="dialog" max-width="440">
    <v-card>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col>
              <v-alert v-model="alert" dismissible type="success">メールをご確認ください！</v-alert>

              <!-- ロゴ -->
              <v-img
                :src="$storage('system') + 'logo.png'"
                class="mx-auto mb-4"
                width="35"
                height="35"
              ></v-img>

              <!-- タイトル -->
              <h2 class="text-h4 font-weight-bold text-center">仮登録</h2>
              <p class="text-body-1 text-center">
                申し訳ございません。<br />
                リリースは来年1月頃の予定です。<br />
                今しばらくお待ちください。
              </p>

              <div class="mt-8 text-center">
                <h6
                  class="text-h6 font-weight-black text-decoration-underline red--text text--lighten-1"
                >
                  今なら早期登録特典あり
                </h6>
                <p class="text-body-1 font-weight-black">以下よりご登録ください！</p>
              </div>

              <!-- フォーム -->
              <v-form>
                <v-text-field
                  v-model="name"
                  :rules="[rules.required, rules.nameMin, rules.nameMax]"
                  label="お名前"
                  counter="16"
                ></v-text-field>

                <v-text-field
                  v-model="email"
                  :rules="[rules.required, rules.email]"
                  label="メールアドレス"
                ></v-text-field>

                <v-row justify="center">
                  <button
                    v-on:click="preRegister()"
                    type="button"
                    class="btn btn-cloto-primary"
                    v-bind:disabled="isButtonDisabled"
                  >
                    仮登録
                  </button>
                </v-row>
              </v-form>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: '新規登録',
      };
    },
  },
  data() {
    return {
      dialog: true,
      alert: false,
      name: '',
      email: '',
      isButtonDisabled: true,
      rules: {
        required: (v) => !!v || '必須項目です。',
        nameMin: (v) => v.length >= 4 || '4文字以上で入力してください。',
        nameMax: (v) => v.length <= 16 || '16文字以下で入力してください。',
        email: (v) => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(v) || 'メールアドレスが無効です。';
        },
      },
    };
  },
  computed: {
    allTexts() {
      return [this.name, this.email];
    },
  },
  watch: {
    dialog: function () {
      // モーダルが閉じたらリダイレクト
      if (this.dialog === false) {
        this.$router.push({ name: 'index' });
      }
    },
    alert: function () {
      // アラートが閉じたらリダイレクト
      if (this.alert === false) {
        this.$router.push({ name: 'index' });
      }
    },
    allTexts(inputField) {
      if (inputField.indexOf('') === -1) {
        this.isButtonDisabled = false; // ログインボタンの有効化
      } else {
        this.isButtonDisabled = true; // ログインボタンの無効化
      }
    },
  },
  methods: {
    preRegister: async function () {
      var input = {
        name: this.name,
        email: this.email,
      };

      var response = await this.$http.post(this.$endpoint('POST:preRegister'), input);

      if (response.status === OK) {
        this.alert = true;
        this.$router.push({ name: 'index' });
      }
    },
  },
};
</script>
