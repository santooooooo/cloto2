import { ON_SOUND, OFF_SOUND } from '@/consts/sound';

const state = {
  show: false,
  type: null,
  message: null,
  timeout: null,
  overlay: {
    show: false,
    color: null,
    message: null,
    timeout: null,
  },
  isSoundOn: false,
};

const getters = {
  isSoundOn: (state) => state.isSoundOn,
};

const mutations = {
  setAlert(state, data) {
    state.type = data.type;
    state.message = data.message;
    state.show = true;
    state.timeout = setTimeout(() => {
      state.show = false;
      state.timeout = null;
    }, 5000);
  },
  clearAlert(state) {
    state.show = false;
    if (state.timeout !== null) {
      clearTimeout(state.timeout);
    }
    state.timeout = null;
  },
  setOverlay(state, data) {
    state.overlay.color = data.color;
    state.overlay.message = data.message;
    state.overlay.description = data.description || '';
    state.overlay.show = true;
    state.overlay.timeout = setTimeout(() => {
      state.overlay.show = false;
      state.overlay.timeout = null;
    }, 2000);
  },
  clearOverlay(state) {
    state.overlay.show = false;
    if (state.overlay.timeout !== null) {
      clearTimeout(state.overlay.timeout);
    }
    state.overlay.timeout = null;
  },
  switchSound(state, data) {
    if (data === null) {
      if (state.isSoundOn) {
        state.isSoundOn = false;
        OFF_SOUND.play();
      } else {
        state.isSoundOn = true;
        ON_SOUND.play();
      }
    } else {
      // 強制的に状態変更する場合（ログイン時など）
      state.isSoundOn = data.isOn;
      data.sound.play();
    }
  },
};

const actions = {
  success(context, message) {
    context.commit('clearAlert');
    context.commit('setAlert', {
      type: 'success',
      message: message || '処理が正常に終了しました。',
    });
  },
  error(context, message) {
    context.commit('clearAlert');
    context.commit('setAlert', {
      type: 'error',
      message: message || 'エラーが発生しました。再読み込みしてください。',
    });
  },
  show(context, data) {
    context.commit('clearAlert');
    context.commit('setAlert', data);
  },
  hide(context) {
    context.commit('clearAlert');
  },
  showOverlay(context, data) {
    context.commit('clearOverlay');
    context.commit('setOverlay', data);
  },
  hideOverlay(context) {
    context.commit('clearOverlay');
  },
  switchSound(context, data) {
    context.commit('switchSound', data || null);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
