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
      </v-list>

      <Periods />
    </v-navigation-drawer>
  </v-card>
</template>

<script>
import Periods from '@/components/mystudy/Periods.vue';

export default {
  components: {
    Periods,
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
