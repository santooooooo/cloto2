<nav class="nav navbar navbar-expand-md navbar-light shadow-sm" id="navbar">
    <a class="nav__logo" href="{{ route('index') }}">
        <img src="/storage/web/header-logo.svg">
    </a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav__item">
                <a class="nav-link" href="{{ route('register') }}">新規登録</a>
            </li>

            <li class="nav__item">
                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
            </li>
            @endguest

            @auth
            <li class="nav__item">
                <a class="nav-link" href="{{ route('course_form', ['username' => Auth::user()->username]) }}">コースを開く</a>
            </li>

            <li class="nav__item">
                <a class="nav-link" href="{{ route('course_all') }}">コースを探す</a>
            </li>
            @endauth
        </ul>

        @auth
        <ul class="navbar-nav user">
            <li class="dropdown">
                <a class="nav__link--usericon" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <user-status user-icon={{ Auth::user()->icon }} :icon-size=30
                        :sync-interval={{ config('consts.syncInterval.STATUS') }}
                        endpoint="{{ route('status', ['user' => Auth::id(), 'isAuth' => (int)true]) }}">
                    </user-status>
                </a>

                <div class="nav__dropdown-menu dropdown-menu">
                    <button class="dropdown-item" onclick="changeStatus('online');"><span class="online__color">●</span>
                        オンライン</button>
                    <button class="dropdown-item" onclick="changeStatus('doNotDisturb');"><span
                            class="doNotDisturb__color">●</span>
                        取り込み中</button>
                    <button class="dropdown-item" onclick="changeStatus('offline');"><span
                            class="offline__color">●</span>
                        離席中</button>
                </div>
            </li>
        </ul>
        <script>
            /**
            * ステータスの変更
            *
            * @param {String} status 変更するステータス
            * @return None
            */
            function changeStatus(status) {
                // APIのURLを生成
                var url = '{{ route('update-status', ['user' => Auth::id(), 'status' => '#']) }}';
                // '#'部分をステータスに置き換える
                var endpoint = url.replace('#', status);

                // ステータスを変更
                axios.get(endpoint);

                // 非同期通信でステータスを変更するため，手動でアイコンを更新
                var navbar = document.getElementById('navbar');
                var statusIcon = navbar.getElementsByClassName('statusIcon')[0];
                statusIcon.className = 'statusIcon ' + status;
            }
        </script>

        <ul class="navbar-nav">
            <li class="dropdown">
                <a class="nav__link--username dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    　{{ Auth::user()->username }}
                </a>

                <div class="nav__dropdown-menu dropdown-menu">
                    <a class="dropdown-item"
                        href="{{ route('user_page', ['username' => Auth::user()->username]) }}">マイページ</a>
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

        <div id="notification">
            <notification :sync-interval={{ config('consts.syncInterval.NOTIFICATION') }}
                endpoint="{{ route('notifications', ['user' => Auth::id()]) }}"></notification>
        </div>
        @endauth
    </div>
</nav>

@include('layouts.message')