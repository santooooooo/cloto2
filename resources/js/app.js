/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require('vue');
window.API = require('./api');
window.Storage = require('./consts/storage');
const fabric = require('fabric').fabric;
window.Peer = require('skyway-js');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$http = window.axios;
Vue.prototype.$endpoint = window.API.getEndpoint;
Vue.prototype.$storage = window.Storage.getStoragePath;

/**
 * Vueコンポーネントの読み込み
 */
Vue.component('InputImage', require('./components/form/InputImage').default);

/**
 * Vueの定義
 */
import VueHead from 'vue-head';
import Chat from 'vue-beautiful-chat';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import App from './App.vue';

Vue.use(VueHead, {
  separator: '|',
  complement: 'CLOTO',
});
Vue.use(Chat);

const app = new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
});

/**
 * Vueのマウント
 */
(async function () {
  /** 前処理 */
  if (isRelease()) {
    await store.dispatch('auth/syncAuthUser');
  }

  /** マウント */
  app.$mount('#app');
})();

/**
 * app.js内で使用する関数
 */
function isRelease() {
  return process.env.MIX_APP_RELEASE === 'true' ? true : false;
}
