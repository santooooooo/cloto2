<template>
  <v-dialog v-model="isLoungeEnter" fullscreen transition="dialog-bottom-transition">
    <v-layout class="px-2">
      <v-flex>
        <v-container fluid>
          <v-row justify="center">
            <div class="video-container" v-if="localStream && !isVideoOff">
              <video width="208" height="117" autoplay :srcObject.prop="localStream"></video>

              <p>{{ authUser.username }}</p>
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

              <p>{{ authUser.username }}</p>
            </div>

            <video
              width="208"
              height="117"
              autoplay
              :srcObject.prop="screenSharing.localStream"
              class="ml-10"
              v-if="screenSharing.localStream"
            ></video>
          </v-row>

          <v-row justify="center" class="mt-3">
            <div
              class="video-container mx-1"
              v-for="participant in participants"
              :key="participant.peerId"
            >
              <video width="320" height="180" autoplay :srcObject.prop="participant"></video>

              <!-- DBにPeerIDを保存して検索 -->
              <p>{{ authUser.username }}</p>
            </div>
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
      <v-flex xs3 v-show="isShowChat">
        <v-card color="grey lighten-2" class="mx-auto" id="chat">
          <v-card flat class="overflow-y-auto" height="500">
            <v-card-text v-for="(message, index) in messages" :key="index">
              <!-- システムメッセージ -->
              <p class="text-center" style="color: red" v-if="message.type === 'system'">
                {{ message.text }}
              </p>

              <!-- ユーザーメッセージ -->
              <p v-else>
                {{ message.peerId + '：' + message.text }}
              </p>
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
    </v-layout>

    <v-app-bar color="yellow darken-4" fixed bottom height="100">
      <!-- 通話終了ボタン -->
      <v-btn depressed x-large color="error" class="ml-10" @click="leaveLounge()">
        自習室に戻る
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
        :color="!screenSharing.localStream ? 'white' : 'red'"
        fab
        depressed
        large
        class="mx-10"
        @click="!screenSharing.localStream ? startScreenSharing() : stopScreenSharing()"
      >
        <v-icon large>{{
          !screenSharing.localStream ? 'mdi-window-restore' : 'mdi-window-close'
        }}</v-icon>
      </v-btn>

      <v-spacer></v-spacer>

      <!-- チャットボタン -->
      <v-btn color="white" icon class="mr-6" @click="isShowChat = !isShowChat">
        <v-icon large>mdi-message-text</v-icon>
      </v-btn>

      <!-- メニューボタン -->
      <v-btn color="white" icon class="mr-10" @click="isShowMenu = true">
        <v-icon large>mdi-menu</v-icon>
      </v-btn>
    </v-app-bar>

    <!-- デバイス選択メニュー -->
    <v-dialog v-model="isShowMenu" max-width="600">
      <v-card color="grey darken-1" dark>
        <v-container>
          <v-row justify="end">
            <v-btn fab x-small depressed color="error" class="mr-4" @click="isShowMenu = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-list-item>
            <v-list-item-content>
              <v-select disabled label="ミュート" v-if="isMute"> </v-select>
              <v-select
                v-model="selectedAudio"
                :items="audioDevices"
                item-value="deviceId"
                item-text="label"
                @change="changeDevice()"
                label="マイク"
                v-else
              >
              </v-select>
            </v-list-item-content>
          </v-list-item>

          <v-list-item>
            <v-list-item-content>
              <v-select disabled label="ビデオオフ" v-if="isVideoOff"> </v-select>
              <v-select
                v-model="selectedVideo"
                :items="videoDevices"
                item-value="deviceId"
                item-text="label"
                @change="changeDevice()"
                label="ビデオ"
                v-else
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
      isLoungeEnter: false, // 休憩室入室制御
      profileDialog: false, // プロフィールのダイアログ制御
      profileUserId: null, // プロフィールを表示するユーザーID

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
      screenSharing: {
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
  methods: {
    /**
     * 休憩室へ入室
     */
    enterLounge: function () {
      this.isLoungeEnter = true;
    },

    /**
     * 休憩室から退室
     */
    leaveLounge: function () {
      this.exitCall();

      this.isLoungeEnter = false;

      this.$emit('leave-lounge');
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
    },

    /**
     * ビデオのオン/オフ切り替え
     */
    videoOff: function () {
      const videoTrack = this.localStream.getVideoTracks()[0];
      this.isVideoOff = !this.isVideoOff;
      videoTrack.enabled = !this.isVideoOff;
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
      // 自身の参加イベント
      this.call.once('open', () => {
        this.messages.push({ type: 'system', peerId: null, text: '=== 入室しました！ ===' });
      });

      // 他ユーザー参加イベント
      this.call.on('peerJoin', (peerId) => {
        this.messages.push({
          type: 'system',
          peerId: null,
          text: '===' + peerId + 'が入室しました！ ===',
        });
      });

      // 他ユーザー参加イベント
      this.call.on('stream', (stream) => {
        // ビデオなどreplaceStreamでは，ここが発火する．
        // streamの中身で分岐できるかを確認する必要あり．

        // 画面共有中
        if (this.screenSharing.localStream !== null) {
          // 自分の画面共有のストリームは除外
          if (stream.id !== this.screenSharing.localStream.id) {
            // 別ピアーで接続するため，画面共有も他人扱いされる
            this.joinUser(stream);
          }
        } else {
          this.joinUser(stream);
        }
      });

      // メッセージ到着イベント
      this.call.on('data', ({ data, src }) => {
        this.messages.push({ type: 'user', peerId: src, text: data });
      });

      // 他ユーザー退出イベント
      this.call.on('removeStream', (stream) => {
        this.leaveUser(stream.peerId);
      });

      // 他ユーザー退出イベント
      this.call.on('peerLeave', (peerId) => {
        this.leaveUser(peerId);
      });

      // 自身の退出イベント
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
      await this.stopScreenSharing();

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
    startScreenSharing: async function () {
      if (this.screenSharing.peer === null) {
        this.screenSharing.peer = new Peer({ key: API_KEY });

        this.screenSharing.localStream = await navigator.mediaDevices.getDisplayMedia({
          video: true,
          audio: false,
        });

        this.screenSharing.peer.joinRoom(this.loungeId, {
          mode: 'sfu',
          stream: this.screenSharing.localStream,
        });

        this.setupScreenSharingEvents();
      }
    },

    /**
     * 画面共有のイベント
     */
    setupScreenSharingEvents: function () {
      // 画面共有終了イベント（Chromeの共有を停止ボタン押下時の処理）
      this.screenSharing.localStream.getVideoTracks()[0].onended = () => {
        this.stopScreenSharing();
      };
    },

    /**
     * 画面共有停止
     */
    stopScreenSharing: async function () {
      if (this.screenSharing.peer !== null) {
        // デバイスの画面共有を停止
        this.screenSharing.localStream.getTracks().forEach((track) => track.stop());
        this.screenSharing.localStream = null;

        // 画面共有用の接続を終了
        this.screenSharing.peer.disconnect();
        this.screenSharing.peer = null;
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
    this.enterLounge();
  },
  destroyed() {
    // 念の為
    this.exitCall();
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

  p {
    position: absolute;
    background-color: black;
    color: white;
    line-height: 1em;
    bottom: 6px;
    left: 0px;
    margin: 0;
    padding: 2px;
  }
}

#chat {
  position: -webkit-sticky;
  position: sticky;
  margin-top: 20px;
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
