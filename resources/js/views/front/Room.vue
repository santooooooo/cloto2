<template>
  <div>
    <v-btn @click="buttonClickEvent('leave')">退席</v-btn>
    <v-btn @click="buttonClickEvent('break')">休憩</v-btn>

    <canvas :width="roomWidth" :height="roomHight" id="room"></canvas>
    <v-card class="mx-auto" max-width="344" outlined>
      <h1>{{ this.roomData.name }}教室</h1>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      canvas: {},
      isDisabledClick: false, // クリック制御
      roomData: [], // 教室データ
      roomWidth: 1080, // 教室サイズ
      roomHight: 600, // 教室サイズ
      iconSize: 30, // アイコンサイズ
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 教室の同期
     */
    syncRoom: async function () {
      var response = await this.$http.get(this.$endpoint('GET:roomShow', [this.$route.params.id]));

      // セクションのループ
      response.data.sections.forEach((section, sectionIndex) => {
        // 座席のループ
        section.seats.forEach((seat, seatIndex) => {
          if (this.roomData.length === 0) {
            // 初回取得
            this.setClickArea(seat.id, section.role, seat.position, seat.status);
          } else if (seat.status !== this.roomData.sections[sectionIndex].seats[seatIndex].status) {
            // 現在の状態から変化があれば再描画
            this.changeColor(seat.status, seat.id);
          }
        });
      });

      // データの更新
      this.roomData = response.data;
    },

    /**
     * キャンバスマウスオーバーイベント
     */
    canvasMouseOver: function (event) {
      if (event.target) {
        event.target.set({ fill: '#ff0000' });
        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスマウスオーバー解除イベント
     */
    canvasMouseOut: function (event) {
      if (event.target) {
        event.target.set({ fill: '#000000' });
        this.canvas.requestRenderAll();
      }
    },

    /**
     * キャンバスクリックイベント
     */
    canvasMouseDown: function (event) {
      if (!this.isDisabledClick) {
        if (event.target) {
          // 着席処理
          if (this.authUser.seat_id === null) {
            this.changeStatus(event.target, 'sitting');
          }
        }
      }
    },

    /**
     * ボタンクリックイベント
     *
     * @param String  status  遷移先の状態
     */
    buttonClickEvent: function (status) {
      if (!this.isDisabledClick) {
        // 状態変更処理
        if (this.authUser.seat_id !== null) {
          this.changeStatus(null, status);
        }
      }
    },

    /**
     * 状態の変更
     *
     * @param Object  changeObject 状態を変更する座席
     * @param String  status  遷移先の状態
     */
    changeStatus: async function (changeObject, status) {
      // クリックを無効化
      this.isDisabledClick = true;

      if (changeObject === null) {
        // 自分が着席中の座席を探索
        this.canvas.getObjects().forEach((object) => {
          if (object.id === this.authUser.seat_id) {
            changeObject = object;
          }
        });
      }

      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          break;

        case 'leave':
          var color = '#ffffff';
          break;

        case 'break':
          var color = '#000000';
          break;
      }

      changeObject.set({ fill: color });

      this.putIcon(changeObject);

      // 変更の適用
      this.canvas.requestRenderAll();

      // データベースへ状態を保存
      await this.seatAction(changeObject.id, status);

      // クリックを有効化
      this.isDisabledClick = false;
    },

    /**
     * 座席状態の変更
     *
     * @param Number  seatId  変更する座席
     * @param String  status  状態
     */
    seatAction: async function (seatId, status) {
      switch (status) {
        case 'sitting':
          var endpoint = this.$endpoint('POST:seatSit', [seatId]);
          break;

        case 'leave':
          var endpoint = this.$endpoint('POST:seatLeave', [seatId]);
          break;

        case 'break':
          var endpoint = this.$endpoint('POST:seatBreak', [seatId]);
          break;
      }

      await this.$http.post(endpoint);

      // ユーザーデータの同期
      await this.$store.dispatch('auth/syncAuthUser');
    },

    /**
     * クリックエリアの設定
     *
     * @param Number  seatId    描画する座席
     * @param String  role      座席の役割
     * @param JSON    position  描画位置
     * @param String  status    座席状態
     */
    setClickArea: function (seatId, role, position, status) {
      var position = JSON.parse(position);
      switch (status) {
        case 'sitting':
          var color = '#ff0000';
          break;

        case 'break':
          var color = '#000000';
          break;

        default:
          var color = '#ffffff';
          break;
      }

      this.canvas.add(
        new fabric.Circle({
          id: seatId,
          role: role,
          fill: 'black',
          stroke: 'black',
          opacity: 0.3,
          left: position.x,
          top: position.y,
          originX: 'center',
          originY: 'center',
          radius: this.iconSize / 2,
          strokeWidth: 1,
          hasControls: false, // 図形周囲のコントロールボタンの無効化
          hasBorders: false, // 図形周囲のボーダーの無効化
          lockMovementX: true, // 横移動の禁止
          lockMovementY: true, // 縦移動の禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },

    /**
     * アイコンの配置
     *
     * @param Object  locatedObject 配置される座席
     */
    putIcon: function (locatedObject) {
      var icon = new Image();
      icon.src = this.$storage('icon') + this.$store.getters['auth/user'].icon;

      this.canvas.add(
        new fabric.Image(icon, {
          left: locatedObject.x,
          top: locatedObject.y,
          scaleX: this.iconSize / icon.naturalWidth,
          scaleY: this.iconSize / icon.naturalHeight,
          clipPath: new fabric.Circle({
            scaleX: icon.naturalWidth / this.iconSize,
            scaleY: icon.naturalHeight / this.iconSize,
            radius: this.iconSize / 2,
            originX: 'center',
            originY: 'center',
          }),
          selectable: false, // 図形の選択を禁止
          hoverCursor: 'default', // カーソルの変更を禁止
        })
      );
    },
  },
  mounted() {
    this.canvas = new fabric.Canvas('room', {
      preserveObjectStacking: true, // オブジェクトの重なり順の固定
    });
    this.canvas.selection = false; // エリア選択の無効化
    this.canvas.setBackgroundImage(
      this.$storage('system') + 'room.png',
      this.canvas.renderAll.bind(this.canvas)
    );

    this.canvas.on('mouse:over', this.canvasMouseOver);
    this.canvas.on('mouse:out', this.canvasMouseOut);
    this.canvas.on('mouse:down', this.canvasMouseDown);

    // 初回取得
    this.syncRoom();

    // 同期開始
    // setInterval(this.syncRoom, 10000);
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

canvas {
  border: 7px solid $gray;
  margin: 0 auto;
}
</style>
