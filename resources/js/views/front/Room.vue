<template>
  <div>
    <v-btn @click="buttonClickEvent('leave')">退席</v-btn>
    <v-btn @click="buttonClickEvent('break')">休憩</v-btn>

    <canvas :width="roomWidth" :height="roomHight" id="room"></canvas>
    <v-card class="mx-auto" max-width="344" outlined>
      <h1>{{ this.roomData.name }}教室</h1>
    </v-card>

    <v-row justify="center">
      <v-btn color="primary" dark @click="enterLounge(20)">Open Dialog</v-btn>

      <v-dialog v-model="chatDialog" width="600px" scrollable persistent>
        <v-card>
          <v-card-title>Select Country</v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            Lorem ipsum dolor sit amet, semper quis, sapien id natoque elit. Nostra urna at, magna at neque sed sed ante imperdiet, dolor mauris cursus velit, velit non, sem nec. Volutpat sem ridiculus placerat leo, augue in, duis erat proin condimentum in a eget, sed fermentum sed vestibulum varius ac, vestibulum volutpat orci ut elit eget tortor. Ultrices nascetur nulla gravida ante arcu. Pharetra rhoncus morbi ipsum, nunc tempor debitis, ipsum pellentesque, vitae id quam ut mauris dui tempor, aptent non. Quisque turpis. Phasellus quis lectus luctus orci eget rhoncus. Amet donec vestibulum mattis commodo, nulla aliquet, nibh praesent, elementum nulla. Sit lacus pharetra tempus magna neque pellentesque, nulla vel erat.
            Justo ex quisque nulla accusamus venenatis, sed quis. Nibh phasellus gravida metus in, fusce aenean ut erat commodo eros. Ut turpis, dui integer, nonummy pede placeat nec in sit leo. Faucibus porttitor illo taciti odio, amet viverra scelerisque quis quis et tortor, curabitur morbi a. Enim tempor at, rutrum elit condimentum, amet rutrum vitae tempor torquent nunc. Praesent vestibulum integer maxime felis. Neque aenean quia vitae nostra, tempus elit enim id dui, at egestas pulvinar. Integer libero vestibulum, quis blandit scelerisque mattis fermentum nulla, tortor donec vestibulum dolor amet eget, elit nullam. Aliquam leo phasellus aliquam curabitur metus a, nulla justo mattis duis interdum vel, mollis vitae et id, vestibulum erat ridiculus sit pulvinar justo sed. Vehicula convallis, et nulla wisi, amet vestibulum risus, quam ac egestas.
            Et vitae, nulla gravida erat scelerisque nullam nunc pellentesque, a dictumst cras augue, purus imperdiet non. Varius montes cursus varius vel tortor, nec leo a qui, magni cras, velit vel consectetuer lobortis vel. Nibh erat et wisi felis leo porttitor, sapien nibh sapien pede mi, sed eget porttitor, repellendus arcu ac quis. Luctus vulputate aut est sem magna, placerat accumsan nunc vestibulum ipsum ac auctor, maecenas lorem in ut nec mauris tortor, doloribus varius sem tortor vestibulum mollis, eleifend tortor felis tempus lacus eu eu. Eleifend vel eu, nullam maecenas mauris nec nunc euismod, tortor porta ridiculus potenti, massa tristique nam magna, et wisi placerat et erat ante. Eget pede erat in facilisis, fermentum venenatis sodales. Ac tortor sociis et non animi tristique, rhoncus malesuada, ut arcu volutpat scelerisque sollicitudin, elit curabitur dui pede purus dolor, integer aenean risus taciti nulla eleifend accumsan. At pulvinar diam parturient, interdum mi velit aliquet et a. Arcu at ac placerat eget justo semper, purus sociis curabitur mi ipsum consequat ut, mollis vestibulum, est ante ornare lacus sem. Neque magna mauris, commodo quisque, praesent semper suscipit lobortis nam. Justo malesuada cursus ac nunc litora nunc. Tellus ac, in lobortis nunc, montes lectus purus fermentum.
            Ac sit wisi. Sodales aliquam, sed vestibulum nullam arcu sit risus arcu, id luctus vitae lorem nibh, integer nec nullam class cursus mi, purus arcu lectus. Vel ante suscipit volutpat potenti mattis sed, wisi eu placerat aliquam erat, lectus morbi lobortis at assumenda. Consequat neque purus ipsum voluptas odio, netus vestibulum ut nec, suspendisse pellentesque nec enim in. Wisi dictum sed semper a, ipsum erat tellus habitasse est, erat sem ornare, vitae quisque ultricies. Dui sed blandit. Tempor et faucibus justo sed luctus, nec vitae vitae. Nunc nibh pede, ipsum vestibulum aenean leo ante ultricies, nam cras quis sed penatibus amet. In mauris a. Integer metus mauris tortor, et rutrum vestibulum ultricies, ut phasellus in ullamcorper ut mollit, eu justo. Cursus pretium venenatis.
            Cras pellentesque vel sodales accumsan aenean. Feugiat metus sit nec in aliquet amet, porttitor pretium vulputate massa. Consequat ipsum luctus quisque adipiscing libero. Wisi sollicitudin. Eget vitae ac lobortis, lorem natoque vestibulum et, aliquet faucibus at morbi nibh, vel condimentum. Massa unde orci sed id sed, odio donec congue nec praesent amet. Hymenaeos velit lacus, quis vivamus libero tempus duis, eu nisi eu, ipsum at accumsan pede justo morbi donec, massa et libero sit risus neque tortor. Ut sed sed etiam hendrerit dapibus, quis metus suspendisse nibh.
            Fringilla tempor felis augue magna. Cum arcu a, id vitae. Pellentesque pharetra in cras sociis adipiscing est. Nibh nec mattis at maecenas, nisl orci aliquam nulla justo egestas venenatis, elementum duis vel porta eros, massa vitae, eligendi imperdiet amet. Nec neque luctus suscipit, justo sem praesent, ut nisl quisque, volutpat torquent wisi tellus aliquam reprehenderit, curabitur cras at quis massa porttitor mauris. Eros sed ultrices. Amet dignissim justo urna feugiat mauris litora, etiam accumsan, lobortis a orci suspendisse. Semper ac mauris, varius bibendum pretium, orci urna nunc ullamcorper auctor, saepe sem integer quam, at feugiat egestas duis. Urna ligula ante. Leo elementum nonummy. Sagittis mauris est in ipsum, nulla amet non justo, proin id potenti platea posuere sit ut, nunc sit erat bibendum. Nibh id auctor, ab nulla vivamus ultrices, posuere morbi nunc tellus gravida vivamus.
            Mauris nec, facilisi quam fermentum, ut mauris integer, orci tellus tempus diam ut in pellentesque. Wisi faucibus tempor et odio leo diam, eleifend quis integer curabitur sit scelerisque ac, mauris consequat luctus quam penatibus fringilla dis, vitae lacus in, est eu ac tempus. Consectetuer amet ipsum amet dui, sed blandit id sed. Tellus integer, dignissim id pede sodales quis, felis dolorem id mauris orci, orci tempus ut. Nullam hymenaeos. Curabitur in a, tortor ut praesent placerat tincidunt interdum, ac dignissim metus nonummy hendrerit wisi, etiam ut.
            Semper praesent integer fusce, tortor suspendisse, augue ligula orci ante asperiores ullamcorper. In sit per mi sed sed, mi vestibulum mus nam, morbi mauris neque vitae aliquam proin senectus. Ac amet arcu mollis ante congue elementum, inceptos eget optio quam pellentesque quis lobortis, sollicitudin sed vestibulum sollicitudin, lectus parturient nullam, leo orci ligula ultrices. At tincidunt enim, suspendisse est sit sem ac. Amet tellus molestie est purus magna augue, non etiam et in wisi id. Non commodo, metus lorem facilisi lobortis ac velit, montes neque sed risus consectetuer fringilla dolor. Quam justo et integer aliquam, cursus nulla enim orci, nam cursus adipiscing, integer torquent non, fringilla per maecenas. Libero ipsum sed tellus purus et. Duis molestie placerat erat donec ut. Dolor enim erat massa faucibus ultrices in, ante ultricies orci lacus, libero consectetuer mauris magna feugiat neque dapibus, donec pretium et. Aptent dui, aliquam et et amet nostra ligula.
            Augue curabitur duis dui volutpat, tempus sed ut pede donec. Interdum luctus, lectus nulla aenean elit, id sit magna, vulputate ultrices pellentesque vel id fermentum morbi. Tortor et. Adipiscing augue lorem cum non lacus, rutrum sodales laoreet duis tortor, modi placerat facilisis et malesuada eros ipsum, vehicula tempus. Ac vivamus amet non aliquam venenatis lectus, sociosqu adipiscing consequat nec arcu odio. Blandit orci nec nec, posuere in pretium, enim ut, consectetuer nullam urna, risus vel. Nullam odio vehicula massa sed, etiam sociis mauris, lacus ullamcorper, libero imperdiet non sodales placerat justo vehicula. Nec morbi imperdiet. Fermentum sem libero iaculis bibendum et eros, eget maecenas non nunc, ad pellentesque. Ut nec diam elementum interdum. Elementum vitae tellus lacus vitae, ipsum phasellus, corporis vehicula in ac sed massa vivamus, rutrum elit, ultricies metus volutpat.
            Semper wisi et, sollicitudin nunc vestibulum, cursus accumsan nunc pede tempus mi ipsum, ligula sed. Non condimentum ac dolor sit. Mollis eu aliquam, vel mattis mollis massa ut dolor ante, tempus lacinia arcu. Urna vestibulum lorem, nulla fermentum, iaculis ut congue ac vivamus. Nam libero orci, pulvinar nulla, enim pellentesque consectetuer leo, feugiat rhoncus rhoncus vel. Magna sociosqu donec, dictum cursus ullamcorper viverra. Ultricies quis orci lorem, suspendisse ut vestibulum integer, purus sed lorem pulvinar habitasse turpis.
            +
          </v-card-text>
          <v-divider></v-divider>

          <v-container>
            <v-row>
              <v-col>
                <v-textarea
                  outlined
                  name="input-7-4"
                  label="Outlined textarea"
                  value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
          <v-card-actions>
            <v-btn color="blue darken-1" text @click="dialog = false">退出</v-btn>
            <v-btn color="blue darken-1" text @click="dialog = false">コメント投稿</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chatDialog: false,
      chatData: {},
      canvas: {},
      isDisabledClick: false, // クリック制御
      roomData: [], // 教室データ
      roomWidth: 900, // 教室サイズ
      roomHight: 600, // 教室サイズ
      clickAreaSize: 50, // クリックエリアサイズ
      iconSize: 50, // アイコンサイズ
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
            if (section.id <= 6) {
              // section 1~6 のエリアの設定
              this.setClickArea(seat.id, section.role, seat.position, seat.status);
            }
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
     * 休憩室への入室
     *
     * @param String  status  遷移先の状態
     */
    enterLounge: async function (seatId) {
      console.log(this.authUser);
      // this.chatData = await this.$http.get(this.$endpoint('GET:chatShow', [sectionId]));
      // this.chatDialog = true;
    },

    /**
     * コメントの投稿
     */
    postComment: function () {
      var data = {
        userId: this.authUser.id,
        sectionId: this.password,
        message: a,
      };

      this.$http.post(this.$endpoint('POST:chatPost'), data);
    },

    /**
     * キャンバスクリックイベント
     */
    canvasClickEvent: function () {
      if (!this.isDisabledClick) {
        var clickObject = this.canvas.getActiveObject();
        console.log(clickObject.role);
        if (clickObject) {
          // 着席処理
          if (this.authUser.seat_id === null) {
            this.changeStatus(clickObject, 'sitting');
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
        new fabric.Rect({
          id: seatId,
          role: role,
          fill: 'black',
          stroke: 'black',
          opacity: 0.3,
          left: position.left,
          top: position.top,
          width: this.clickAreaSize,
          height: this.clickAreaSize,
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
          left: locatedObject.left,
          top: locatedObject.top,
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
      this.$storage('system') + 'floor.png',
      this.canvas.renderAll.bind(this.canvas)
    );
    this.canvas.on('mouse:down', this.canvasClickEvent);

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
