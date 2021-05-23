const state = {
  karteId: null,
  postId: null,
};

const getters = {
  karteId: (state) => state.karteId,
  postId: (state) => state.postId,
};

const mutations = {
  setItem(state, data) {
    switch (data.type) {
      case 'karte':
        state.karteId = data.id;
        break;

      case 'post':
        state.postId = data.id;
        break;
    }
  },
  clearItem(state, data) {
    switch (data) {
      case 'karte':
        state.karteId = null;
        break;

      case 'post':
        state.postId = null;
        break;
    }
  },
};

const actions = {
  open(context, data) {
    context.commit('setItem', data);
  },
  close(context, data) {
    context.commit('clearItem', data);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
