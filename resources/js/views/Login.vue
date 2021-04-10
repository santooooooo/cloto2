<template>
  <div id="login">
    <v-row no-gutters justify="center">
      <div id="canvas-container">
        <canvas :width="imgWidth" :height="imgHeight" id="canvas"></canvas>
      </div>
    </v-row>

    <!-- 吹き出し -->
    <div id="popup" ref="popup" v-show="popup.isShow">
      <p class="text-h5">{{ popup.text }}</p>
    </div>

    <!-- ログイン，新規登録ダイアログ -->
    <LoginDialog
      :is-open="isOpenLoginDialog"
      @close="isOpenLoginDialog = $event"
      @open-register-dialog="isOpenRegisterDialog = $event"
    />
    <RegisterDialog :is-open="isOpenRegisterDialog" @close="isOpenRegisterDialog = $event" />
  </div>
</template>

<script>
import LoginDialog from '@/components/auth/LoginDialog';
import RegisterDialog from '@/components/auth/RegisterDialog';

export default {
  head: {
    title() {
      return {
        inner: 'ログイン',
      };
    },
  },
  components: {
    LoginDialog,
    RegisterDialog,
  },
  data() {
    return {
      canvas: null, // キャンバスエリア
      imgWidth: 2600, // 画像サイズ
      imgHeight: 1200, // 画像サイズ
      popup: {
        isShow: false, // 吹き出し制御
        text: 'クリックしてみよう！', // 吹き出しに表示するテキスト
      },
      isOpenLoginDialog: false, // ログインダイアログ表示制御
      isOpenRegisterDialog: false, // 新規登録ダイアログ表示制御
    };
  },

  computed: {
    authCheck() {
      return this.$store.getters['auth/check'];
    },
  },

  watch: {
    $windowWidth: function (windowWidth) {
      // ウィンドウリサイズ時に拡大率を変更
      if (this.canvas) {
        let zoom = (windowWidth - 10) / this.imgWidth;
        this.setZoom(zoom);
      }
    },
  },

  methods: {
    /**
     * オブジェクト色の設定
     *
     * @param {Object} object - 設定するオブジェクト
     * @param {String} color - 設定する色
     */
    setColor: function (object, color) {
      object.set({ fill: color });
      this.canvas.requestRenderAll();
    },

    /**
     * オブジェクト色の初期化
     *
     * @param {Object} object - 初期化するオブジェクト
     */
    resetColor: function (object) {
      this.setColor(object, '');
    },

    /**
     * 吹き出しの表示
     */
    showPopup: function () {
      // 吹き出しの位置を設定
      let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      this.$refs.popup.style.left = window.event.clientX + 'px';
      this.$refs.popup.style.top = window.event.clientY + scrollTop - 50 + 'px';
      // 表示
      this.popup.isShow = true;
    },

    /**
     * 吹き出しの非表示
     */
    hidePopup: function () {
      this.popup.isShow = false;
    },

    /**
     * キャンバスマウスオーバーイベント
     *
     * @param {Object} target - イベントの対象
     */
    canvasMouseOver: function (target) {
      this.setColor(target, '#0000FF');
      this.showPopup(target);
    },

    /**
     * キャンバスマウスオーバー解除イベント
     *
     * @param {Object} target - イベントの対象
     */
    canvasMouseOut: function (target) {
      this.resetColor(target);
      this.hidePopup();
    },

    /**
     * キャンバスクリックイベント
     */
    canvasMouseDown: function () {
      this.isOpenLoginDialog = true;
    },

    /**
     * 拡大の適用
     *
     * @param {Number} zoom - 拡大率
     */
    setZoom: function (zoom) {
      this.canvas.setZoom(zoom);
      this.canvas.setWidth(this.imgWidth * zoom);
      this.canvas.setHeight(this.imgHeight * zoom);
    },
  },

  mounted() {
    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('canvas', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'login.png',
      this.canvas.renderAll.bind(this.canvas)
    );

    // 初期サイズの設定（横幅MAX）
    let zoom = (this.$windowWidth - 10) / this.imgWidth;
    this.setZoom(zoom);

    // クリックエリアの設定
    this.canvas.add(
      new fabric.Rect({
        fill: '',
        opacity: 0.1,
        left: 1050,
        top: 430,
        width: 490,
        height: 500,
        originX: 'left',
        originY: 'top',
        hoverCursor: 'pointer',
        selectable: false, // 図形の選択を禁止
      })
    );

    // マウスオーバーイベントの設定
    this.canvas.on('mouse:over', (event) => {
      // オブジェクトのオーバー時にのみ実行
      if (event.target) {
        this.canvasMouseOver(event.target);
      }
    });

    // マウスオーバー解除イベントの設定
    this.canvas.on('mouse:out', (event) => {
      // オブジェクトのオーバー解除時にのみ実行
      if (event.target) {
        this.canvasMouseOut(event.target);
      }
    });

    // クリックイベントの設定
    this.canvas.on('mouse:down', (event) => {
      // オブジェクトのクリック時にのみ実行
      if (event.target) {
        this.canvasMouseDown(event.target);
      }
    });
  },
};
</script>

<style lang="scss" scoped>
#login {
  background-color: #000000;

  #canvas-container {
    height: calc(100vh - 64px);
  }

  #popup {
    position: absolute;
    max-width: 300px;

    p {
      padding: 5px 10px;
      background: #ffffff;
      border: 5px solid #000000;
      border-radius: 10px;
      font-weight: bold;
    }
  }
}
</style>
