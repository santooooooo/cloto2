const Storage = require('@/consts/storage').getStoragePath;

// 通知音
const onSound = new Audio(Storage('system') + 'notification_sound_on.mp3');
const offSound = new Audio(Storage('system') + 'notification_sound_off.mp3');
onSound.volume = 0.6;
offSound.volume = 0.6;

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
      clearTimeout(state.timeout);
    }
    state.timeout = null;
  },
  setOverlay(state, option) {
    state.overlay.color = option.color;
    state.overlay.message = option.message;
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
  switchSound(state) {
    if (state.isSoundOn) {
      offSound.play();
      state.isSoundOn = false;
    } else {
      onSound.play();
      state.isSoundOn = true;
    }
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
  showOverlay(context, option) {
    context.commit('clearOverlay');
    context.commit('setOverlay', option);
  },
  hideOverlay(context) {
    context.commit('clearOverlay');
  },
  switchSound(context) {
    context.commit('switchSound');
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
