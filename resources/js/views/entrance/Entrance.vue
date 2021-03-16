<template>
  <v-layout>
    <Drawer :floors="floors" />

    <v-flex>
      <!-- 強制的にコンポーネントを初期化（メモリリーク対策） -->
      <router-view :key="$route.params.roomId" />
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/entrance/Drawer';

export default {
  head: {
    title() {
      return {
        inner: 'フロア案内',
      };
    },
  },
  components: {
    Drawer,
  },
  data() {
    return {
      floors: [], // ドロワーメニュー用階層一覧
    };
  },
  async mounted() {
    let response = await axios.get('/api/rooms');
    response.data.forEach((room) => {
      // 着席者数のカウント
      let userNum = 0;
      room.sections.forEach((section) => {
        section.seats.forEach((seat) => {
          if (seat.user) {
            userNum += 1;
          }
        });
      });

      this.floors.push({ id: room.id, name: room.name, userNum: userNum });
    });
  },
};
</script>
