/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require("vue");


/**
 * Vueコンポーネントの読み込み
 */
Vue.component('image-upload-area', require('./components/form/imageDropUpload.vue').default);


/**
 * Vueの定義
 */
import router from "./router";

const app = new Vue({
    el: '#app',
    router: router
});