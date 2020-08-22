<footer class="footer">
    <div class="footer__logo row">
        <img src="/storage/web/logo-name.svg">
    </div>

    <div class="footer__site-map row text-center">
        <div class="col-md-6">
            <span class="footer__link"><i class="fas fa-chevron-right"></i> <a
                    href="{{ route('index') }}">トップ</a></span>

            @auth
            <span class="footer__link"><i class="fas fa-chevron-right"></i> <a
                    href="{{ route('user_page', ['username' => Auth::user()->username]) }}">マイページ</a></span>
            <span class="footer__link"><i class="fas fa-chevron-right"></i> <a
                    href="{{ route('course_all') }}">コース一覧</a></span>
            @endauth

            <span class="footer__link"><i class="fas fa-chevron-right"></i> <a href="#">ヘルプ</a></span>
            <span class="footer__link"><i class="fas fa-chevron-right"></i> <a href="#">利用規約</a></span>
        </div>

        <div class="col-md-6">
            <span class="footer__link"><a href="https://twitter.com/CLOTO_JP">
                    <i class="fab fa-twitter fa-2x"></i>
                </a></span>
            <span class="footer__link"><a href="mailto:info@cloto.jp"><i class="fas fa-envelope fa-2x"></i></a></span>
            <span class="footer__link"><a href="https://info.cloto.jp"><i class="fas fa-link fa-2x"></i></a></span>
        </div>
    </div>

    <div class="footer__copyright">
        <span>© 2020 CLOTO Team.</span>
    </div>
</footer>
