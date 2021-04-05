/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
require('fabric');
window.Vue = require('vue');
window.Peer = require('skyway-js');
window.FlowChat = require('./plugins/flow-chat');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$moment = require('moment');
Vue.prototype.$storage = require('./consts/storage').getStoragePath;
const functions = require('./plugins/functions');
Vue.prototype.$formatStr = functions.formatStr;
Vue.prototype.$slack = functions.slackPost;

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
import { VueMasonryPlugin } from 'vue-masonry';

Vue.use(VueWindowSizePlugin);
Vue.use(VueHead, {
  separator: '/',
  complement: process.env.MIX_APP_NAME,
});
Vue.use(VueDragscroll);
Vue.use(Chat);
Vue.use(VueMasonryPlugin);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
