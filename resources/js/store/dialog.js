const state = {
  karteId: null,
};

const getters = {
  karteId: (state) => state.karteId,
};

const mutations = {
  setKarte(state, data) {
    state.karteId = data;
  },
  clearKarte(state) {
    state.karteId = null;
  },
};

const actions = {
  openKarte(context, data) {
    context.commit('setKarte', data);
  },
  closeKarte(context) {
    context.commit('clearKarte');
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
