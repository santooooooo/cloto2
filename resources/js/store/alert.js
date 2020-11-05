const state = {
  show: false,
  type: null,
  message: null,
  timeout: null,
};

const mutations = {
  setAlert(state, option) {
    state.type = option.type;
    state.message = option.message;
    state.show = true;
    state.timeout = setTimeout(() => {
      state.show = false;
      state.timeout = null;
    }, 5000);
  },
  clearAlert(state) {
    state.show = false;
    if (state.timeout !== null) {
      clearInterval(state.timeout);
    }
    state.timeout = null;
  },
};

const actions = {
  show(context, option) {
    context.commit('clearAlert');
    context.commit('setAlert', option);
  },
  hide(context) {
    context.commit('clearAlert');
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
