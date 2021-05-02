<template>
  <v-card class="mx-auto" width="180" flat tile>
      <v-list nav dense>
        <v-list-item-group color="#f6bf00">
          <v-list-item class="mb-4 green"> <!-- drawerでいう"to"以降は削除してあります -->
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text">入門期<span class="pl-2" style="font-size: 0.6rem">解放済み</span></v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4 blue">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold white--text accent-1">素人期<span class="pl-2" style="font-size: 0.6rem">取り組み中</span></v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">苦労人前期<span class="pl-2" style="font-size: 0.6rem">未解放</span></v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">苦労人後期<span class="pl-2" style="font-size: 0.6rem">未解放</span></v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item class="mb-4">
            <v-list-item-content>
              <v-list-item-title class="text-body-1 font-weight-bold grey--text accent-1">玄人期<span class="pl-2" style="font-size: 0.6rem">未解放</span></v-list-item-title>
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
