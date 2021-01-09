/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require('vue');
window.Storage = require('./consts/storage');
require('fabric');
window.Peer = require('skyway-js');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$http = window.axios;
Vue.prototype.$storage = window.Storage.getStoragePath;

/**
 * Vueコンポーネントの読み込み
 */
Vue.component('ImageInput', require('./components/form/ImageInput').default);

/**
 * Vueの定義
 */
import VueHead from 'vue-head';
import Chat from 'vue-beautiful-chat';
import VueDragscroll from 'vue-dragscroll';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import App from './App.vue';

Vue.use(VueHead, {
  separator: '/',
  complement: process.env.MIX_APP_NAME,
});

Vue.use(Chat);
Vue.use(VueDragscroll);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
