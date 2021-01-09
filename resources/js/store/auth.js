import { OK, CREATED, UNPROCESSABLE_ENTITY } from '@/consts/status';

const state = {
  user: null,
  apiStatus: null,
  registerErrorMessages: null,
  loginErrorMessages: null,
};

const getters = {
  check: (state) => !!state.user,
  user: (state) => (state.user ? state.user : ''),
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
  },
  setRegisterErrorMessages(state, messages) {
    state.registerErrorMessages = messages;
  },
  setLoginErrorMessages(state, messages) {
    state.loginErrorMessages = messages;
  },
};

const actions = {
  async syncAuthUser(context) {
    // ログインユーザーの取得
    const response = await axios.get('/api/auth');
    const user = response.data || null;
    context.commit('setUser', user);
  },
  async register(context, data) {
    // 初期化
    context.commit('setApiStatus', null);

    // 登録リクエスト
    const response = await axios.post('/api/register', data);

    // 成功
    if (response.status === CREATED) {
      context.commit('setApiStatus', true);
      return false;
    }

    // エラー発生
    context.commit('setApiStatus', false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      // 入力値エラー発生
      context.commit('setRegisterErrorMessages', response.data.errors);
    } else {
      // その他のエラー発生
      context.commit('error/setCode', response.status, { root: true });
    }
  },
  async login(context, data) {
    // 初期化
    context.commit('setApiStatus', null);

    // ログインリクエスト
    const response = await axios.post('/api/login', data);

    // 成功
    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }

    // エラー発生
    context.commit('setApiStatus', false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      // 入力値エラー発生
      context.commit('setLoginErrorMessages', response.data.errors);
    } else {
      // その他のエラー発生
      context.commit('error/setCode', response.status, { root: true });
    }
  },
  async logout(context) {
    // 初期化
    context.commit('setApiStatus', null);

    // ログアウトリクエスト
    const response = await axios.post('/api/logout');

    // 成功
    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', null);
      return false;
    }

    // エラー発生
    context.commit('setApiStatus', false);
    context.commit('error/setCode', response.status, { root: true });
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
