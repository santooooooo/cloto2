<template>
  <v-container fluid id="content">
    <div class="mb-12 pa-4" id="classdesc">
      <h1 class="text-h3 text-center">{{ title }}</h1>
    </div>

    <p>
      Class5ではClass4で学んだ言語ごとの基礎的な文法や仕組みを、<br />
      実際のWebページを利用して体感していきましょう。
    </p>

    <p>
      特にClass5では「模写学習」をしていきます。<br />
      実際に動いているWebページを構成しているソースコードを模写しながら、<br />
      役割や関連性を丁寧に理解していきましょう。
    </p>

    <p>
      Class5の模写学習で理解を深めて、<br />
      次のClass6ではいよいよ簡単なWeb制作をします。<br />
      このClass5で構造や仕組み、基本的な文法で理解できていない箇所は、<br />
      なるべく克服していきましょう。
    </p>

    <p class="font-weight-bolder">
      積極的に調べ学習、質問をしながら、どんどん手を動かしていきましょう!!
    </p>

    <ul class="agenda">
      <li>0-0　Class5</li>
      <li>1-0　模写学習のすゝめ</li>
      <li>1-1　模写学習のルールを決める</li>
      <li>1-2　効果的な模写学習の方法</li>
      <li>2-0　Webブラウザの活用</li>
      <li>2-1　開発者ツール</li>
      <li>2-2　ファイル構造の理解・確認</li>
      <li>3-0　おすすめの模写学習教材</li>
      <li>3-1　Codestep</li>
      <li>3-2　YouTube</li>
      <li>3-3　その他</li>
    </ul>

    <h2 class="text-h4 font-weight-bold">
      <span>模写学習のすゝめ</span>
    </h2>
    <v-container fluid>
      <p>
        Class4の教材学習で言語ごと基礎的な学習が済んだら、<br />
        実際に動いているプログラムのソースコードを模写してみましょう。<br />
        模写学習では参考書学習で学んだ内容が、<br />
        本番環境でどう活きているのかを実際に確認しながら学ぶことができます。
      </p>
      <p>
        模写学習ではヘッダーフッターの作りや、レイアウト。<br />
        興味のある部分の挙動の箇所など、<br />
        目的を持って的を絞って模写することが望ましいです。
      </p>

      <p>
        教材は、実際に動いているWebサービスや、<br />
        模写コーディング用の練習サイトなどを模写するのがいいでしょう。<br />
        最近ではYouTubeなどでも良質なWebサイトの見本がたくさんあるので、<br />
        利用してみるのも良いでしょう。
      </p>

      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>模写学習のルールを決める</span>
    </h2>
    <v-container fluid>
      <p>
        模写学習からは様々なことを学習することができます。<br />
        フォントや文字サイズ、色、デザイン、レイアウト、レスポンシブ、背景画像の配置や見せ方、<br />
        paddingやmargin、アニメーションの付け方、そしてファイル構造など、<br />
        数えきれません。
      </p>

      <p>
        そんな中で全てを忠実に再現することは、<br />
        「模写学習」において重要なことではありません。<br />
        「模写学習」の目標はClass3やClass4で学んできた中でいまいち理解できていない箇所や、<br />
        実際に体感することができなかったWebページとしての全体的な構成や、<br />
        逆に細やかな表現方法を学ぶために行います。
      </p>

      <p>
        模写するために選んだ教材から何をどの程度学ぶかを決めることが重要です。<br />
        「ヘッダー、フッターの作りを学習する」や「気に入った画像の表示方法を再現してみる」と言ったように、<br />
        目的を明らかにして、さらにその中にも深追いや非効率的な学習にならないように、<br />
        ルールを設けることが必要です。<br />
        「多少の違いは気にしない」や「トータルのレイアウトは崩れても構わないので、個々の要素ごとに学びたい箇所だけ正確に模写する」や、<br />
        「テキストのフォントや色、素材は気にせず、レイアウトは完璧に再現する」などです。
      </p>

      <p>
        あるいは、「完全に再現する」というのもまた難しいものなので、<br />
        取り組んでみる価値があるでしょう。<br />
        そういう意味からも、教材とするWebページは複数あるといいでしょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>効果的な模写学習の方法</span>
    </h2>
    <v-container fluid>
      <p>
        模写学習は丁寧に取り組むことが肝心です。<br />
        まず手本とするWebページのHTMLのソースコードを読み解く必要があります。<br />
        次にCSSを見て、さらにファイルの構造を確認し、<br />
        JavaScriptがどのように機能しているか確認してから写し始めましょう。
      </p>
      <p>
        その際に、ただただ写して動作することを確認するだけではあまり意味がありません。<br />
        手本通りに写した後、少し値を変えてみて、どこがどう変化するかを確認してみましょう。<br />
        この一行にどんな意味があるのか。コメントアウトして隠してみたり、<br />
        表示したりして、じっくり確認してみましょう。
      </p>

      <p>
        Webサイトの模写教材、お手本としては、必ずしもあまり高度で複雑なものを選ぶ必要はありません。<br />
        シンプルなページからしっかりと学び取るほうがいいでしょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>Webブラウザの活用</span>
    </h2>
    <v-container fluid>
      <p>
        WebサイトはWebブラウザに表示されるわけですが、<br />
        このWebブラウザにはWebページを表示する以外にも多くの機能があります。<br />
        実際にコーディングしている際にもHTMLファイルをWebブラウザで開くことで、<br />
        ブラウザ上で現在開発できている箇所までをそのまま表示することができます。
      </p>

      <p>
        次に紹介する「開発者ツール」などもその代表的なものの一つで、<br />
        Class5以降では必須のツールになります。<br />
        Webブラウザを使いこなすことで、<br />
        Web制作に必要な多くのことを学ぶことができます。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>開発者ツール</span>
    </h2>
    <v-container fluid>
      <p>
        先ほど紹介したWebブラウザの機能の一つとして、<br />
        「開発者ツール」と呼ばれるものがあります。<br />
        ブラウザごとに、表示方法は多少異なりますが、<br />
        基本的には表示することが可能です。
      </p>

      <p>
        開発者ツールとは何かというと、<br />
        表示されているWebページのソースコードを閲覧、<br />
        一時的に編集できるツールです。<br />
        開発者ツールを開いたまま、各要素に触れていくと、<br />
        Webページ上の対応する箇所が反応し、<br />
        「このコードがここを表現している」というのが一目でわかるものになっています。<br />
        また、そのコードを一時的に書き換えて変更を反映させることもできます。
      </p>

      <p>
        開発者ツールで与えた変更は、実際にページに反映されることはないので、<br />
        安心してどんどん触ってみましょう。Webブラウザも奥が深いですよ。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>ファイル構造の理解・確認</span>
    </h2>
    <v-container fluid>
      <p>
        開発者ツールを開くとソースコードが見れることに加え、<br />
        それらが記述されたファイルが、どのように関連しているのか。<br />
        どのような構造で組み立てられているのかを見ることができます。
      </p>

      <p>
        チュートリアル学習などでは意識することがなかった箇所かと思います。<br />
        非常に勉強になるので模写学習のついでにぜひ確認してみてください。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>おすすめの模写学習教材</span>
    </h2>
    <v-container fluid>
      <p>
        模写学習で使うべき教材は、あまり高度で複雑なものではなく、<br />
        シンプルなものがいいです。<br />
        あるいは真似したい、理解したい機能やレイアウトが含まれているものがいいです。<br />
        「模写学習」を調べれば、模写に最適な教材等が紹介されていますが、<br />
        ここでは特におすすめの模写学習教材について記述します。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>
    <h2 class="text-h4 font-weight-bold">
      <span>Codestep</span>
    </h2>
    <v-container fluid>
      <p>
        CodestepはWebサイト制作の実践力をつけるためのコーディング学習サイトです。<br />
        難易度や学習内容ごとに用意されたデモサイト、そのレイアウトの解説、<br />
        ソースコードの添付の3セットで模写学習を通じてWebサイト制作について学ぶ、<br />
        無料のデジタル教材です。
      </p>

      <p>
        非常にわかりやすく、模写学習で学ぶべきことがしっかりまとまっている教材ですので、<br />
        お勧めしております。<br />

        <a href="https://code-step.com" target="_blank" rel="noopener noreferrer">Codestep</a>
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>YouTube</span>
    </h2>
    <v-container fluid>
      <p>
        YouTubeでWebサイトを作るような動画では、<br />
        ほとんどの場合、投稿者がテキストエディタを画面収録しながら、<br />
        Web制作を進めていくものが多く、模写学習に近い体験を得ることができます。<br />
      </p>
      <p>
        しかし、投稿者ごとによって教材・解説の質がバラバラですので、<br />
        見極める必要はあります。<br />
        また、投稿者自身がうっかり間違えていて、動画の概要欄で訂正していたり、<br />
        解説が正確でない場合がよくありますので、<br />
        最初は高評価やコメント欄を見て取り組んでみましょう。
      </p>

      <p>
        また、YouTubeでは少しでもわかりやすいように投稿者が工夫して、<br />
        素材をあらかじめ用意したり、細かく解説をしてくれるので、<br />
        わかった気分になってしまうことが多いです。<br />
        流れに沿って一周するだけでなく、再現できるか、本当に理解しているか、<br />
        ソースコードを一つ一つ復習することで、さらにもう１段階成長できますので、<br />
        じっくりと丁寧に取り組みましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span>その他</span>
    </h2>
    <v-container fluid>
      <p>
        もちろん一般に自分で見つけたWebサイトを模写しても結構です。<br />
        専用の解説がなく一から読解していく必要があるので、非常に勉強になります。
        ここでは、Webデザインのサンプルサイトをいくつか紹介します。<br />
        気に入ったものや、真似してみたいものを選んで、模写していきましょう。
      </p>

      <p>
        Class6以降学習を進めて、実務に至り、Webサイトを自作していく過程で、<br />
        一つでも多くのデザインパターンを知っていることは武器になります。<br />
        多くのWebサイトを見て、気になったものは模写してみましょう。
      </p>

      <p class="font-weight-bolder">
        <a href="https://io3000.com" target="_blank" rel="noopener noreferrer"> I/O 3000 </a>
      </p>
      <p>
        国内外を問わず、Web制作の参考となるサイトをセレクトしてるWebデザインギャラリーサイトです。<br />
        カテゴリやタグ、色などで絞り込みができます。<br />
        また作成年度ごとに絞り込みができる点が非常に興味深いです。
      </p>

      <p>
        10年前のWebデザインはトップページに文字が多く、<br />
        カラム割りが多いように見えたりと、<br />
        時代の変遷によるWebサイトの流行りを学ぶこともできます。
      </p>

      <p class="font-weight-bolder">
        <a href="https://bookma.torch.blue" target="_blank" rel="noopener noreferrer"> bookma! </a>
      </p>
      <p>
        Webデザインに特化したブックマークサイトです。<br />
        主に日本のWebサイトがブックマークされています。<br />
        色、フォント、雰囲気、さまざまなジャンルのWebサイトが表示されており、<br />
        アイデアの幅を広げるにはもってこいのサイトです。
      </p>
      <p class="font-weight-bolder">
        <a href="https://81-web.com" target="_blank" rel="noopener noreferrer"> 81-web.com </a>
      </p>
      <p>
        日本の優れたWebデザインを集めたギャラリーとリンク集です。<br />
        PC用とスマホ用の二つのデザインに対応しています。<br />
        トップページがたくさん表示されており、<br />
        Web制作においてトップページの第一印象、素材の重要性がよくわかります。
      </p>
      <p class="font-weight-bolder">
        <a href="https://responsive-jp.com" target="_blank" rel="noopener noreferrer">
          Responsive Web Design JP
        </a>
      </p>
      <p>
        日本国内の秀逸なレスポンシブWebデザインのサイトを集めたリンク集です。<br />
        端末やWebブラウザのウィンドウサイズごとに表示を変える<br />
        「レスポンシブデザイン」で秀逸なものが集められています。<br />
        モバイル端末が普及し、「Webブラウジングはスマホで」という人も増えている現在において、<br />
        レスポンシブデザインはWeb制作の工程の中でも重要度を増しています。
      </p>
      <p class="font-weight-bolder">
        <a href="https://www.awwwards.com" target="_blank" rel="noopener noreferrer"> awwwards. </a>
      </p>
      <p>
        英語ベースのWebデザイン集です。<br />
        日本語のものとかなりイメージが変わるので、注意が必要ですが、<br />
        エキセントリックなデザインも多く、構成を学ぶ上では刺激的で面白いかもしれません。<br />
        各国のデザイナーが評価軸ごとに採点しているのも面白いポイントです。<br />
        高評価されているサイトから学ぶことは多いと思うので是非見てみてください。
      </p>
    </v-container>

    <v-row justify="center" class="mb-4">
      <v-btn dark color="primary" @click="$emit('next')">完了（次へ進む）</v-btn>
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
      title: 'Class 5', // コンテンツタイトル
      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>
