/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require('vue');
window.API = require('./api');
window.Storage = require('@/consts/storage');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$http = window.axios;
Vue.prototype.$endpoint = window.API.getEndpoint;
Vue.prototype.$storage = window.Storage.getStoragePath;

/**
 * Vueコンポーネントの読み込み
 */
// Vue.component('InputImage', require('./components/form/InputImage').default);

/**
 * Vueの定義
 */
import VueHead from 'vue-head';
import Chat from 'vue-beautiful-chat';
import router from './router';
import store from './store';
import vuetify from '@/plugins/vuetify';
import App from './App.vue';

Vue.use(VueHead, {
  separator: '|',
  complement: '管理画面',
});

Vue.use(Chat);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
