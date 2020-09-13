<template>
  <footer class="footer">
    <div class="footer__logo row">
      <img :src="$storage('system') + 'logo-name.svg'" />
    </div>

    <div class="footer__site-map row text-center">
      <div class="col-md-6">
        <span class="footer__link">
          <i class="fas fa-chevron-right"></i>
          <router-link :to="{ name: 'index' }">トップ</router-link>
        </span>

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
          <a href="https://twitter.com/cloto_jp" target="_blank">
            <i class="fab fa-twitter fa-2x"></i>
          </a>
        </span>
        <span class="footer__link">
          <a href="mailto:info@cloto.jp">
            <i class="fas fa-envelope fa-2x"></i>
          </a>
        </span>
        <span class="footer__link">
          <a href="#" target="_blank">
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

<style lang="scss" scoped>
@import '~/_variables';

.footer {
  width: 100%;
  padding: 20px;
  background-color: $primary;
  color: $white;

  &__logo {
    margin: 0;

    img {
      max-width: 200px;
      height: auto;
    }
  }

  &__site-map {
    margin: 0;
    padding: 40px 0;
  }

  &__link {
    margin: 0 10px;

    a {
      color: $white;

      &:hover {
        color: $gray;
      }
    }
  }

  &__copyright {
    text-align: center;
  }
}
</style>
