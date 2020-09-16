<template>
  <v-card class="mx-auto" max-width="344" outlined>
    <h1>{{ this.room.name }}教室</h1>
    <v-btn id="seat1" @click="seatAction('sit', 1)">着席</v-btn>
    <v-btn id="seat2" @click="seatAction('sit', 2)">着席</v-btn>
    <v-btn id="seat3" @click="seatAction('sit', 3)">着席</v-btn>
    <v-btn @click="seatAction('leave', 1)">離席</v-btn>
    <v-btn @click="seatAction('break', 1)">休憩</v-btn>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      room: [], // 教室データ
    };
  },
  methods: {
    /**
     * 教室の同期
     */
    syncRoom: function () {
      this.$http.get(this.$endpoint('GET:roomShow', [this.$route.params.id])).then((response) => {
        // セクションのループ
        response.data.sections.forEach((section, sectionIndex) => {
          // 座席のループ
          section.seats.forEach((seat, seatIndex) => {
            if (this.room.length === 0) {
              // 初回取得
              this.changeColor(seat.status, seat.id);
            } else if (seat.status !== this.room.sections[sectionIndex].seats[seatIndex].status) {
              // 現在の状態から変化があれば再描画
              this.changeColor(seat.status, seat.id);
            }
          });
        });

        this.room = response.data;
      });
    },
    /**
     * 座席の描画
     *
     * @param Number  seat_id 描画する座席
     * @param String  status  状態
     */
    changeColor: function (seat_id, status) {
      switch (status) {
        case 'sitting':
          $('#seat' + seat_id).css('color', 'red');
          break;

        case 'break':
          $('#seat' + seat_id).css('color', 'blue');
          break;

        default:
          $('#seat' + seat_id).css('color', 'white');
          break;
      }
    },
    /**
     * 座席状態の変更
     *
     * @param Number  seat_id 変更する座席
     * @param String  status  状態
     */
    seatAction: function (seat_id, status) {
      switch (status) {
        case 'sit':
          var endpoint = this.$endpoint('POST:seatSit', [seat_id]);
          break;

        case 'leave':
          var endpoint = this.$endpoint('POST:seatLeave', [seat_id]);
          break;

        case 'break':
          var endpoint = this.$endpoint('POST:seatBreak', [seat_id]);
          break;
      }

      this.$http.post(endpoint);

      // フロントと同期
      this.syncRoom();
    },
  },
  async mounted() {
    // 初回取得
    await this.syncRoom();

    // 同期開始
    // setInterval(this.syncRoom, 10000);
  },
};
</script>

<style></style>
