<template>
  <v-layout>
    <Drawer :floors="floors" />

    <v-flex>
      <router-view />
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
      rooms: null,
    };
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('rooms'));
    this.rooms = response.data;

    this.rooms.forEach((room) => {
      this.floors.push({ id: room.id, name: room.name });
    });
  },
};
</script>

<style></style>
