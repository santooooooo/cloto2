import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import alert from './alert';
import auth from './auth';
import dialog from './dialog';

const store = new Vuex.Store({
  modules: {
    alert,
    auth,
    dialog,
  },
});

export default store;
