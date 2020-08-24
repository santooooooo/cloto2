/**
 * 必要なライブラリの読み込み
 */
require('./bootstrap');
window.Vue = require("vue");
window.API = require('./routes/api');
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
Vue.component('image-upload-area', require('./components/form/imageDropUpload.vue').default);
Vue.component('profile', require('./components/user/profile.vue').default);


/**
 * Vueの定義
 */
import router from "./routes/router";

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            AuthUser: '',   // ログインユーザー
        }
    },
    mounted() {
        // ログインユーザーの取得
        this.$http.get(this.$endpoint('AuthUser'))
            .then((response) => {
                this.AuthUser = response.data;
            });
    }
});