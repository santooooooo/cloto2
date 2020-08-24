/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require("vue");
window.API = require('./routes/api');

/**
 * Vueプロトタイプの設定
 */
Vue.prototype.$http = window.axios;
Vue.prototype.$endpoint = window.API.getEndpoint;

/**
 * Vueコンポーネントの読み込み
 */
Vue.component('image-upload-area', require('./components/form/imageDropUpload.vue').default);
Vue.component('profile', require('./components/user/profile.vue').default);


/**
 * Vueの定義
 */
import router from "./routes/router";

const app = new Vue({
    el: '#app',
    router
});