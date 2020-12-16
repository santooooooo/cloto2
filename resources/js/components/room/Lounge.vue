<template>
  <v-container fluid>
    <v-layout class="px-2">
      <v-flex>
        <v-container fluid>
          <v-row justify="center">
            <v-sheet color="rgba(0, 0, 0, 1)" width="208" height="117" class="video-container">
              <!-- 自分のビデオ（オフ） -->
              <v-sheet
                color="black"
                width="208"
                height="117"
                class="d-flex justify-center align-center"
                v-if="isVideoOff || localStream === null"
              >
                <v-avatar size="50" class="aligh-self-center"
                  ><img :src="$storage('icon') + authUser.icon"
                /></v-avatar>
              </v-sheet>

              <!-- 自分のビデオ（オン） -->
              <video
                width="208"
                height="117"
                muted="true"
                autoplay
                :srcObject.prop="localStream"
                v-else
              ></video>

              <p class="handlename">{{ authUser.handlename }}</p>

              <p class="is-mute" v-if="isMute">
                <v-icon color="red">mdi-microphone-off</v-icon>
              </p>
            </v-sheet>
          </v-row>

          <v-row justify="center" class="mt-3" v-if="screenSharing.stream">
            <!-- 画面共有 -->
            <video autoplay :srcObject.prop="screenSharing.stream" style="max-width: 80%"></video>
          </v-row>

          <!-- ピン留め時 -->
          <v-row justify="center" class="mt-3" v-if="typeof pinnedParticipant !== 'undefined'">
            <v-hover v-slot="{ hover }">
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                :width="videoSize.width"
                :height="videoSize.height"
                class="video-container mx-1"
              >
                <!-- 参加者のビデオ（オフ） -->
                <v-sheet
                  color="black"
                  :width="videoSize.width"
                  :height="videoSize.height"
                  class="d-flex justify-center align-center"
                  v-if="pinnedParticipant.isVideoOff"
                >
                  <v-avatar size="150" class="aligh-self-center"
                    ><img :src="$storage('icon') + pinnedParticipant.icon"
                  /></v-avatar>
                </v-sheet>

                <!-- 参加者のビデオ（オン） -->
                <video
                  :width="videoSize.width"
                  :height="videoSize.height"
                  autoplay
                  :srcObject.prop="pinnedParticipant.stream"
                  :class="speakerId === pinnedParticipant.stream.peerId ? 'speaker' : ''"
                  v-else
                ></video>

                <p class="handlename">{{ pinnedParticipant.handlename }}</p>

                <p class="is-mute" v-if="pinnedParticipant.isMute">
                  <v-icon color="red">mdi-microphone-off</v-icon>
                </p>

                <!-- hover -->
                <v-fade-transition>
                  <v-overlay absolute opacity="0.7" v-if="hover">
                    <v-sheet
                      color="rgba(0, 0, 0, 0)"
                      :width="videoSize.width"
                      :height="videoSize.height"
                    >
                      <v-btn
                        icon
                        x-large
                        class="pin-button"
                        @click="pinnedParticipant.isPinned = false"
                      >
                        <v-icon> mdi-pin-off </v-icon>
                      </v-btn>

                      <v-btn
                        icon
                        x-large
                        class="account-button"
                        @click="showProfile(pinnedParticipant.username)"
                      >
                        <v-icon> mdi-account </v-icon>
                      </v-btn>
                    </v-sheet>
                  </v-overlay>
                </v-fade-transition>
              </v-sheet>
            </v-hover>
          </v-row>

          <!-- 通常時 -->
          <v-row justify="center" class="mt-3">
            <!-- 参加者のビデオ（オン） -->
            <v-hover
              v-slot="{ hover }"
              v-for="participant in notPinnedParticipants"
              :key="participant.stream.peerId"
            >
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                :width="videoSize.showWidth"
                :height="videoSize.showHeight"
                class="video-container mx-1"
              >
                <!-- 参加者のビデオ（オフ） -->
                <v-sheet
                  color="black"
                  :width="videoSize.showWidth"
                  :height="videoSize.showHeight"
                  class="d-flex justify-center align-center"
                  v-if="participant.isVideoOff"
                >
                  <v-avatar size="80" class="aligh-self-center"
                    ><img :src="$storage('icon') + participant.icon"
                  /></v-avatar>
                </v-sheet>

                <!-- 参加者のビデオ（オン） -->
                <video
                  :width="videoSize.showWidth"
                  :height="videoSize.showHeight"
                  autoplay
                  :srcObject.prop="participant.stream"
                  :class="speakerId === participant.stream.peerId ? 'speaker' : ''"
                  v-else
                ></video>

                <p class="handlename">{{ participant.handlename }}</p>

                <p class="is-mute" v-if="participant.isMute">
                  <v-icon color="red">mdi-microphone-off</v-icon>
                </p>

                <!-- hover -->
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
                        @click="showProfile(participant.username)"
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
            :user-param="profile.username"
            @close="profile.dialog = $event"
            v-if="profile.dialog"
          ></ProfileDialog>
        </v-container>
      </v-flex>

      <!-- チャットエリア -->
      <v-flex xs3 v-show="chat.isOpen">
        <v-card color="grey lighten-2" class="mx-auto" id="chat">
          <v-card flat class="overflow-y-auto" height="500">
            <v-card-text v-for="(message, index) in chat.messages" :key="index">
              <!-- ユーザーメッセージ -->
              <p v-if="message.handlename">
                <span class="text-caption">{{ message.handlename }}</span>
                <span class="text-body-1 font-weight-bold">{{ message.text }}</span>
              </p>

              <!-- システムメッセージ -->
              <p class="text-center" style="color: red" v-else>
                {{ message.text }}
              </p>
            </v-card-text>
          </v-card>

          <v-card-actions>
            <v-text-field
              v-model="chat.localText"
              class="px-2"
              label="メッセージを送ろう！"
              @keypress="chat.canSubmit = true"
              @keyup.enter="sendMessage()"
            ></v-text-field>
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

      <!-- 通知音ボタン -->
      <v-btn color="white" icon class="mr-6" @click="settingNotificationSound()">
        <v-icon large>{{ notificationSound.isOn ? 'mdi-bell' : 'mdi-bell-off' }}</v-icon>
      </v-btn>

      <!-- チャットボタン -->
      <v-badge
        bordered
        dot
        color="deep-purple accent-4"
        :value="chat.notification"
        offset-x="40"
        offset-y="15"
      >
        <v-btn color="white" icon class="mr-6" @click="controlChat()">
          <v-icon large>mdi-message-text</v-icon>
        </v-btn>
      </v-badge>

      <!-- メニューボタン -->
      <v-btn color="white" icon class="mr-10" @click="isOpenMenu = true">
        <v-icon large>mdi-menu</v-icon>
      </v-btn>
    </v-app-bar>

    <!-- デバイス選択メニュー -->
    <v-dialog v-model="isOpenMenu" max-width="600">
      <v-card color="grey darken-1" dark>
        <v-container>
          <v-row justify="end">
            <v-btn fab x-small depressed color="error" class="mr-4" @click="isOpenMenu = false">
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

const API_KEY = process.env.MIX_SKYWAY_API_KEY;

export default {
  components: {
    ProfileDialog,
  },
  props: {
    loungeId: String,
    capacity: Number,
  },
  data() {
    return {
      //*** 通話 ***//
      participants: [], // 参加者
      roomMode: 'mesh', // 接続モード
      peer: null, // Peer接続オブジェクト
      localStream: null, // 自分の送信データ
      call: null, // 接続プロパティ
      screenSharing: {
        isLocal: false, // 自分の画面共有か
        peer: null, // Peer接続オブジェクト（画面共有用）
        stream: null, // 画面共有データ
      },

      //*** 入力デバイス ***//
      isOpenMenu: false, // デバイス選択メニュー表示制御
      audioDevices: [], // 音声入力デバイス一覧
      videoDevices: [], // 映像入力デバイス一覧
      selectedAudio: null, // 選択されている音声入力
      selectedVideo: null, // 選択されている映像入力
      videoSize: {
        width: 640, // ビデオ取得サイズ（横）
        height: 360, // ビデオ取得サイズ（縦）
        showWidth: 320, // ビデオ表示サイズ（横）
        showHeight: 180, // ビデオ表示サイズ（縦）
      },
      isMute: false, // ミュート制御
      isVideoOff: false, // ビデオオフ制御

      //*** 音声検出 ***//
      voiceDetectionObject: null, // 音声検出オブジェクト
      speakerId: null, // 話し中ユーザーのID

      //*** チャット ***//
      chat: {
        isOpen: false, // チャットエリア表示制御
        canSubmit: false, // 送信制御
        notification: false, // 通知制御
        localText: '', // 送信するメッセージ
        messages: [], // メッセージ一覧
      },

      //*** 通知音 ***//
      notificationSound: {
        isOn: false, // 通知音制御
        notificationOn: new Audio(this.$storage('system') + 'notification_sound_on.mp3'),
        notificationOff: new Audio(this.$storage('system') + 'notification_sound_off.mp3'),
        joinNotification: new Audio(this.$storage('system') + 'join_notification.mp3'),
        leaveNotification: new Audio(this.$storage('system') + 'leave_notification.mp3'),
        messageNotification: new Audio(this.$storage('system') + 'message_notification.mp3'),
      },

      //*** プロフィール ***//
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
    pinnedParticipant() {
      // ピン留めされている参加者（一人）
      return this.participants.filter((participant) => {
        return participant.isPinned === true;
      })[0];
    },
    notPinnedParticipants() {
      // ピン留めされていない参加者
      return this.participants.filter((participant) => {
        return participant.isPinned === false;
      });
    },
  },
  methods: {
    /**
     * 休憩室から退室
     */
    leaveLounge: async function () {
      await this.exitCall();
      this.$emit('leave-lounge');
    },

    /**
     * 通話の開始
     */
    makeCall: async function () {
      this.call = this.peer.joinRoom(this.loungeId, {
        mode: this.roomMode,
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
        this.chat.messages.push({ handlename: null, text: '入室しました！' });
      });

      // 他ユーザー参加イベント
      this.call.on('stream', (stream) => {
        this.joinUser(stream);

        // 現在の自分の状態を送信（新規参加者に現在の状態を通知）
        this.call.send({ type: 'audioEvent', content: { isMute: this.isMute } });
        this.call.send({ type: 'videoEvent', content: { isVideoOff: this.isVideoOff } });
      });

      // データ到着イベント
      this.call.on('data', async ({ data, src }) => {
        // 送信者が取得されるまで待機
        for (var i = 0; i < 50; i++) {
          // 参加直後，this.participantsへの追加前に検索されるので回避
          // 新規ユーザーのstreamよりも先にdataが届く
          // 存在しない場合の対策として上限を5秒に設定
          try {
            var sender = await new Promise((resolve, reject) => {
              // 送信者を検索（参加者のPeerIDを確認）
              var participant = this.participants.filter((participant) => {
                return src === participant.stream.peerId;
              })[0];

              if (typeof participant === 'undefined') {
                // 再処理へ
                reject();
              } else {
                // 終了
                resolve(participant);
              }
            });

            break;
          } catch (error) {
            // 0.1秒待機
            await new Promise((resolve) => setTimeout(resolve, 100));
            // 再処理
            continue;
          }
        }

        switch (data.type) {
          case 'message':
            // メッセージ受信イベント
            this.chat.messages.push({ handlename: sender.handlename, text: data.content });

            if (!this.chat.isOpen) {
              // 通知音
              if (this.notificationSound.isOn) {
                this.notificationSound.messageNotification.play();
              }

              // 通知の表示
              this.chat.notification = true;
            }
            break;

          case 'audioEvent':
            // ミュートイベント
            sender.isMute = data.content.isMute;
            break;

          case 'videoEvent':
            // ビデオオフイベント
            sender.isVideoOff = data.content.isVideoOff;
            break;
        }
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
        if (this.localStream !== null) {
          this.localStream.getTracks().forEach((track) => track.stop());
          this.localStream = null;
        }

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
      var response = await this.$http.get(this.$endpoint('getUserByPeerId', [stream.peerId]));
      var user = response.data;

      // ユーザーが参加した場合
      if (user !== '') {
        // 通知音
        if (this.notificationSound.isOn) {
          this.notificationSound.joinNotification.play();
        }

        // 参加者の追加
        this.participants.push({
          isPinned: false, // ピン留めしているか
          username: user.username, // ユーザー名
          handlename: user.handlename, // 表示名
          icon: user.icon, // アイコン
          isMute: true, // ミュート状態
          isVideoOff: true, // ビデオオフ状態
          stream: stream,
        });

        // 音声検知の開始
        this.startVoiceDetection(stream);

        // 参加メッセージの追加
        this.chat.messages.push({
          handlename: null,
          text: user.handlename + 'が入室しました！',
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
      // 通知音
      if (this.notificationSound.isOn) {
        this.notificationSound.leaveNotification.play();
      }

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
          mode: this.roomMode,
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
     * 通話デバイスへのアクセス
     *
     * @returns Boolean アクセス成功/失敗
     */
    accessDevice: async function () {
      try {
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

        return true;
      } catch (error) {
        // 他のアプリがデバイスを使用している場合
        return false;
      }
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

      // 通知
      this.call.send({ type: 'audioEvent', content: { isMute: this.isMute } });
    },

    /**
     * ビデオのオン/オフ切り替え
     */
    videoOff: function () {
      const videoTrack = this.localStream.getVideoTracks()[0];
      this.isVideoOff = !this.isVideoOff;
      videoTrack.enabled = !this.isVideoOff;

      // 通知
      this.call.send({ type: 'videoEvent', content: { isVideoOff: this.isVideoOff } });
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
     * 発言者の更新
     *
     * @param String peerId  発言中のユーザーのPeerID
     */
    speakerUpdate(peerId) {
      this.speakerId = peerId;
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
     * チャットエリアの制御
     */
    controlChat: function () {
      this.chat.isOpen = !this.chat.isOpen;
      this.chat.notification = false;
    },

    /**
     * メッセージの送信処理
     */
    sendMessage: function () {
      if (this.chat.canSubmit && this.chat.localText !== '') {
        // メッセージの送信
        this.call.send({ type: 'message', content: this.chat.localText });

        // 自分の画面を更新
        this.chat.messages.push({
          handlename: this.authUser.handlename,
          text: this.chat.localText,
        });
        this.chat.localText = '';
      }
    },

    /**
     * 通知音の制御
     */
    settingNotificationSound: function () {
      if (this.notificationSound.isOn) {
        this.notificationSound.isOn = false;
        this.notificationSound.notificationOff.play();
      } else {
        this.notificationSound.isOn = true;
        this.notificationSound.notificationOn.play();
      }
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
  },

  async created() {
    // 定員が4人より多い場合はSFU方式を利用
    if (this.capacity > 4) {
      this.roomMode = 'sfu';
    }

    // Peerの作成
    var response = await this.$http.get(this.$endpoint('authPeerId'));
    const myPeerId = response.data;
    this.peer = new Peer(myPeerId, { key: API_KEY });

    // 入力デバイスへのアクセス
    var access = await this.accessDevice();

    if (access) {
      // 入力デバイスへの接続
      await this.connectDevice();

      // 通話開始
      this.makeCall();

      // 通話開始時はミュート/ビデオオフに設定
      this.mute();
      this.videoOff();
    } else {
      this.$store.dispatch('alert/show', {
        type: 'error',
        message: 'マイクまたはカメラが認識できませんでした．．．',
      });

      this.leaveLounge();
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.video-container {
  position: relative;

  .handlename {
    position: absolute;
    background-color: black;
    color: white;
    line-height: 1em;
    bottom: 0;
    left: 0;
    margin: 0;
    padding: 2px;
  }

  .is-mute {
    position: absolute;
    color: white;
    line-height: 1em;
    bottom: 0;
    right: 0;
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
