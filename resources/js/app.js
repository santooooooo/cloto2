/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require('vue');
window.API = require('./api');
window.Storage = require('./consts/storage');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$http = window.axios;
Vue.prototype.$csrf = window.Laravel.csrfToken;
Vue.prototype.$endpoint = window.API.getEndpoint;
Vue.prototype.$storage = window.Storage.getStoragePath;

/**
 * Vueコンポーネントの読み込み
 */
Vue.component('vue-header', require('./components/layouts/VueHeader.vue').default);
Vue.component('vue-footer', require('./components/layouts/VueFooter.vue').default);
Vue.component('image-drop-upload', require('./components/form/ImageDropUpload.vue').default);
Vue.component('profile', require('./components/user/Profile.vue').default);

/**
 * Vueの定義
 */
import VueHead from 'vue-head';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';

Vue.use(VueHead, {
  separator: '|',
  complement: 'CLOTO',
});

const app = new Vue({
  router,
  store,
  vuetify,
  data() {
    return {
      AuthUser: '', // ログインユーザー
    };
  },
  methods: {
    SyncAuthUser: function() {
      // ログインユーザーの同期
      this.$http.get(this.$endpoint('GET:AuthUser')).then(response => {
        this.AuthUser = response.data;
        if (typeof this.AuthUser.sns !== 'undefined') {
          this.AuthUser.sns = JSON.parse(this.AuthUser.sns);
        }
      });
    },
    AuthCheck: function() {
      // ログインチェック
      if (typeof this.AuthUser.user_id === 'undefined') {
        return false;
      } else {
        return true;
      }
    },
  },
  async created() {
    // ログインユーザーの初回同期
    var response = await this.$http.get(this.$endpoint('GET:AuthUser'));
    this.AuthUser = response.data;
    if (typeof this.AuthUser.sns !== 'undefined') {
      this.AuthUser.sns = JSON.parse(this.AuthUser.sns);
    }
    // 同期完了後にマウント
    this.$mount('#app');
  },
  watch: {
    $route: function(to, from) {
      // ページ遷移イベント
      if (to.path !== from.path) {
        // ログインユーザーの同期
        this.SyncAuthUser();
      }
    },
  },
});
