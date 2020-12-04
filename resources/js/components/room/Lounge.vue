<template>
  <v-container fluid>
    <v-layout class="px-2">
      <v-flex>
        <v-container fluid>
          <v-row justify="center">
            <!-- 自分のビデオ（オン） -->
            <v-sheet
              color="rgba(0, 0, 0, 1)"
              width="208"
              height="117"
              class="video-container"
              v-if="localStream && !isVideoOff"
            >
              <video
                width="208"
                height="117"
                muted="true"
                autoplay
                :srcObject.prop="localStream"
              ></video>

              <p>{{ authUser.username }}</p>
            </v-sheet>

            <!-- 自分のビデオ（オフ） -->
            <v-sheet
              color="rgba(0, 0, 0, 1)"
              width="208"
              height="117"
              class="video-container"
              v-else
            >
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
            </v-sheet>
          </v-row>

          <v-row justify="center" class="mt-3" v-if="screenSharing.stream">
            <!-- 画面共有 -->
            <video autoplay :srcObject.prop="screenSharing.stream" style="max-width: 80%"></video>
          </v-row>

          <v-row justify="center" class="mt-3">
            <!-- 参加者のビデオ（オン） -->
            <v-hover
              v-slot="{ hover }"
              v-for="participant in participants"
              :key="participant.stream.peerId"
            >
              <!-- ピン留め時 -->
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                :width="videoSize.width"
                :height="videoSize.height"
                class="video-container mx-1"
                v-if="participant.isPinned"
              >
                <video
                  :width="videoSize.width"
                  :height="videoSize.height"
                  autoplay
                  :srcObject.prop="participant.stream"
                  :class="speakerId === participant.stream.peerId ? 'speaker' : ''"
                ></video>

                <p>{{ participant.names.handlename }}</p>

                <!-- hover時 -->
                <v-fade-transition>
                  <v-overlay absolute opacity="0.7" v-if="hover">
                    <v-sheet
                      color="rgba(0, 0, 0, 0)"
                      :width="videoSize.width"
                      :height="videoSize.height"
                    >
                      <v-btn icon x-large class="pin-button" @click="participant.isPinned = false">
                        <v-icon> mdi-pin-off </v-icon>
                      </v-btn>

                      <v-btn
                        icon
                        x-large
                        class="account-button"
                        @click="showProfile(participant.names.username)"
                      >
                        <v-icon> mdi-account </v-icon>
                      </v-btn>
                    </v-sheet>
                  </v-overlay>
                </v-fade-transition>
              </v-sheet>

              <!-- 通常時 -->
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                :width="videoSize.showWidth"
                :height="videoSize.showHeight"
                class="video-container mx-1"
                v-else
              >
                <video
                  :width="videoSize.showWidth"
                  :height="videoSize.showHeight"
                  autoplay
                  :srcObject.prop="participant.stream"
                  :class="speakerId === participant.stream.peerId ? 'speaker' : ''"
                ></video>

                <p>{{ participant.names.handlename }}</p>

                <!-- hover時 -->
                <v-fade-transition>
                  <v-overlay absolute opacity="0.7" v-if="hover">
                    <v-sheet
                      color="rgba(0, 0, 0, 0)"
                      :width="videoSize.showWidth"
                      :height="videoSize.showHeight"
                    >
                      <v-btn icon x-large class="pin-button" @click="participant.isPinned = true">
                        <v-icon> mdi-pin </v-icon>
                      </v-btn>

                      <v-btn
                        icon
                        x-large
                        class="account-button"
                        @click="showProfile(participant.names.username)"
                      >
                        <v-icon> mdi-account </v-icon>
                      </v-btn>
                    </v-sheet>
                  </v-overlay>
                </v-fade-transition>
              </v-sheet>
            </v-hover>
          </v-row>

          <!-- プロフィールダイアログ -->
          <ProfileDialog
            :username="profile.username"
            @close="profile.dialog = $event"
            v-if="profile.dialog"
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
                <span class="text-caption">{{ message.handlename }}</span>
                <span class="text-body-1 font-weight-bold">{{ message.text }}</span>
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
            <v-btn icon @click="sendMessage()">
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
        :color="screenSharing.stream && screenSharing.isLocal ? 'red' : 'white'"
        :disabled="screenSharing.stream && !screenSharing.isLocal"
        fab
        depressed
        large
        class="mx-10"
        @click="!screenSharing.stream ? startScreenSharing() : stopScreenSharing()"
      >
        <v-icon large>
          {{
            screenSharing.stream && screenSharing.isLocal
              ? 'mdi-window-close'
              : 'mdi-window-restore'
          }}
        </v-icon>
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
  </v-container>
</template>

<script>
import voiceDetection from 'voice-activity-detection';
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
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },

      participants: [],
      audioDevices: [],
      videoDevices: [],
      videoSize: {
        width: 640,
        height: 360,
        showWidth: 320,
        showHeight: 180,
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
        isLocal: false, // 自分の画面共有か
        peer: null,
        stream: null,
      },
      localText: '', // 送信するメッセージ
      messages: [], // メッセージ一覧
      voiceDetectionObject: null, // 音声検出オブジェクト
      speakerId: null, // 話し中ユーザーのID
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * PeerIDからユーザーを取得
     *
     * @param String  peerId  検索するPeerID
     * @returns Object {username, handlename} ユーザー名，表示名
     */
    getNamesByPeerId: async function (peerId) {
      var response = await this.$http.get(this.$endpoint('getNamesByPeerId', [peerId]));
      return response.data;
    },

    /**
     * 休憩室から退室
     */
    leaveLounge: function () {
      this.exitCall();
      this.$emit('leave-lounge');
    },

    /**
     * プロフィールの表示
     *
     * @param String  username  プロフィールを表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
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
        this.messages.push({ type: 'system', handlename: null, text: '入室しました！' });
      });

      // 他ユーザー参加イベント
      this.call.on('stream', (stream) => {
        this.joinUser(stream);
      });

      // メッセージ到着イベント
      this.call.on('data', async ({ data, src }) => {
        // ユーザー名と表示名の取得
        var names = await this.getNamesByPeerId(src);
        this.messages.push({ type: 'user', handlename: names.handlename, text: data });
      });

      // 他ユーザー退出イベント
      this.call.on('peerLeave', (peerId) => {
        if (this.screenSharing.stream !== null && peerId === this.screenSharing.stream.peerId) {
          // 参加者の画面共有の停止
          this.screenSharing.stream = null;
        } else {
          // 参加者の退出
          this.leaveUser(peerId);
        }
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
        // 音声検知の終了
        this.stopVoiceDetection();

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
     *
     * @param MediaStream stream  参加したユーザーのストリーム
     */
    joinUser: async function (stream) {
      // ユーザー名と表示名の取得
      var names = await this.getNamesByPeerId(stream.peerId);

      if (names !== '') {
        // ユーザーが参加した場合
        this.participants.push({ isPinned: false, names: names, stream: stream });

        // 音声検知の開始
        this.startVoiceDetection(stream);

        // 参加メッセージの送信
        this.messages.push({
          type: 'system',
          peerId: null,
          text: names.handlename + 'が入室しました！',
        });
      } else {
        // 画面共有が参加した場合
        if (!this.screenSharing.isLocal) {
          // 自分が画面共有していない場合（他人が画面共有を開始）
          this.screenSharing.stream = stream;
        }
      }
    },

    /**
     * 参加者の退出
     *
     * @param String peerId  退出したユーザーのPeerID
     */
    leaveUser: function (peerId) {
      this.participants = this.participants.filter((participant) => {
        // 退出したユーザーのpeerId以外を残す
        return participant.stream.peerId !== peerId;
      });
    },

    /**
     * 画面共有開始
     */
    startScreenSharing: async function () {
      if (this.screenSharing.stream === null) {
        this.screenSharing.peer = new Peer({ key: API_KEY });

        this.screenSharing.stream = await navigator.mediaDevices.getDisplayMedia({
          video: true,
          audio: false,
        });

        this.screenSharing.peer.joinRoom(this.loungeId, {
          mode: 'sfu',
          stream: this.screenSharing.stream,
        });

        this.screenSharing.isLocal = true;

        this.setupScreenSharingEvents();
      }
    },

    /**
     * 画面共有のイベント
     */
    setupScreenSharingEvents: function () {
      // 画面共有終了イベント（Chromeの共有を停止ボタン押下時の処理）
      this.screenSharing.stream.getVideoTracks()[0].onended = () => {
        this.stopScreenSharing();
      };
    },

    /**
     * 画面共有停止
     */
    stopScreenSharing: async function () {
      if (this.screenSharing.stream !== null) {
        this.screenSharing.isLocal = false;

        // デバイスの画面共有を停止
        this.screenSharing.stream.getTracks().forEach((track) => track.stop());
        this.screenSharing.stream = null;

        // 画面共有用の接続を終了
        this.screenSharing.peer.disconnect();
        this.screenSharing.peer = null;
      }
    },

    /**
     * メッセージの送信処理
     */
    sendMessage: function () {
      // メッセージの送信
      this.call.send(this.localText);

      // 自分の画面を更新
      this.messages.push({
        type: 'user',
        handlename: this.authUser.handlename,
        text: this.localText,
      });
      this.localText = '';
    },

    /**
     * 音声検知の開始
     *
     * @param MediaStream stream  音声検知するユーザー（全員）のストリーム
     */
    startVoiceDetection: function (stream) {
      const audioContext = new AudioContext();

      // 音声検知時のイベント
      var options = {
        // 検知開始（発声開始）
        onVoiceStart: () => {
          // 発言者の枠点灯
          this.speakerUpdate(stream.peerId);
        },

        // 検知終了（発声終了）
        onVoiceStop: () => {
          // 発言者の枠消灯
          this.speakerUpdate(null);
        },
      };

      // 音声検出開始
      this.voiceDetectionObject = voiceDetection(audioContext, stream, options);
    },

    /**
     * 音声検知の終了
     */
    stopVoiceDetection() {
      // 音声検知終了
      if (this.voiceDetectionObject) {
        this.voiceDetectionObject.destroy();
      }
    },

    /**
     * 発言者の更新
     *
     * @param String peerId  発言中のユーザーのPeerID
     */
    speakerUpdate(peerId) {
      this.speakerId = peerId;
    },
  },

  async created() {
    // Peerの作成
    var response = await this.$http.get(this.$endpoint('authPeerId'));
    const myPeerId = response.data;
    this.peer = new Peer(myPeerId, { key: API_KEY });

    await this.accessDevice();
    await this.connectDevice();
    this.makeCall();
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
    bottom: 0;
    left: 0;
    margin: 0;
    padding: 2px;
  }

  .pin-button {
    position: absolute;
    top: 50%;
    left: 40%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
  }

  .account-button {
    position: absolute;
    top: 50%;
    right: 40%;
    transform: translate(50%, -50%);
    -webkit-transform: translate(50%, -50%);
    -ms-transform: translate(50%, -50%);
  }

  .speaker {
    outline: 5px solid #f6bf00;
    outline-offset: -5px;
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
.v-dialog {
  background-color: rgba(0, 0, 0, 0.6);
}
</style>
