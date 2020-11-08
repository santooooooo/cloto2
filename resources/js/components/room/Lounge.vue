<template>
  <v-overlay opacity="0.7" z-index="4">
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

    マイク:
    <select v-model="selectedAudio" @change="onChange">
      <option disabled value="">Please select one</option>
      <option
        v-for="(audioDevice, index) in audioDevices"
        v-bind:key="index"
        :value="audioDevice.value"
      >
        {{ audioDevice.text }}
      </option>
    </select>

    カメラ:
    <select v-model="selectedVideo" @change="onChange">
      <option
        v-for="(videoDevice, index) in videoDevices"
        v-bind:key="index"
        :value="videoDevice.value"
      >
        {{ videoDevice.text }}
      </option>
    </select>

    <v-btn @click="shareDisplay()">画面共有</v-btn>
    <video id="my-display" width="500" height="500" muted="true" autoplay playsinline></video>

    <!-- <v-row justify="start"> aaaaaa </v-row> -->
    <v-container fluid id="lounge">
      <!-- <v-flex md9 class="videosContainer"> -->
      <v-row>
        <!-- <v-avatar size="200" @click="showProfile()"> -->
        <video id="my-video" width="500" height="500" muted="true" autoplay playsinline></video>
        <!-- </v-avatar> -->
        <!-- <v-avatar
          size="200"
          v-for="participant in participants"
          :key="participant.peerId"
          @click="showProfile()"
        > -->
        <video
          width="500"
          height="500"
          v-for="participant in participants"
          :key="participant.peerId"
          autoplay
          :srcObject.prop="participant"
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
  </v-overlay>
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
      selectedAudio: '',
      selectedVideo: '',
      peerId: '',
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
      this.chatArea.addEventListener('scroll', this.scrollEvent);
    },

    /**
     * 休憩室から退室
     */
    leaveLounge: function () {
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

    onChange: function () {
      if (this.selectedAudio != '' && this.selectedVideo != '') {
        this.connectLocalCamera();
      }
    },

    connectLocalCamera: async function () {
      const constraints = {
        audio: this.selectedAudio ? { deviceId: { exact: this.selectedAudio } } : false,
        video: this.selectedVideo ? { deviceId: { exact: this.selectedVideo } } : false,
      };

      const userStream = await navigator.mediaDevices.getUserMedia(constraints);
      document.getElementById('my-video').srcObject = userStream;

      // 通話開始
      this.makeCall(userStream);
    },

    shareDisplay: async function () {
      const displayStream = await navigator.mediaDevices.getDisplayMedia({
        video: true,
      });

      document.getElementById('my-display').srcObject = displayStream;

      // 通話開始
      this.makeCall(displayStream);
    },

    makeCall: function (stream) {
      //   const call = this.peer.call(this.calltoid, this.localStream);
      const call = this.peer.joinRoom(this.loungeId, {
        mode: 'sfu',
        stream: stream,
      });
      this.setupCallEventHandlers(call);
    },

    setupCallEventHandlers: function (call) {
      // if (existingCall) {
      //   existingCall.close();
      // }

      // existingCall = call;
      // setupEndCallUI();
      // $('#room-id').text(call.name);

      call.on('stream', (stream) => {
        this.addVideo(stream);
      });

      call.on('removeStream', (stream) => {
        this.removeVideo(stream.peerId);
      });

      call.on('peerLeave', (peerId) => {
        this.removeVideo(peerId);
      });

      call.on('close', () => {
        // this.removeAllRemoteVideos();
        // setupMakeCallUI();
      });
    },
    addVideo: function (stream) {
      this.participants.push(stream);
    },
    removeVideo: function (peerId) {
      this.participants = this.participants.filter((participant) => {
        // 退出したユーザーのpeerId以外を残す
        return participant.peerId !== peerId;
      });
    },
  },

  async created() {
    console.log(API_KEY);
    this.peer = new Peer({ key: API_KEY }); //新規にPeerオブジェクトの作成
    // this.peer = new Peer({ key: API_KEY, debug: 3 }); //新規にPeerオブジェクトの作成
    // this.peer.on('open', () => (this.peerId = this.peer.id)); //PeerIDを反映
    // this.peer.on("call", (call) => {
    //   // call.answer(this.localStream);
    //   // this.connect(call);
    //   call.on("stream", function (stream) {
    //     console.log("here");
    //     addVideo(stream);
    //   });
    //   call.on("peerLeave", function (peerId) {
    //     removeVideo(peerId);
    //   });
    //   call.on("close", function () {
    //     removeAllRemoteVideos();
    //     setupMakeCallUI();
    //   });
    // });
    //デバイスへのアクセス
    await navigator.mediaDevices.getUserMedia({ audio: true, video: true });
    const devices = await navigator.mediaDevices.enumerateDevices();

    //オーディオデバイスの情報を取得
    devices
      .filter((device) => device.kind === 'audioinput')
      .map((audio) =>
        this.audioDevices.push({
          text: audio.label || `Microphone ${this.audioDevices.length + 1}`,
          value: audio.deviceId,
        })
      );

    //カメラの情報を取得
    devices
      .filter((device) => device.kind === 'videoinput')
      .map((video) =>
        this.videoDevices.push({
          text: video.label || `Camera  ${this.videoDevices.length - 1}`,
          value: video.deviceId,
        })
      );

    this.selectedAudio = this.audioDevices[0].value;
    this.selectedVideo = this.videoDevices[0].value;
    console.log(this.audioDevices, this.videoDevices);
    this.connectLocalCamera();
    // console.log(deviceInfos);
    // this.makeCall();
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
  display: none;
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
