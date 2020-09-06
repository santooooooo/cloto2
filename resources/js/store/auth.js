import { getEndpoint as $endpoint } from '@/api';
import { OK } from '@/consts/error';

const state = {
  user: null,
  apiStatus: null,
};

const getters = {
  check: state => !!state.user,
  user: state => (state.user ? state.user : ''),
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
  },
};

const actions = {
  async register(context, data) {
    const response = await axios.post($endpoint('POST:register'), data);
    context.commit('setUser', response.data);
  },
  async login(context, data) {
    // 初期化
    context.commit('setApiStatus', null);

    // ログインリクエスト
    const response = await axios
      .post($endpoint('POST:login'), data)
      .catch(err => err.response || err);

    // 成功
    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }

    // エラー発生
    context.commit('setApiStatus', false);
    context.commit('error/setCode', response.status, { root: true });
  },
  async logout(context) {
    const response = await axios.post($endpoint('POST:logout'));
    context.commit('setUser', null);
  },
  async authUser(context) {
    // ログインユーザーの取得
    const response = await axios.get($endpoint('GET:authUser'));
    const user = response.data || null;
    context.commit('setUser', user);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
