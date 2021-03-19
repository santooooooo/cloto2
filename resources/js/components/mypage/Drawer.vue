<template>
  <v-card class="mx-auto" width="250" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">マイページ</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list nav dense>
        <v-list-item-group color="#f6bf00">
          <v-list-item class="mb-4" :to="{ name: 'mypage' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold"
                >プロフィール</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4" :to="{ name: 'follow' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">フォロー</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4" :to="{ name: 'follower' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">フォロワー</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4" :to="{ name: 'karte' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">カルテ</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
