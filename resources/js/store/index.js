import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import auth from './auth';
import error from './error';

const store = new Vuex.Store({
  modules: {
    auth,
    error,
  },
});

export default store;
