<template>
  <div fluid class="index">
    <v-container>
      <v-card max-width="600" class="mx-auto mt-6 mb-12 pa-6">
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

      <v-card max-width="900" class="mx-auto pa-6 question">
        <h4>よくあるご質問</h4>
        <v-treeview :items="questions"></v-treeview>
      </v-card>
    </v-container>
    <v-container> </v-container>
  </div>
</template>

<script>
import Carousel from '@/components/service/Carousel';

export default {
  components: {
    Carousel,
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
      questions: [
        {
          id: 1,
          name: '複数の席に同時に着席することはできますか？',
          children: [{ name: 'できません。他のお客様のご迷惑になります。' }],
        },
        {
          id: 2,
          name: '複数の席に同時に着席することはできますか？',
          children: [{ name: 'できません。他のお客様のご迷惑になります。' }],
        },
        {
          id: 3,
          name: '複数の席に同時に着席することはできますか？',
          children: [{ name: 'できません。他のお客様のご迷惑になります。' }],
        },
      ],
    };
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
        var response = await this.$http.post(this.$endpoint('contact'), input);

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
  background-color: $light-gray;
  .question {
    background-color: white;
  }
}
</style>
