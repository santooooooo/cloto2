<template>
  <v-container fluid pa-0 class="index">
    <div class="concept">
      <v-row class="top mt-n12">
        <v-spacer></v-spacer>

        <v-col cols="5" sm="7" align-self="center">
          <h1 class="text-center text-h3 font-weight-bold">創る、繋がる、好きになる</h1>
          <p class="text-center text-subtitle-1 font-weight-bold">
            プログラミングに取り組むみなさん、こんにちは。<br />
            「実際のプログラミングって大変. . . 」<br />
            「何からしたらいいんだろう」<br />
            そんな悩みとは今日でさようなら。<br />
            プログラミングを楽しみながら継続できる環境がここに生まれました！
          </p>

          <v-row justify="center" class="mt-12">
            <v-btn x-large color="primary" class="font-weight-bold">さあはじめよう！</v-btn>
          </v-row>
        </v-col>

        <v-col cols="5" sm="4" class="mr-12" align-self="center">
          <v-img :src="$storage('system') + 'top-logo.svg'" max-width="500" contain></v-img>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>

      <v-row class="scroll">
        <span></span>
      </v-row>

      <v-row class="mx-12 description">
        <v-col class="mt-n12">
          <v-card width="400" class="mx-auto">
            <v-img
              class="mx-auto"
              width="350"
              aspect-ratio="2"
              :src="$storage('system') + 'twitter-card.png'"
            ></v-img>

            <v-card-title>
              <span class="title mx-auto text-h4 font-weight-bold">&nbsp;自習&nbsp;</span>
            </v-card-title>

            <v-card-text class="text-center text-h6 font-weight-bold">
              自宅にいながら、まるで本物の自習室！<br />
              そんな体験に拘りました。
            </v-card-text>
          </v-card>
        </v-col>

        <v-col>
          <v-card width="400" class="mx-auto">
            <v-img
              class="mx-auto"
              width="350"
              aspect-ratio="2"
              :src="$storage('system') + 'twitter-card.png'"
            ></v-img>

            <v-card-title>
              <span class="title mx-auto text-h4 font-weight-bold">&nbsp;休憩&nbsp;</span>
            </v-card-title>

            <v-card-text class="text-center text-h6 font-weight-bold">
              休憩時間も有意義に<br />
              日々頑張る仲間たちと交流しましょう。
            </v-card-text>
          </v-card>
        </v-col>

        <v-col class="mt-12">
          <v-card width="400" class="mx-auto">
            <v-img
              class="mx-auto"
              width="350"
              aspect-ratio="2"
              :src="$storage('system') + 'twitter-card.png'"
            ></v-img>

            <v-card-title>
              <span class="title mx-auto text-h4 font-weight-bold">&nbsp;記録&nbsp;</span>
            </v-card-title>

            <v-card-text class="text-center text-h6 font-weight-bold">
              日々の活動や取り組みは<br />
              記録され、あなたを支えます。
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </div>

    <v-container fluid class="bottom">
      <v-row class="content">
        <v-spacer></v-spacer>

        <v-col cols="4">
          <div class="mx-auto">
            <v-row justify="center">
              <v-icon class="icon">mdi-cloud-circle</v-icon>
            </v-row>
            <h2 class="mt-5 text-center text-h4 font-weight-bold">いつでもどこからでも</h2>
            <p class="mt-8 text-center text-body-1">
              CLOTOはプログラミングで「創る」というあなたの体験を<br />
              より直感的に、創造的で楽しいものにします。<br />
              これら全ての体験がPC一台で、一つのアカウントで。
            </p>
            <v-img
              class="mx-auto mt-12"
              width="350"
              aspect-ratio="2"
              :src="$storage('system') + 'twitter-card.png'"
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
              プログラミングを続ける上で、仲間の存在ほど心強いものはありません。<br />
              そしてプログラミングの醍醐味はなんといっても「創る」こと。<br />
              「創る」楽しみを仲間共有し、プログラミングをもっと好きになる。<br />
              そんな空間を創りたい。それがCLOTOの存在理由。
            </p>
            <v-img
              class="mx-auto mt-12"
              width="350"
              aspect-ratio="2"
              :src="$storage('system') + 'twitter-card.png'"
            ></v-img>
          </div>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>

      <v-container>
        <v-fade-transition mode="out-in">
          <!-- 変化前 -->
          <div class="content" v-if="!hover1" key="0">
            <v-row>
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img
                    width="350"
                    aspect-ratio="2"
                    :src="$storage('system') + 'twitter-card.png'"
                  >
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <p class="text-center text-h6">
                  プログラミング、1人で悩んでいませんか？<br />
                  技術面でもキャリア面でも相談できるって素晴らしい。<br />
                  周りにプログラミング仲間がいない<br />
                  そんなあなた、必見です。
                </p>
              </v-col>
            </v-row>
          </div>

          <!-- 変化後 -->
          <div class="content" v-else key="1">
            <v-row class="my-12">
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img width="350" aspect-ratio="2" :src="$storage('system') + 'sample.png'">
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <h3 class="mb-6 text-center text-h4 font-weight-bold">創ってる 音がする</h3>
                <p class="mt-6 text-center text-h6">
                  自習を開始すれば、自動的に音声チャットが起動<br />
                  隣の仲間がキーボードを叩く音が聞こえてきます。<br />
                  自宅にいながらそこはもう完全な自習室。<br />
                  程よい緊張があなたを集中へ誘います。
                </p>
              </v-col>
            </v-row>

            <v-row class="my-12">
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img width="350" aspect-ratio="2" :src="$storage('system') + 'sample.png'">
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <h3 class="mb-6 text-center text-h4 font-weight-bold">プログラミングでつながる</h3>
                <p class="mt-6 text-center text-h6">
                  集中のためにはメリハリが重要。<br />
                  「疲れてきたな」「煮詰まってきたな」<br />
                  そんな時は休憩室にいきましょう。<br />
                  プログラミングを愛する仲間があなたを待っています。
                </p>
              </v-col>
            </v-row>
          </div>
        </v-fade-transition>

        <v-fade-transition mode="out-in">
          <!-- 変化前 -->
          <div class="content" v-if="!hover2" key="0">
            <v-row>
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img
                    width="350"
                    aspect-ratio="2"
                    :src="$storage('system') + 'twitter-card.png'"
                  >
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <p class="text-center text-h6">
                  「プログラミングは継続が大事」<br />
                  それを理解していても続かない<br />
                  続けたいけど楽しくない。<br />
                  そんなあなた、必見です。
                </p>
              </v-col>
            </v-row>
          </div>

          <!-- 変化後 -->
          <div class="content" v-else key="1">
            <v-row class="my-12">
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img width="350" aspect-ratio="2" :src="$storage('system') + 'sample.png'">
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <h3 class="mb-6 text-center text-h4 font-weight-bold">頑張りを、記録しよう</h3>
                <p class="mt-6 text-center text-h6">
                  日々の活動を記録しないのはもったいない。<br />
                  プログラミングをする中で学んだこと、達成したことは<br />
                  どんどん記録して共有しましょう。<br />
                  日々記録をすることで、あなた自身が見えてくる。<br />
                  他の人からもフィードバックをもらえます。
                </p>
              </v-col>
            </v-row>

            <v-row class="my-12">
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img width="350" aspect-ratio="2" :src="$storage('system') + 'sample.png'">
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <h3 class="mb-6 text-center text-h4 font-weight-bold">記録はあなたの力になる</h3>
                <p class="mt-6 text-center text-h6">
                  あなたの活動記録はデータとなって力強くあなたをサポートします。<br />
                  今後、CLOTOはひとりひとりのデータを元に<br />
                  よりパーソナルな支援ができる環境を構築します。
                </p>
              </v-col>
            </v-row>
          </div>
        </v-fade-transition>

        <v-fade-transition mode="out-in">
          <!-- 変化前 -->
          <div class="content" v-if="!hover3" key="0">
            <v-row>
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img
                    width="350"
                    aspect-ratio="2"
                    :src="$storage('system') + 'twitter-card.png'"
                  >
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <p class="text-center text-h6">
                  もくもく会やハッカソン、勉強会<br />
                  開催されているのは知っているけどなかなか一歩が踏み出せない<br />
                  そんなあなた、必見です。
                </p>
              </v-col>
            </v-row>
          </div>

          <!-- 変化後 -->
          <div class="content" v-else key="1">
            <v-row class="my-12">
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img width="350" aspect-ratio="2" :src="$storage('system') + 'sample.png'">
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <h3 class="mb-6 text-center text-h4 font-weight-bold">競争より、共創しよう</h3>
                <p class="mt-6 text-center text-h6">
                  アイデアや技術を独占する時代はもう終わりです。<br />
                  積極的に学んだこと、創ったものを公開しあうことで<br />
                  お互いに刺激し合う方が有意義とは思いませんか？<br />
                  人のアイデアに触れ人に学ぶ。<br />
                  そこから独創性、創造性が生まれると信じています。
                </p>
              </v-col>
            </v-row>

            <v-row class="my-12">
              <v-col align-self="center">
                <v-card class="mx-auto" width="350">
                  <v-img width="350" aspect-ratio="2" :src="$storage('system') + 'sample.png'">
                  </v-img>
                </v-card>
              </v-col>

              <v-col align-self="center">
                <h3 class="mb-6 text-center text-h4 font-weight-bold">キャリアにもつながる</h3>
                <p class="mt-6 text-center text-h6">
                  あなたの活動は公開され、あなた自身の魅力になります。<br />
                  楽しめば楽しんだ分だけ評価される。<br />
                  そんな環境になることをCLOTOは約束します。
                </p>
              </v-col>
            </v-row>
          </div>
        </v-fade-transition>
      </v-container>
    </v-container>

    <v-row justify="center" class="foot-btn">
      <v-btn x-large color="primary" class="font-weight-bold">さあはじめよう！</v-btn>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      hover1: false,
      hover2: false,
      hover3: false,
    };
  },
  mounted() {
    window.onscroll = () => {
      var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;

      if (scrollTop <= 2000) {
        this.hover1 = false;
        this.hover2 = false;
        this.hover3 = false;
      } else if (2000 < scrollTop && scrollTop <= 2750) {
        this.hover1 = true;
        this.hover2 = false;
        this.hover3 = false;
      } else if (2750 < scrollTop && scrollTop <= 3500) {
        this.hover1 = true;
        this.hover2 = true;
        this.hover3 = false;
      } else if (3500 < scrollTop) {
        this.hover1 = true;
        this.hover2 = true;
        this.hover3 = true;
      }
    };
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.index {
  max-width: 100%;
  background-color: $light-gray;

  .foot-btn {
    padding: 400px;
  }
}

.concept {
  background-color: $primary;
  color: $white;
  position: relative;
  height: 1350px;

  .top {
    height: 900px;
  }

  .description {
    margin-top: 200px;

    .title {
      background: linear-gradient(transparent 70%, #cae6ff 70%);
    }
  }

  &:before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0px 100vw 115px 0;
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
  border-left: 1px solid #fff;
  border-bottom: 1px solid #fff;
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
  margin-top: 100px;

  .content {
    margin-top: 200px;

    .icon {
      color: $primary;
      font-size: 5em;
    }

    h3:first-letter {
      font-size: 1.3em;
      color: $primary;
    }
  }
}
</style>
