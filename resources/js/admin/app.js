/**
 * 必要なライブラリの読み込み
 */
require('@/bootstrap');
window.Vue = require('vue');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$moment = require('moment');
Vue.prototype.$storage = require('@/consts/storage').getStoragePath;
const functions = require('@/plugins/functions');
Vue.prototype.$formatStr = functions.formatStr;

/**
 * Vueの定義
 */
import App from './App.vue';
import router from './router';
import store from './store';
import vuetify from '@/plugins/vuetify';
import VueHead from 'vue-head';
import Chat from 'vue-beautiful-chat';

Vue.use(VueHead, {
  separator: '|',
  complement: '管理画面',
}).use(Chat);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
