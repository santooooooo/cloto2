<template>
  <v-container fluid pa-0 class="index">
    <!-- 新規登録，ログインフォーム -->
    <router-view />

    <!-- メイン -->
    <Smartphone v-if="$vuetify.breakpoint.xs" />
    <Laptop v-else />

    <!-- 問い合わせフォーム -->
    <v-card max-width="600" class="mx-auto mb-12 pa-6">
      <v-container>
        <h5 class="text-center text-h5">お問い合わせ</h5>

        <v-form ref="form" v-model="contactFormValidation.valid" lazy-validation>
          <v-text-field
            v-model="contactForm.name"
            :rules="contactFormValidation.nameRules"
            label="お名前"
            required
          ></v-text-field>

          <v-text-field
            v-model="contactForm.email"
            :rules="contactFormValidation.emailRules"
            label="メールアドレス"
            required
          ></v-text-field>

          <v-textarea
            v-model="contactForm.body"
            :rules="contactFormValidation.bodyRules"
            label="お問い合わせ内容"
            required
          ></v-textarea>

          <v-btn
            :loading="contactForm.loading"
            :disabled="!contactFormValidation.valid"
            @click="sendContact()"
            block
            large
            color="info"
            class="mt-4 font-weight-bold"
            >送信
          </v-btn>
        </v-form>
      </v-container>
    </v-card>

    <div class="text-center ma-2">
      <v-snackbar v-model="contactForm.snackbar" :timeout="contactForm.timeout">
        {{ contactForm.message }}

        <template v-slot:action="{ attrs }">
          <v-btn color="pink" text v-bind="attrs" @click="contactForm.snackbar = false">
            Close
          </v-btn>
        </template>
      </v-snackbar>
    </div>

    <v-btn
      fixed
      dark
      fab
      bottom
      right
      x-large
      color="#00acee"
      class="ma-5"
      target="_blank"
      href="http://twitter.com/share?url=https://cloto.jp&text=デフォルトツイート&via=cloto_jp&hashtags=#CLOTO"
    >
      <v-icon>mdi-twitter</v-icon>
    </v-btn>
  </v-container>
</template>

<script>
import Smartphone from '@/components/index/Smartphone';
import Laptop from '@/components/index/Laptop';
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: 'CLOTO',
        separator: ' ',
        complement: ' ',
      };
    },
  },
  components: {
    Smartphone,
    Laptop,
  },
  data() {
    return {
      contactForm: {
        name: '',
        email: '',
        body: '',
        loading: false,
        snackbar: false,
        message: '',
        timeout: 10000,
      },
      contactFormValidation: {
        valid: false,
        nameRules: [
          (v) => !!v || '名前は必須項目です。',
          (v) => (v && v.length <= 16) || '16文字以下で入力してください。',
        ],
        emailRules: [
          (v) => !!v || 'メールアドレスは必須項目です。',
          (v) => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return pattern.test(v) || 'メールアドレスが無効です。';
          },
        ],
        bodyRules: [(v) => !!v || 'お問い合わせ内容は必須項目です。'],
      },
    };
  },
  methods: {
    sendContact: async function () {
      if (this.$refs.form.validate()) {
        this.contactForm.loading = true;

        var input = {
          name: this.contactForm.name,
          email: this.contactForm.email,
          body: this.contactForm.body,
        };

        // 問い合わせ送信処理
        var response = await this.$http.post(this.$endpoint('contact'), input);

        if (response.status === OK) {
          this.$refs.form.reset();
        }

        this.contactForm.loading = false;
        this.contactForm.message = response.data;
        this.contactForm.snackbar = true;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.index {
  max-width: 100%;
  background-color: $light-gray;

  a:hover {
    text-decoration: none;
  }
}
</style>
