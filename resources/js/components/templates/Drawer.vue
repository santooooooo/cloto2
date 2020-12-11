<template>
  <v-card class="mx-auto" width="250" min-height="100vh" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h5">ページタイトル</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list nav dense>
        <v-list-item-group color="#f6bf00">
          <v-list-item class="mb-4" :to="{ name: 'index' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">サンプル</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4" :to="{ name: 'index' }">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold">サンプル</v-list-item-title>
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
