<template>
  <v-container fluid pa-0>
    <div id="top">
      <v-row no-gutters class="pt-6 pb-12" v-if="!isSmartphone">
        <v-spacer></v-spacer>

        <v-col cols="5" justify="center" align-self="center">
          <div class="mt-8">
            <h1 class="text-left text-h4 font-weight-bold fade-down" id="cloto-title">
              創る、繋がる、好きになる
            </h1>
            <p class="text-left text-subtitle-1 font-weight-bold fade-in-left" id="cloto-text">
              プログラミングに取り組むみなさん、こんにちは。<br />
              「実際のプログラミングって大変. . . 」<br />
              「何からしたらいいんだろう」<br />
              そんな悩みとは今日でさようなら。<br />
              プログラミングを楽しみながら継続できる環境がここに生まれました！
            </p>

            <v-row no-gutters justify="center" class="mt-12">
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

            <v-row no-gutters justify="center" class="mt-12">
              <v-btn x-large color="primary" class="font-weight-bold" :to="{ name: 'login' }">
                ログイン
              </v-btn>
            </v-row>
          </div>
        </v-col>

        <v-col cols="5" align-self="center">
          <v-img
            :src="$storage('system') + 'index.svg'"
            max-width="500"
            contain
            class="mx-auto"
          ></v-img>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>

      <div class="pt-6 pb-12 px-6" v-else>
        <v-img
          :src="$storage('system') + 'index.svg'"
          max-width="500"
          contain
          class="mx-auto"
        ></v-img>

        <div class="mt-8">
          <h1 class="text-center font-weight-bold text-h5 fade-down" id="cloto-title">
            創る、繋がる、好きになる
          </h1>
          <p class="text-center text-subtitle-1 font-weight-bold fade-in-left" id="cloto-text">
            プログラミングに取り組むみなさん、こんにちは。<br />
            「実際のプログラミングって大変. . . 」<br />
            「何からしたらいいんだろう」<br />
            そんな悩みとは今日でさようなら。<br />
            プログラミングを楽しみながら継続できる環境がここに生まれました！
          </p>

          <v-row no-gutters justify="center" class="mt-12">
            <v-btn
              x-large
              color="primary"
              class="font-weight-bold"
              href="https://spark.adobe.com/page/JwVbQbzQtbSkB"
              target="_blank"
            >
              詳しく見る
            </v-btn>
          </v-row>

          <v-row
            no-gutters
            justify="center"
            class="mt-12 text-center text-subtitle-1 font-weight-bold"
          >
            本製品は現在スマートフォンには対応しておりません。PCからご利用ください。
          </v-row>
        </div>
      </div>

      <v-divider></v-divider>

      <v-row no-gutters class="pb-4">
        <v-col sm="4">
          <p :class="['text-h4', isSmartphone ? 'text-center' : 'text-right']">News</p>
        </v-col>

        <v-col sm="8">
          <v-list color="#f6bf00" :width="isSmartphone ? '100%' : '70%'">
            <v-list-item href="https://spark.adobe.com/page/2c4jjsCRpBaLJ" target="_blank">
              <v-list-item-icon>
                <v-icon class="white--text">mdi-information</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  メール誤送信による個人情報漏洩についてのお詫び<small>（2020/03/19）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-item
              href="https://kansai-students-pitch-grand-prix-2021.peatix.com"
              target="_blank"
            >
              <v-list-item-icon>
                <v-icon class="white--text">mdi-sword</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  KANSAI STUDENTS PITCH Grand Prix 2021に出場しました。<small>（2020/03/06）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-item
              href="https://waseda-edge.jp/event_detail_2020?id=20210217"
              target="_blank"
            >
              <v-list-item-icon>
                <v-icon class="white--text">mdi-trophy</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  第3回 WASEDA Demo DayにてSAP賞を受賞しました。<small>（2020/02/17）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>

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
              href="https://www.innovation-osaka.jp/ja/event-report/event-report-8898"
              target="_blank"
            >
              <v-list-item-icon>
                <v-icon class="white--text">mdi-trophy</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="white--text">
                  ミライノピッチ2020にてNICT賞を受賞しました。<small>（2020/12/12）</small>
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
                  <small>（2020/12/06）</small>
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
                  <small>（2020/08/17）</small>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-col>
      </v-row>
    </div>

    <v-row no-gutters justify="center" class="mx-12 py-12">
      <v-col sm="6" class="mr-4 my-12">
        <v-img :src="$storage('system') + 'toC.png'"></v-img>
      </v-col>

      <v-col sm="4" class="ml-4 my-12">
        <p class="text-h4 text-center font-weight-bold" id="to-c">
          to <span class="green--text">C</span> 事業
        </p>

        <div id="to-c-text">
          <p class="text-h6 text-left font-weight-bolder">
            プログラミング学習って、<br />思ってたより大変、、、
          </p>
          <p class="text-body-1 text-left mb-6">
            そう思って挫折したことはありませんか？<br />学習を諦めてしまったことはありませんか？
          </p>
          <p class="text-body-1 text-left mb-6">
            その経験、あなただけのものではないのです。<br />実はエンジニアを志すほとんど全ての人が、その経験を経て、なんとかして乗り越えて実力を身につけています。
          </p>
          <p class="text-body-1 text-left mb-6">
            CLOTOはこの困難を乗り越えるためのエッセンスをサービスに落とし込んでいます。
          </p>
          <p class="text-body-1 text-left">
            CLOTOを利用することで、「集中できる学習環境」と「切磋琢磨できる学習仲間」を得ることができ、それが「楽しく学習を継続できる環境」となり、あなたの学習を支えます。
          </p>
        </div>
      </v-col>
    </v-row>

    <v-divider></v-divider>

    <v-row no-gutters justify="center" class="mx-12 py-12">
      <v-col sm="6" class="mr-4 my-12">
        <v-img :src="$storage('system') + 'toB.png'"></v-img>
      </v-col>

      <v-col sm="4" class="ml-4 my-12">
        <p class="text-h4 text-center font-weight-bold" id="to-b">
          to <span style="color: #ff99ab">B</span> 事業
        </p>

        <div id="to-b-text">
          <p class="text-body-1 text-left font-weight-bold red--text">
            ※量産体制が整っていないため、新規受注を休止しています。
          </p>

          <p class="text-h6 text-left font-weight-bolder">
            DX化に興味はあるけど、<br />どこが便利になるの？
          </p>
          <p class="text-body-1 text-left mb-6">
            CLOTOは貴社が必要とする機能を盛り込むことができる
            <span class="font-weight-bold red--text">バーチャルテナント</span>です。
          </p>

          <p class="text-body-1 text-left">以下のような機能を搭載可能です。</p>
          <v-row no-gutters justify="start">
            <ul>
              <li>個人デスク</li>
              <li>会議室</li>
              <li>休憩室</li>
              <li>イベントホール</li>
              <li>日報</li>
            </ul>
          </v-row>
          <p class="text-body-1 text-left mb-6">など．．．．</p>

          <p class="text-body-1 text-left mb-6">
            必要な機能がございましたら、<br />一度
            <a class="font-weight-bold blue--text" v-scroll-to="{ el: '#contact' }">
              お問い合わせ
            </a>
            ください。
          </p>
        </div>
      </v-col>
    </v-row>

    <p class="text-h4 text-center font-weight-bold">
      <span style="background: linear-gradient(transparent 70%, #ff99ab 70%)">導入事例</span>
    </p>

    <v-row no-gutters justify="center" class="mx-12">
      <v-col sm="6" class="mr-4 my-12">
        <v-img :src="$storage('system') + 'learnmore.png'"></v-img>
      </v-col>

      <v-col sm="4" class="ml-4 my-12" id="company-example">
        <p class="text-h5 text-center font-weight-bold">
          <a
            href="https://www.learn-more.co.jp"
            target="_blank"
            class="black--text"
            rel="noopener noreferrer"
          >
            株式会社LearnMore様 <v-icon class="text-body-1">mdi-open-in-new</v-icon>
          </a>
        </p>

        <p class="text-h6 text-center">学習塾の運営</p>
        <p class="text-body-1 text-left mb-6">
          オンラインで受けられる個人・少人数授業で、講師は全員教育大学を卒業しておりネットがつながる場所であれば学習塾に通わずに授業が受けられることが特徴の<a
            href="https://subjuku.wixsite.com/subjuku"
            target="_blank"
            rel="noopener noreferrer"
            >サブ塾</a
          >の運営にご利用されています。
        </p>
        <p class="text-body-1 text-left mb-6">
          一人ひとりに合ったコンテンツを作成しアニメーションやPowerPointを用いて授業を行うため、分かりやすいだけでなく面白いと感じながら学べるのが強みです。1対1や友達と一緒にも授業に参加できます。
        </p>

        <p class="text-body-1 text-left">カスタム例</p>
        <v-row no-gutters justify="start">
          <ul>
            <li>グループ学習室</li>
            <li>カルテ内容の変更</li>
            <li>ファイルのアップロード機能</li>
            <li>入退室時のメール通知</li>
          </ul>
        </v-row>
        <p class="text-body-1 text-left">など．．．．</p>
      </v-col>
    </v-row>

    <v-divider></v-divider>

    <div class="my-12 py-12">
      <p class="text-h4 text-center font-weight-bold">メンバー</p>

      <v-row no-gutters justify="space-around" class="mx-12 my-8">
        <v-col md="3" xl="3">
          <v-card max-height="600" width="400" class="mx-auto my-4" id="profile-1">
            <v-img
              contain
              :src="$storage('system') + 'tachibana.jpg'"
              class="white--text align-end"
            >
              <div class="profile">
                <h5 class="text-h5">立花 慶人 <small>@y0sh1z0</small></h5>
              </div>
            </v-img>

            <v-card-actions>
              <v-row no-gutters justify="space-around">
                <v-btn
                  icon
                  x-large
                  color="#3b5998"
                  href="https://www.facebook.com/y0sh1z0415"
                  target="_blank"
                >
                  <v-icon>mdi-facebook</v-icon>
                </v-btn>

                <v-btn
                  icon
                  x-large
                  color="#1da1f2"
                  href="https://twitter.com/y0_sh1z0_CLOTO"
                  target="_blank"
                >
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>

                <v-btn
                  icon
                  x-large
                  color="#262626"
                  href="https://www.instagram.com/y0_sh1z0"
                  target="_blank"
                >
                  <v-icon>mdi-instagram</v-icon>
                </v-btn>

                <v-btn icon x-large color="#000000" disabled target="_blank">
                  <v-icon>mdi-github</v-icon>
                </v-btn>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>

        <v-col md="3" xl="3">
          <v-card max-height="600" width="400" class="mx-auto my-4" id="profile-2">
            <v-img contain :src="$storage('system') + 'fujii.jpg'" class="white--text align-end">
              <div class="profile">
                <h5 class="text-h5">藤井 敦寛 <small>@a2h1r0</small></h5>
              </div>
            </v-img>

            <v-card-actions>
              <v-row no-gutters justify="space-around">
                <v-btn
                  icon
                  x-large
                  color="#3b5998"
                  href="https://www.facebook.com/a2h1r0"
                  target="_blank"
                >
                  <v-icon>mdi-facebook</v-icon>
                </v-btn>

                <v-btn
                  icon
                  x-large
                  color="#1da1f2"
                  href="https://twitter.com/_a2h1r0"
                  target="_blank"
                >
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>

                <v-btn icon x-large color="#262626" disabled target="_blank">
                  <v-icon>mdi-instagram</v-icon>
                </v-btn>

                <v-btn
                  icon
                  x-large
                  color="#000000"
                  href="https://github.com/a2h1r0"
                  target="_blank"
                >
                  <v-icon>mdi-github</v-icon>
                </v-btn>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>

        <v-col md="3" xl="3">
          <v-card max-height="600" width="400" class="mx-auto my-4" id="profile-3">
            <v-img contain :src="$storage('system') + 'santo.jpg'" class="white--text align-end">
              <div class="profile">
                <h5 class="text-h5">山藤 駿亮 <small>@santo</small></h5>
              </div>
            </v-img>

            <v-card-actions>
              <v-row no-gutters justify="space-around">
                <v-btn icon x-large color="#3b5998" disabled target="_blank">
                  <v-icon>mdi-facebook</v-icon>
                </v-btn>

                <v-btn
                  icon
                  x-large
                  color="#1da1f2"
                  href="https://twitter.com/SAshunchan"
                  target="_blank"
                >
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>

                <v-btn icon x-large color="#262626" disabled target="_blank">
                  <v-icon>mdi-instagram</v-icon>
                </v-btn>

                <v-btn
                  icon
                  x-large
                  color="#000000"
                  href="https://github.com/santooooooo"
                  target="_blank"
                >
                  <v-icon>mdi-github</v-icon>
                </v-btn>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>

        <v-col md="3" xl="3">
          <v-card max-height="600" width="400" class="mx-auto my-4" id="profile-4">
            <v-img contain :src="$storage('system') + 'takeda.jpg'" class="white--text align-end">
              <div class="profile">
                <h5 class="text-h5">武田 和樹 <small>@tkknot</small></h5>
              </div>
            </v-img>

            <v-card-actions>
              <v-row no-gutters justify="space-around">
                <v-btn icon x-large color="#3b5998" disabled target="_blank">
                  <v-icon>mdi-facebook</v-icon>
                </v-btn>

                <v-btn icon x-large color="#1da1f2" disabled target="_blank">
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>

                <v-btn icon x-large color="#262626" disabled target="_blank">
                  <v-icon>mdi-instagram</v-icon>
                </v-btn>

                <v-btn icon x-large color="#000000" disabled target="_blank">
                  <v-icon>mdi-github</v-icon>
                </v-btn>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </div>

    <v-divider></v-divider>

    <div class="py-12">
      <p class="text-h4 text-center font-weight-bold">公式SNS</p>

      <v-row no-gutters justify="center">
        <v-btn
          icon
          x-large
          color="#1DA1F2"
          href="https://twitter.com/cloto_jp"
          target="_blank"
          class="mx-4"
        >
          <v-icon>mdi-twitter</v-icon>
        </v-btn>

        <v-btn
          icon
          x-large
          color="#262626"
          href="https://www.instagram.com/cloto.jp"
          target="_blank"
          class="mx-4"
        >
          <v-icon>mdi-instagram</v-icon>
        </v-btn>
      </v-row>

      <v-card max-width="600" class="mx-auto my-12 px-12 py-8" id="contact">
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
    </div>
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
    /**
     * アニメーションの設定
     */
    setupAnimations: function () {
      // スクロールした際の縦座標を取得
      const scrollY = window.scrollY;

      if (scrollY >= 800) {
        document.getElementById('to-c').classList.add('fade-down');
        document.getElementById('to-c-text').classList.add('fade-up');
      }
      if (scrollY >= 1500) {
        document.getElementById('to-b').classList.add('fade-down');
        document.getElementById('to-b-text').classList.add('fade-up');
      }
      if (scrollY >= 1850) {
        document.getElementById('company-example').classList.add('fade-in-right');
      }
      if (scrollY >= 2800) {
        document.getElementById('profile-1').classList.add('fade-up');
        document.getElementById('profile-2').classList.add('fade-up2');
        document.getElementById('profile-3').classList.add('fade-up3');
        document.getElementById('profile-4').classList.add('fade-up4');
      }
      if (scrollY >= 3800) {
        document.getElementById('contact').classList.add('open-width');
      }
    },

    /**
     * 問い合わせメールの送信
     */
    submit: async function () {
      if (this.$refs.contactForm.validate()) {
        this.contactForm.loading = true;

        // 問い合わせ送信処理
        let response = await axios.post('/api/contact', {
          name: this.contactForm.name,
          email: this.contactForm.email,
          body: this.contactForm.body,
        });

        if (response.status === OK) {
          // Slack通知
          this.$slack(
            '問い合わせメールBot',
            ':incoming_envelope:',
            this.contactForm.name + '様が問い合わせメールを送信しました。'
          );

          this.$refs.contactForm.reset();
        }

        this.contactForm.loading = false;
      }
    },
  },

  created() {
    window.addEventListener('scroll', this.setupAnimations);
  },

  beforeDestroy() {
    window.removeEventListener('scroll', this.setupAnimations);
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';
@import '~/_animations';

.container {
  background-color: $white;

  #top {
    background-color: $primary;
    color: $white;
  }

  a:hover {
    text-decoration: none;
  }

  .profile {
    line-height: 2rem;
    padding: 16px;
    background-color: #000000;

    h5 {
      margin: 0;

      small {
        font-size: 0.6em;
      }
    }
  }

  // animation動作前の表示を隠す
  #cloto-title,
  #cloto-text,
  #to-c,
  #to-c-text,
  #to-b,
  #to-b-text,
  #company-example,
  #profile-1,
  #profile-2,
  #profile-3,
  #profile-4,
  #contact {
    opacity: 0;
  }

  // animation: name duration timing-function delay directon iteration-count fill-mode
  .fade-down {
    animation: fadeDown 2s ease-out 0.5s normal 1 forwards;
  }

  .fade-up {
    animation: fadeUp 2s ease-out 0.5s normal 1 forwards;
  }

  .fade-up2 {
    animation: fadeUp 2s ease 0.8s normal 1 forwards;
  }

  .fade-up3 {
    animation: fadeUp 2s ease 1.1s normal 1 forwards;
  }

  .fade-up4 {
    animation: fadeUp 2s ease 1.4s normal 1 forwards;
  }

  .fade-in-left {
    animation: fadeInLeft 2s ease-in-out 2s normal 1 forwards;
  }

  .fade-in-right {
    animation: fadeInRight 2s linear 0s normal 1 forwards;
  }

  .open-width {
    animation: openWidth 2s ease-in-out 0s normal 1 forwards;
  }
}
</style>
