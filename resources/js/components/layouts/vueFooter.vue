<template>
  <footer class="footer">
    <div class="footer__logo row">
      <img :src="$storage('system') + 'logo-name.svg'" />
    </div>

    <div class="footer__site-map row text-center">
      <div class="col-md-6">
        <router-link class="footer__link" :to="{ name: 'home' }">
          <i class="fas fa-chevron-right"></i>
          <a href="#">トップ</a>
        </router-link>

        <span class="footer__link">
          <i class="fas fa-chevron-right"></i>
          <a href="#">ヘルプ</a>
        </span>
        <span class="footer__link">
          <i class="fas fa-chevron-right"></i>
          <a href="#">利用規約</a>
        </span>
      </div>

      <div class="col-md-6">
        <span class="footer__link">
          <a href="https://twitter.com/cloto_jp">
            <i class="fab fa-twitter fa-2x"></i>
          </a>
        </span>
        <span class="footer__link">
          <a href="mailto:info@cloto.jp">
            <i class="fas fa-envelope fa-2x"></i>
          </a>
        </span>
        <span class="footer__link">
          <a href="https://info.cloto.jp">
            <i class="fas fa-link fa-2x"></i>
          </a>
        </span>
      </div>
    </div>

    <div class="footer__copyright">
      <span>© 2020 CLOTO Team.</span>
    </div>
  </footer>
</template>

<script>
export default {};
</script>

<style>
</style>