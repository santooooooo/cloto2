<template>
  <!-- <v-overlay opacity="0.7" z-index="4"> -->
  <!-- 新着メッセージ通知 -->
  <!-- <v-row
      justify="center"
      class="mb-3"
      :style="{ visibility: notification ? 'visible' : 'hidden' }"
    >
      <a @click="scrollToBottom()">
        <v-badge inline :value="true" color="red" content="↓ 新着メッセージ"></v-badge>
      </a>
    </v-row> -->

  <!-- <v-container ma-0 pa-0 fluid> -->
  <!-- <div class="videosContainer">
        <video id="myStream" autoplay muted="true"></video>
      </div> -->
  <!-- <video id="their-video" width="200" autoplay playsinline></video> -->
  <v-container fluid id="lounge">
    <div>
      <p class="messages" id="js-messages" v-for="message in messages" :key="message.id">
        {{ message }}
      </p>
      <v-text-field v-model="localText" solo rounded class="pa-2"></v-text-field>
      <button id="js-send-trigger" @click="onClickSend()">Send</button>
    </div>

    マイク:
    <select v-model="selectedAudio" @change="changeDevice()">
      <option
        v-for="audioDevice in audioDevices"
        :key="audioDevice.deviceId"
        :value="audioDevice.deviceId"
      >
        {{ audioDevice.label }}
      </option>
    </select>

    カメラ:
    <select v-model="selectedVideo" @change="changeDevice()">
      <option
        v-for="videoDevice in videoDevices"
        :key="videoDevice.deviceId"
        :value="videoDevice.deviceId"
      >
        {{ videoDevice.label }}
      </option>
    </select>

    <v-btn @click="mute()">ミュート</v-btn>
    <v-btn @click="videoOff()">ビデオオフ</v-btn>

    <v-btn @click="startShareDisplay()">画面共有</v-btn>
    <v-btn @click="stopShareDisplay()">画面共有停止</v-btn>
    <video id="my-shareDisplay" width="300" height="300" muted="true" autoplay playsinline></video>

    <!-- <v-row justify="start"> aaaaaa </v-row> -->
    <!-- <v-flex md9 class="videosContainer"> -->
    <v-row>
      <!-- <v-avatar size="200" @click="showProfile()"> -->
      <video
        width="800"
        height="800"
        v-for="participant in participants"
        :key="participant.peerId"
        autoplay
        :srcObject.prop="participant"
      ></video>
      <!-- </v-avatar> -->
      <!-- <v-avatar
          size="200"
          v-for="participant in participants"
          :key="participant.peerId"
          @click="showProfile()"
        > -->
      <video
        width="800"
        height="800"
        autoplay
        :srcObject.prop="localStream"
        v-if="localStream && !isVideoOff"
      ></video>
      <v-img height="800" width="800" src="https://picsum.photos/id/11/500/300" v-else></v-img>

      <video
        width="800"
        height="800"
        autoplay
        :srcObject.prop="shareDisplay.localStream"
        v-if="shareDisplay.localStream"
      ></video>
      <!-- </v-avatar> -->
      <!-- </v-flex> -->
    </v-row>
    <!-- <v-flex md3> -->
    <!-- チャット -->
    <!-- <beautiful-chat
          :open="enterLounge"
          :close="leaveLounge"
          :onMessageWasSent="onMessageWasSent"
          :colors="chatColors"
          :isOpen="isLoungeEnter"
          :messageList="messageList"
          :participants="chatParticipants"
          :showEmoji="true"
          :showHeader="false"
        >
          <template v-slot:user-avatar="{ message, user }">
            <div v-if="message.data.type === 'text' && user && user.name">
              {{ user.name.toUpperCase()[0] }}
            </div>
          </template>
        </beautiful-chat> -->

    <v-btn fixed dark bottom right x-large color="error" class="ma-10" @click="leaveLounge()">
      自習室に戻る
    </v-btn>

    <!-- プロフィールダイアログ -->
    <ProfileDialog
      :user-id="profileUserId"
      @close="profileDialog = $event"
      v-if="profileDialog"
    ></ProfileDialog>
    <!-- </v-container> -->
    <!-- </v-flex> -->
  </v-container>
  <!-- </v-overlay> -->
</template>

<script>
import ProfileDialog from '@/components/room/ProfileDialog';

const API_KEY = '2e332f2b-d951-499d-bc1a-451f4aeaf7b1';

export default {
  components: {
    ProfileDialog,
  },
  props: {
    loungeId: String,
  },
  data() {
    return {
      chatArea: '', // チャットエリア
      syncTimer: null, // 同期制御
      chatParticipants: [], // チャット参加者
      messageList: [], // メッセージデータ
      notification: false, // 新着通知
      isLoungeEnter: false, // チャットのダイアログ制御
      profileDialog: false, // プロフィールのダイアログ制御
      profileUserId: null, // プロフィールを表示するユーザーID

      chatColors: {
        // beautiful-chatの色設定
        messageList: {
          bg: '#ffffff',
        },
        sentMessage: {
          bg: '#f6bf00',
          text: '#000000',
        },
        receivedMessage: {
          bg: '#696969',
          text: '#ffffff',
        },
        userInput: {
          bg: '#ffffff',
          text: '#212121',
        },

        // 以下は使用しないが定義上必要
        header: {
          bg: '',
          text: '',
        },
        launcher: {
          bg: '',
        },
      },

      participants: [],
      audioDevices: [],
      videoDevices: [],
      peer: null,
      localStream: null,
      call: null,
      selectedAudio: null,
      selectedVideo: null,
      isMute: false,
      isVideoOff: false,
      shareDisplay: {
        peer: null,
        localStream: null,
      },
      localText: '',
      messages: [],
    };
  },
  computed: {
    leftSide() {
      return this.chatParticipants.filter((participant, index) => {
        return index % 2 === 0;
      });
    },
    rightSide() {
      return this.chatParticipants.filter((participant, index) => {
        return index % 2 === 1;
      });
    },
  },
  watch: {
    /**
     * メッセージ追加時
     */
    'messageList.length': function () {
      if (!this.isBottom()) {
        this.notification = true;
      }
    },
  },
  methods: {
    /**
     * 末尾までスクロールされているか
     */
    isBottom() {
      return this.chatArea.scrollTop === this.chatArea.scrollHeight - this.chatArea.clientHeight
        ? true
        : false;
    },

    /**
     * スクロールイベント
     */
    scrollEvent: function () {
      // 末尾に達したら通知を削除
      if (this.isBottom()) {
        this.notification = false;
      }
    },

    /**
     * チャットを末尾までスクロール
     */
    scrollToBottom: function () {
      this.chatArea.scrollTop = this.chatArea.scrollHeight;
    },

    /**
     * 休憩室データの取得
     *
     * @param Number  loungeId   入室している休憩室ID
     */
    getLounge: async function (loungeId) {
      var response = await this.$http.get(this.$endpoint('chatShow', [loungeId]));
      this.chatParticipants = response.data.chatParticipants;
      this.messageList = response.data.messageList;
    },

    /**
     * 休憩室へ入室
     */
    enterLounge: function () {
      this.isLoungeEnter = true;

      // スクロールイベントの設定
      this.chatArea = document.getElementsByClassName('sc-message-list')[0];
      // this.chatArea.addEventListener('scroll', this.scrollEvent);
    },

    /**
     * 休憩室から退室
     */
    leaveLounge: function () {
      this.exitCall();

      this.isLoungeEnter = false;

      this.$emit('leave-lounge');

      // 同期停止
      clearInterval(this.syncTimer);
      this.syncTimer = null;
    },

    /**
     * メッセージの送信
     */
    onMessageWasSent: function (message) {
      this.$http.post(this.$endpoint('chatPost'), message);

      // 一時的に描画するためリストへ追加
      this.messageList = [...this.messageList, Object.assign({}, message, { id: Math.random() })];
    },

    /**
     * プロフィールの表示
     *
     * @param Number  userId   プロフィールを表示するユーザーID
     */
    showProfile: function (userId) {
      this.profileUserId = userId;
      this.profileDialog = true;
    },

    /**
     * 通話デバイスへのアクセス
     */
    accessDevice: async function () {
      // デバイスへのアクセス可能にするためにgetUserMediaを実行
      await navigator.mediaDevices.getUserMedia({ audio: true, video: true });
      const devices = await navigator.mediaDevices.enumerateDevices();

      // オーディオデバイスの情報を取得
      this.audioDevices = devices.filter((device) => {
        return device.kind === 'audioinput';
      });

      // カメラの情報を取得
      this.videoDevices = devices.filter((device) => {
        return device.kind === 'videoinput';
      });

      this.selectedAudio = this.audioDevices[0].deviceId;
      this.selectedVideo = this.videoDevices[0].deviceId;
    },

    /**
     * 通話デバイスへの接続
     */
    connectDevice: async function () {
      const constraints = {
        audio: this.selectedAudio ? { deviceId: { exact: this.selectedAudio } } : false,
        video: this.selectedVideo ? { deviceId: { exact: this.selectedVideo } } : false,
      };

      this.localStream = await navigator.mediaDevices.getUserMedia(constraints);
    },

    /**
     * 通話デバイスの切り替え
     */
    changeDevice: async function () {
      await this.connectDevice();
      // ストリームの置き換え
      this.call.replaceStream(this.localStream);
    },

    /**
     * ミュートの切り替え
     */
    mute: function () {
      const audioTrack = this.localStream.getAudioTracks()[0];
      this.isMute = !this.isMute;
      audioTrack.enabled = !this.isMute;

      // ストリームの置き換え
      this.call.replaceStream(this.localStream);
    },

    /**
     * ビデオのオン/オフ切り替え
     */
    videoOff: function () {
      const videoTrack = this.localStream.getVideoTracks()[0];
      this.isVideoOff = !this.isVideoOff;
      videoTrack.enabled = !this.isVideoOff;

      // ストリームの置き換え
      this.call.replaceStream(this.localStream);
    },

    /**
     * 通話の開始
     */
    makeCall: async function () {
      this.call = this.peer.joinRoom(this.loungeId, {
        mode: 'sfu',
        stream: this.localStream,
      });

      this.setupCallEvents();
    },

    /**
     * 通話のイベント
     */
    setupCallEvents: function () {
      this.call.once('open', () => {
        this.messages.push('=== You joined ===');
      });

      this.call.on('peerJoin', (peerId) => {
        this.messages.push(`=== ${peerId} joined ===`);
      });

      this.call.on('stream', (stream) => {
        // ビデオなどreplaceStreamでは，ここが発火する．
        // streamの中身で分岐できるかを確認する必要あり．
        // 別ピアーで接続するため，画面共有も他人扱いされる
        // そのため，自分の画面共有のストリームは除外
        if (stream.id !== this.shareDisplay.localStream.id) {
          this.joinUser(stream);
        }
      });

      this.call.on('data', ({ data, src }) => {
        // Show a message sent to the room and who sent
        this.messages.push(`${src}: ${data}`);
      });

      this.call.on('removeStream', (stream) => {
        this.leaveUser(stream.peerId);
      });

      this.call.on('peerLeave', (peerId) => {
        this.leaveUser(peerId);
      });

      this.call.on('close', () => {
        // this.removeAllRemoteVideos();
        // setupMakeCallUI();
      });
    },

    /**
     * 通話の終了
     */
    exitCall: async function () {
      // 画面共有の停止
      await this.stopShareDisplay();

      if (this.peer !== null) {
        // デバイスの使用を停止
        this.localStream.getTracks().forEach((track) => track.stop());
        this.localStream = null;

        // 通話の接続を終了
        this.peer.disconnect();
        this.peer = null;
      }
    },

    /**
     * 参加者の追加
     */
    joinUser: function (stream) {
      this.participants.push(stream);
    },

    /**
     * 参加者の退出
     */
    leaveUser: function (peerId) {
      this.participants = this.participants.filter((participant) => {
        // 退出したユーザーのpeerId以外を残す
        return participant.peerId !== peerId;
      });
    },

    /**
     * 画面共有開始
     */
    startShareDisplay: async function () {
      if (this.shareDisplay.peer === null) {
        this.shareDisplay.peer = new Peer({ key: API_KEY });

        this.shareDisplay.localStream = await navigator.mediaDevices.getDisplayMedia({
          video: true,
          audio: false,
        });

        this.shareDisplay.peer.joinRoom(this.loungeId, {
          mode: 'sfu',
          stream: this.shareDisplay.localStream,
        });
      }
    },

    /**
     * 画面共有停止
     */
    stopShareDisplay: async function () {
      if (this.shareDisplay.peer !== null) {
        // デバイスの画面共有を停止
        this.shareDisplay.localStream.getTracks().forEach((track) => track.stop());
        this.shareDisplay.localStream = null;

        // 画面共有用の接続を終了
        this.shareDisplay.peer.disconnect();
        this.shareDisplay.peer = null;
      }
    },

    onClickSend: function () {
      this.call.send(this.localText);

      this.messages.push(`${this.peer.id}: ${this.localText}`);
      this.localText = '';

      console.log(this.messages);
    },
  },

  async created() {
    this.peer = new Peer({ key: API_KEY });
    // this.peer = new Peer({ key: API_KEY, debug: 3 });

    await this.accessDevice();
    await this.connectDevice();
    this.makeCall();
  },

  async mounted() {
    // 初回取得
    await this.getLounge(this.loungeId);
    this.enterLounge();
    // // 同期開始
    // this.syncTimer = setInterval(() => {
    //   this.getLounge(this.loungeId);
    // }, 3000);
  },
  destroyed() {
    // 念の為
    this.exitCall();

    // 休憩室退出時にはタイマーを解除
    if (this.syncTimer !== null) {
      clearInterval(this.syncTimer);
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.v-avatar {
  cursor: pointer;

  &__spacer {
    cursor: default;
  }
}

#lounge {
  width: 100vw;
  max-width: 100%;
}
</style>

<style lang="scss">
/* beautiful-chatのスタイル */
.sc-launcher {
  // チャットオープンアイコンの無効化
  // sharedisplay: none;
}

// .sc-chat-window {
//   // チャットの中央寄せ
//   position: static !important;

//   width: 60vw !important;

//   .sc-user-input {
//     border-bottom-left-radius: 0;
//     border-bottom-right-radius: 0;
//   }

//   .sc-message-list {
//     padding-left: 10px;

//     // hover時のみスクロールバーを表示
//     overflow-y: hidden;
//     padding-right: 10px;
//     &:hover {
//       overflow-y: scroll;
//       padding-right: 0;
//     }

//     .sc-message {
//       width: 90%;
//     }
//   }
// }
</style>
