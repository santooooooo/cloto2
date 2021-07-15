<template>
  <v-dialog
    v-model="dialog"
    fullscreen
    persistent
    no-click-animation
    transition="dialog-bottom-transition"
  >
    <!-- 権限確認画面 -->
    <v-overlay :value="permissionOverlay" z-index="7" class="text-center" opacity="1">
      <div class="arrow"></div>
      <p class="text-h4">権限を許可してください。</p>
      <p class="text-body-2 mt-6 mr-8">（一度許可した方は必要ありません。）</p>
      <p class="text-h5 mt-12">通話を伴いますのでマイクとカメラを使用します。</p>
      <p class="text-h6 mb-0 mt-6 mr-8">（ミュート、カメラオフで接続されます。）</p>
    </v-overlay>

    <!-- ローディング画面 -->
    <v-overlay :value="loading" z-index="6" class="text-center" opacity="0.9">
      <p class="text-h5 mb-5">接続中</p>
      <v-progress-linear
        indeterminate
        height="10"
        color="green"
        class="progress-linear mb-12"
      ></v-progress-linear>

      <p class="text-body-2 mb-0 mt-12">カメラランプが10秒ほど点灯する場合があります．．．</p>
    </v-overlay>

    <!-- トピック -->
    <v-app-bar
      color="grey lighten-2"
      fixed
      top
      height="60"
      :class="['app-bar', appBar.isShow ? 'show' : '']"
    >
      <v-row dense justify="center">
        <v-col md="6" sm="10">
          <v-row dense>
            <v-text-field
              v-model="topic"
              clearable
              class="mt-8 px-2"
              label="トピック"
              @keydown="showAppBar"
              @keydown.enter="updateTopic"
              @click:clear="updateTopic"
            ></v-text-field>
            <v-btn icon class="mt-6" @click="updateTopic">
              <v-icon>mdi-send</v-icon>
            </v-btn>
          </v-row>
        </v-col>
      </v-row>
    </v-app-bar>

    <v-layout class="px-2" ref="container">
      <!-- 視聴者一覧 -->
      <v-flex class="viewer-container">
        <v-container fluid py-0>
          <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                class="bg-warning text-white font-weight-bold"
                v-bind="attrs"
                v-on="on"
                :disabled="!viewers.length"
              >
                参加人数：{{ viewers.length }}
              </v-btn>
            </template>

            <v-list max-height="200" class="bg-secondary">
              <v-list-item v-for="viewer in viewers" :key="viewer.id" class="viewer bg-secondary">
                <v-list-item-title
                  class="d-flex"
                  @click="
                    $store.dispatch('dialog/open', { type: 'user', username: viewer.username })
                  "
                >
                  <v-avatar size="40" class="ma-1">
                    <img :src="$storage('icon') + viewer.icon" />
                  </v-avatar>
                  <p class="ma-4 font-weight-bold text-white">{{ viewer.username }}</p>
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-container>
      </v-flex>

      <v-flex>
        <v-container fluid py-0>
          <!--*** 画面共有ON ***-->
          <v-row justify="center" v-if="screenSharing.stream">
            <!-- 自分のビデオ -->
            <v-sheet color="rgba(0, 0, 0, 1)" width="208" height="117" class="video ma-2">
              <!-- オフ -->
              <v-sheet
                color="black"
                width="208"
                height="117"
                class="d-flex justify-center align-center"
                v-if="isVideoLoading || isVideoOff || localStream === null"
              >
                <v-avatar size="50">
                  <img :src="$storage('icon') + authUser.icon" />
                </v-avatar>
              </v-sheet>

              <!-- オン -->
              <video
                width="208"
                height="117"
                muted="true"
                autoplay
                :srcObject.prop="localStream"
                v-else
              ></video>

              <p class="handlename" style="font-size: 0.8em">{{ authUser.handlename }}</p>

              <p class="is-mute" v-if="isAudioLoading || isMute">
                <v-icon color="red">mdi-microphone-off</v-icon>
              </p>
            </v-sheet>

            <!-- 参加者のビデオ -->
            <v-hover v-slot="{ hover }" v-for="speaker in notPinnedSpeakers" :key="speaker.peerId">
              <v-sheet
                color="rgba(0, 0, 0, 1)"
                width="208"
                height="117"
                :class="['video', 'ma-2', speakerId === speaker.peerId ? 'speaker' : '']"
              >
                <!-- オフ -->
                <v-sheet
                  color="black"
                  width="208"
                  height="117"
                  class="d-flex justify-center align-center"
                  v-if="speaker.loading || speaker.isVideoOff"
                >
                  <!-- ローディング中 -->
                  <v-progress-circular
                    size="40"
                    width="4"
                    color="green"
                    indeterminate
                    v-if="speaker.loading || speaker.icon === null"
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
                        @click="
                          $store.dispatch('dialog/open', {
                            type: 'user',
                            username: speaker.username,
                          })
                        "
                      >
                        <v-icon> mdi-account </v-icon>
                      </v-btn>
                    </v-sheet>
                  </v-overlay>
                </v-fade-transition>
              </v-sheet>
            </v-hover>

            <!-- 画面共有 -->
            <v-row justify="center" class="mt-3">
              <video autoplay :srcObject.prop="screenSharing.stream" id="screen-sharing"></video>
            </v-row>
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
                  v-if="pinnedSpeaker.loading || pinnedSpeaker.isVideoOff"
                >
                  <!-- ローディング中 -->
                  <v-progress-circular
                    size="70"
                    width="4"
                    color="green"
                    indeterminate
                    v-if="pinnedSpeaker.loading || pinnedSpeaker.icon === null"
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
                        @click="
                          $store.dispatch('dialog/open', {
                            type: 'user',
                            username: pinnedSpeaker.username,
                          })
                        "
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
            <!-- 自分のビデオ -->
            <v-col sm="6" md="6" lg="6">
              <v-row justify="center">
                <v-sheet
                  color="rgba(0, 0, 0, 1)"
                  :width="videoShowWidth"
                  :height="videoShowHeight"
                  class="video ma-2"
                >
                  <!-- オフ -->
                  <v-sheet
                    color="black"
                    :width="videoShowWidth"
                    :height="videoShowHeight"
                    class="d-flex justify-center align-center"
                    v-if="isVideoLoading || isVideoOff || localStream === null"
                  >
                    <v-avatar size="80">
                      <img :src="$storage('icon') + authUser.icon" />
                    </v-avatar>
                  </v-sheet>

                  <!-- オン -->
                  <video
                    :width="videoShowWidth"
                    :height="videoShowHeight"
                    muted="true"
                    autoplay
                    :srcObject.prop="localStream"
                    v-else
                  ></video>

                  <p class="handlename">{{ authUser.handlename }}</p>

                  <p class="is-mute" v-if="isAudioLoading || isMute">
                    <v-icon color="red">mdi-microphone-off</v-icon>
                  </p>
                </v-sheet>
              </v-row>
            </v-col>

            <!-- 参加者のビデオ -->
            <v-col sm="6" md="6" lg="6" v-for="speaker in notPinnedSpeakers" :key="speaker.peerId">
              <v-row justify="center">
                <v-hover v-slot="{ hover }">
                  <v-sheet
                    color="rgba(0, 0, 0, 1)"
                    :width="videoShowWidth"
                    :height="videoShowHeight"
                    :class="['video', 'ma-2', speakerId === speaker.peerId ? 'speaker' : '']"
                  >
                    <!-- オフ -->
                    <v-sheet
                      color="black"
                      :width="videoShowWidth"
                      :height="videoShowHeight"
                      class="d-flex justify-center align-center"
                      v-if="speaker.loading || speaker.isVideoOff"
                    >
                      <!-- ローディング中 -->
                      <v-progress-circular
                        size="70"
                        width="4"
                        color="green"
                        indeterminate
                        v-if="speaker.loading || speaker.icon === null"
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
                            @click="
                              $store.dispatch('dialog/open', {
                                type: 'user',
                                username: speaker.username,
                              })
                            "
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
        </v-container>
      </v-flex>

      <!-- タイマーの設定画面 -->
      <v-flex class="timer-setting" v-if="timer.setting.dialog">
        <v-card width="320">
          <v-row justify="space-around">
            <v-card-title>タイマーセット</v-card-title>
            <v-btn
              fab
              x-small
              depressed
              color="error"
              class="mt-3"
              @click="timer.setting.dialog = !timer.setting.dialog"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-row dense justify="center">
            <v-col md="3" sm="3">
              <v-row dense>
                <v-text-field
                  v-model="timer.setting.minutes"
                  class="mt-3 px-2"
                  label="分"
                  type="number"
                  min="0"
                  max="99"
                ></v-text-field>
              </v-row>
            </v-col>
            <v-col md="3" sm="3">
              <v-row dense>
                <v-text-field
                  v-model="timer.setting.seconds"
                  class="mt-3 px-2"
                  label="秒"
                  width="5%"
                  type="number"
                  min="0"
                  max="59"
                ></v-text-field>
              </v-row>
            </v-col>
            <v-col md="1" sm="3">
              <v-row dense>
                <v-btn
                  class="mt-5 text-white"
                  @click="setTimer"
                  color="yellow darken-3"
                  :disabled="!timerValidate"
                >
                  セット
                </v-btn>
              </v-row>
            </v-col>
          </v-row>
        </v-card>
      </v-flex>

      <!-- タイマー -->
      <v-flex
        class="timer"
        :style="{
          top: screenSharing.stream ? '7%' : '40%',
          left: screenSharing.stream ? '80%' : '40%',
        }"
        v-if="timer.isShow"
      >
        <v-toolbar width="280" class="rounded" color="yellow darken-3">
          <v-toolbar-title class="text-white mr-4" style="font-size: 2rem">
            <span v-if="String(timer.minutes).length === 1">0</span>{{ timer.minutes }}:<span
              v-if="String(timer.seconds).length === 1"
              >0</span
            >{{ timer.seconds }}</v-toolbar-title
          >
          <v-row justify="center">
            <v-btn
              icon
              color="white"
              @click="timer.play ? pauseAllTimer() : playAllTimer()"
              :disabled="timer.minutes === 0 && timer.seconds === 0"
            >
              <v-icon>{{ timer.play ? 'mdi-pause' : 'mdi-play' }}</v-icon>
            </v-btn>
            <v-btn icon color="white" @click="reloadAllTimer" :disabled="timer.reload">
              <v-icon>mdi-reload</v-icon>
            </v-btn>
            <v-btn icon color="white" @click="cancelTimer" :disabled="timer.cancel">
              <v-icon>mdi-close-circle</v-icon>
            </v-btn>
          </v-row>
        </v-toolbar>
      </v-flex>

      <!-- チャットエリア -->
      <v-flex xs2 v-show="chat.isOpen">
        <v-card color="grey lighten-2" class="mx-auto" id="chat">
          <div
            class="overflow-y-auto"
            :style="{ height: $windowHeight - 300 + 'px' }"
            ref="chatScrollArea"
          >
            <v-card-text v-for="(message, index) in chat.messages" :key="index">
              <span class="text-caption">{{ message.handlename }}</span>
              <span class="text-body-1 font-weight-bold" v-html="message.text"></span>
            </v-card-text>
          </div>

          <v-row no-gutters class="mt-2" justify="space-around">
            <v-btn text @click="sendEmoji('😄')">😄</v-btn>
            <v-btn text @click="sendEmoji('🤣')">🤣</v-btn>
            <v-btn text @click="sendEmoji('🤔')">🤔</v-btn>
            <v-btn text @click="sendEmoji('👏')">👏</v-btn>
            <v-btn text @click="sendEmoji('💥')">💥</v-btn>
            <v-btn text @click="sendEmoji('💩')">💩</v-btn>
          </v-row>

          <v-text-field
            v-model="chat.localText"
            class="mx-4"
            append-outer-icon="mdi-send"
            @keydown.enter="sendMessage"
            @click:append-outer="sendMessage"
          ></v-text-field>
        </v-card>
      </v-flex>
    </v-layout>

    <v-app-bar
      color="yellow darken-4"
      fixed
      bottom
      height="100"
      :class="['app-bar', appBar.isShow ? 'show' : '']"
    >
      <v-row>
        <v-col md="4" sm="4" align-self="center">
          <v-row justify="start" class="mt-8">
            <v-col md="6" sm="6">
              <v-select disabled label="ミュート" v-if="isMute"></v-select>
              <v-select
                v-model="selectedAudio"
                :items="audioDevices"
                item-text="label"
                item-value="deviceId"
                @change="changeDevice()"
                label="マイク"
                v-else
              >
              </v-select>
            </v-col>

            <v-col md="6" sm="6">
              <v-select disabled label="ビデオオフ" v-if="isVideoOff"></v-select>
              <v-select
                v-model="selectedVideo"
                :items="videoDevices"
                item-text="label"
                item-value="deviceId"
                @change="changeDevice()"
                label="ビデオ"
                v-else
              >
              </v-select>
            </v-col>
          </v-row>
        </v-col>

        <v-col md="4" sm="4" align-self="center">
          <v-row justify="center">
            <!-- ミュートボタン -->
            <v-btn
              :color="!isMute ? 'white' : 'red'"
              :disabled="isAudioLoading || isVideoLoading"
              fab
              depressed
              :large="$vuetify.breakpoint.lg"
              :class="[
                $vuetify.breakpoint.xl ? 'mx-10' : '',
                $vuetify.breakpoint.lg ? 'mx-8' : '',
                $vuetify.breakpoint.md ? 'mx-5' : 'mx-1',
              ]"
              @click="mute()"
            >
              <v-icon large>{{ !isMute ? 'mdi-microphone' : 'mdi-microphone-off' }}</v-icon>
            </v-btn>

            <!-- ビデオオフボタン -->
            <v-btn
              :color="!isVideoOff ? 'white' : 'red'"
              :disabled="isAudioLoading || isVideoLoading || !video"
              fab
              depressed
              :large="$vuetify.breakpoint.lg"
              :class="[
                $vuetify.breakpoint.xl ? 'mx-10' : '',
                $vuetify.breakpoint.lg ? 'mx-8' : '',
                $vuetify.breakpoint.md ? 'mx-5' : 'mx-1',
              ]"
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
              :large="$vuetify.breakpoint.lg"
              :class="[
                $vuetify.breakpoint.xl ? 'mx-10' : '',
                $vuetify.breakpoint.lg ? 'mx-8' : '',
                $vuetify.breakpoint.md ? 'mx-5' : 'mx-1',
              ]"
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
          </v-row>
        </v-col>

        <v-col md="4" sm="4" align-self="center">
          <v-row justify="end">
            <!-- タイマーボタン -->
            <v-btn color="white" icon class="mr-6">
              <v-icon @click="timer.setting.dialog = !timer.setting.dialog" large>mdi-alarm</v-icon>
            </v-btn>

            <!-- 通知音ボタン -->
            <v-btn color="white" icon class="mr-6" @click="$store.dispatch('alert/switchSound')">
              <v-icon large>
                {{ isNotificationOn ? 'mdi-music-note' : 'mdi-music-note-off' }}
              </v-icon>
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

            <!-- 部屋閲覧ボタン -->
            <v-btn
              color="white"
              icon
              class="mr-6"
              @mousedown="toggleShowRoom(true)"
              @mouseup="toggleShowRoom(false)"
              @mouseleave="toggleShowRoom(false)"
            >
              <v-icon large>mdi-chevron-down</v-icon>
            </v-btn>

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
import { JOIN_CALL_SOUND, LEAVE_CALL_SOUND, ALARM_SOUND } from '@/consts/sound';

const API_KEY = process.env.MIX_SKYWAY_API_KEY;

export default {
  props: {
    callId: Number,
  },
  data() {
    return {
      dialog: true, // 入室制御
      dialogElement: null, // ダイアログ要素
      permissionOverlay: false, // 権限確認画面
      loading: false, // ローディング制御
      appBar: {
        timer: null, // ツールバー表示タイマー
        isShow: false, // ツールバー表示制御
      },
      topic: null, // トピック

      //*** 通話 ***//
      participants: [], // 参加者
      roomMode: 'sfu', // 接続モード
      peer: null, // Peer接続オブジェクト
      localStream: null, // 自分の送信データ
      call: null, // 接続プロパティ
      screenSharing: {
        isLocal: false, // 自分の画面共有か
        peer: null, // Peer接続オブジェクト（画面共有用）
        stream: null, // 画面共有データ
      },

      //*** 入力デバイス ***//
      video: false, // ビデオの有無
      audioDevices: [], // 音声入力デバイス一覧
      videoDevices: [], // 映像入力デバイス一覧
      selectedAudio: null, // 選択されている音声入力
      selectedVideo: null, // 選択されている映像入力
      videoSize: {
        width: 640, // ビデオ取得サイズ（横）
        height: 360, // ビデオ取得サイズ（縦）
      },
      isAudioLoading: true, // マイク接続ローディング制御
      isMute: false, // ミュート制御
      isVideoLoading: true, // ビデオ接続ローディング制御
      isVideoOff: false, // ビデオオフ制御

      //*** 音声検出 ***//
      voiceDetectionObject: null, // 音声検出オブジェクト
      speakerId: null, // 話し中ユーザーのID

      //*** チャット ***//
      chat: {
        flow: null, // チャットクラス
        isOpen: false, // チャットエリア表示制御
        notification: false, // 通知制御
        localText: '', // 送信するメッセージ
        messages: [], // メッセージ一覧
      },

      //*** タイマー ***//
      timer: {
        isShow: false, // タイマーの表示制御
        setting: {
          dialog: false, // タイマーの設定画面の表示制御
          minutes: 0, // タイマーの設定画面の分数
          seconds: 0, // タイマーの設定画面の秒数
        },
        play: false, // タイマーのスタート制御
        pause: true, // タイマーの一時停止制御
        cancel: false, // タイマーの削除制御
        reload: false, // タイマーのリロード制御
        minutes: 0, // タイマーの分数
        seconds: 0, // タイマーの秒数
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
      return this.$windowWidth / 3.75;
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
    timerValidate() {
      // タイマーの設定値の検証
      const minutes = Number(this.timer.setting.minutes);
      const seconds = Number(this.timer.setting.seconds);

      const validMinutes = minutes < 99 && minutes >= 0 && Number.isInteger(minutes);
      const validSeconds = seconds < 59 && seconds >= 0 && Number.isInteger(seconds);

      const validMinAndSec = minutes > 0 || seconds > 0;

      if (validMinutes && validSeconds && validMinAndSec) {
        return true;
      }

      return false;
    },
  },
  watch: {
    $windowWidth: function () {
      // チャットクラスの更新
      this.setupChatClass();
    },
    $windowHeight: function () {
      // チャットクラスの更新
      this.setupChatClass();
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
        stream: this.localStream,
      });

      this.setupCallEvents();
    },

    /**
     * 通話のイベント
     */
    setupCallEvents: function () {
      // 他ユーザー参加イベント
      this.call.on('stream', (stream) => {
        this.joinSpeaker(stream);
      });

      // データ到着イベント
      this.call.on('data', async ({ data, src }) => {
        // 送信者が取得されるまで待機
        let sender;
        for (let i = 0; i < 50; i++) {
          // 参加直後，this.participantsへの追加前に検索されるので回避
          // 新規ユーザーのstreamよりも先にdataが届く
          // 存在しない場合の対策として上限を5秒に設定
          try {
            sender = await new Promise((resolve, reject) => {
              // 送信者を検索（参加者のPeerIDを確認）
              let participant = this.participants.filter((participant) => {
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
            break;

          case 'joinViewerData':
            // 参加した視聴者のデータの受信
            this.joinViewer(src, data.content);
            break;

          case 'loadingEvent':
            // ローディングイベント
            sender.loading = data.content;
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

            // 通知の表示
            if (!this.chat.isOpen) {
              this.chat.notification = true;
              this.showAppBar();
            }
            break;

          case 'setTimer':
            if (!this.timer.isShow) {
              // タイマーの表示
              this.timer.isShow = true;
            }
            // タイマーの設定
            this.timer.minutes = data.content.minutes;
            this.timer.seconds = data.content.seconds;
            // タイマーの再設定（リロード時）
            this.timer.setting.minutes = data.content.timerSettingMinutes;
            this.timer.setting.seconds = data.content.timerSettingSeconds;
            break;

          case 'cancelTimer':
            // タイマーの非表示
            this.timer.isShow = false;
            this.timer.play = false;
            this.timer.minutes = 0;
            this.timer.seconds = 0;
            break;

          case 'playTimer':
            if (!this.timer.play) {
              // タイマーの開始
              this.playTimer(data.content);
            } else {
              // タイマーが既に開始している場合は終了時刻の再設定のみ行う
              this.setExactTime(data.content);
            }
            break;

          case 'pauseTimer':
            // タイマーの一時停止
            this.pauseTimer();
            break;

          case 'reloadTimer':
            // タイマーのリロード
            this.reloadTimer();
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
      // 自分の画面共有が有効な場合
      if (this.screenSharing.isLocal) {
        // 画面共有の停止
        await this.stopScreenSharing();
      }

      if (this.peer !== null) {
        // 音声検知の終了
        this.stopVoiceDetection();

        // デバイスの使用を停止
        if (this.localStream !== null) {
          this.localStream.getTracks().forEach((track) => track.stop());
          this.localStream = null;
        }

        // 通話の接続を終了
        await this.peer.destroy();
        this.peer = null;
      }
    },

    /**
     * 登壇者の追加
     *
     * @param {MediaStream} stream - 参加した登壇者のストリーム
     */
    joinSpeaker: async function (stream) {
      // 参加者がいるか確認
      // ミュートやビデオの切替時にもストリームが置き換わるため発火する場合がある
      // 同一のPeerIDが存在しないことを確認する
      let isJoin = !this.participants.some((participant) => participant.peerId === stream.peerId);

      if (isJoin) {
        // ユーザーが参加した場合
        if (stream.getAudioTracks().length > 0) {
          // 現在の自分の状態を送信（新規参加者に現在の状態を通知）
          this.call.send({ type: 'joinSpeakerData', content: this.authUser });
          this.call.send({ type: 'loadingEvent', content: this.loading });
          this.call.send({ type: 'audioEvent', content: this.isMute });
          this.call.send({ type: 'videoEvent', content: this.isVideoOff });

          // 現在のトピックを送信
          if (this.topic !== null) {
            this.call.send({ type: 'topic', content: this.topic });
          }

          // 途中参加者へタイマーの情報を送信
          if (this.timer.isShow) {
            // 全体へ送信するデータの作成
            const timerInfo = {
              minutes: this.timer.minutes,
              seconds: this.timer.seconds,
              timerSettingMinutes: this.timer.setting.minutes,
              timerSettingSeconds: this.timer.setting.seconds,
            };

            // タイマーの情報を登壇者へ送信
            this.call.send({ type: 'setTimer', content: timerInfo });

            // タイマーがスタートしていた場合は途中参加者のタイマーもスタートさせる
            if (this.timer.play) {
              // タイマーの終了時刻を登壇者へ送信
              const now = this.$moment().format('MMMM Do YYYY, h:mm:ss a');
              const endTime = this.$moment(now, 'MMMM Do YYYY, h:mm:ss a')
                .add(this.timer.minutes, 'minutes')
                .add(this.timer.seconds, 'seconds');

              //タイマーをスタートさせる
              this.call.send({ type: 'playTimer', content: endTime });
            }
          }

          // 通知音
          if (this.isNotificationOn) {
            JOIN_CALL_SOUND.play();
          }

          // 参加者の追加
          this.participants.push({
            isPinned: false, // ピン留めしているか
            username: '', // ユーザー名
            handlename: '', // 表示名
            icon: null, // アイコン
            loading: true, // 接続待ち状態
            isMute: true, // ミュート状態
            isVideoOff: true, // ビデオオフ状態
            peerId: stream.peerId,
            stream: stream,
          });

          // 音声検知の開始
          this.startVoiceDetection(stream);
        } else {
          // 画面共有が参加した場合
          if (!this.screenSharing.isLocal) {
            // 自分が画面共有していない場合（他人が画面共有を開始）
            this.screenSharing.stream = stream;
          }
        }
      }
    },

    /**
     * 視聴者の追加
     *
     * @param {String} peerId - 参加した視聴者のPeerID
     * @param {Object} user - 参加した視聴者のデータ
     */
    joinViewer: async function (peerId, user) {
      // 参加者がいるか確認
      // ミュートやビデオの切替時にもストリームが置き換わるため発火する場合がある
      // 同一のPeerIDが存在しないことを確認する
      let isJoin = !this.participants.some((participant) => participant.peerId === peerId);

      if (isJoin) {
        // 現在の自分の状態を送信（新規参加者に現在の状態を通知）
        this.call.send({ type: 'joinSpeakerData', content: this.authUser });
        this.call.send({ type: 'loadingEvent', content: this.loading });
        this.call.send({ type: 'audioEvent', content: this.isMute });
        this.call.send({ type: 'videoEvent', content: this.isVideoOff });

        // 現在のトピックを送信
        if (this.topic !== null) {
          this.call.send({ type: 'topic', content: this.topic });
        }

        // 途中参加者へタイマーの情報を送信
        if (this.timer.isShow) {
          // 全体へ送信するデータの作成
          const timerInfo = {
            minutes: this.timer.minutes,
            seconds: this.timer.seconds,
            timerSettingMinutes: this.timer.setting.minutes,
            timerSettingSeconds: this.timer.setting.seconds,
          };

          // タイマーの情報を登壇会場全体へ送信
          this.call.send({ type: 'setTimer', content: timerInfo });
          // タイマーがスタートしていた場合は途中参加者のタイマーもスタートさせる
          if (this.timer.play) {
            // タイマーの終了時刻を登壇者へ送信
            const now = this.$moment().format('MMMM Do YYYY, h:mm:ss a');
            const endTime = this.$moment(now, 'MMMM Do YYYY, h:mm:ss a')
              .add(this.timer.minutes, 'minutes')
              .add(this.timer.seconds, 'seconds');

            // タイマーをスタートさせる
            this.call.send({ type: 'playTimer', content: endTime });
          }
        }

        // 通知音
        if (this.isNotificationOn) {
          JOIN_CALL_SOUND.play();
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
     * @param {String} peerId - 退出したユーザーのPeerID
     */
    leaveUser: function (peerId) {
      // 通知音
      if (this.isNotificationOn) {
        LEAVE_CALL_SOUND.play();
      }

      this.participants = this.participants.filter((participant) => {
        // 退出したユーザーのpeerId以外を残す
        return participant.peerId !== peerId;
      });
    },

    /**
     * 画面共有開始
     */
    startScreenSharing: async function () {
      if (this.screenSharing.stream === null) {
        try {
          this.screenSharing.peer = new Peer({ key: API_KEY });

          this.screenSharing.stream = await navigator.mediaDevices.getDisplayMedia({
            audio: false,
            video: true,
          });

          this.screenSharing.peer.joinRoom(this.callId, {
            mode: this.roomMode,
            stream: this.screenSharing.stream,
          });

          this.screenSharing.isLocal = true;

          this.setupScreenSharingEvents();
        } catch (error) {
          // キャンセルボタン押下時
          this.$store.dispatch('alert/error', '画面共有がキャンセルされました．．．');
        }
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
        await this.screenSharing.peer.destroy();
      }
    },

    /**
     * 通話デバイスへのアクセス
     */
    accessDevice: async function () {
      //** 権限確認 */
      this.permissionOverlay = true;

      // ビデオ通話
      await navigator.mediaDevices
        .getUserMedia({
          audio: true,
          video: true,
        })
        .then(async (stream) => {
          // デバイスの停止
          stream.getTracks().forEach((track) => track.stop());

          //** デバイスの一覧を取得 */
          const devices = await navigator.mediaDevices.enumerateDevices();
          // マイクデバイスの一覧を取得
          this.audioDevices = devices.filter((device) => {
            return (
              device.kind === 'audioinput' &&
              device.deviceId !== 'default' &&
              device.deviceId !== 'communications'
            );
          });
          // カメラデバイスの一覧を取得
          this.videoDevices = devices.filter((device) => {
            return (
              device.kind === 'videoinput' &&
              device.deviceId !== 'default' &&
              device.deviceId !== 'communications'
            );
          });

          // 初期値の設定
          this.selectedAudio = this.audioDevices[0].deviceId;
          this.selectedVideo = this.videoDevices[0].deviceId;
          this.video = true;
          this.permissionOverlay = false;
        })
        .catch(async (error) => {
          // 音声通話
          await navigator.mediaDevices
            .getUserMedia({
              audio: true,
              video: false,
            })
            .then(async (stream) => {
              // デバイスの停止
              stream.getTracks().forEach((track) => track.stop());

              //** デバイスの一覧を取得 */
              const devices = await navigator.mediaDevices.enumerateDevices();
              // マイクデバイスの一覧を取得
              this.audioDevices = devices.filter((device) => {
                return (
                  device.kind === 'audioinput' &&
                  device.deviceId !== 'default' &&
                  device.deviceId !== 'communications'
                );
              });

              // 初期値の設定
              this.selectedAudio = this.audioDevices[0].deviceId;
              this.video = false;
              this.permissionOverlay = false;
            });
        });
    },

    /**
     * 通話デバイスへの接続
     */
    connectDevice: async function () {
      // Audioは常に残す（どちらかを定義しておく必要あり）
      let constraints = {
        audio: this.selectedAudio ? { deviceId: this.selectedAudio } : false,
        video: this.selectedVideo && !this.isVideoOff ? { deviceId: this.selectedVideo } : false,
      };

      // 録画サイズの設定
      if (constraints.video) {
        constraints.video.width = {
          min: this.videoSize.width,
          max: this.videoSize.width,
        };
        constraints.video.height = {
          min: this.videoSize.height,
          max: this.videoSize.height,
        };
      }

      try {
        // デバイスの接続
        this.localStream = await navigator.mediaDevices.getUserMedia(constraints);

        // 起動時はすぐにカメラを停止する
        if (this.loading && constraints.video) {
          // 接続時にはenabledで停止
          // デバイスを停止すると，相手にvideoストリームが届かない
          this.localStream.getVideoTracks()[0].enabled = false;
        }

        // ストリーム再作成時にミュートが解除される（ビデオ切り替え時など）
        if (this.isMute) {
          this.localStream.getAudioTracks()[0].enabled = false;
        }
      } catch (error) {
        // 他のアプリがデバイスを使用している場合
        this.errorEvent(
          'マイクまたはカメラが認識できませんでした。ブラウザの設定から権限を有効化してから再読み込みしてください。'
        );
      }
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
    mute: async function () {
      this.isAudioLoading = true;

      this.isMute = !this.isMute;

      // Audio，Videoのいずれかを残しておく必要があるので，enableで制御
      this.localStream.getAudioTracks()[0].enabled = !this.isMute;

      // 通知
      this.call.send({ type: 'audioEvent', content: this.isMute });

      this.isAudioLoading = false;
    },

    /**
     * ビデオのオン/オフ切り替え
     */
    videoOff: async function () {
      this.isVideoLoading = true;

      this.isVideoOff = !this.isVideoOff;

      if (this.isVideoOff) {
        // ビデオデバイスの停止
        this.localStream.getVideoTracks().forEach((track) => track.stop());
      } else {
        // ビデオデバイスの再接続
        await this.changeDevice();
      }

      // 通知
      this.call.send({ type: 'videoEvent', content: this.isVideoOff });

      this.isVideoLoading = false;
    },

    /**
     * 音声検知の開始
     *
     * @param {MediaStream} stream - 音声検知するユーザーのストリーム
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
     * @param {String} peerId - 発言中のユーザーのPeerID
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
     * トピックの更新処理
     *
     * @param {Event} event - クリック or キーボードイベント
     */
    updateTopic: function (event) {
      // クリックまたは日本語変換以外のEnter押下時に発火
      if (event.type === 'click' || (event.type === 'keydown' && event.keyCode === 13)) {
        // ×アイコンの押下時
        if (event.target.ariaLabel === 'clear icon') {
          this.topic = '';
        }

        // トピックの更新
        this.call.send({ type: 'topic', content: this.topic });
        this.$store.dispatch('alert/success', 'トピックが更新されました。');
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
     * チャットクラスの設定
     */
    setupChatClass: function () {
      this.chat.flow = new FlowChat({
        app: this.$refs.container,
        width: this.$windowWidth - 10,
        height: this.$windowHeight - 50,
      });

      // チャットの待機
      this.chat.flow.listen();
    },

    /**
     * 絵文字の送信処理
     *
     * @param {String} emoji - 絵文字
     */
    sendEmoji: function (emoji) {
      // 絵文字の送信
      this.call.send({ type: 'message', content: emoji });

      // 自分の画面を更新
      this.addMessage(this.authUser.handlename, emoji);
    },

    /**
     * メッセージの送信処理
     *
     * @param {Event} event - クリック or キーボードイベント
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
     * @param {String} handlename - 表示名
     * @param {String} message - 内容
     */
    addMessage: function (handlename, message) {
      let text = this.$formatStr(message);

      // メッセージを流す
      this.chat.flow.send(text, '#ffffff', 50);

      // メッセージの追加
      this.chat.messages.push({
        handlename: handlename,
        text: text,
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
     * @param {Object} participant - ピン留めする参加者
     */
    pin: function (participant) {
      // 既にピン留めされているユーザーを解除
      if (this.pinnedSpeaker) {
        this.pinnedSpeaker.isPinned = false;
      }

      participant.isPinned = true;
    },

    /**
     * ツールバーの表示制御
     *
     * @param {Event} event - マウス移動イベント
     */
    showAppBar: function (event = null) {
      // マウスが動作すると表示
      this.appBar.isShow = true;
      clearTimeout(this.appBar.timer);

      let hide = true;
      if (event !== null) {
        // マウスがツールバー上にある場合，非表示にしない
        let cursorFromBottom = this.$windowHeight - event.clientY;
        if (cursorFromBottom <= 100) {
          hide = false;
        }
      }

      if (hide) {
        this.appBar.timer = setTimeout(() => {
          // 停止1秒後に隠す
          this.appBar.isShow = false;
        }, 1000);
      }
    },

    /**
     * 部屋の表示切り替え
     */
    toggleShowRoom: function (show) {
      if (show) {
        this.$refs.container.style.opacity = 0;
        this.dialogElement.style.backgroundImage = null;
      } else {
        this.$refs.container.style.opacity = 1;
        this.dialogElement.style.backgroundImage =
          'url("' + this.$storage('seat') + 'seat_' + this.authUser.seat.id + '.png")';
      }
    },

    /**
     * エラー発生時のイベント
     *
     * @param {String} message - エラーメッセージ
     */
    errorEvent: function (message) {
      this.$store.dispatch('alert/error', message);
      this.leaveCall();
    },

    /**
     * タイマーのセット
     */
    setTimer: function () {
      if (this.timerValidate) {
        // タイマーの表示
        this.timer.isShow = true;

        this.timer.setting.minutes = Number(this.timer.setting.minutes);
        this.timer.setting.seconds = Number(this.timer.setting.seconds);
        this.timer.minutes = this.timer.setting.minutes;
        this.timer.seconds = this.timer.setting.seconds;

        // 全体へ送信するデータの作成
        const timerInfo = {
          minutes: this.timer.minutes,
          seconds: this.timer.seconds,
          timerSettingMinutes: this.timer.setting.minutes,
          timerSettingSeconds: this.timer.setting.seconds,
        };

        // タイマーの情報を登壇会場全体へ送信
        this.call.send({ type: 'setTimer', content: timerInfo });
      } else {
        this.$store.dispatch(
          'alert/error',
          'タイマーの設定値に誤りがあります。正しい値を入力してください。'
        );
      }
    },

    /**
     * タイマーの終了時刻から正確な時間を取得し，タイマーへセット
     *
     * @param {String} endTime - タイマー設定者から送信されたタイマー終了時刻
     */
    setExactTime: function (endTime) {
      endTime = this.$moment(endTime);
      const now = this.$moment();

      // 終了時刻と現在の時刻の差からタイマーにセットする分数・秒数を求める
      const diffMinutes = this.$moment(endTime, 'MMMM Do YYYY, h:mm:ss a').diff(
        this.$moment(now, 'MMMM Do YYYY, h:mm:ss a'),
        'minutes'
      );
      const diffSeconds = this.$moment(endTime, 'MMMM Do YYYY, h:mm:ss a').diff(
        this.$moment(now, 'MMMM Do YYYY, h:mm:ss a'),
        'seconds'
      );

      // タイマーにセット
      this.timer.minutes = diffMinutes;
      this.timer.seconds = diffSeconds - diffMinutes * 60;
    },

    /**
     * タイマーの開始
     *
     * @param {String} endTime - タイマー設定者から送信されたタイマー終了時刻
     */
    playTimer: function (endTime) {
      this.setExactTime(endTime);

      this.timer.play = true;
      this.timer.cancel = true;
      this.timer.pause = false;
      this.timer.reload = true;

      // カウントダウン
      const countDown = () => {
        // 退席した際にタイマーの動作を停止
        if (this.peer === null) {
          clearInterval(play);
          clearInterval(pause);
          return;
        }

        if (this.timer.seconds >= 0) {
          // 分数が1以上ので秒数が0になるとき、分数を一つ下げて秒数を60にする
          if (this.timer.minutes > 0 && this.timer.seconds === 0) {
            this.timer.minutes--;
            this.timer.seconds += 60;
          }

          if (this.timer.seconds === 0) {
            ALARM_SOUND.play();

            // カウントダウンの終了
            clearInterval(play);
            // 一時停止の検知の終了
            clearInterval(pause);

            this.timer.cancel = false;
            this.timer.reload = false;
            return;
          }

          // 秒数のカウントダウン。
          this.timer.seconds--;
        }
      };

      // 一時停止
      const stopCount = () => {
        if (this.timer.pause) {
          clearInterval(play);
          clearInterval(pause);
        }
      };

      // カウントダウンの開始
      const play = setInterval(countDown, 1000);
      // 一時停止の検知の開始
      const pause = setInterval(stopCount, 10);
    },

    /**
     * タイマーの一時停止
     */
    pauseTimer: function () {
      this.timer.play = false;
      this.timer.pause = true;
      this.timer.cancel = false;
      this.timer.reload = false;
    },

    /**
     * タイマーのリロード
     */
    reloadTimer: function () {
      this.timer.play = false;
      // タイマーの値を設定画面で設定した値に戻す
      this.timer.minutes = Number(this.timer.setting.minutes);
      this.timer.seconds = Number(this.timer.setting.seconds);
    },

    /**
     * タイマーの解除
     */
    cancelTimer: function () {
      // タイマーの非表示
      this.timer.isShow = false;
      this.timer.play = false;
      this.timer.minutes = 0;
      this.timer.seconds = 0;

      // タイマーの解除を登壇会場全体へ送信
      this.call.send({ type: 'cancelTimer', content: null });
    },

    /**
     * 登壇会場全体のタイマーの開始
     */
    playAllTimer: function () {
      // 終了時刻を求める
      const now = this.$moment().format('MMMM Do YYYY, h:mm:ss a');
      const endTime = this.$moment(now, 'MMMM Do YYYY, h:mm:ss a')
        .add(this.timer.minutes, 'minutes')
        .add(this.timer.seconds, 'seconds');

      // 登壇会場内の全ユーザーのタイマーを開始
      this.call.send({ type: 'playTimer', content: endTime });

      // 自身のタイマーを開始
      this.playTimer(endTime);
    },

    /**
     * 登壇会場全体のタイマーの一時停止
     */
    pauseAllTimer: function () {
      // 登壇会場内の全ユーザーのタイマーを一時停止
      this.call.send({ type: 'pauseTimer', content: null });
      // 自身のタイマーを一時停止
      this.pauseTimer();
    },

    /**
     * 登壇会場全体のタイマーのリロード
     */
    reloadAllTimer: function () {
      // 登壇会場内の全ユーザーのタイマーをリロード
      this.call.send({ type: 'reloadTimer', content: null });
      // 自身のタイマーをリロード
      this.reloadTimer();
    },
  },

  async created() {
    this.loading = true;

    // 15秒間接続できなければ終了
    const timeout = () => {
      // 権限確認中の場合，再度待機
      if (this.permissionOverlay) {
        setTimeout(timeout, 15000);
      } else {
        if (this.loading) {
          this.errorEvent('エラーが発生しました。再読み込みしてください。');
        }
      }
    };
    setTimeout(timeout, 15000);

    // エラー発生時のイベント
    Vue.config.errorHandler = (error) => {
      this.$slack(
        'エラーBot',
        ':poop:',
        this.authUser.username + '様のデバイスでエラー発生！\n' + '```' + error + '```'
      );
      this.errorEvent('エラーが発生しました。再読み込みしてください。');
    };

    // エラー発生時のイベント
    window.addEventListener('error', (error) => {
      this.$slack(
        'エラーBot',
        ':poop:',
        this.authUser.username +
          '様のデバイスでエラー発生！\n' +
          '```' +
          error.type +
          ': ' +
          error.message +
          '```'
      );
      this.errorEvent('エラーが発生しました。再読み込みしてください。');
    });

    // エラー発生時のイベント
    window.addEventListener('unhandledrejection', (error) => {
      this.$slack(
        'エラーBot',
        ':poop:',
        this.authUser.username + '様のデバイスでエラー発生！\n' + '```' + error.reason + '```'
      );
      this.errorEvent('エラーが発生しました。再読み込みしてください。');
    });

    // Peerの作成
    this.peer = new Peer({ key: API_KEY });

    // Peerの生成を待機
    await new Promise((resolve) => setTimeout(resolve, 1000));

    if (typeof this.peer.id !== 'undefined') {
      // デバイスの接続
      await this.accessDevice();
      await this.connectDevice();

      // 通話開始
      await this.makeCall();

      // 通話開始時はミュート/ビデオオフに設定
      this.mute();
      setTimeout(() => {
        // ビデオオフを遅延させないと，videoストリームが相手に接続できない
        this.videoOff();

        // 通知音の有効化
        this.$store.dispatch('alert/switchSound', {
          isOn: true,
          sound: JOIN_CALL_SOUND,
        });

        this.loading = false;
        this.call.send({ type: 'loadingEvent', content: false });
      }, 5000);
    }
  },

  async mounted() {
    // ユーザーデータの同期
    await this.$store.dispatch('auth/syncAuthUser');

    // 背景の設定
    this.dialogElement = document.getElementsByClassName('v-dialog')[0];
    this.dialogElement.style.backgroundImage =
      'url("' + this.$storage('seat') + 'seat_' + this.authUser.seat.id + '.png")';

    // ツールバー表示制御の設定
    window.addEventListener('mousemove', this.showAppBar);

    // チャットクラスの設定
    this.setupChatClass();
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
.arrow {
  display: inline-block;
  height: 80px;
  width: 40px;
  background-color: #5bc0de;
  position: relative;
  top: 60px;
  left: -300px;
}

.arrow:before {
  position: absolute;
  content: '';
  width: 0px;
  height: 0px;
  border: 60px solid transparent;
  border-bottom: 60px solid #5bc0de;
  left: -40px;
  top: -120px;
}

.progress-linear {
  width: 430px;
}

.viewer-container {
  position: absolute;
  top: 5rem;
}

.timer-setting {
  position: absolute;
  z-index: 3;
  top: 40%;
  left: 65%;
}

.timer {
  position: absolute;
  z-index: 2;
}

.video {
  position: relative;

  // v-hover要素に適用
  .v-overlay {
    z-index: 0 !important;
  }

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

#screen-sharing {
  max-width: 80%;
}

.normal-container {
  height: 100vh;
}

#chat {
  position: absolute;
  z-index: 2;
  top: 3rem;
  right: 1rem;
  width: 15%;

  .overflow-y-auto {
    background-color: white;
  }
}

.app-bar {
  transition: 0.8s;
  opacity: 0;
  pointer-events: none;

  &.show {
    opacity: 1;
    pointer-events: auto;
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

.viewer {
  cursor: pointer;
}
</style>
