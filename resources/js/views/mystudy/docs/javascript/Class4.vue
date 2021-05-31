<template>
  <v-container fluid id="content">
    <div class="mb-4 pa-4" id="class4-desc">
      <h1 class="text-h4 text-center mb-12">{{ title }}</h1>
    </div>

    <p>Class4からは「苦労人前期」に入ります。</p>
    <p class="font-weight-bolder">
      いよいよここからがプログラミング独学の始まりです。
      インプットとアウトプットを繰り返して頑張っていきましょう！
    </p>
    <p>
      Class4では媒体を問わず、<br />
      専門的な「教材」を用いて本格的な学習を開始していきます。<br />
      チュートリアル学習からさらに踏み込んで、<br />
      具体的な文法や、組み合わせなどを学習していきます。<br />
      この基本パターンをたくさん知っていることで、<br />
      自分で創る際の発想の源になります。
    </p>

    <p>
      全てを理解することを目標にする必要はありませんが、<br />
      できるだけ丁寧に学習していきましょう！
    </p>

    <ul class="agenda">
      <li>0-0　Class4</li>
      <li>1-0　参考書学習のすゝめ</li>
      <li>1-1　HTMLの学習</li>
      <li>1-2　CSSの学習</li>
      <li>1-3　Bootstrapの学習</li>
      <li>1-4　JavaScriptの学習</li>
      <li>1-5　jQueryの学習</li>
      <li>2-0　環境を作ろう</li>
      <li>2-1　Web制作の開発環境</li>
      <li>2-2　調べるべきこと</li>
      <li>3-0　おすすめ教材</li>
      <li>3-1　参考書</li>
      <li>3-2　公式ドキュメント</li>
      <li>3-3　ドットインストール</li>
    </ul>

    <v-container fluid class="mb-12" id="recommend">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> 参考書学習のすゝめ </span>
      </h2>

      <p>
        参考書学習の目標は一つの言語に対して、<br />
        チュートリアル学習から、さらに踏み込んで細かい学習を進めていくことにあります。<br />
        多くの参考書では、具体的な数値などを用いて基本文法を学習したり、<br />
        開発を疑似体験するように作られています。
      </p>

      <p>
        一つの言語あたり１〜２つほど学習するのが良いでしょう。<br />
        こちらはあまり時間をかけずに、短期間で取り組んでしまうことが重要です。<br />
        学習間隔を開けてしまうと、前回学んだ内容を忘れてしまったり、<br />
        学習開始にかけるエネルギーが多く必要になります。<br />
        あまり学習効率が良くないので、短期間に集中して取り組んでしまいましょう。
      </p>

      <p>
        Web制作を学んでいくこのロードでは、<br />
        特にJavaScriptを用いたWeb制作の教材が最適でしょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="html">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> HTMLの学習 </span>
      </h2>

      <p>
        HTMLの正式名はHyperText Markup Language。<br />
        テキストを記述するための言語で、<br />
        Webページの骨格を作るために利用します。<br />
        現在のバージョンはHTML5です。拡張子は[.html]。
      </p>

      <p>
        世界的に主流の規格なので、<br />
        マークアップ言語はHTMLが扱えれば問題ないでしょう。<br />
        見出し、段落、表、リストなど文書内の各部分を「要素」と呼びます。
      </p>

      <p>
        この要素の構造をコンピュータに伝えるのがマークアップ言語の役割です。<br />
        要素を記述するための目印を「タグ」と言います。<br />
        HTMLではこの「要素」と「タグ」が理解できればあとは簡単です。<br />
        具体的な記述方法を学びながら表現の幅を広げていきましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="CSS">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> CSSの学習 </span>
      </h2>

      <p>
        CSSの正式名はCascading Style<br />
        Sheets。HTMLの要素をどのように表示、修飾するかを指示するスタイルシートという仕様の一つです。<br />
        現在のバージョンはCSS Level3。拡張子は[.css] 。<br />
        HTML要素にスタイルを加えていくように記述します。
      </p>

      <p>
        スタイルとは、文字サイズ、色、フォント、背景色、要素の配置位置、余白などです。<br />
        CSSでは「セレクタ」「宣言ブロック」「プロパティ」「値」などの言葉が重要になります。<br />
        教材ではこの仕組みに着目しながら進めていきましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="Bootstrap">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> Bootstrapの学習 </span>
      </h2>

      <p>
        BootstrapとはWebサイトやWebアプリケーションを作成する、<br />
        Webアプリケーションフレームワークです。<br />
      </p>
      <p>
        Class0でも簡単に触れましたが、<br />
        「フレームワーク」とはソフトウェアフレームワークのことで、<br />
        アプリケーションなどの実装に必要となる一般的な機能や定型コードを、<br />
        ライブラリとしてあらかじめ用意したものです。
      </p>

      <p>
        「ライブラリ」とは、汎用性の高い複数のプログラムを利用しやすいようにまとめたものです。<br />
        ライブラリは他のプログラムになんらかの効果を与えるプログラムの集まりです。
      </p>

      <p>
        一方で、フレームワークとライブラリの明確な区別はありません。<br />
        一般に、フレームワークはライブラリを複数集めたものや、<br />
        より体系立って整理されたものというような認識です。<br />
        フレームワークはシステムの構築に必須な処理に関して、<br />
        スムーズに実装できるという働きがあります。
      </p>

      <p>
        夜ご飯で例えると、<br />
        フレームワークもライブラリも使わない場合はお肉屋さんや八百屋さんでの買い物から開始、<br />
        フレームワークを使う場合は材料があらかじめが用意されており、<br />
        そこから自分で味付けして調理するイメージ。<br />
        フレームワークとライブラリを使う場合は、お惣菜コーナーから好きなおかずを選んでくるようなイメージでしょうか。<br />
        非常に便利ですのでClass4では難しいことは考えずに、<br />
        とりあえずフレームワークの利用方法を学習すると良いでしょう。
      </p>

      <p>
        しかし一方で、複雑な処理の実装や、より独自性を出す際には、<br />
        やはりフレームワークだけではなく言語を理解した設計が必要になります。<br />
        あるいは、フレームワークの学習自体に時間がかかるというデメリットや、<br />
        不必要に導入してしまうことによりプログラムを肥大化させ、<br />
        挙動が重くなるなどの可能性もあるので、<br />
        将来的には特徴をしっかりと理解した上で使うことが重要といえます。
      </p>

      <p>
        BootstrapはHTML、CSSベースのデザインテンプレートです。<br />
        文字のデザインや各種フォーム、ボタン、カード、ナビゲーションなどが用意されています。<br />
      </p>
      <p>
        <a
          href="https:getbootstrap.jp/docs/5.0/getting-started/introduction"
          target="_blank"
          rel="noopener noreferrer"
        >
          BootstrapのWebページ
        </a>
        には多くのテンプレートが掲載されており、<br />
        それを記述するためのソースコードが添付されています。<br />
        あらかじめ、Bootstrapを利用できるように、HTMLの&gt;head&lt;部分に所定の記述をしておくことで、<br />
        コピーアンドペーストでテンプレートを利用できるようになるという優れものです。<br />
        数値や色を変えてアレンジすることで応用的な活用もできます。
      </p>

      <p>Webページの表現の幅が広がるので、ぜひ積極的に利用してみてください。</p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="js">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> JavaScriptの学習 </span>
      </h2>
      <p>
        JavaScriptはプログラミング言語です。<br />
        分類的にはオブジェクト指向スクリプト言語と言われます。<br />
        よく似た名前の言語として「Java」がありますが、<br />
        JavaScript誕生の経緯から見ても全く別物の言語と考えて良いでしょう。拡張子は[.js]。
      </p>

      <p>
        JavaScriptの最大の特徴に「ブラウザ上で動作するプログラミング言語である」というものがあります。<br />
        これは、「ユーザーがブラウザで行う操作をきっかけに、さまざまな処理を発動することができる」ということです。<br />
        マウスの移動や、クリック、ダブルクリック、ホバー時にそれぞれ処理を変えたり、<br />
        Webページのページ遷移時に処理を行なったり、<br />
        といったユーザーのWebページへの操作に対してアクションをつけることができることが最大の特徴です。
      </p>

      <p>
        この特徴により、Web制作の場面でJavaScriptは、HTML、CSSで作られたページに、<br />
        アニメーションやそのほか様々な動きをつけることを可能にし、重宝されるのです。
      </p>

      <p>
        また、「非同期通信」が可能という特徴もあります。<br />
        これはサイトを更新、つまりリロードすることなく表示内容を変更できるというものです。<br />
        普段当たり前に行えていることなので、<br />
        いまいちピンとこないかも知れませんが、<br />
        HTML、CSSだけでは、ページに変更を加える際、<br />
        その都度更新しなくては表示内容が変更されません。<br />
        JavaScriptで「非同期通信」を行えばすぐに変更結果が表示されるため、<br />
        ページの更新をよりスムーズに行うことができるようになるのです。
      </p>

      <p>
        JavaScriptはその特徴から、<br />
        主にクライアントサイドで使われるプログラミング言語ですが、<br />
        近年はNode.jsといった、<br />
        サーバサイドでのJavaScript実行環境も生まれたことにより、<br />
        その活躍の幅を広げています。
      </p>

      <p>
        また、PCのネイティブアプリケーションやスマホアプリケーションの開発もできるようになっています。<br />
        このように汎用性が高く主流な言語になっているため、<br />
        学習に必要な情報も豊富で一番最初に学習するには、<br />
        もってこいのプログラミング言語と言えるでしょう。
      </p>

      <p>
        JavaScriptでは、「関数」「引数」「変数」「クラス」といった言葉が非常に重要になってきます。<br />
        これらに着目しながら学習をしましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="jq">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> jQueryの学習 </span>
      </h2>

      <p>
        jQueryはJavaScriptの記述をより簡易化するために設計されたJavaScriptのフレームワークです。<br />
        jQueryはそのコンセプトにもなっているように、<br />
        「より少ない記述で、より多くのことをする」ことを目的に開発されました。<br />
        JavaScriptでの表現の幅を広げてくれる武器になります。
      </p>

      <p>
        jQueryはHTMLを操作するための「DOM操作」、<br />
        その名の通りの「CSS操作」、「アニメーションとエフェクト」の追加、<br />
        通信が可能な「Ajax」などの機能を持っています。<br />
        いずれもJavaScriptを元に作られているものです。<br />
        ブラウザごとの対応をしなくていいのも特徴です。<br />
        また、プラグインが多いことも特徴であり、<br />
        非常に便利ですのでぜひJavaScriptとセットで学習しましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"></span>
      </h2>
      2-0　開発環境を作ろう
      Class3で選んだチュートリアル教材によっては、開発環境が整っている方もいるかと思います。
      一方でチュートリアル学習の段階で、開発環境の用意が必要なかった方（Progateなどで学習された方）は、ぜひこの場でWeb制作に必要な開発環境を作っていきましょう。
      Web制作、特にHTML、CSS、JavaScriptの開発環境の構築は比較的難易度も低いので、あまり難しく考えず取り組んでみましょう。ほとんどの教材で最初の開発環境の準備について記述されているので、その通りやってみましょう。ここでは簡単に概要だけ記載しておきますが、ここも「調べる力」が重要です。基本の「型」を元に、さらに調べてより便利にカスタマイズしたり、自分より早く学習に取り組んでいる人に質問してみることが重要です。プログラミング学習の方法は常に複数の答えがあるものなので、自分のパターン、自分の最適解を見つけていく姿勢が重要です。
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="make-env">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3">Web制作の開発環境 </span>
      </h2>

      <p>
        Class2でも触れたWeb制作の仕組みを理解できていれば、<br />
        決して難しいものではありません。<br />
        Web制作で必要な環境は以下です。
      </p>

      <ul>
        <li>Webブラウザ</li>
        <li>
          ソースコードエディタ（プログラミングのソースコード編集用に最適化されたソフトウェア）。
        </li>
      </ul>

      <p>
        Webブラウザは近年の情勢や汎用性の高さからも、<br />
        Google Chromeを推奨しています。<br />
        Apple社のSafariや、Mozilla社のFirefoxなどでももちろん可能です。
      </p>

      <p>
        ソースコードエディタはプログラムを編集するのに最適化されたテキストエディタソフトウェアです。<br />
        最初はなるべくメジャーなものを利用されることを推奨します。<br />
        マイクロソフト社のVisual Studio Code<br />
        などは有名なソースコードエディタソフトと言えます。<br />
        とりあえずという方はこちらをインストールすることをお勧めします。
      </p>

      <p>
        これはソースコードエディタに限ったことではありませんが、<br />
        あるツールがメジャーであることには、<br />
        何か利便性が高いなどの理由があることが多いです。<br />
        インターネット上にある情報量も多く、何か困った時に検索しやすく、<br />
        質問もしやすいです。<br />
        何事も最初は標準の「型」を学習することが良いと思います。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="should-search">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> 調べるべきこと </span>
      </h2>

      <p>
        Class4では、教材に乗っ取ってとりあえず開発してみることが良いと思います。<br />
        HTML、CSS、JavaScriptの「型」を一通り学習しましょう。<br />
        Class4で特に調べるべきことは、
      </p>

      <ul>
        <li>Webの仕組み（Class2で復習）</li>
        <li>Web制作をする上でのファイル構造</li>
        <li>ソースコードエディタの使い方</li>
        <li>Webブラウザの開発者ツール</li>
        <li>デバッグツールの使い方</li>
        <li>命名規則などのルール、慣習</li>
      </ul>

      <p>
        チュートリアル教材で説明を受けるものの、<br />
        実際に触るとよくわからないものの一つにファイル構造があります。<br />
        HTMLの.htmlファイルやCSSの.cssファイル、JavaScriptの.jsファイルが、<br />
        それぞれどのように関係し合っているのか。<br />
        あるいはどのようにファイルが作用してWebブラウザに影響を与えているかなどです。ここがわからないと全体像をなかなかイメージできないと思います。チュートリアル教材を読み直す、あるいはClass4で学習しようと思う教材で手を動かしながら確認しましょう。それでもわからないことがあると思います。そんな時は迷わずすぐに検索しましょう！
      </p>

      <p>
        ソースコードエディタは多くの機能を持っています。<br />
        学習を進める過程でご自身に最適なテキストエディタに仕上げてください。
      </p>

      <p>
        Webブラウザも奥が深いです。<br />
        開発者ツール、デバッグツールと呼ばれるものがあって、<br />
        表示されているWebページの要素、HTMLやCSS、そのほかのファイルのソースコードを見ることができたり、<br />
        その場限りではありますが、実際にそのソースコードを書き換えて一時的にWebページに変更点を反映させることができます。<br />
        非常に便利ですのでぜひ調べてみてください。
      </p>

      <p>
        命名規則とは、例えばJavaScriptでclass名を決めるときのルールです。<br />
        実はあれ、ルールがあるんです。<br />
        プログラミング言語は機械に命令を与えるための言語であると同時に、<br />
        自分以外の開発者にもその内容を伝えるための言語であるとも言えます。<br />
        [プログラミングで「伝える」コース]では、<br />
        基本的に個人でのWeb制作を通じた価値の創造を主眼にコースが作成されています。
      </p>
      <p>
        一方で実際にエンジニアとして就職したり、<br />
        フリーランスのエンジニアとしてプロジェクトを抱えたりする場合には、<br />
        ほとんどの場合に複数人での開発が必要になります。<br />
        この際に重要になるのが、命名規則に代表される言語ごとのルールです。<br />
        言語ですから当然ルールがあります。
      </p>

      <p>
        実際にはルールを破っても実行できますが、<br />
        複数人での開発ではかなり忌避されます。<br />
        そのほか、コメントでメモを残すことも重要です。<br />
        コメントを入れないと、見直した時に何がなんの処理かわからなくなってしまう場合や、<br />
        質問してもレビューしにくいなどという弊害があります。
      </p>

      <p>
        かなり現実的に困ることもありますので、<br />
        もし余裕があれば日頃から気に留めて、<br />
        誰もが読みやすくルールに則ったコードを書けるように練習をしていきましょう！
      </p>

      <p>
        このような話に興味のある方は、<br />
        命名規則などのルールに関しては、「言語ごとの公式ドキュメント」を、<br />
        読みやすいコードに関しては、「リーダブルコード」や「コード
        綺麗に書く」などのワードで検索すると、<br />
        関連項目が出てくるかと思いますので調べてみることをお勧めします。<br />
        何か学びがあったら、惜しみなく他の学習者にも共有していきましょう！
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="recommend">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> おすすめ教材 </span>
      </h2>

      <p>
        Class4の目的をおさらいすると、<br />
        「各言語に対して、基本文法や記述の仕方、特徴を学ぶ」ことにあります。<br />
        従って、チュートリアル学習に比べて、<br />
        ある程度の専門的な教材に取り組んでいくことになります。
      </p>

      <p>
        CLOTOでは言語ごとにコミュニティを用意しています。<br />
        ここに各言語のおすすめ教材やサイトを共有できる掲示板、資料棚のような機能を用意する予定です。<br />
        また、タイムラインや、プロフィールでも情報共有ができるように、<br />
        随時アップデートして参りますので楽しみにしていてください。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="book">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> 参考書 </span>
      </h2>

      <p>
        参考書学習とは、書籍やPDFといった印刷物で学習していく方法です。<br />
        特にHTML&CSSや、Webデザイン、ホームページ制作といった教材はかなり充実しており、<br />
        もはや選ぶのに困るくらいかも知れません。<br />
        どれも素晴らしいものですので、実際に書店へ行き、自分にとって見やすく、<br />
        楽しんで取り組めるものを購入しましょう。<br />
        そしてここでも日にちを空けることなく、<br />
        なるべく早く一気にやり切ってしまいましょう。
      </p>

      <p>
        あえていうのであれば、具体的な書籍名は控えますが、<br />
        Class4の目的も鑑みると、<br />
        英語学習で言うところの、「文法演習」「語彙力を増やす」といったような学習をしなくてはならないので、<br />
        「辞書のように使えるもの」をお勧めします。<br />
        「逆引きできる」ようなものもいいですね。<br />
        網羅的に多くのサンプルコードと利用局面が書いてあるようなものも良いかも知れません。
      </p>

      <p>
        文法や場面ごとに一つずつコードサンプルが載っていて、<br />
        細かく練習ができるようなものがいいかも知れません。<br />
        ボキャブラリーを増やすことが重要です。<br />
        「HTMLであんなことできたな。」「ここでJavaScript使ってあのアニメーションをつけよう」などと思うことができれば、<br />
        しめたものです。
      </p>

      <p>
        この辞書のような使い方ができるというのは、<br />
        参考書学習の利点かも知れません。<br />
        参考書学習で気をつけなくてはならないのは、<br />
        「いつ書かれたものか。」「どのバージョンについて書いたものか。」を誤らないことです。<br />
        例えば2021年5月現在、HTMLはHTML5ですし、<br />
        CSSはCSS3というバージョンが最新版で主流です。<br />
        古いものを買ってしまうと無駄になってしまいますので気をつけましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="document">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> 公式ドキュメント </span>
      </h2>

      <p>
        公式ドキュメントとは言語の開発者、団体などがまとめているドキュメントのことで、<br />
        実はチュートリアルから各要素、文法、構文などが事細かに記述されています。<br />
        命名規則などのルールも載っていることが多いです。
      </p>

      <p>
        開発者や団体などが提供していない場合、<br />
        第三者が作成した要素リファレンス集などもあります。
      </p>

      <p>
        なかなか公式ドキュメントをしっかり読んで学習する人は少ないですが、<br />
        現役エンジニアの多くは「困ったら公式ドキュメント」と言います。<br />
        ぜひ学習に役立ててみてください。
      </p>

      <p>
        一方で、公式ドキュメントは英語で記述されていることが多いです。<br />
        専門的な用語も多いので読み進めていくとなると、ハードルもが上がるかと思います。<br />
        無理して一周目の教材学習で用いる必要はないのかなと思います。<br />
        しかし、「こういうものがある」ということは絶対に知っておくべきでしょう。
      </p>

      <p>
        ちなみにプログラミングを学習する方は、<br />
        余力があれば英語も学習したほうが絶対に良いです。<br />
        クラス名や関数名などの理解が早まったり、<br />
        公式ドキュメントなどを正確に理解することができます。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <v-container fluid class="mb-12" id="dotinstall">
      <h2 class="text-h4 font-weight-bold mb-10">
        <span class="pl-3 grey lighten-3"> ドットインストール </span>
      </h2>
      <p>
        Class3でも紹介したこの「ドットインストール」ですが、<br />
        こちらの教材は言語ごとにチュートリアルレベルから、<br />
        Class4レベルの学習もできるので、<br />
        ここで再度紹介します。
      </p>

      <p>
        言語で言えば「HTML」「CSS」「JavaScript」「jQuery」。<br />
        そのほかでいえば「Webサイト制作」などのレッスンに取り組むことをお勧めします。
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
      title: 'Class 4', // コンテンツタイトル
      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>
