<template>
  <v-layout>
    <Drawer :floors="floors" @onClick="reload" />

    <v-flex>
      <router-view />
    </v-flex>
  </v-layout>
</template>

<script>
import Drawer from '@/components/entrance/Drawer';

export default {
  components: {
    Drawer,
  },
  data() {
    return {
      floors: [
        { name: 'イベントホール', id: 1 },
        { name: 'スマホアプリ開発', id: 2 },
        { name: 'Web制作・Web開発', id: 3 },
        { name: '資格等学習', id: 4 },
        { name: '外部学習ツール自習', id: 5 },
      ], // ドロワーメニュー用階層一覧
      rooms: '',
    };
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('roomShow', []));
    this.rooms = response.data;

    this.rooms.forEach((room) => {
      this.floors.push({ id: room.id, name: room.name });
    });
  },
  methods: {
    reload: function () {
      this.$router.go({ path: this.$router.currentRoute.path, force: true });
    },
  },
};
</script>

<style></style>
