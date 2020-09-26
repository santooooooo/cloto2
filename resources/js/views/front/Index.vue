<template>
  <v-container fluid pa-0>
    <div class="top">
      <v-row class="concept">
        <v-spacer></v-spacer>

        <v-col cols="5" align-self="center" class="mt-n12">
          <v-row justify="center" class="my-12">
            <v-btn x-large color="primary" class="font-weight-bold">さあはじめよう！</v-btn>
          </v-row>

          <h1 class="text-center text-h1 font-weight-bold">CLOTO</h1>
          <p class="text-center text-subtitle-1 font-weight-bold">
            「チュートリアル学習も終わり、いよいよ腕試し！！」<br />
            そんな駆け出しエンジニアのみなさん、朗報です！<br />
            「実際のプログラミングって大変．．．」<br />
            「何からしたらいいんだろう」<br />
            そんな悩みとは今日でさようなら。<br />
            プログラミングを楽しみながら継続できる環境がここに生まれました！
          </p>
        </v-col>

        <v-col cols="5" class="mr-12">
          <v-img :src="$storage('system') + 'top-logo.svg'" contain></v-img>
        </v-col>
      </v-row>

      <v-row class="scroll">
        <a href="#"></a>
      </v-row>

      <h3 class="mt-12 text-center text-h3 font-weight-bold">これはなに？</h3>
      <v-row>
        <v-spacer></v-spacer>

        <v-col cols="4">
          <v-hover v-slot:default="{ hover }">
            <v-card :elevation="hover ? 16 : 2" class="mx-auto" max-width="350">
              <v-card-text class="font-weight-medium mt-12 text-center text-h4 font-weight-bold">
                施設
              </v-card-text>

              <v-img
                class="white--text align-end"
                height="200px"
                :src="$storage('system') + 'classroom.png'"
              ></v-img>

              <v-card-text class="font-weight-medium mt-12 text-center subtitle-1 font-weight-bold">
                現実より集中できちゃう仮想自習室！
              </v-card-text>
            </v-card>
          </v-hover>
        </v-col>

        <v-col cols="4">
          <v-hover v-slot:default="{ hover }">
            <v-card :elevation="hover ? 16 : 2" class="mx-auto" max-width="350">
              <v-card-text class="font-weight-medium mt-12 text-center text-h4 font-weight-bold">
                記録
              </v-card-text>

              <v-img
                class="white--text align-end"
                height="200px"
                :src="$storage('system') + 'note.png'"
              ></v-img>

              <v-card-text class="font-weight-medium mt-12 text-center subtitle-1 font-weight-bold">
                自分の成長が記録に！
              </v-card-text>
            </v-card>
          </v-hover>
        </v-col>

        <v-spacer></v-spacer>
      </v-row>
    </div>
  </v-container>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
@import '~/_variables';

// fluidが動作しないので上書き
.container--fluid {
  max-width: 100%;
}

.top {
  height: 1500px;
  background-color: $primary;
  color: $white;

  .concept {
    height: 900px;
  }

  // 下矢印
  .scroll a {
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
}
</style>
