<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    persistent
    no-click-animation
    transition="dialog-bottom-transition"
  >
    <!-- ローディング画面 -->
    <v-overlay :value="isLoading" z-index="6" class="text-center" opacity="0.9">
      <p class="text-h5 mb-5">接続中</p>
      <v-progress-linear
        indeterminate
        height="10"
        color="green"
        class="progress-linear mb-12"
      ></v-progress-linear>
    </v-overlay>

    <!-- トピック -->
    <v-app-bar
      color="grey lighten-2"
      fixed
      top
      height="60px"
      :class="['app-bar', appBar.isShow ? 'show' : '']"
    >
      <v-row dense justify="center">
        <span class="text-h4">{{ topic }}</span>
      </v-row>
    </v-app-bar>

    <v-layout class="px-2">
      <!-- 視聴者一覧 -->
      <v-flex xs1 v-if="viewers.length">
        <v-avatar
          size="40"
          class="viewer ma-2"
          v-for="viewer in viewers"
          :key="viewer.peerId"
          @click="showProfile(viewer.username)"
        >
          <img :src="$storage('icon') + viewer.icon" />
        </v-avatar>
      </v-flex>

      <v-flex>
        <v-container fluid py-0>
          <!--*** 画面共有ON ***-->
          <v-row justify="center" v-if="screenSharing.stream">
            <!-- 参加者のビデオ -->
            <v-hover v-slot="{ hover }" v-for="speaker in notPinnedSpeakers" :key="speaker.peerId">
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                width="208"
                height="117"
                :class="['video', 'ma-2', speakerId === speaker.peerId ? 'speaker' : '']"
                v-if="speaker.stream"
              >
                <!-- オフ -->
                <v-sheet
                  color="black"
                  width="208"
                  height="117"
                  class="d-flex justify-center align-center"
                  v-if="speaker.isLoading || speaker.isVideoOff"
                >
                  <!-- ローディング中 -->
                  <v-progress-circular
                    size="40"
                    width="4"
                    color="green"
                    indeterminate
                    v-if="speaker.isLoading || speaker.icon === null"
                  ></v-progress-circular>

                  <v-avatar size="50" v-else>
                    <img :src="$storage('icon') + speaker.icon" />
                  </v-avatar>

                  <audio autoplay :srcObject.prop="speaker.stream"></audio>
                </v-sheet>

                <!-- オン -->
                <video
                  width="208"
                  height="117"
                  autoplay
                  :srcObject.prop="speaker.stream"
                  v-else
                ></video>

                <p class="handlename" style="font-size: 0.8em">{{ speaker.handlename }}</p>

                <p class="is-mute" v-if="speaker.isMute">
                  <v-icon color="red">mdi-microphone-off</v-icon>
                </p>

                <!-- hover -->
                <v-fade-transition>
                  <v-overlay absolute opacity="0.7" v-if="hover">
                    <v-sheet color="rgba(0, 0, 0, 0)" width="208" height="117">
                      <v-btn icon x-large class="pin-button" @click="pin(speaker)">
                        <v-icon> mdi-pin </v-icon>
                      </v-btn>

                      <v-btn
                        icon
                        x-large
                        class="account-button"
                        @click="showProfile(speaker.username)"
                      >
                        <v-icon> mdi-account </v-icon>
                      </v-btn>
                    </v-sheet>
                  </v-overlay>
                </v-fade-transition>
              </v-sheet>
            </v-hover>
          </v-row>

          <!--*** ピン留め時 ***-->
          <v-row justify="center" class="mt-3" v-if="pinnedSpeaker">
            <v-hover v-slot="{ hover }">
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                :width="videoSize.width"
                :height="videoSize.height"
                :class="['video', 'mx-1', speakerId === pinnedSpeaker.peerId ? 'speaker' : '']"
              >
                <!-- オフ -->
                <v-sheet
                  color="black"
                  :width="videoSize.width"
                  :height="videoSize.height"
                  class="d-flex justify-center align-center"
                  v-if="pinnedSpeaker.isLoading || pinnedSpeaker.isVideoOff"
                >
                  <!-- ローディング中 -->
                  <v-progress-circular
                    size="70"
                    width="4"
                    color="green"
                    indeterminate
                    v-if="pinnedSpeaker.isLoading || pinnedSpeaker.icon === null"
                  ></v-progress-circular>

                  <v-avatar size="150" v-else>
                    <img :src="$storage('icon') + pinnedSpeaker.icon" />
                  </v-avatar>

                  <audio autoplay :srcObject.prop="pinnedSpeaker.stream"></audio>
                </v-sheet>

                <!-- オン -->
                <video
                  :width="videoSize.width"
                  :height="videoSize.height"
                  autoplay
                  :srcObject.prop="pinnedSpeaker.stream"
                  v-else
                ></video>

                <p class="handlename">{{ pinnedSpeaker.handlename }}</p>

                <p class="is-mute" v-if="pinnedSpeaker.isMute">
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
                        @click="pinnedSpeaker.isPinned = false"
                      >
                        <v-icon> mdi-pin-off </v-icon>
                      </v-btn>

                      <v-btn
                        icon
                        x-large
                        class="account-button"
                        @click="showProfile(pinnedSpeaker.username)"
                      >
                        <v-icon> mdi-account </v-icon>
                      </v-btn>
                    </v-sheet>
                  </v-overlay>
                </v-fade-transition>
              </v-sheet>
            </v-hover>
          </v-row>

          <!--*** 通常時（画面共有OFF） ***-->
          <v-row justify="center" class="normal-container" v-if="!screenSharing.stream">
            <!-- 参加者のビデオ -->
            <v-col sm="6" md="6" lg="6" v-for="speaker in notPinnedSpeakers" :key="speaker.peerId">
              <v-row justify="center">
                <v-hover v-slot="{ hover }">
                  <v-sheet
                    color="rgba(0, 0, 0, 1)"
                    :width="videoShowWidth"
                    :height="videoShowHeight"
                    :class="['video', 'ma-2', speakerId === speaker.peerId ? 'speaker' : '']"
                    v-if="speaker.stream"
                  >
                    <!-- オフ -->
                    <v-sheet
                      color="black"
                      :width="videoShowWidth"
                      :height="videoShowHeight"
                      class="d-flex justify-center align-center"
                      v-if="speaker.isLoading || speaker.isVideoOff"
                    >
                      <!-- ローディング中 -->
                      <v-progress-circular
                        size="70"
                        width="4"
                        color="green"
                        indeterminate
                        v-if="speaker.isLoading || speaker.icon === null"
                      ></v-progress-circular>

                      <v-avatar size="80" v-else>
                        <img :src="$storage('icon') + speaker.icon" />
                      </v-avatar>

                      <audio autoplay :srcObject.prop="speaker.stream"></audio>
                    </v-sheet>

                    <!-- オン -->
                    <video
                      :width="videoShowWidth"
                      :height="videoShowHeight"
                      autoplay
                      :srcObject.prop="speaker.stream"
                      v-else
                    ></video>

                    <p class="handlename">{{ speaker.handlename }}</p>

                    <p class="is-mute" v-if="speaker.isMute">
                      <v-icon color="red">mdi-microphone-off</v-icon>
                    </p>

                    <!-- hover -->
                    <v-fade-transition>
                      <v-overlay absolute opacity="0.7" v-if="hover">
                        <v-sheet
                          color="rgba(0, 0, 0, 0)"
                          :width="videoShowWidth"
                          :height="videoShowHeight"
                        >
                          <v-btn icon x-large class="pin-button" @click="pin(speaker)">
                            <v-icon> mdi-pin </v-icon>
                          </v-btn>

                          <v-btn
                            icon
                            x-large
                            class="account-button"
                            @click="showProfile(speaker.username)"
                          >
                            <v-icon> mdi-account </v-icon>
                          </v-btn>
                        </v-sheet>
                      </v-overlay>
                    </v-fade-transition>
                  </v-sheet>
                </v-hover>
              </v-row>
            </v-col>
          </v-row>

          <!-- 画面共有 -->
          <v-row justify="center" class="mt-3" v-if="screenSharing.stream">
            <video autoplay :srcObject.prop="screenSharing.stream" style="max-width: 80%"></video>
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
      <v-flex xs3 v-show="chat.isOpen">
        <v-card color="grey lighten-2" class="mx-auto" id="chat">
          <div class="overflow-y-auto" ref="chatScrollArea">
            <v-card-text v-for="(message, index) in chat.messages" :key="index">
              <!-- ユーザーメッセージ -->
              <p v-if="message.handlename">
                <span class="text-caption">{{ message.handlename }}</span>
                <span class="text-body-1 font-weight-bold" v-html="message.text"></span>
              </p>

              <!-- システムメッセージ -->
              <p class="text-center" style="color: red" v-else>
                {{ message.text }}
              </p>
            </v-card-text>
          </div>

          <v-card-actions>
            <v-text-field
              v-model="chat.localText"
              class="px-2"
              label="入力"
              @keydown.enter="sendMessage"
            ></v-text-field>
            <v-btn icon @click="sendMessage">
              <v-icon>mdi-send</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>

    <v-app-bar
      color="yellow darken-4"
      fixed
      bottom
      height="100px"
      :class="['app-bar', appBar.isShow ? 'show' : '']"
    >
      <v-row>
        <v-col md="4" sm="4" align-self="center">
          <v-row justify="start">
            <span class="ml-10 text-h4">視聴席</span>
          </v-row>
        </v-col>

        <v-col md="4" sm="4" align-self="center">
          <v-row justify="center">
            <!-- ミュートボタン -->
            <v-btn
              disabled
              fab
              depressed
              :large="$vuetify.breakpoint.lg"
              :class="[
                $vuetify.breakpoint.xl ? 'mx-10' : '',
                $vuetify.breakpoint.lg ? 'mx-8' : '',
                $vuetify.breakpoint.md ? 'mx-5' : 'mx-1',
              ]"
            >
              <v-icon large>mdi-microphone-off</v-icon>
            </v-btn>

            <!-- ビデオオフボタン -->
            <v-btn
              disabled
              fab
              depressed
              :large="$vuetify.breakpoint.lg"
              :class="[
                $vuetify.breakpoint.xl ? 'mx-10' : '',
                $vuetify.breakpoint.lg ? 'mx-8' : '',
                $vuetify.breakpoint.md ? 'mx-5' : 'mx-1',
              ]"
            >
              <v-icon large>mdi-video-off</v-icon>
            </v-btn>

            <!-- 画面共有ボタン -->
            <v-btn
              disabled
              fab
              depressed
              :large="$vuetify.breakpoint.lg"
              :class="[
                $vuetify.breakpoint.xl ? 'mx-10' : '',
                $vuetify.breakpoint.lg ? 'mx-8' : '',
                $vuetify.breakpoint.md ? 'mx-5' : 'mx-1',
              ]"
            >
              <v-icon large>mdi-window-restore</v-icon>
            </v-btn>
          </v-row>
        </v-col>

        <v-col md="4" sm="4" align-self="center">
          <v-row justify="end">
            <!-- 通知音ボタン -->
            <v-btn color="white" icon class="mr-6" @click="$store.dispatch('alert/switchSound')">
              <v-icon large>{{ isNotificationOn ? 'mdi-bell' : 'mdi-bell-off' }}</v-icon>
            </v-btn>

            <!-- チャットボタン -->
            <v-badge
              bordered
              dot
              color="deep-purple accent-4"
              :value="chat.notification"
              offset-x="35"
              offset-y="13"
            >
              <v-btn
                color="white"
                icon
                :class="['mr-5', chat.notification ? 'notification' : '']"
                @click="toggleChat()"
              >
                <v-icon large>mdi-message-text</v-icon>
              </v-btn>
            </v-badge>

            <!-- 通話終了ボタン -->
            <v-btn
              color="error"
              depressed
              :x-large="$vuetify.breakpoint.xl || $vuetify.breakpoint.lg"
              :large="$vuetify.breakpoint.md"
              :class="[$vuetify.breakpoint.xl || $vuetify.breakpoint.lg ? 'mx-12' : 'mx-5']"
              @click="leaveCall()"
            >
              自習室に戻る
            </v-btn>
          </v-row>
        </v-col>
      </v-row>
    </v-app-bar>
  </v-dialog>
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
    callId: Number,
  },
  data() {
    return {
      dialog: true, // 入室制御
      isLoading: false, // ローディング制御
      appBar: {
        timer: null, // ツールバー表示タイマー
        isShow: false, // ツールバー表示制御
      },
      topic: '', // トピック

      //*** 通話 ***//
      participants: [], // 参加者
      roomMode: 'mesh', // 接続モード
      peer: null, // Peer接続オブジェクト
      call: null, // 接続プロパティ
      screenSharing: {
        peer: null, // Peer接続オブジェクト（画面共有用）
        stream: null, // 画面共有データ
      },

      //*** 入力デバイス ***//
      videoSize: {
        width: 640, // ビデオ取得サイズ（横）
        height: 360, // ビデオ取得サイズ（縦）
      },

      //*** 音声検出 ***//
      voiceDetectionObject: null, // 音声検出オブジェクト
      speakerId: null, // 話し中ユーザーのID

      //*** チャット ***//
      chat: {
        isOpen: false, // チャットエリア表示制御
        notification: false, // 通知制御
        localText: '', // 送信するメッセージ
        messages: [], // メッセージ一覧
      },

      //*** 通知音 ***//
      notificationSounds: {
        join: new Audio(this.$storage('system') + 'join_lounge.mp3'),
        leave: new Audio(this.$storage('system') + 'leave_lounge.mp3'),
        receiveMessage: new Audio(this.$storage('system') + 'message_receive.mp3'),
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
    isNotificationOn() {
      return this.$store.getters['alert/isSoundOn'];
    },
    videoShowWidth() {
      return this.$windowWidth / 3;
    },
    videoShowHeight() {
      return (this.videoShowWidth / 16) * 9;
    },
    pinnedSpeaker() {
      // ピン留めされている登壇者（一人）
      return this.participants.filter((participant) => {
        return typeof participant.stream !== 'undefined' && participant.isPinned === true;
      })[0];
    },
    notPinnedSpeakers() {
      // ピン留めされていない登壇者
      return this.participants.filter((participant) => {
        return typeof participant.stream !== 'undefined' && participant.isPinned === false;
      });
    },
    viewers() {
      // 視聴者
      return this.participants.filter((participant) => {
        return typeof participant.stream === 'undefined';
      });
    },
  },
  methods: {
    /**
     * 通話室から退室
     */
    leaveCall: async function () {
      await this.exitCall();
      this.dialog = false;
      this.$emit('leave-call');
    },

    /**
     * 通話の開始
     */
    makeCall: async function () {
      this.call = this.peer.joinRoom(this.callId, {
        mode: this.roomMode,
      });

      this.setupCallEvents();
    },

    /**
     * 通話のイベント
     */
    setupCallEvents: function () {
      // 自身の参加イベント
      this.call.once('open', () => {
        this.addMessage(null, '入室しました！');
      });

      // 他ユーザー参加イベント
      this.call.on('stream', (stream) => {
        this.joinSpeaker(stream);
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
                return src === participant.peerId;
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
          case 'joinSpeakerData':
            // 参加した登壇者のデータの受信
            sender.username = data.content.username;
            sender.handlename = data.content.handlename;
            sender.icon = data.content.icon;
            // 参加メッセージの追加
            this.addMessage(null, sender.handlename + 'が入室しました！');
            break;

          case 'joinViewerData':
            // 参加した視聴者のデータの受信
            this.joinViewer(src, data.content);
            // 参加メッセージの追加
            this.addMessage(null, data.content.handlename + 'が入室しました！');
            break;

          case 'loadingEvent':
            // ローディングイベント
            sender.isLoading = data.content;
            break;

          case 'audioEvent':
            // ミュートイベント
            sender.isMute = data.content;
            break;

          case 'videoEvent':
            // ビデオオフイベント
            sender.isVideoOff = data.content;
            break;

          case 'topic':
            // トピックの受信
            this.topic = data.content;
            this.showAppBar();
            break;

          case 'message':
            // メッセージの受信
            this.addMessage(sender.handlename, data.content);

            if (!this.chat.isOpen) {
              // 通知音
              if (this.isNotificationOn) {
                this.notificationSounds.receiveMessage.play();
              }

              // 通知の表示
              this.chat.notification = true;
              this.showAppBar();
            }
            break;
        }
      });

      // 他ユーザー退出イベント
      this.call.on('peerLeave', (peerId) => {
        if (this.screenSharing.peer !== null && peerId === this.screenSharing.peer.id) {
          // 自分の画面共有が停止された場合
          this.screenSharing.peer = null;
        } else if (
          this.screenSharing.stream !== null &&
          peerId === this.screenSharing.stream.peerId
        ) {
          // 参加者の画面共有が停止された場合
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
      if (this.peer !== null) {
        // 音声検知の終了
        this.stopVoiceDetection();

        // 通話の接続を終了
        await this.peer.disconnect();
        this.peer = null;
      }
    },

    /**
     * 登壇者の追加
     *
     * @param MediaStream stream  参加した登壇者のストリーム
     */
    joinSpeaker: async function (stream) {
      // 参加者がいるか確認
      // ミュートやビデオの切替時にもストリームが置き換わるため発火する場合がある
      // 同一のPeerIDが存在しないことを確認する
      var isJoin = !this.participants.some((participant) => participant.peerId === stream.peerId);

      if (isJoin) {
        // ユーザーが参加した場合
        if (stream.getAudioTracks().length > 0) {
          // 現在の自分の状態を送信（新規参加者に現在の状態を通知）
          this.call.send({ type: 'joinViewerData', content: this.authUser });
          // 現在のトピックを送信
          this.call.send({ type: 'topic', content: this.topic });

          // 通知音
          if (this.isNotificationOn) {
            this.notificationSounds.join.play();
          }

          // 参加者の追加
          this.participants.push({
            isPinned: false, // ピン留めしているか
            username: '', // ユーザー名
            handlename: '', // 表示名
            icon: null, // アイコン
            isLoading: true, // 接続待ち状態
            isMute: true, // ミュート状態
            isVideoOff: true, // ビデオオフ状態
            peerId: stream.peerId,
            stream: stream,
          });

          // 音声検知の開始
          this.startVoiceDetection(stream);
        } else {
          // 画面共有が参加した場合
          this.screenSharing.stream = stream;
        }
      }
    },

    /**
     * 視聴者の追加
     *
     * @param String  peerId  参加した視聴者のPeerID
     * @param Object  user    参加した視聴者のデータ
     */
    joinViewer: async function (peerId, user) {
      // 参加者がいるか確認
      // ミュートやビデオの切替時にもストリームが置き換わるため発火する場合がある
      // 同一のPeerIDが存在しないことを確認する
      var isJoin = !this.participants.some((participant) => participant.peerId === peerId);

      if (isJoin) {
        // 現在の自分の状態を送信（新規参加者に現在の状態を通知）
        this.call.send({ type: 'joinViewerData', content: this.authUser });

        // 通知音
        if (this.isNotificationOn) {
          this.notificationSounds.join.play();
        }

        // 参加者の追加
        this.participants.push({
          username: user.username, // ユーザー名
          handlename: user.handlename, // 表示名
          icon: user.icon, // アイコン
          peerId: peerId,
        });
      }
    },

    /**
     * 参加者の退出
     *
     * @param String peerId  退出したユーザーのPeerID
     */
    leaveUser: function (peerId) {
      // 通知音
      if (this.isNotificationOn) {
        this.notificationSounds.leave.play();
      }

      this.participants = this.participants.filter((participant) => {
        // 退出したユーザーのpeerId以外を残す
        return participant.peerId !== peerId;
      });
    },

    /**
     * 音声検知の開始
     *
     * @param MediaStream stream  音声検知するユーザーのストリーム
     */
    startVoiceDetection: function (stream) {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      const audioCtx = new AudioContext();

      // 音声検知時のイベント
      const options = {
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
      this.voiceDetectionObject = voiceDetection(audioCtx, stream, options);
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
     * チャットエリアの表示切り替え
     */
    toggleChat: function () {
      this.chat.isOpen = !this.chat.isOpen;
      this.chat.notification = false;
    },

    /**
     * メッセージの送信処理
     *
     * @param event クリック or キーボードイベント
     */
    sendMessage: function (event) {
      // クリックまたは日本語変換以外のEnter押下時に発火
      if (event.type === 'click' || (event.type === 'keydown' && event.keyCode === 13)) {
        if (this.chat.localText !== '') {
          // メッセージの送信
          this.call.send({ type: 'message', content: this.chat.localText });

          // 自分の画面を更新
          this.addMessage(this.authUser.handlename, this.chat.localText);
          this.chat.localText = '';
        }
      }
    },

    /**
     * メッセージの追加処理
     *
     * @param String handlename 表示名
     * @param String text 内容
     */
    addMessage: function (handlename, text) {
      const url = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;

      // メッセージの追加
      this.chat.messages.push({
        handlename: handlename,
        text: text.replace(url, '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>'),
      });

      // 最下部へスクロール（メッセージのDOM挿入後に実行）
      this.$nextTick(() => {
        if (this.$refs.chatScrollArea) {
          this.$refs.chatScrollArea.scrollTop = this.$refs.chatScrollArea.scrollHeight;
        }
      });
    },

    /**
     * ピン留め
     *
     * @param Object  participant ピン留めする参加者
     */
    pin: function (participant) {
      // 既にピン留めされているユーザーを解除
      if (this.pinnedSpeaker) {
        this.pinnedSpeaker.isPinned = false;
      }

      participant.isPinned = true;
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
     * ツールバーの表示制御
     */
    showAppBar: function () {
      // マウスが動作すると表示
      this.appBar.isShow = true;
      clearTimeout(this.appBar.timer);

      this.appBar.timer = setTimeout(() => {
        // 停止2秒後に隠す
        this.appBar.isShow = false;
      }, 2000);
    },

    /**
     * エラー発生時のイベント
     *
     * @param String  message エラーメッセージ
     */
    errorEvent: function (message) {
      this.$store.dispatch('alert/error', message);
      this.leaveCall();
    },
  },

  async created() {
    this.isLoading = true;

    // 15秒間接続できなければ終了
    const timeout = () => {
      if (this.isLoading) {
        this.errorEvent('エラーが発生しました。再読み込みしてください。');
      }
    };
    setTimeout(timeout, 15000);

    // ボリュームの調整
    this.notificationSounds.join.volume = 0.6;
    this.notificationSounds.leave.volume = 0.6;
    this.notificationSounds.receiveMessage.volume = 0.6;

    // // エラー発生時のイベント
    // Vue.config.errorHandler = (error) => {
    //   this.errorEvent('エラーが発生しました。再読み込みしてください。');
    // };

    // // エラー発生時のイベント
    // window.addEventListener('error', (error) => {
    //   this.errorEvent('エラーが発生しました。再読み込みしてください。');
    // });

    // // エラー発生時のイベント
    // window.addEventListener('unhandledrejection', (error) => {
    //   this.errorEvent('エラーが発生しました。再読み込みしてください。');
    // });

    // Peerの作成
    this.peer = new Peer({ key: API_KEY });

    // Peerの生成を待機
    await new Promise((resolve) => setTimeout(resolve, 1000));

    if (typeof this.peer.id !== 'undefined') {
      // 通話開始
      await this.makeCall();

      this.isLoading = false;

      // 自分の情報を送信
      this.call.send({ type: 'joinViewerData', content: this.authUser });
    }
  },

  async mounted() {
    // ユーザーデータの同期
    await this.$store.dispatch('auth/syncAuthUser');

    // 背景の設定
    const dialog = document.getElementsByClassName('v-dialog')[0];
    if (this.authUser.seat.role === 'mentor') {
      // 透過
      dialog.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    } else {
      // 画像
      dialog.style.backgroundImage =
        'url("' + this.$storage('seat') + 'seat_' + this.authUser.seat.id + '.png")';
    }

    // ツールバー表示制御の設定
    window.addEventListener('mousemove', this.showAppBar);
  },

  beforeDestroy() {
    // イベントの削除
    window.removeEventListener('mousemove', this.showAppBar);
    clearTimeout(this.appBar.timer);

    // 念の為
    this.exitCall();
  },
};
</script>

<style lang="scss" scoped>
.progress-linear {
  width: 430px;
}

.viewer {
  cursor: pointer;
}

.normal-container {
  height: 100vh;
}

.video {
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

  &.speaker {
    outline: 5px solid #f6bf00;
  }
}

#chat {
  position: -webkit-sticky;
  position: sticky;
  top: 8px;

  .overflow-y-auto {
    height: 500px;
    background-color: white;
  }
}

.app-bar {
  opacity: 0;
  transition: 0.8s;

  &.show {
    display: block;
    opacity: 1;
  }

  // 通知
  .notification {
    animation: scaleChange 2s infinite ease-out;
    transform-origin: 50% 50%;
    animation-play-state: running;

    @keyframes scaleChange {
      0% {
        transform: scale(0.8, 0.8);
      }
      5% {
        transform: scale(1.2, 1.2);
      }
      10% {
        transform: scale(1, 1);
      }
      15% {
        transform: scale(1.1, 1.1);
      }
      20% {
        transform: scale(1, 1);
      }
      100% {
        transform: scale(1, 1);
      }
    }
  }
}
</style>

<style lang="scss">
.v-dialog {
  background-size: cover;
}
</style>
