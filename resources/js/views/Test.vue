<template>
  <div id="app">
    <video id="their-video" width="200" autoplay playsinline></video>
    <video id="my-video" muted="true" width="500" autoplay playsinline></video>
    <p>
      Your Peer ID: <span id="my-id">{{ peerId }}</span>
    </p>
    <input v-model="roomName" placeholder="room name" />
    <button @click="makeCall" class="button--green">Call</button>
    <br />

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
      <option disabled value="">Please select one</option>
      <option
        v-for="(videoDevice, index) in videoDevices"
        v-bind:key="index"
        :value="videoDevice.value"
      >
        {{ videoDevice.text }}
      </option>
    </select>
  </div>
</template>

<script>
const API_KEY = '2e332f2b-d951-499d-bc1a-451f4aeaf7b1';

export default {
  data: function () {
    return {
      audioDevices: [],
      videoDevices: [],
      selectedAudio: '',
      selectedVideo: '',
      peerId: '',
      roomName: '',
      localStream: {},
    };
  },
  methods: {
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

      const stream = await navigator.mediaDevices.getUserMedia(constraints);
      document.getElementById('my-video').srcObject = stream;
      this.localStream = stream;
    },

    makeCall: function () {
      //   const call = this.peer.call(this.calltoid, this.localStream);
      const call = this.peer.joinRoom(this.roomName, { mode: 'sfu', stream: this.localStream });
      this.connect(call);
    },

    connect: function (call) {
      call.on('stream', (stream) => {
        const el = document.getElementById('their-video');
        el.srcObject = stream;
        el.play();
      });
    },
  },

  created: async function () {
    console.log(API_KEY);
    this.peer = new Peer({ key: API_KEY, debug: 3 }); //新規にPeerオブジェクトの作成
    this.peer.on('open', () => (this.peerId = this.peer.id)); //PeerIDを反映
    this.peer.on('call', (call) => {
      call.answer(this.localStream);
      this.connect(call);
    });

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

    console.log(this.audioDevices, this.videoDevices);
    // console.log(deviceInfos);
  },
};
</script>

<style scoped>
p {
  font-size: 2em;
  text-align: center;
}
</style>
