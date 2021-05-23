const state = {
  karteId: null,
  postId: null,
};

const getters = {
  karteId: (state) => state.karteId,
  postId: (state) => state.postId,
};

const mutations = {
  setKarte(state, data) {
    state.karteId = data;
  },
  clearKarte(state) {
    state.karteId = null;
  },
  setPost(state, data) {
    state.postId = data;
  },
  clearPost(state) {
    state.postId = null;
  },
};

const actions = {
  openKarte(context, data) {
    context.commit('setKarte', data);
  },
  closeKarte(context) {
    context.commit('clearKarte');
  },
  openPost(context, data) {
    context.commit('setPost', data);
  },
  closePost(context) {
    context.commit('clearPost');
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
