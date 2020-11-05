const state = {
  show: false,
  type: null,
  message: null,
};

const mutations = {
  show(state, option) {
    state.type = option.type;
    state.message = option.message;
    state.show = true;
  },
  hide(state) {
    state.show = false;
  },
};

export default {
  namespaced: true,
  state,
  mutations,
};
