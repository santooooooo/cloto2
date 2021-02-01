<template>
  <v-container fluid pa-0 class="index" v-if="!isSmartphone">
    <v-container fluid class="concept">
      <v-row>
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
            :src="$storage('system') + 'top.svg'"
            max-width="500"
            contain
            class="mx-auto"
          ></v-img>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>
    </v-container>

    <div class="scroll">
      <span></span>
    </div>

    <v-container fluid class="bottom">
      <v-row class="mx-12">
        <v-col class="mt-n12">
          <v-card width="400" class="mx-auto">
            <v-img
              eager
              class="mx-auto"
              width="400"
              :src="$storage('system') + 'study.svg'"
            ></v-img>

            <v-card-title>
              <span class="title mx-auto text-h4 font-weight-bold">&nbsp;自習&nbsp;</span>
            </v-card-title>

            <v-card-text class="text-center text-h6 font-weight-bold">
              自宅にいながら、まるで本物の自習室！そんな体験に拘りました。
            </v-card-text>
          </v-card>
        </v-col>

        <v-col>
          <v-card width="400" class="mx-auto">
            <v-img
              eager
              class="mx-auto"
              width="400"
              :src="$storage('system') + 'break.svg'"
            ></v-img>

            <v-card-title>
              <span class="title mx-auto text-h4 font-weight-bold">&nbsp;休憩&nbsp;</span>
            </v-card-title>

            <v-card-text class="text-center text-h6 font-weight-bold">
              休憩時間も有意義に。日々頑張る仲間たちと交流しましょう。
            </v-card-text>
          </v-card>
        </v-col>

        <v-col class="mt-12">
          <v-card width="400" class="mx-auto">
            <v-img
              eager
              class="mx-auto"
              width="400"
              :src="$storage('system') + 'record.svg'"
            ></v-img>

            <v-card-title>
              <span class="title mx-auto text-h4 font-weight-bold">&nbsp;記録&nbsp;</span>
            </v-card-title>

            <v-card-text class="text-center text-h6 font-weight-bold">
              日々の活動や取り組みは記録され、あなたを支えます。
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>

      <v-row class="content">
        <v-spacer></v-spacer>

        <v-col cols="4">
          <div class="mx-auto">
            <v-row justify="center">
              <v-icon class="icon">mdi-cloud-circle</v-icon>
            </v-row>
            <h2 class="mt-5 text-center text-h4 font-weight-bold">いつでもどこでも</h2>
            <p class="mt-5 text-center text-body-1">
              CLOTOはプログラミングで「創る」を<br />
              より直感的に、創造的で楽しいものにします。<br />
              これら全ての体験がPC一台で、一つのアカウントで。
            </p>
            <v-img
              eager
              class="mx-auto mt-12"
              width="500"
              :src="$storage('system') + 'everywhere.svg'"
            ></v-img>
          </div>
        </v-col>

        <v-col cols="4">
          <div class="mx-auto">
            <v-row justify="center">
              <v-icon class="icon">mdi-account-multiple</v-icon>
            </v-row>
            <h2 class="mt-5 text-center text-h4 font-weight-bold">みんなが創ってる</h2>
            <p class="mt-5 text-center text-body-1">
              仲間の存在ほど心強いものはありません。<br />
              「創る」楽しみを仲間と共有し、もっと好きになる。<br />
              そんな空間を創りたい。それがCLOTOの存在理由。
            </p>
            <v-img
              eager
              class="mx-auto mt-12"
              width="500"
              :src="$storage('system') + 'everyone.svg'"
            ></v-img>
          </div>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>

      <v-card max-width="600" class="mx-auto my-12 pa-6">
        <v-container>
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
        </v-container>
      </v-card>
    </v-container>
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

.index {
  max-width: 100%;
  background-color: $light-gray;

  a:hover {
    text-decoration: none;
  }

  .concept {
    max-width: 100%;
    height: 1500px;
    padding-top: 10vh;
    background-color: $primary;
    color: $white;
    position: relative;

    &:before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 0px 100vw 180px 0;
      border-color: transparent transparent $light-gray transparent;
    }
  }

  // 下矢印
  .scroll span {
    position: absolute;
    top: 800px;
    left: 50%;
    width: 24px;
    height: 24px;
    margin-left: -12px;
    border-left: 1px solid #ffffff;
    border-bottom: 1px solid #ffffff;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    -webkit-animation: sdb 2s infinite;
    animation: sdb 2s infinite;
    box-sizing: border-box;
  }
  @-webkit-keyframes sdb {
    0% {
      -webkit-transform: rotate(-45deg) translate(0, 0);
    }
    20% {
      -webkit-transform: rotate(-45deg) translate(-10px, 10px);
    }
    40% {
      -webkit-transform: rotate(-45deg) translate(0, 0);
    }
  }
  @keyframes sdb {
    0% {
      transform: rotate(-45deg) translate(0, 0);
    }
    20% {
      transform: rotate(-45deg) translate(-10px, 10px);
    }
    40% {
      transform: rotate(-45deg) translate(0, 0);
    }
  }

  .bottom {
    max-width: 100%;
    background-color: $light-gray;
    margin-top: -300px;

    .title {
      background: linear-gradient(transparent 70%, #cae6ff 70%);
    }

    .content {
      margin-top: 200px;
    }

    .icon {
      color: $primary;
      font-size: 5em;
    }

    .arrow-bottom {
      display: inline-block;
      width: 18px;
      height: 18px;
      margin: 100px auto;
      border-bottom: 4px solid $black;
      border-right: 4px solid $black;
      transform: rotate(45deg);
    }
  }
}
</style>
