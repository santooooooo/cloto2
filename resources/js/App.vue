<template>
  <v-app>
    <!-- 画面サイズの最小を設定 -->
    <v-overlay
      z-index="9999"
      opacity="0.9"
      v-if="!isDebug && !$route.meta.isPublic && width < minWidth"
    >
      <h1 class="font-weight-bold">ウィンドウを拡大してください。</h1>
    </v-overlay>

    <!-- オフライン時の操作無効化用オーバーレイ -->
    <v-overlay z-index="9999" opacity="0.9" v-if="isOffline">
      <h1 class="font-weight-bold">インターネットに接続してください。</h1>
    </v-overlay>

    <!-- アラート -->
    <v-alert
      :value="alert.show"
      :type="alert.type"
      dark
      dense
      dismissible
      transition="scale-transition"
    >
      {{ alert.message }}
      <template v-slot:close>
        <v-icon class="ml-2" @click="$store.dispatch('alert/hide')">mdi-close-circle</v-icon>
      </template>
    </v-alert>

    <!-- メッセージオーバーレイ-->
    <v-overlay
      z-index="9997"
      opacity="0.8"
      :value="alert.overlay.show"
      :color="alert.overlay.color"
      dark
    >
      <p class="overlay-message">{{ alert.overlay.message }}</p>
    </v-overlay>

    <!-- ヘッダー -->
    <Header @show-drawer="isShowDrawer = true" />

    <!-- ドロワーメニュー -->
    <Drawer v-model="isShowDrawer" @logout="logout" v-if="isRelease" />

    <!-- メイン -->
    <v-main id="main">
      <router-view />
    </v-main>

    <!-- フッター -->
    <Footer @logout="logout" />

    <!-- 問い合わせ -->
    <beautiful-chat
      :open="openChat"
      :close="closeChat"
      :onMessageWasSent="onMessageWasSent"
      :colors="chatColors"
      :isOpen="isChatOpen"
      :messageList="inquiries"
      :participants="chatParticipants"
      :showCloseButton="true"
      :showEmoji="true"
      :showHeader="true"
      :alwaysScrollToBottom="true"
      v-if="authCheck"
    >
      <template v-slot:user-avatar="{ message, user }">
        <div
          style="
            border-radius: 50%;
            color: pink;
            font-size: 15px;
            line-height: 25px;
            text-align: center;
            background: tomato;
            width: 25px !important;
            height: 25px !important;
            min-width: 30px;
            min-height: 30px;
            margin: 5px;
            font-weight: bold;
          "
          v-if="message.data.type === 'text' && user && user.name"
        >
          {{ user.name.toUpperCase()[0] }}
        </div>
      </template>
      <template v-slot:system-message-body="{ message }"> [System]: {{ message.text }} </template>
    </beautiful-chat>
  </v-app>
</template>

<script>
import Header from './Header';
import Drawer from './Drawer';
import Footer from './Footer';
import { UNAUTHORIZED, INTERNAL_SERVER_ERROR } from '@/consts/status';

export default {
  components: {
    Header,
    Drawer,
    Footer,
  },
  data() {
    return {
      chime: new Audio(this.$storage('system') + 'chime.mp3'), // チャイム音
      isOffline: false, // オフライン状態
      setOnlineTimer: null, // オンライン状態の通知制御
      width: window.innerWidth, // ウィンドウの横幅
      minWidth: 1350, // ウィンドウの最小サイズ
      isShowDrawer: false, // ドロワーメニューの表示制御
      inquiries: null, // 問い合わせ
      chatParticipants: [], // チャット参加者
      isChatOpen: false, // チャットモーダル制御
      chatColors: {
        // beautiful-chatの色設定
        header: {
          bg: '#D32F2F',
          text: '#fff',
        },
        launcher: {
          bg: '#D32F2F',
        },
        messageList: {
          bg: '#fff',
        },
        sentMessage: {
          bg: '#F44336',
          text: '#fff',
        },
        receivedMessage: {
          bg: '#eaeaea',
          text: '#222222',
        },
        userInput: {
          bg: '#fff',
          text: '#212121',
        },
      },
    };
  },
  computed: {
    isDebug() {
      return process.env.MIX_APP_DEBUG === 'true' ? true : false;
    },
    isRelease() {
      return process.env.MIX_APP_RELEASE === 'true' ? true : false;
    },
    alert() {
      return this.$store.state.alert;
    },
    authCheck() {
      return this.$store.getters['auth/check'];
    },
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    authCheck: function (val) {
      if (val) {
        // ログイン中は5分毎にオンライン状態を通知
        this.setOnlineTimer = setInterval(() => {
          this.$http.get(this.$endpoint('setOnline'));
        }, 300000);
      } else {
        // ログアウト時に停止
        clearInterval(this.setOnlineTimer);
      }
    },
    'authUser.seat': function (val, oldVal) {
      // 初回のデータ取得時には実行しない
      if (typeof oldVal !== 'undefined') {
        if (val !== null && oldVal === null) {
          /**
           * 着席時
           */
          // 時間割イベントの受信開始
          Echo.channel('room-' + val.section.room_id).listen('TimetableEvent', (event) => {
            if (event.status === 'study') {
              // 自習時間
              this.$store.dispatch('alert/showOverlay', {
                color: '#ff4500',
                message: '自習時間です！',
              });
              // チャイム
              if (this.$store.getters['alert/isSoundOn']) {
                this.chime.play();
              }
            } else if (event.status === 'break') {
              // 休憩時間
              this.$store.dispatch('alert/showOverlay', {
                color: '#4169e1',
                message: '休憩時間です！',
              });
              // チャイム
              if (this.$store.getters['alert/isSoundOn']) {
                this.chime.play();
              }
            }
          });
        } else if (val === null && oldVal !== null) {
          /**
           * 退席時
           */
          // 部屋イベントの受信終了
          Echo.leave('room-' + oldVal.section.room_id);
        }
      }
    },
  },
  methods: {
    onMessageWasSent(message) {
      console.log(message);
      var response = this.$http.post(this.$endpoint('POST:chatPost'), message);
      this.messageList = [...this.messageList, Object.assign({}, message, { id: Math.random() })];
      console.log('メッセージ送信');
    },
    openChat() {
      this.isChatOpen = true;
      console.log('チャットオープン');
      this.getInquiry();
    },
    closeChat() {
      this.isChatOpen = false;
      console.log('チャットクローズ');
    },

    /**
     * 問い合わせの取得
     */
    getInquiry: async function () {
      var response = await this.$http.get(this.$endpoint('inquiryIndex'));
      this.inquiries = response.data;
    },

    /**
     * ウィンドウリサイズ時のイベント
     */
    resizeEvent: function () {
      this.width = window.innerWidth;
    },

    /**
     * オフライン時のイベント
     */
    offlineEvent: function () {
      this.isOffline = true;

      if (this.authUser.seat !== null) {
        alert(
          'インターネットに接続してください。5分以上接続が復帰しない場合は自動的に退席します。'
        );
      }
    },

    /**
     * オンライン復帰時のイベント
     */
    onlineEvent: function () {
      if (this.authCheck) {
        // オンライン状態を通知
        this.$http.get(this.$endpoint('setOnline'));
      }

      this.isOffline = false;
    },

    /**
     * 戻るボタンの無効化
     */
    stopBackButtonEvent: function () {
      this.$store.dispatch('alert/show', {
        type: 'error',
        message: '戻るボタンでの操作は禁止されています。',
      });

      history.go(1);
    },

    /**
     * 戻るボタンでページに復帰した時のイベント
     *
     * @param event
     */
    pageBackEvent: function (event) {
      var historyTraversal =
        event.persisted ||
        (typeof window.performance != 'undefined' && window.performance.navigation.type === 2);
      if (historyTraversal) {
        // リロード（戻るボタンでアクセスすると休憩室に入室できない）
        window.location.reload();
      }
    },

    /**
     * ログアウト処理
     */
    logout: async function () {
      // ログアウト処理
      await this.$store.dispatch('auth/logout');

      // トップページへリダイレクト
      if (this.$route.path !== this.$router.resolve({ name: 'index' }).href) {
        this.$router.push({ name: 'index' });
      }
    },
  },
  mounted() {
    // ボリュームの調整
    this.chime.volume = 0.2;

    // オフライン時のイベント
    window.addEventListener('offline', this.offlineEvent);

    // オンライン復帰時のイベント
    window.addEventListener('online', this.onlineEvent);

    // ウィンドウリサイズ時のイベント
    window.addEventListener('resize', this.resizeEvent);

    // 戻るボタンの無効化
    history.pushState(null, null, location.href);
    window.addEventListener('popstate', this.stopBackButtonEvent);

    // 戻るボタンでページに復帰した時のイベント
    window.addEventListener('pageshow', (event) => {
      this.pageBackEvent(event);
    });

    // エラー発生時のイベント
    Vue.config.errorHandler = (err, vm, info) => {
      this.$store.dispatch('alert/show', {
        type: 'error',
        message: 'エラーが発生しました。再読み込みしてください。',
      });
    };

    // エラー発生時のイベント
    window.addEventListener('error', (event) => {
      this.$store.dispatch('alert/show', {
        type: 'error',
        message: 'エラーが発生しました。再読み込みしてください。',
      });
    });

    // エラー発生時のイベント
    window.addEventListener('unhandledrejection', (event) => {
      this.$store.dispatch('alert/show', {
        type: 'error',
        message: 'エラーが発生しました。再読み込みしてください。',
      });
    });
  },
};
</script>

<style lang="scss" scoped>
.v-alert {
  position: fixed;
  z-index: 9998;
  top: 15px;
  left: 50%;
  transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
}

.overlay-message {
  font-size: 100px;
}

#main {
  min-height: 100vh;
}
</style>
