<template>
  <div id="map">
    <v-row no-gutters justify="center">
      <div id="canvas-container" v-dragscroll>
        <canvas :width="mapWidth" :height="mapHeight" id="canvas"></canvas>
      </div>
    </v-row>

    <!-- 建物名吹き出し -->
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
        inner: 'マップ',
      };
    },
  },
  components: {
    LoginDialog,
    RegisterDialog,
  },
  data() {
    return {
      isLoading: false, // ローディング制御
      canvas: null, // キャンバスエリア
      mapWidth: 2600, // マップサイズ
      mapHeight: 1200, // マップサイズ
      buildings: [
        {
          name: 'クリックしてみよう！',
          position: {
            x: 700,
            y: 200,
            width: 1300,
            height: 900,
          },
          url: 'https://cloto.jp',
        },
        // {
        //   name: 'サブ塾',
        //   position: {
        //     x: 1450,
        //     y: 550,
        //     width: 300,
        //     height: 300,
        //   },
        //   url: 'https://sub-juku.cloto.jp',
        // },
      ],
      popup: {
        isShow: false, // 吹き出し制御
        text: '', // 吹き出しに表示するテキスト
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
        var zoom = windowWidth / this.mapWidth;
        this.setZoom(zoom);
      }
    },
  },

  methods: {
    /**
     * 建物色の設定
     *
     * @param Object  buildingObject  設定する建物オブジェクト
     * @param String  color           設定する色
     */
    setColor: function (buildingObject, color) {
      buildingObject.set({ fill: color });
      this.canvas.requestRenderAll();
    },

    /**
     * 建物色の初期化
     *
     * @param Object  buildingObject  初期化する建物オブジェクト
     */
    resetColor: function (buildingObject) {
      this.setColor(buildingObject, '');
    },

    /**
     * 吹き出しの表示
     *
     * @param Object  buildingObject  表示する建物オブジェクト
     */
    showPopup: function (buildingObject) {
      // 吹き出しの位置を設定
      var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      this.$refs.popup.style.left = window.event.clientX + 'px';
      this.$refs.popup.style.top = window.event.clientY + scrollTop - 50 + 'px';
      // 表示
      this.popup.text = buildingObject.name;
      this.popup.isShow = true;
    },

    /**
     * 吹き出しの非表示
     */
    hidePopup: function () {
      this.popup.isShow = false;
      this.popup.text = '';
    },

    /**
     * キャンバスマウスオーバーイベント
     *
     * @param target イベントの対象
     */
    canvasMouseOver: function (target) {
      this.setColor(target, '#0000FF');
      this.showPopup(target);
    },

    /**
     * キャンバスマウスオーバー解除イベント
     *
     * @param target イベントの対象
     */
    canvasMouseOut: function (target) {
      this.resetColor(target);
      this.hidePopup();
    },

    /**
     * キャンバスクリックイベント
     *
     * @param target イベントの対象
     */
    canvasMouseDown: function (target) {
      // if (target.name === process.env.MIX_APP_NAME) {
      // ログイン処理
      if (!this.authCheck) {
        this.isOpenLoginDialog = true;
      } else {
        this.$router.push({ name: 'entrance' });
      }
      // } else {
      //   // リダイレクト
      //   window.location.href = target.url;
      // }
    },

    /**
     * キャンバススクロールイベント
     *
     * @param event マウスイベント
     */
    canvasScroll: function (event) {
      // 拡大率の計算
      var delta = event.e.deltaY;
      var defaultZoom = this.$windowWidth / this.mapWidth;
      var zoom = this.canvas.getZoom();
      zoom *= 0.999 ** delta;
      if (zoom > 1.3) zoom = 1.3;
      if (zoom < defaultZoom) zoom = defaultZoom;

      // 拡大の適用
      this.setZoom(zoom);

      // スクロールによる移動の無効化
      event.e.preventDefault();
      event.e.stopPropagation();
    },

    /**
     * 拡大の適用
     *
     * @param Number  zoom  拡大率
     */
    setZoom: function (zoom) {
      this.canvas.setZoom(zoom);
      this.canvas.setWidth(this.mapWidth * zoom);
      this.canvas.setHeight(this.mapHeight * zoom);
    },
  },

  mounted() {
    // ロード開始
    this.isLoading = true;

    /**
     * キャンバスの設定
     */
    this.canvas = new fabric.Canvas('canvas', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'map.png',
      this.canvas.renderAll.bind(this.canvas)
    );
    this.canvas.defaultCursor = 'grab';

    // 初期サイズの設定（横幅MAX）
    var zoom = this.$windowWidth / this.mapWidth;
    this.setZoom(zoom);

    // クリックエリアの設定
    this.buildings.forEach((building) => {
      this.canvas.add(
        new fabric.Rect({
          name: building.name,
          url: building.url,
          fill: '',
          opacity: 0.1,
          left: building.position.x,
          top: building.position.y,
          width: building.position.width,
          height: building.position.height,
          originX: 'left',
          originY: 'top',
          hoverCursor: 'pointer',
          selectable: false, // 図形の選択を禁止
        })
      );
    });

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
      this.canvas.defaultCursor = 'grabbing';

      // オブジェクトのクリック時にのみ実行
      if (event.target) {
        this.canvasMouseDown(event.target);
      }
    });

    // クリック終了イベントの設定
    this.canvas.on('mouse:up', () => {
      this.canvas.defaultCursor = 'grab';
    });

    // スクロールイベントの設定
    this.canvas.on('mouse:wheel', this.canvasScroll);

    // ロード終了
    this.isLoading = false;
  },
};
</script>

<style lang="scss" scoped>
#map {
  background-color: #000000;

  #canvas-container {
    height: calc(100vh - 64px);
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

    &::-webkit-scrollbar {
      display: none;
    }
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
