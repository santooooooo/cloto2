@extends('app')

@section('content')
<!-- Title -->
<title>メール認証 / {{ config('app.name') }}</title>

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">認証完了</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        ご確認ありがとうございます。認証が完了しました。
                    </div>

                    <form class="d-inline" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ログイン</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
