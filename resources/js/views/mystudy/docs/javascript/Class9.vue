<template>
  <v-container fluid id="content">
    <h1 class="text-h3 white--text text-center mb-12 pa-4">{{ title }}</h1>

    <p>
      Class8で実際にWeb制作をしてきました。<br />
      しかし、Webサイトはまだローカル環境で完成しているだけであってClass8の状態ではインターネットに公開されていません。<br />
      Web制作は「伝えたいこと」を伝えることを目的に行なってきた以上、インターネット上に公開しなくてはなりません。<br />
      Class9ではインターネット上に自作のWebサイトを公開する方法を学んでいきます。
    </p>

    <ul>
      <li>0-0　Class9</li>
      <li>1-0　Webサイト公開のすゝめ</li>
      <li>1-1　ドメインの用意</li>
      <li>1-2　レンタルサーバの用意</li>
      <li>1-3　常時SSLにする</li>
      <li>1-4　FTPクライアントソフト</li>
      <li>2-0　おすすめWeb公開ツール</li>
      <li>2-1　GitHub Pages</li>
      <li>2-2　Heroku</li>
      <li>2-3　AWS</li>
      <li>2-4　SAKURA internet</li>
      <li>2-5　ロリポップ!</li>
    </ul>

    <h2 class="text-h4 font-weight-bold">
      <span> Webサイト公開のすゝめ </span>
    </h2>
    <v-container fluid>
      <p>
        Class8の最後にも触れましたが、Webサイトを公開するにあたっては気をつけるべきことがあるので、<br />
        それらの確認を必ずしてから公開に移りましょう。
      </p>

      <p>
        Webサイト公開ですが、まずはWebの仕組みについて、<br />
        Class2で触れているので確認しましょう。<br />
        Webサイトをインターネット上に公開するためには、ドメイン(URLの一部)と、Webサーバが必要になります。<br />
        その他にも留意すべき点を記しておきます。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> ドメインの用意 </span>
    </h2>
    <v-container fluid>
      <p>
        Class2でWebの仕組みについて説明したときに、URLについて触れました。<br />
        URLはUniform Resource Locatorの略で、統一資源位置指定子と言います。<br />
        インターネット上の情報の所在を表記する方法です。<br />
        主にWebページの保存場所や電子メールの宛先などを示しています。<br />
        日本ではURLのことをアドレスと呼ぶことがありますが、<br />
        MACアドレスやIPアドレスなどと紛らわしいため、技術用語としては好まれません。
      </p>

      <p>
        IPネットワークでここのコンピュータを識別し、接続先を指定するために使用される名称の一部であり、<br />
        URLの一部にもなるのがドメインです。<br />
        ドメインはインターネットにおいては世界中で絶対に重複しないようにするため、<br />
        ICANN(アイキャン)という非営利機関によって一元管理されています。<br />
        また、世界中で重複が許されないというWWWの仕組み上、<br />
        ドメイン名を使用する権利は、一番初めに申請したものに与えられるようになっています。<br />
        ドメインは登録から最低１年、更新手続きを行うことで、期間を延長することが可能です。
      </p>

      <p>
        ドメインにはいくつか種類があり、有料のものと無料のものがあります。<br />
        ドメインについてさらにみていきましょう。 例えばCLOTOのURLですが、<br />
        https://cloto.jp/<br />
        のようになっています。<br />
        この「cloto.jp」の部分がドメインになっています。<br />
        メールアドレスで言うと、@以降の箇所がドメインになっています。
      </p>

      <p>この「.jp」の箇所がドメインの種類になるわけですが、他には以下のようなものがあります。</p>
      <ul>
        <li>.com : 一般企業や個人での利用が多い</li>
        <li>.net : ネットワークサービスを意識させる</li>
        <li>.org : 組織やグループなどの非営利団体を表す</li>
        <li>.info : 情報発信、お問い合わせなどを表す</li>
        <li>.biz : 商用利用、ビジネスを想起させる</li>
        <li>.jp : 所在が日本にあることを表す</li>
      </ul>

      <p>
        これら以外にも様々な種類のドメインがあります。<br />
        通信会社ごとにメールアドレスのドメインを持っていることもあります。<br />
        これらどのドメインを選んでも基本的に違いはありません。
      </p>

      <p>
        「.jp」は日本に住所がないと申請できません。日本に住所があることは世界的に一定の信用を担保できるなどの利点があります。<br />
        そう言う観点から言うと「.co.jp」のドメインは普通のドメイン取得に必要なものに加えて、<br />
        企業としての登記情報が必要になるため、信頼性の高さが別格です。
      </p>

      <p>
        独自ドメインを取得するためには、ドメイン取得サービスで、取得したいドメインが既に利用されていないか調べます。<br />
        ドメインは企業名や、サービス名、サイト名などと一致している方がよく、短く覚えやすいものがいいでしょう。<br />
        どれだけ理想に近いドメイン名が取得できるか、そしてドメイン取得にかかる値段を鑑みて、<br />
        どの種類のドメインを取得するか決めましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> レンタルサーバの用意 </span>
    </h2>
    <v-container fluid>
      <p>
        Class2で紹介したように、Webサイトをインターネット上に公開するには、サーバが必要です。<br />
        かつては、自分で高性能のサーバ専用のコンピュータを用意して、環境構築をする必要がありましたが、<br />
        近年は月額料金でレンタルできるサーバが普及してきています。<br />
        以前に比べ格段に安く、またオンラインで簡単に申し込むことができるので、非常に便利になってきています。
      </p>

      <p>
        レンタルサーバーにも様々な種類があるので、レビューなどを見て良いものを選びましょう。<br />
        セキュリティ対策や常時SSL化ができるかに注意しながら、容量と費用とを考慮して用途にあったものを選びましょう。<br />
        有名なものは後ほど簡単に紹介します。 　
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> 常時SSLにする </span>
    </h2>
    <v-container fluid>
      <p>
        Web制作だけに関わらず、プログラミング独学をしていく先のエンジニア、開発者という仕事は、<br />
        セキュリティと隣り合わせの職業です。<br />
        インターネットは世界中を繋ぎ、世の中を便利にした一方で、常に情報が世界中に拡散されてしまったり、<br />
        公開していない情報を狙ってインターネット経由で攻撃を受けることがあります。
      </p>

      <p>
        これらは完全に防ぐことができません。<br />
        一方で情報を扱う以上、あるいはインターネットという公共の場にサービスを提供する以上、<br />
        少しでもセキュリティ対策を心がけることは開発者の責務です。
      </p>

      <p>
        Web制作の現場における最も初歩的なセキュリティ対策が常時SSL化です。<br />
        インターネットなどのコンピュータネットワークにおいて、<br />
        セキュリティを要求される通信を行うためのプロトコル(通信規約)であるTLS(Transport Layer
        Security)というものがありますが、<br />
        これの別名がSSL(Secure Sockets Layer)です。
      </p>

      <p>
        URLの先頭に「http://」というものがついていると思います。<br />
        これはHTTP(Hypertext Transfer
        Protocol)というWebページなどのコンテンツの送受信に用いられるプロトコルを示しています。<br />
        SSLをHTTPと組み合わせることでHTTPSという安全なプロトコルを実現します。
      </p>

      <p>
        CLOTOのURLもよく見ると、<br />
        https://cloto.jp/<br />
        先頭が「https」になっているかと思います
      </p>

      <p>
        このようにセキュリティ対策をするために、常時全てのページに対して、<br />
        HTTPとSSlの両方のプロトコルを組み合わせた比較的安全なHTTPSのプロトコルにすることを「常時SSL化」と言います。
        Webブラウザによっては、この常時SS化をしておかないと、<br />
        「このページは保護されていません」などの警告文が出るようになっています。<br />
        あなたの作ったWebサイトを訪問したときに、警告文が出れば、閲覧者から信頼を得ることができません。
      </p>

      <p>
        常時SSL化をし「https」にしておくと他にもメリットがあります。<br />
        検索エンジンでの検索順位が優先されるため、SEO対策になります。<br />
        サイト分析の精度も上がります。またページ表示速度も早くなります。<br />
        レンタルサーバーを選ぶときには、常時SSL化ができるかを確認し、<br />
        いざWebサイト公開の際には常時SSL化をしましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> FTPクライアントソフト </span>
    </h2>
    <v-container fluid>
      <p>
        FTPクライアントソフトとは、作成したWebページをサーバにアップロードするためのソフトウェアです。<br />
        ホームページ作成ソフトや、クラウド型のCMS(Content Management
        System：コンテンツ管理システム)には、<br />
        すでに同等の機能を持ち合わせているものも多いので近年では必ずしも必要としません。<br />
      </p>

      <p>
        [プログラミングで「伝える」コース　JavaScriptを軸に学ぶロード]では、<br />
        こういったサービスを利用していない前提ですのでいくつか有名なFTPクライアントソフトを紹介します。<br />
        この他にもたくさんあるので調べて使ってみましょう。<br />
        ※ホームページ作成ソフトでのWeb制作をサポートするロードも用意していこうと思うので楽しみにしていてください。
      </p>

      <ul>
        <li>FileZilla</li>
        <li>FFFTP</li>
        <li>WinSCP</li>
        <li>Core</li>
        <li>FTP</li>
      </ul>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> おすすめサービス </span>
    </h2>
    <v-container fluid>
      <p>
        Web制作をインターネット上に公開する際に使えるサービスをいくつか紹介します。<br />
        具体的な使い方は割愛するので、検索したり、質問したりして活用していきましょう。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> GitHub Pages GitHub </span>
    </h2>
    <v-container fluid>
      <p>
        PagesについてはClass8でも紹介しました。<br />
        静的なWebページを簡単にインターネット上に公開できるWebサービスです。<br />
        更新も簡単に加えることができます。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> Heroku </span>
    </h2>
    <v-container fluid>
      <p>
        Herokuとは環境開発用のサーバサービスです。<br />
        Emailアドレスさえあれば登録可能で、１サービスのみ無料で利用することができます。
      </p>
      <p>
        基本的にはWebアプリ向けのサービスなので、HTMLを中心とする静的なWebサイトの場合には、<br />
        PHPなどでファイルを作ることで、Webアプリと認識させることで、表示が可能になります。<br />
        少し応用的な利用法になりますが、今後、Webアプリ開発なども想定しているのであれば、<br />
        ここで少し調べてみるのもありかもしれません。
      </p>

      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> AWS Amazon S3 </span>
    </h2>
    <v-container fluid>
      <p>
        AWS(Amazon Web Service)はAmazon社の提供する世界最大のクラウドサービスです。<br />
        このサービスの一環に Amazon S3(Amazon Simple Storage Service)というものがあります。<br />
        Webサイトのコンテンツ配信やバックアップに利用できます。S3は静的なWebページのみに対応しています。
      </p>
      <p>
        AWSは全世界的に利用されている世界最大のクラウドサービスです。<br />
        Amazon
        S3以外にも非常に多くのサービスを提供しており、業界標準にもなりつつあるサービスです。<br />
        エンジニア、開発者として知っておいて損のないサービスでしょう。<br />
        利用するしないに関わらず、どこかで時間をとって調べてみる価値がありそうですよ。
      </p>
      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> SAKURA internet </span>
    </h2>
    <v-container fluid>
      <p>
        SAKURA
        internetは国内で有力なレンタルサーバ、クラウドコンピューティングを提供するサービスです。<br />
        「さくらのレンタルサーバ」、「さくらVPS」などいくつかのサービスを提供しています。<br />
        ドメインの取得、レンタルサーバの利用が可能です。<br />
        ファイルをサーバへアップするためにFTPソフトを使う方法と、独自のファイルマネージャーを使う方法のふたつが用意されています。
      </p>

      <v-row justify="center" class="mt-10">
        <v-btn dark color="success" @click="$emit('karte-post')">ここまでを記録</v-btn>
      </v-row>
    </v-container>

    <h2 class="text-h4 font-weight-bold">
      <span> ロリポップ！ </span>
    </h2>
    <v-container fluid>
      <p>
        ロリポップ！は女性、学生、Web制作初心者をターゲットとした個人向けのレンタルサーバサービスです。<br />
        月額100円という低価格から料金設定が組まれており、またサポート体制が厚いサービスになっており、<br />
        初めてのWebサイト公開をする際にはおすすめのサービスです。
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
      title: 'Class 9', // コンテンツタイトル
      filePath: this.$docs(this.$route.params.roadName, 'class' + Number(this.$route.params.class)), // コンテンツデータのパス
    };
  },
};
</script>
