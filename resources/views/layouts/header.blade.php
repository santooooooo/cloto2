<nav class="nav navbar navbar-expand-md navbar-light shadow-sm" id="navbar">
    <a class="nav__logo" href="{{ route('index') }}">
        <img src="{{ config('consts.storage.system').'header-logo.svg' }}">
    </a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav__item">
                <a class="nav-link" href="{{ route('register') }}">新規登録</a>
            </li>

            <li class="nav__item">
                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
            </li>
        </ul>

        @auth
        <ul class="navbar-nav">
            <li class="dropdown">
                <a class="nav__link--username dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="{{ config('consts.storage.icon').Auth::user()->icon }}" class="rounded-circle" width="30"
                        height="30" />
                    　 {{ Auth::user()->username }}
                </a>

                <div class="nav__dropdown-menu dropdown-menu">
                    {{-- <a class="dropdown-item"
                        href="{{ route('user_show', ['username' => Auth::user()->username]) }}">マイページ</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                </div>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
        @endauth
    </div>
</nav>

@include('layouts.message')