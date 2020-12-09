<template>
  <div fluid class="index">
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
  </div>
</template>

<script>
import Carousel from '@/components/service/Carousel';

export default {
  components: {
    Carousel,
  },
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.index {
  background-color: $light-gray;
}
</style>
