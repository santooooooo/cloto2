<template>
  <v-dialog v-model="isLoungeEnter" fullscreen transition="dialog-bottom-transition">
    <v-layout class="px-2">
      <v-flex>
        <v-container fluid>
          <v-row justify="center">
            <div class="video-container" v-if="localStream && !isVideoOff" style="height: 117px">
              <video width="208" height="117" autoplay :srcObject.prop="localStream"></video>

              <small>{{ authUser.username }}</small>
            </div>

            <div class="video-container" v-else>
              <v-sheet
                color="black"
                width="208"
                height="117"
                class="d-flex justify-center align-center"
              >
                <v-avatar size="50" class="aligh-self-center"
                  ><img :src="$storage('icon') + authUser.icon"
                /></v-avatar>
              </v-sheet>

              <small>{{ authUser.username }}</small>
            </div>

            <video
              width="208"
              height="117"
              autoplay
              :srcObject.prop="shareDisplay.localStream"
              class="ml-10"
              v-if="shareDisplay.localStream"
            ></video>
          </v-row>

          <video
            id="my-shareDisplay"
            width="300"
            height="300"
            muted="true"
            autoplay
            playsinline
          ></video>

          <v-row>
            <video
              width="800"
              height="800"
              v-for="participant in participants"
              :key="participant.peerId"
              autoplay
              :srcObject.prop="participant"
            ></video>

            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
            <v-sheet
              color="black"
              width="208"
              height="208"
              class="d-flex justify-center align-center"
            >
              <v-avatar size="50" class="aligh-self-center"
                ><img :src="$storage('icon') + authUser.icon"
              /></v-avatar>
            </v-sheet>
          </v-row>

          <!-- プロフィールダイアログ -->
          <ProfileDialog
            :user-id="profileUserId"
            @close="profileDialog = $event"
            v-if="profileDialog"
          ></ProfileDialog>
        </v-container>
      </v-flex>

      <!-- チャットエリア -->
      <v-flex v-show="isShowChat">
        <v-card color="grey lighten-2" class="mx-auto" width="400" id="chat">
          <v-card flat class="overflow-y-auto" height="600">
            <v-card-text v-for="message in messages" :key="message.id">
              {{ message }}
            </v-card-text>
          </v-card>

          <v-card-actions>
            <v-textarea
              v-model="localText"
              rows="1"
              class="px-2"
              label="メッセージを送ろう！"
            ></v-textarea>
            <v-btn icon @click="onClickSend()">
              <v-icon>mdi-send</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>

      <!-- 通話終了ボタン -->
      <v-btn fixed dark bottom right x-large color="error" class="ma-10" @click="leaveLounge()">
        自習室に戻る
      </v-btn>
    </v-layout>

    <v-app-bar color="yellow darken-4" fixed bottom height="100">
      <!-- メニューボタン -->
      <v-btn color="white" icon class="ml-10" @click="isShowMenu = true">
        <v-icon large>mdi-menu</v-icon>
      </v-btn>

      <v-spacer></v-spacer>

      <!-- ミュートボタン -->
      <v-btn :color="!isMute ? 'white' : 'red'" fab depressed large class="mx-10" @click="mute()">
        <v-icon large>{{ !isMute ? 'mdi-microphone' : 'mdi-microphone-off' }}</v-icon>
      </v-btn>

      <!-- ビデオオフボタン -->
      <v-btn
        :color="!isVideoOff ? 'white' : 'red'"
        fab
        depressed
        large
        class="mx-10"
        @click="videoOff()"
      >
        <v-icon large>{{ !isVideoOff ? 'mdi-video' : 'mdi-video-off' }}</v-icon>
      </v-btn>

      <!-- 画面共有ボタン -->
      <v-btn
        :color="!shareDisplay.localStream ? 'white' : 'red'"
        fab
        depressed
        large
        class="mx-10"
        @click="!shareDisplay.localStream ? startShareDisplay() : stopShareDisplay()"
      >
        <v-icon large>{{
          !shareDisplay.localStream ? 'mdi-window-restore' : 'mdi-window-close'
        }}</v-icon>
      </v-btn>

      <v-spacer></v-spacer>

      <!-- チャットボタン -->
      <v-btn color="white" icon class="mr-10" @click="isShowChat = !isShowChat">
        <v-icon large>mdi-message-text</v-icon>
      </v-btn>
    </v-app-bar>

    <!-- デバイス選択メニュー -->
    <v-dialog v-model="isShowMenu" persistent max-width="600">
      <v-card color="grey darken-1" dark>
        <v-container>
          <v-row justify="end">
            <v-btn fab x-small depressed color="error" class="mr-4" @click="isShowMenu = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-list-item>
            <v-list-item-content>
              マイク:
              <v-select
                v-model="selectedAudio"
                :items="audioDevices"
                item-value="deviceId"
                item-text="label"
                @change="changeDevice()"
              >
              </v-select>
            </v-list-item-content>
          </v-list-item>

          <v-list-item>
            <v-list-item-content>
              ビデオ:
              <v-select
                v-model="selectedVideo"
                :items="videoDevices"
                item-value="deviceId"
                item-text="label"
                @change="changeDevice()"
              >
              </v-select>
            </v-list-item-content>
          </v-list-item>
        </v-container>
      </v-card>
    </v-dialog>
  </v-dialog>
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
      videoSize: {
        width: 640,
        height: 360,
      },
      peer: null,
      localStream: null,
      call: null,
      selectedAudio: null,
      selectedVideo: null,
      isMute: false, // ミュート制御
      isVideoOff: false, // ビデオオフ制御
      isShowChat: false, // チャットエリア表示制御
      isShowMenu: false, // デバイス選択メニュー表示制御
      shareDisplay: {
        peer: null,
        localStream: null,
      },
      localText: '', // 送信するメッセージ
      messages: [], // メッセージ一覧
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
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
      var constraints = {
        audio: this.selectedAudio ? { deviceId: { exact: this.selectedAudio } } : false,
        video: this.selectedVideo ? { deviceId: { exact: this.selectedVideo } } : false,
      };

      // 録画サイズの設定
      constraints.video.width = {
        min: this.videoSize.width,
        max: this.videoSize.width,
      };
      constraints.video.height = {
        min: this.videoSize.height,
        max: this.videoSize.height,
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
      // メッセージの送信
      this.call.send(this.localText);

      // 自分の画面を更新
      this.messages.push(`${this.peer.id}: ${this.localText}`);
      this.localText = '';
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

.video-container {
  position: relative;

  small {
    position: absolute;
    color: white;
    bottom: 1px;
    left: 1px;
  }
}

#chat {
  position: -webkit-sticky;
  position: sticky;
  top: 20px;
}
</style>

<style lang="scss">
/* beautiful-chatのスタイル */
.sc-launcher {
  // チャットオープンアイコンの無効化
  // sharedisplay: none;
}

.v-dialog {
  background-color: rgba(0, 0, 0, 0.6);
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
