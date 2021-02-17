@extends('app')

@section('content')
<!-- Title -->
<title>メール認証 / {{ config('app.name') }}</title>

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールをご確認ください。</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            認証メールを再送しました。
                        </div>
                    @endif

                    <p>{{ $user->email }} に認証メールを送信しました。</p>
                    <p>本登録完了後にサービスをご利用いただけます！</p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        メールを再送する場合は<button type="submit" class="btn btn-link p-0 m-0 align-baseline">こちら</button>をクリックしてください。
                    </form>

                    <br />
                    <br />
                    
                    <p>メールアドレスを間違えた場合は、一度ログアウトしてからトップページ下部のフォームよりお問い合わせください。</p>

                    <form class="d-inline" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
