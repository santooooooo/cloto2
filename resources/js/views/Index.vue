<template>
  <v-container fluid pa-0 class="index">
    <!-- 新規登録，ログインフォーム -->
    <router-view />

    <!-- メイン -->
    <!-- <Smartphone v-if="$vuetify.breakpoint.xs" />
    <Laptop v-else /> -->
    top

    <!-- 問い合わせフォーム -->
    <v-card max-width="600" class="mx-auto mb-12 pa-6">
      <v-container>
        <h5 class="text-center text-h5">お問い合わせ</h5>

        <v-form ref="contactForm" v-model="contactForm.validation.valid" lazy-validation>
          <v-text-field
            v-model="contactForm.name"
            :rules="contactForm.validation.nameRules"
            label="お名前"
            maxlength="16"
            counter
          ></v-text-field>

          <v-text-field
            v-model="contactForm.email"
            :rules="contactForm.validation.emailRules"
            label="メールアドレス"
          ></v-text-field>

          <v-textarea
            v-model="contactForm.body"
            :rules="contactForm.validation.bodyRules"
            label="お問い合わせ内容"
          ></v-textarea>

          <v-btn
            :loading="contactForm.loading"
            :disabled="!contactForm.validation.valid"
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
      href="http://twitter.com/share?url=https://cloto.jp&text=駆け出しエンジニアからプロフェッショナルまで、プログラミングをもっと楽しく！&via=cloto_jp&hashtags=CLOTO,プログラミング"
      v-if="!authCheck"
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
        inner: '',
        separator: ' ',
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
        validation: {
          valid: false,
          nameRules: [(v) => !!v || '名前は必須項目です。'],
          emailRules: [
            (v) => !!v || 'メールアドレスは必須項目です。',
            (v) => {
              const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return pattern.test(v) || 'メールアドレスが無効です。';
            },
          ],
          bodyRules: [(v) => !!v || 'お問い合わせ内容は必須項目です。'],
        },
      },
    };
  },
  computed: {
    authCheck() {
      return this.$store.getters['auth/check'];
    },
  },
  methods: {
    sendContact: async function () {
      if (this.$refs.contactForm.validate()) {
        this.contactForm.loading = true;

        var input = {
          name: this.contactForm.name,
          email: this.contactForm.email,
          body: this.contactForm.body,
        };

        // 問い合わせ送信処理
        var response = await this.$http.post('/api/contact', input);

        if (response.status === OK) {
          this.$refs.contactForm.reset();
          this.$store.dispatch('alert/success', response.data);
        } else {
          this.$store.dispatch('alert/error', response.data);
        }

        this.contactForm.loading = false;
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
