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
Vue.component('vue-header', require('./components/layouts/vueHeader.vue').default);
Vue.component('vue-footer', require('./components/layouts/vueFooter.vue').default);
Vue.component('image-drop-upload', require('./components/form/imageDropUpload.vue').default);
Vue.component('profile', require('./components/user/profile.vue').default);


/**
 * Vueの定義
 */
import VueHead from 'vue-head';
import router from "./routes/router";

Vue.use(VueHead, {
    separator: '|',
    complement: 'CLOTO'
});

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            AuthUser: '', // ログインユーザー
        }
    },
    methods: {
        SyncAuthUser: function () { // ログインユーザーの同期
            this.$http.get(this.$endpoint('GET:AuthUser'))
                .then((response) => {
                    this.AuthUser = response.data;
                });
        },
        AuthCheck: function () { // ログインチェック
            if (typeof this.AuthUser.user_id === 'undefined') {
                return false;
            } else {
                return true;
            }
        }
    },
    mounted() {
        this.SyncAuthUser();
    },
    watch: {
        '$route': function (to, from) { // ページ遷移イベント
            if (to.path !== from.path) {
                // ログインユーザーの同期
                this.SyncAuthUser();
            }
        }
    }
});
