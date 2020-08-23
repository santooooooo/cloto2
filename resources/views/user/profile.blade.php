<div class="user-profile">
    {{-- プロフィール欄 --}}
    <div class="user-profile__content card">

        <div class="row">
            {{-- アイコンとユーザー名 --}}
            <div class="user-profile__user col-md-5">
                <img src="/storage/user/icon/{{ $user->icon }}" class="rounded-circle" width="100" height="100">
                <p class="user-profile__user--handlename">{{ $user->handlename }}</p>
                <p class="user-profile__user--username">{{ '@'.$user->username }}</p>
            </div>

            <div class="col-md-7">
                <div class="user-profile__button">
                    @if ($user->user_id == Auth::id())
                    {{-- マイページの場合 --}}
                    <a href="{{ route('user_edit', ['username' => $user->username]) }}"
                        class="btn btn-cloto-primary">編集する</a>
                    @endif
                </div>

                {{-- ボタン類 --}}
                @if (isset($sns) || isset($user->web))
                <div class="user-profile__sns-container">
                    @isset ($sns['twitter'])
                    <a class="user-profile__sns--twitter" href="https://twitter.com/{{ $sns['twitter'] }}"
                        target="_blank">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                    @endisset

                    @isset ($sns['github'])
                    <a class="user-profile__sns--github" href="https://github.com/{{ $sns['github'] }}" target="_blank">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                    @endisset

                    @isset ($sns['qiita'])
                    <a class="user-profile__sns--qiita" href="https://qiita.com/{{ $sns['qiita'] }}" target="_blank">
                        <i class="fa fa-search fa-2x"></i>
                    </a>
                    @endisset

                    @isset ($user->web)
                    <a class="user-profile__sns--web" href="{{ $user->web }}" target="_blank">
                        <i class="fas fa-link fa-2x"></i>
                    </a>
                    @endisset
                </div>
                @endif
            </div>
        </div>

        @if (!empty($user->introduction))
        <div class="user-profile__introduction">
            <p>{{ $user->introduction }}</p>
        </div>
        @endif
    </div>
</div>