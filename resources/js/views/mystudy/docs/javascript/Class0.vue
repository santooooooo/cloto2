<template>
  <v-container class="mt-4" fluid id="content-container">
    <v-row>
      <!-- 目次 -->
      <ContentTable :period="period" :contents="contents" />

      <v-col cols="10">
        <!-- タイトル -->
        <div class="mb-4 pa-4">
          <h1 class="text-h4 text-center mb-12">{{ title }}</h1>
          <p class="text-body-2 mx-6">このコンテンツの説明</p>
        </div>

        <!-- コンテンツ1 -->
        <v-container fluid class="mb-12" id="greeting">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">Greeting</span>
          </h4>

          <p class="mb-8">ようこそCLOTOへ。</p>

<p class="mb-8">この文章をご覧になっているみなさんは、おそらく「プログラミングを学習したい」と思われていることと思います。</p>
<p class="mb-8">さて、この「プログラミングの学習」ですが、目標には何を置くべきでしょうか。<br />
就職？転職？フリーランス？それとも趣味？研究？
ある意味では全て正しいのではないでしょうか。</p>
<p class="mb-8">みなさんそれぞれに、何かの目的があってプログラミング学習を始められたこと思います。<br />
実際に世の中に普及し始めたプログラミング学習支援サービスのほとんどが、<br />
上記のような目標に向かってカリキュラムを組んでいます。</p>
<p class="mb-8">CLOTOもこうした目標を持つ学習者を支援できる環境でありたいと考えています。</p>		
<p class="mb-8">一方でこうも考えます。</p>		
<p class="mb-8 font-weight-bolder">「それはプログラミング学習の目標として最適なのか。」</p>	
<p class="mb-8">プログラミング学習の直接的な目標＝ゴールはエンジニア就職を果たすことでしょうか。<br />転職して収入を上げることでしょうか。研究成果を出すことでしょうか。</p>
<p class="mb-8">もちろん間接的に、プログラミング学習を進めた先に、そのような体験が待っていることは間違いありません。<br />また強い動機になり得るので重要です。</p>
<p class="mb-8">しかしそれはあくまで学習する目的、動機の一つではないでしょうか。<br />
エンジニア転職を成功させることこそがプログラミング学習のゴールと言えるでしょうか。<br />
新卒の見込み採用で、エンジニア就職した人にはプログラミング学習は不要でしょうか。</p>
		
<p class="mb-8">新卒の見込み採用で、エンジニア就職した人にはプログラミング学習は不要でしょうか。 <br />
これはエンジニアに限ったことではありませんが、<br />特にIT業界は技術の変化が速い領域ですのでエンジニア自身にも常に学び続ける姿勢が求められます。
</p>
<p class="mb-8">つまり、プログラミング学習のゴールは、<br />本来的に就職、転職、案件獲得、と言った人生における区切りとは直接関係のないものなのです。</p>
<p class="mb-8">CLOTOはこの「プログラミング学習の目標は何か」という本質的な問いに対する答えとして<br />
<p class="mb-8 font-weight-bolder">「プログラミングを駆使し、新たな価値を創り続けることができるようになること」</p>
<p class="mb-8">というものを提唱します。<br />
何かを「創る」体験を、学習を通じて得る必要があると考えています。</p>

<p class="mb-8">みなさんのプログラミング学習が実りあるものになることを願っています。</p>
        </v-container>

        <!-- コンテンツ2 -->
        <v-container fluid class="mb-12" id="suggest">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">ダミー2</span>
          </h4>

          <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
          <v-row>
            <v-col cols="6">
              <p class="mb-8">ダミー</p>
            </v-col>
            <v-col cols="6">
              <v-img
                max-width="90%"
                max-height="60vh"
                :src="filePath + '1.png'"
                class="mb-10"
              ></v-img>
            </v-col>
          </v-row>

          <h5 class="text-h5 font-weight-bold mb-8">ダミー</h5>
          <v-row>
            <v-col cols="6">
              <p class="mb-8">ダミー</p>
            </v-col>
            <v-col cols="6">
              <v-img
                max-width="90%"
                max-height="60vh"
                :src="filePath + '2.png'"
                class="mb-10"
              ></v-img>
            </v-col>
          </v-row>
        </v-container>

        <!-- コンテンツ3 -->
        <v-container fluid class="mb-12" id="cut">
          <h4 class="text-h4 font-weight-bold text-left-border mb-10">
            <span class="pl-3 grey lighten-3">ダミー3</span>
          </h4>

          <p class="mb-8">ダミー</p>
          <p class="mb-8">ダミー</p>
          <p>ダミー</p>
        </v-container>

        <v-row justify="center">
          <v-btn color="blue" class="text-white" @click="$emit('next')">完了（次へ進む）</v-btn>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: this.title,
      };
    },
  },
  data() {
    return {
      period: 'introduction', // 期間名
      title: 'Class 0', // コンテンツタイトル
      contents: [
        { id: '#greeting', title: '0-0. Greeting', activeStart: 0, activeEnd: 1648 },
        { id: '#suggest', title: '0-1. プログラミングを\n取り巻く環境', activeStart: 1648, activeEnd: 8000 },
        { id: '#cut', title: '0-3. ダミー3', activeStart: 8000, activeEnd: 99999 },
      ], // 目次データ

      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
  mounted(){
    let suggest = document.getElementById('suggest')
    let clientRect = suggest.getBoundingClientRect()

    let y = clientRect.top
    console.log(y);
  }
};
</script>
