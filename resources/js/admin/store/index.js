import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import alert from './alert';
import auth from './auth';

const store = new Vuex.Store({
  modules: {
    alert,
    auth,
  },
});

export default store;
