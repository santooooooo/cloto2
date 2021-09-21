const state = {
  username: null,
  karteId: null,
  postId: null,
  questionId: null,
};

const getters = {
  username: (state) => state.username,
  karteId: (state) => state.karteId,
  postId: (state) => state.postId,
  questionId: (state) => state.questionId,
};

const mutations = {
  setItem(state, data) {
    switch (data.type) {
      case 'user':
        state.username = data.username;
        break;

      case 'karte':
        state.karteId = data.id;
        break;

      case 'post':
        state.postId = data.id;
        break;

      case 'question':
        state.questionId = data.id;
        break;
    }
  },
  clearItem(state, data) {
    switch (data) {
      case 'user':
        state.username = null;
        break;

      case 'karte':
        state.karteId = null;
        break;

      case 'post':
        state.postId = null;
        break;

      case 'question':
        state.questionId = null;
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
