<template>
  <v-dialog v-model="dialog" max-width="440">
    <v-card>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col>
              <!-- ロゴ -->
              <v-img
                :src="$storage('system') + 'logo.svg'"
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
                  β版完成時にご連絡いたします。
                </h6>
                <p class="text-body-1 font-weight-black">以下よりご登録ください！</p>
              </div>

              <!-- フォーム -->
              <v-form
                ref="preRegisterForm"
                v-model="preRegisterForm.validation.valid"
                lazy-validation
              >
                <v-text-field
                  v-model="preRegisterForm.name"
                  :rules="preRegisterForm.validation.nameRules"
                  label="お名前"
                ></v-text-field>

                <v-text-field
                  v-model="preRegisterForm.email"
                  :rules="preRegisterForm.validation.emailRules"
                  label="メールアドレス"
                ></v-text-field>

                <v-checkbox
                  v-model="preRegisterForm.newsletter"
                  label="アンケートの送付を許可する"
                  color="primary"
                  hide-details
                ></v-checkbox>
                <small
                  >より良いサービスをお届けするために、多くの方からのフィードバックを必要としています。
                  メールでの簡単なアンケートにご協力いただけますと幸いです。</small
                >

                <v-row justify="center" class="mt-6">
                  <v-btn
                    :loading="preRegisterForm.loading"
                    :disabled="!preRegisterForm.validation.valid"
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
      preRegisterForm: {
        name: '',
        email: '',
        newsletter: true,
        loading: false,
        validation: {
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
  },
  methods: {
    preRegister: async function () {
      if (this.$refs.preRegisterForm.validate()) {
        this.preRegisterForm.loading = true;

        var input = {
          name: this.preRegisterForm.name,
          email: this.preRegisterForm.email,
          newsletter: this.preRegisterForm.newsletter,
        };

        // 仮登録処理
        var response = await this.$http.post(this.$endpoint('preRegister'), input);

        if (response.status === OK) {
          this.$store.dispatch('alert/success', response.data);
          this.$router.push({ name: 'index' });
        } else {
          this.$store.dispatch('alert/error', response.data);
          this.preRegisterForm.loading = false;
        }
      }
    },
  },
};
</script>

<style lang="scss">
label {
  margin: 0 !important;
}
</style>
