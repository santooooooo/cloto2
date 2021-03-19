/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
require('fabric');
window.Vue = require('vue');
window.Peer = require('skyway-js');
window.Storage = require('./consts/storage');
window.Functions = require('./plugins/functions');
window.FlowChat = require('./plugins/flow-chat');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$storage = window.Storage.getStoragePath;
Vue.prototype.$formatStr = window.Functions.formatStr;
Vue.prototype.$slack = window.Functions.slackPost;

/**
 * Vueコンポーネントの読み込み
 */
Vue.component('ImageInput', require('./components/form/ImageInput').default);

/**
 * Vueの定義
 */
import App from './App.vue';
import router from './router';
import store from './store';
import vuetify from './plugins/vuetify';
import { VueWindowSizePlugin } from 'vue-window-size/option-api';
import VueHead from 'vue-head';
import VueDragscroll from 'vue-dragscroll';
import Chat from 'vue-beautiful-chat';

Vue.use(VueWindowSizePlugin);
Vue.use(VueHead, {
  separator: '/',
  complement: process.env.MIX_APP_NAME,
});
Vue.use(VueDragscroll);
Vue.use(Chat);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
