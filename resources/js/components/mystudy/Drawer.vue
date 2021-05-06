<template>
  <v-card class="mx-auto" width="250" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">マイスタディ</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list nav dense>
        <v-list-item-group color="#f6bf00">
          <v-list-item class="mb-4" :to="{ name: 'mystudy' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">ホーム</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4" :to="{ name: 'karte' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">カルテ</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>

        <!-- 期一覧 -->
        <Periods />
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block depressed color="#f6bf00" dark @click="dialog = true">カルテ記入</v-btn>
          <KartePostDialog @close="dialog = $event" v-if="dialog" />
        </div>
      </template>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
import Periods from '@/components/mystudy/Periods.vue';
import KartePostDialog from '@/components/commons/KartePostDialog';

export default {
  components: {
    Periods,
    KartePostDialog,
  },
  data() {
    return {
      dialog: false, // カルテ投稿ダイアログの制御
    };
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
