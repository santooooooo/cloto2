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
Vue.prototype.$statusColor = functions.statusColor;
Vue.prototype.$slack = functions.slackPost;

/**
 * Vueコンポーネントの読み込み
 */
Vue.component('ProfileDialog', require('./components/commons/ProfileDialog').default);
Vue.component('KarteContainer', require('./components/commons/KarteContainer').default);
Vue.component('KarteDialog', require('./components/commons/KarteDialog').default);
Vue.component('PostDialog', require('./components/commons/PostDialog').default);
Vue.component('ImageInput', require('./components/commons/form/ImageInput').default);
Vue.component('ContentTable', require('./components/mystudy/docs/ContentTable').default);

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
import VueScrollTo from 'vue-scrollto';
import Chat from 'vue-beautiful-chat';
import VueMasonryWall from 'vue-masonry-wall';

Vue.use(VueWindowSizePlugin)
  .use(VueHead, {
    separator: '/',
    complement: process.env.MIX_APP_NAME,
  })
  .use(VueDragscroll)
  .use(VueScrollTo)
  .use(Chat)
  .use(VueMasonryWall);

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
