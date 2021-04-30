<template>
  <v-card class="mx-auto" width="180" flat tile>
      <v-list nav dense>
        <v-list-item-group color="#f6bf00">
          <v-list-item class="mb-4"> <!-- drawerでいう"to"以降は削除してあります -->
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">入門期</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">素人期</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">苦労人前期</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">苦労人後期</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">玄人期</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        </v-list-item-group>
      </v-list>
  </v-card>
</template>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
