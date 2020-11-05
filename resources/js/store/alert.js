const state = {
  show: false,
  type: null,
  message: null,
};

const mutations = {
  showAlert(state, option) {
    state.show = true;
    state.type = option.type;
    state.message = option.message;
  },
};

export default {
  state,
  mutations,
};
