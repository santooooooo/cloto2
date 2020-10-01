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
              <v-form ref="form" v-model="preRegisterFormValidation.valid" lazy-validation>
                <v-text-field
                  v-model="preRegisterForm.name"
                  :rules="preRegisterFormValidation.nameRules"
                  label="お名前"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="preRegisterForm.email"
                  :rules="preRegisterFormValidation.emailRules"
                  label="メールアドレス"
                  required
                ></v-text-field>

                <v-row justify="center" class="mt-4">
                  <v-btn
                    :loading="preRegisterForm.loading"
                    :disabled="!preRegisterFormValidation.valid"
                    @click="preRegister()"
                    color="info"
                    class="font-weight-bold"
                    >仮登録
                  </v-btn>
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
      preRegisterForm: {
        name: '',
        email: '',
        loading: false,
      },
      preRegisterFormValidation: {
        valid: false,
        nameRules: [(v) => !!v || 'お名前は必須項目です。'],
        emailRules: [
          (v) => !!v || 'メールアドレスは必須項目です。',
          (v) => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return pattern.test(v) || 'メールアドレスが無効です。';
          },
        ],
      },
    };
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
  },
  methods: {
    preRegister: async function () {
      if (this.$refs.form.validate()) {
        this.preRegisterForm.loading = true;

        var input = {
          name: this.preRegisterForm.name,
          email: this.preRegisterForm.email,
        };

        var response = await this.$http.post(this.$endpoint('POST:preRegister'), input);

        if (response.status === OK) {
          this.alert = true;
          this.preRegisterForm.loading = false;
          this.$router.push({ name: 'index' });
        }
      }
    },
  },
};
</script>
