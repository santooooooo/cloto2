import Vue from 'vue';
import Vuetify from 'vuetify';
Vue.use(Vuetify);

import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

const vuetify = new Vuetify({
  icons: {
    iconfont: 'mdi',
  },
});

export default vuetify;
