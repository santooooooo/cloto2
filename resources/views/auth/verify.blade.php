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

                    認証完了後にサービスをご利用いただけます！
                    
                    <br><br>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        メールを再送する場合は<button type="submit" class="btn btn-link p-0 m-0 align-baseline">こちら</button>をクリックしてください。
                    </form>

                    <br><br>
                    
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
