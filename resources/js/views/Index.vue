<template>
  <v-container fluid pa-0 v-if="!isSmartphone">
    <div id="top">
      <v-row class="pt-6 pb-12">
        <v-spacer></v-spacer>

        <v-col cols="5" justify="center" align-self="center">
          <div>
            <h1 class="text-center text-h4 font-weight-bold">創る、繋がる、好きになる</h1>
            <p class="text-center text-subtitle-1 font-weight-bold">
              プログラミングに取り組むみなさん、こんにちは。<br />
              「実際のプログラミングって大変. . . 」<br />
              「何からしたらいいんだろう」<br />
              そんな悩みとは今日でさようなら。<br />
              プログラミングを楽しみながら継続できる環境がここに生まれました！
            </p>

            <v-row justify="center" class="mt-12">
              <v-btn
                x-large
                text
                color="white"
                class="text-h5 font-weight-bold text-decoration-underline"
                href="https://spark.adobe.com/page/JwVbQbzQtbSkB"
                target="_blank"
              >
                ＞ CLOTOについて詳しく見る
              </v-btn>
            </v-row>

            <v-row justify="center" class="mt-12">
              <v-btn x-large color="primary" class="font-weight-bold" :to="{ name: 'map' }">
                入場
              </v-btn>
            </v-row>
          </div>
        </v-col>

        <v-col cols="5" align-self="center">
          <v-img
            eager
            :src="$storage('system') + 'index.svg'"
            max-width="500"
            contain
            class="mx-auto"
          ></v-img>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>

      <v-divider></v-divider>

      <v-row class="pb-4">
        <v-col sm="4">
          <p class="text-h4 text-right">News</p>
        </v-col>

        <v-col sm="8">
          <v-list color="#f6bf00" width="70%">
            <v-list-item href="https://spark.adobe.com/page/JwVbQbzQtbSkB" target="_blank">
              <v-list-item-icon>
                <v-icon class="white--text">mdi-alpha</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  α版をリリースしました。<small>（2020/02/11）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-item
              href="https://www.innovation-osaka.jp/ja/service/pitch/mirainno"
              target="_blank"
            >
              <v-list-item-icon>
                <v-icon class="white--text">mdi-trophy</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  ミライノピッチ2020にてNICT賞を受賞しました。<small>（2020/02/11）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-item
              href="http://www.ritsumei.ac.jp/research/vc/pastcontest/2020/team.html"
              target="_blank"
            >
              <v-list-item-icon>
                <v-icon class="white--text">mdi-trophy</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  第17回立命館大学学生ベンチャーコンテストにて<br />アクロホールディングス賞・NVCC賞・ASTER賞を受賞しました。
                  <small>（2020/02/11）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-item href="https://u25.billage.space/archive/20200817" target="_blank">
              <v-list-item-icon>
                <v-icon class="white--text">mdi-trophy</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  U-25 kansai pitch contest vol.4にて<br />りそなグループ賞を受賞しました。
                  <small>（2020/02/11）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-col>
      </v-row>
    </div>

    <v-row class="mx-12 my-12">
      <v-col sm="6">
        <v-img :src="$storage('system') + 'toC.png'"></v-img>
      </v-col>

      <v-col sm="6">
        <p class="text-h4 text-center font-weight-bold">
          to <span class="green--text">C</span> 事業
        </p>
        <p class="text-body-1 text-center">
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば
        </p>
      </v-col>
    </v-row>

    <v-divider></v-divider>

    <v-row class="mx-12 my-12">
      <v-col sm="6">
        <v-img :src="$storage('system') + 'toB.png'"></v-img>
      </v-col>

      <v-col sm="6">
        <p class="text-h4 text-center font-weight-bold">
          to <span class="green--text">B</span> 事業
        </p>
        <p class="text-body-1 text-center">
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば<br />
          がんば
        </p>
      </v-col>
    </v-row>

    <p class="text-h4 text-center font-weight-bold">納品先</p>

    <v-row class="mx-12 my-12">
      <v-col sm="6">
        <v-img :src="$storage('system') + 'toB.png'"></v-img>
      </v-col>

      <v-col sm="6">
        <p class="text-h5 text-center font-weight-bold">株式会社LearnMore様</p>
        <p class="text-body-1 text-center">
          あああ<br />
          あああ<br />
          あああ
        </p>
      </v-col>
    </v-row>

    <v-card max-width="600" class="mx-auto my-12 px-12 py-8">
      <h5 class="text-center text-h5">お問い合わせ</h5>

      <v-form ref="contactForm" v-model="contactForm.validation.valid" lazy-validation>
        <v-text-field
          v-model="contactForm.name"
          :rules="contactForm.validation.nameRules"
          :disabled="contactForm.loading"
          label="お名前"
          maxlength="16"
          counter
        ></v-text-field>

        <v-text-field
          v-model="contactForm.email"
          :rules="contactForm.validation.emailRules"
          :disabled="contactForm.loading"
          label="メールアドレス"
        ></v-text-field>

        <v-textarea
          v-model="contactForm.body"
          :rules="contactForm.validation.bodyRules"
          :disabled="contactForm.loading"
          label="お問い合わせ内容"
        ></v-textarea>

        <v-btn
          :loading="contactForm.loading"
          :disabled="!contactForm.validation.valid"
          @click="submit()"
          block
          large
          color="primary"
          class="mt-4 font-weight-bold"
          >送信
        </v-btn>
      </v-form>
    </v-card>
  </v-container>

  <v-container v-else>
    <p class="font-weight-bold">現在スマートフォンには対応しておりません．．．</p>
  </v-container>
</template>

<script>
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
    isSmartphone() {
      if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
        return true;
      } else {
        return false;
      }
    },
  },
  methods: {
    submit: async function () {
      if (this.$refs.contactForm.validate()) {
        this.contactForm.loading = true;

        // 問い合わせ送信処理
        var response = await axios.post('/api/contact', {
          name: this.contactForm.name,
          email: this.contactForm.email,
          body: this.contactForm.body,
        });

        if (response.status === OK) {
          this.$refs.contactForm.reset();
        }

        this.contactForm.loading = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.container {
  background-color: $light-gray;

  #top {
    background-color: $primary;
    color: $white;
  }

  a:hover {
    text-decoration: none;
  }
}
</style>
