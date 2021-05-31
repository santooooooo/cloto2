<template>
  <v-container fluid id="content">
    <div class="mb-4 pa-4" id="classdesc">
      <h1 class="text-h4 text-center mb-12">{{ title }}</h1>
    </div>

    <p>
      Class6ではお題に沿っていよいよ初制作を行なっていきます。<br />
      まずは真似ることから始めても構いません。<br />
      他の学習者の作品を見たり、インターネットから探したりして発想を得ましょう。
    </p>

    <ul class="agenda">
      <li>0-0　Class6</li>
      <li>1-0　初制作のすゝめ</li>
      <li>2-0　「自己紹介HP」を創る</li>
      <li>2-1　「自己紹介HP」制作における必須項目</li>
      <li>2-2　テーマを決める</li>
      <li>2-3　ページ構成を考える</li>
      2-4　ページごとに載せる情報を考える

      <li>2-5　各ページの雰囲気を考える</li>
      <li>2-6　配置などを手書きする</li>
      <li>2-7　素材を用意する</li>
      <li>2-8　コーディングする</li>
      <li>3-0　フレームワーク利用のすゝめ</li>
      <li>4-0　Webページ公開のすゝめ</li>
      <li>4-1　GitHub Pages</li>
    </ul>

    <v-container fluid class="mb-12" id="begin">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">初制作のすゝめ</span>
      </h2>
      <p>
        いよいよ１から全ての制作フローを経て、一つのWebサイトを作る段階に来ました。<br />
        [プログラミングで「伝える」コース]という名の通り、<br />
        Web制作は「伝えたいこと」をインターネットを通じて伝えるための手段です。<br />
        ここを再度押さえておきましょう。
      </p>

      <p>
        この事実からどのようなことがわかるかというと、<br />
        Web制作で一番重要なことはコーディングではないということです。
      </p>

      <p>
        元も子もない話のような気がしますがそういうわけではありません。<br />
        もちろんコーディングも重要です。<br />
        Class3以降実際にHTMLやCSS、JavaScriptやフレームワークについて学習してきましたが、<br />
        それらは「伝えたいこと」を効果的に表現するための具体的手法なのです。
      </p>

      <p></p>
      Web制作では実際にコードを書き始める前に、 伝えたいことは何か どのように表現し、伝えるか
      デザインはどうするのか イラストや写真、動画などは何を使うか どのようなWebサイトにするのか
      を決める必要があります。この見通しが全て立ったらやっとコーディングです。どんなに簡単に思える制作目標であっても、間違ってもコーディングありきで、突然始めるようなことは実践的ではないのでやめましょう。
      実務でのWeb制作の現場でも、依頼主が何を伝えようとしているのか、綿密に打ち合わせをすることから始めます。伝えたいこと、キャッチコピー、素材、サイトの雰囲気、操作性、外部との繋がり。あるいはここに分析ツールを埋め込んで閲覧行動の分析を可能にしたり、お問い合わせフォームを入れるなどのニーズにも答えていく必要があります。この仕様をしっかりと確定させることこそがWeb制作で一番重要なことです。ここに価値があるのです。コーディングするだけでは、全ての指示がないと制作できない状態になってしまいます。
      トータルでWeb制作を行える力を身につけていきましょう。
      CLOTOには言語ごとにコミュニティという自習室が設けられています。Class6以降はこれまで以上に積極的に、コミュニティを利用しましょう。検索してもわからないことはコミュニティのチャット欄で質問してみましょう。タイムラインに流してもいいでしょう。これまで以上に調べること、すぐアウトプットしていくことが重要です。逆に質問されたら、いいアウトプット機会と捉えて回答してあげましょう。もし、質問が分からなければこそっと調べることで自分のインプット学習にもなります。
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="intro-hp">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> 「自己紹介HP」を創る </span>
      </h2>

      <p>
        Class6では一律に「自己紹介」のWebページを創ってみましょう。<br />
        チュートリアル学習、参考書学習、模写学習で学んだことを活かしながら、<br />
        自分を表現しましょう。
      </p>

      <p>
        今回の伝えたいことは「あなた自身について」です。<br />
        あなたの特徴、良いところを余すことなく伝えましょう。<br />
        表現方法は自由です。<br />
        Class5で見てきたWebデザイン集から着想を得ることも重要でしょう。<br />
        当然本名である必要もありません。<br />
        ハンドルネームで構いませんし、情報が全て真実である必要もありません。
      </p>

      <p>
        このコースに取り組む学習者がこの「自己紹介」ホームページ制作に取り掛かります。<br />
        是非素敵なWebページに仕上げてください。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="need">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">「自己紹介」HP制作における必須項目</span>
      </h2>

      <p>必須項目は以下の通りです。</p>

      <ul>
        <li>プロフィール写真</li>
        <li>名前（ハンドルネーム可能）</li>
        <li>SNSリンク</li>
        <li>ヘッダー・ボディ・フッターからなるページを2ページ以上</li>
        <li>ボタン 二種類以上のフォント</li>
        <li>JavaScriptを用いた「お問い合わせフォーム」</li>
      </ul>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="theme">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> テーマを決める </span>
      </h2>
    </v-container>

    <p>
      まずテーマを定めましょう。<br />
      もちろん今回のテーマは「自己紹介」なのですが、<br />
      より細かく決めていきましょう。
    </p>

    <p>
      自分のどんな点をピックアップして伝えるのか。
      例えば「明るくてアウトドアが大好きな自分」なのか。
      「クールでインテリジェンスな雰囲気を醸し出す自分」なのか。 「趣味に全てを捧げる自分」なのか。
    </p>

    <p>
      まずはこのように一連の制作活動全てに関わる根幹となるテーマをしっかりと言語化しましょう。<br />
      Webページは基本的に、固定されており、また視覚情報に頼られます。<br />
      日常会話以上に論理的で、主張が一貫されている必要があります。<br />
      しっかりと最初に言語化しておきましょう。
    </p>

    <p>
      「旅行が大好きな大学生の青年」と「起業家として新しい価値を問う30歳の男性」では、<br />
      Webページでの表現の仕方はまるで違うはずです。<br />
      自分という人間を、どのような人間と捉え、どう伝えていくか。<br />
      じっくりと考えてみましょう。
    </p>
    <v-row justify="center" class="mt-10">
      <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
    </v-row>

    <v-container fluid class="mb-12" id="pages">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">ページ構成を考える</span>
      </h2>

      <p>
        「伝えたいこと」であるテーマを決めることができれば、<br />
        次は実際にページ構成を考えていきましょう。<br />
        ページは何枚用意して、それぞれのページにどのようなメッセージを持たせるのか。<br />
        ページ毎の概要を定めていきましょう。
      </p>

      <p>
        特別なツールを使う必要は全くありません。裏紙やノートと鉛筆があれば十分。<br />
        先ほど考えたテーマを念頭に、要素を分解していきましょう。<br />
        ホームページはどうするか。<br />
        ホームの他にはどのような情報を載せるページを作りましょうか。<br />
        日々の活動報告、趣味、経歴などなど。<br />
        Class6では２〜３ページ程度作りましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="info">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">ページごとに載せる情報を考える</span>
      </h2>

      <p>
        ページ割りが決まれば、次はページごとに載せる情報を考えていきましょう。<br />
        全てを載せることはナンセンスです。 1ページでテーマは一つに絞りましょう。<br />
        読み進めるにしたがって次から次へと違う内容が出てくると、<br />
        非常に読みにくいサイトになります。
      </p>

      <p>
        「伝えたいこと」もブレてしまい、支離滅裂な文章、構成になってしまうので気をつけましょう。<br />
        こちらも紙と鉛筆を持って、ページごとに書きたいことの概要をメモしましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="atmosphere">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> 各ページの雰囲気を考える </span>
      </h2>

      <p>
        各ページごとにテーマからブレない程度に雰囲気をつけていきましょう。<br />
        ページしたときに心奪われるような、ワクワクするような閲覧体験を作りましょう。<br />
        特に今回のお題は「自己紹介」ですので、ページごとに少し違った雰囲気で、<br />
        色々な面を表現してもいいかもしれません。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="align">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">配置などを手書きする</span>
      </h2>

      <p>
        ページ構成、ページごとの情報、雰囲気が決まったら、<br />
        今度は各ページのレイアウト、配置を定めていきましょう。<br />
        Web制作では効果的な写真、アニメーション、フォント、配色など、<br />
        さまざまな方法で「伝えたいこと」を表現します。<br />
        どのような写真や文字、文章をどこに配置するのか。概要を定めましょう。
      </p>

      <p>
        これも紙と鉛筆で全く問題ありません。まずはページの構成を決めましょう。<br />
        手書きでささっとキャッチコピーのエリアやテキストのエリア、<br />
        画像のエリアなどをメモをします。
      </p>

      <p>
        そこから徐々に細かく、テキストはどのような内容にするか。<br />
        画像はどのような素材をどう使うかを決めていきましょう。<br />
        Webページは、デバイスのディスプレイという限られた空間に表現しなくてはなりません。<br />
        ここに適切な情報を適切な箇所に配置していく必要があります。
      </p>

      <p>
        最近ではAdobeXDやFigmaなどの、非常に便利なUIデザインツールがあります。<br />
        大変便利で高性能なものですが、<br />
        これを使うにもやはり最初は手書きのメモに勝るものはないでしょう。
        Class7以降では、より詳細部分を具体的に検討する際や、<br />
        コーディングに踏み切る前、プレビューする場合などに積極的な利用を推奨します。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="equip">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">素材を用意する</span>
      </h2>

      <p>
        ここまでいかがだったでしょうか。<br />
        これから作ろうとしている自己紹介Webサイトのイメージはできたでしょうか。<br />
        イメージができたら、自己紹介HPで使用しようと考えている画像を用意しましょう。<br />
        画像が用意できたら必要な加工を施す必要があります。<br />
        画像サイズ、切り抜き、彩度、透明度など、必要な状態に加工してみましょう。
      </p>

      <p>
        AdobeのPhotoshopやIllustratorといった、有名な有料の画像編集ソフトもありますし、<br />
        最近では無料でも高品質のものも増えています。<br />
        Microsoft OfficeのPowerPointなども簡単な画像編集はできるので、<br />
        使ってみてもいいでしょう。<br />
        スマートフォンなどで編集できるアプリケーションもあるので色々検索をかけたり、<br />
        調べたりする必要があるでしょう。
      </p>

      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="coding">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">コーディングする</span>
      </h2>

      <p>
        ページ構成や、テキストの内容、レイアウトの決定や素材の準備など、<br />
        Web制作の準備ができたらいよいよコーディングです。<br />
        Class3〜Class5で学習してきたことを活かして実際にコードを書いていきましょう。<br />
        ぜひ自己紹介HPにおける必須項目を入れてみてください。
      </p>

      <p>
        まずはHTMLとCSSを用いて、<br />
        ある程度の自己紹介ページ静的な部分の骨格や体裁を整えていきましょう。<br />
        それが出来上がってきたら、JavaScriptで動きをつけていきましょう。<br />
        必須項目にある、JavaScriptを用いた「お問い合わせフォーム」の作成では、<br />
        閲覧者がフォームに記述したデータをサイト運営者が受け取れる仕組みを作りましょう。
      </p>

      <p>
        わからないことは検索と質問を使い分けながら、すぐに調べましょう。<br />
        キリの良い所でカルテを書いて、<br />
        実際にコーディングや調べ物をしていく過程で学んだことの記録をつけることも忘れずに継続しましょう。<br />
        他の学習者にアドバイスをもらったり、<br />
        [プログラミングで「伝える」コース]のClass6を終えている学習者のカルテを参考にしても良いでしょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="framework">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">フレームワーク利用のすゝめ</span>
      </h2>

      <p>
        Class4で学習したフレームワーク。<br />
        写真などをテキストと一緒に効果的に表示する際など、<br />
        フレームワークは非常に便利です。<br />
        Class6ではフレームワークをあなたの表現の幅を広げるものと、<br />
        好意的に捉えてつけるものは使っていきましょう。
      </p>

      <p>
        しかしここはあくまで学習過程。<br />
        用意されたフレームワークをそのまま使うだけでは芸がありません。<br />
        しっかりと自分の思い描いていたWebページの雰囲気、構成に合うようにアレンジするなどして活かしていきましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="open">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">Webページ公開のすゝめ</span>
      </h2>

      <p>
        初のWeb制作はいかがでしょうか。<br />
        実際に思い描いていたものや「伝えたいこと」がWebブラウザ上に表示されれば、<br />
        面白く思えてきたのではないでしょうか。
      </p>

      <p>
        実際に「自己紹介HP」の制作ができれば、<br />
        実際にそれをインターネット上に公開してみましょう。<br />
        これまでは自分のPCの中でファイルにコーディングしていく、<br />
        いわゆる「ローカル環境でのWeb制作」をしてきました。<br />
        これをインターネット上に公開すればURLリンクなどを発行することで、<br />
        実際に多くの人にWebサイトをみてもらうことができます。
      </p>

      <p>
        ローカル環境で制作したWebサイトのファイルはサーバへ保存することで、<br />
        インターネット上からアクセスできるようになります。
        Class6では「自己紹介HP」の制作が課題でした。<br />
        ここではローカル環境での制作ができれば良いので、<br />
        Webページを公開することは強制ではありません。<br />
        もし公開してみてもいいと思える方は、載せてはいけない情報がないか確認した上で、<br />
        良い学習機会になると思うので是非チャレンジしてみてください。
      </p>

      <p>
        完成したWebサイトを公開した場合はURLを、<br />
        そうでない場合は完成したWebサイトのスクリーンショットの公開することを以て、<br />
        Class6の完了とします。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="githubpages">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">GitHub Pages</span>
      </h2>

      <p>
        最も簡単なWebページの公開方法の一つとして、GitHubPagesを紹介します。<br />
        GitHub PagesはGitHubがユーザーに提供している静的Webページのための、<br />
        ウェブホスティングサービスです。<br />
        ウェブホスティングサービスとはいわばレンタルサーバです。<br />
        ユーザーのブログやプロジェクトのドキュメントを公開することができます。
      </p>
      <p>
        GitHub Pagesは静的なWebサイトで利用することができます。<br />
        HTMLやCSS、JavaScriptで構成されているようなWebサイトの公開には最適のツールの一つですので、<br />
        是非調べて活用してみてください。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
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
      title: 'Class 6', // コンテンツタイトル
      contents: [
        { id: '#classdesc', title: '0-0. Class6', activeStart: 0, activeEnd: 596 },
        { id: '#begin', title: '1-0. 初制作のすゝめ', activeStart: 0, activeEnd: 596 },
        { id: '#intro-hp', title: '2-0. 「自己紹介HP」を創る', activeStart: 0, activeEnd: 596 },
        {
          id: '#need',
          title: '2-1. 「自己紹介」HP制作における必須項目',
          activeStart: 0,
          activeEnd: 596,
        },
        { id: '#theme', title: '2-2. テーマを決める', activeStart: 0, activeEnd: 596 },
        { id: '#pages', title: '2-3. ページ構成を考える', activeStart: 0, activeEnd: 596 },
        {
          id: '#info',
          title: '2-4. ページごとに載せる情報を考える',
          activeStart: 0,
          activeEnd: 596,
        },
        {
          id: '#atmosphere',
          title: '2-5. 各ページの雰囲気を考える',
          activeStart: 0,
          activeEnd: 596,
        },
        { id: '#align', title: '2-6. 配置などを手書きする', activeStart: 0, activeEnd: 596 },
        { id: '#equip', title: '2-7. 素材を用意する', activeStart: 0, activeEnd: 596 },
        { id: '#coding', title: '2-8. コーディングする', activeStart: 0, activeEnd: 596 },
        {
          id: '#framework',
          title: '3-0. フレームワーク利用のすゝめ',
          activeStart: 0,
          activeEnd: 596,
        },
        { id: '#open', title: '4-0. Webページ公開のすゝめ', activeStart: 0, activeEnd: 596 },
        { id: '#githubpages', title: '4-1. GitHub Pages', activeStart: 0, activeEnd: 596 },
      ], // 目次データ

      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>
