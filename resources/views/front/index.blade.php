@extends('layouts.app')

@section('title', 'CLOTO')

@section('top')
<div class="welcome container">
    <div class="row">
        <div class="welcome__cloto-icon col-6">
            <img src="/storage/web/top.png">
        </div>

        <div class="welcome__content col-6 d-flex align-items-center">
            @guest
            @if ($errors->any())
            <router-view v-bind:errors="{{ $errors }}" />
            @else
            <router-view />
            @endif
            @endguest

            @auth
            <router-view user="{{ Auth::user()->username }}" />
            @endauth
        </div>
    </div>
</div>
@endsection


@section('content')
<div class="index">
    <div class="index__container">
        <p class="index__concept">
            「チュートリアル学習も終わり、いよいよ腕試し！！」<br>
            そんな駆け出しエンジニアのみなさん、朗報です！<br>
            <br>
            「実際のプログラミングって大変．．．」<br>
            「何からしたらいいんだろう」<br>
            <br>
            そんな悩みとは今日でさようなら。<br>
            <br>
            プログラミングを楽しみながら継続できる環境がここに生まれました！
        </p>

        <h1 class="index__value">CLOTOが提供する5つの価値</h1>

        <hr>

        <div class="index__content row">
            <div class="col-md-6">
                <img class="index__intro-img" src="/storage/web/1st.png">
            </div>
            <div class="index__intro-body col-md-6">
                <h2>1.創りたいものを提案</h2>
                <p>
                    何かを創りたいと思ったらすぐログイン！<br>
                    簡単なフォームに必要事項を入力するだけで
                    「創る」にコミットできる「コース」が出来上がります！
                </p>
            </div>
        </div>

        <hr>

        <div class="index__content row">
            <div class="col-md-6">
                <img class="index__intro-img" src="/storage/web/2nd.png">
            </div>
            <div class="index__intro-body col-md-6">
                <h2>2.目標を直感的に選べる</h2>
                <p>
                    「何を創ったらいいんだろう．．．」<br>
                    そんな時はみんなの「コース」を覗いてみましょう！<br>
                    似た目標を持った仲間が切磋琢磨している環境が
                    あなたの参加を待っています！
                </p>
            </div>
        </div>

        <hr>

        <div class="index__content row">
            <div class="col-md-6">
                <img class="index__intro-img" src="/storage/web/3rd.png">
            </div>
            <div class="index__intro-body col-md-6">
                <h2>3.影響し合えるコミュニティ</h2>
                <p>
                    それぞれの「コース」では大きく似た目標を持つ
                    「コースメンバー」が進捗を共有したり、情報を交換して
                    お互いに良い刺激を与え合いながら開発を進めています。<br>
                    どんどん交流しスキルアップやモチベーションの維持に
                    繋げましょう！
                </p>
            </div>
        </div>

        <hr>

        <div class="index__content row">
            <div class="col-md-6">
                <img class="index__intro-img" src="/storage/web/4th.png">
            </div>
            <div class="index__intro-body col-md-6">
                <h2>4.教え合える交流スペース</h2>
                <p>
                    「カルテ」と呼ばれる自分の進捗を共有することができます。<br>
                    カルテでは活動内容や、活動時間、感想や困ったこと
                    などを、画像とともに投稿できます。<br>
                    カルテに対してコメントをつけることも可能です。
                </p>
            </div>
        </div>

        <hr>

        <div class="index__content row">
            <div class="col-md-6">
                <img class="index__intro-img" src="/storage/web/5th.png">
            </div>
            <div class="index__intro-body col-md-6">
                <h2>5.活動の記録と共有</h2>
                <p>
                    コースページでは最新の「カルテ」のみが公開されます。<br>
                    過去の積み上げは「マイページ」に蓄積されていきます。<br>
                    マイページはあなたのプロフィール欄であると同時に
                    あなたの活動や努力の証となります。<br>
                    自分がどこでつまり、どう乗り越えたのか
                    日々投稿するカルテがあなたの軌跡となるでしょう。
                </p>
            </div>
        </div>

        <hr>

        <div class="index__conclude">
            CLOTOは言わば「新生児」<br>
            ユーザーの皆さんと一緒に成長していきます。<br>
            <br>
            プログラミングに出会った全ての人に<br>
            「創る」喜びを届けたい。<br>
            <br>
            共創しよう。
        </div>
    </div>
</div>

@endsection