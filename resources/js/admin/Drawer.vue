<template>
  <v-navigation-drawer app dark fixed permanent>
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="text-center">
          <router-link :to="{ name: 'home' }">
            <img :src="$storage('system') + 'header-logo.svg'" />
          </router-link>
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-list nav>
      <v-list-item exact :to="{ name: 'home' }">
        <v-list-item-icon>
          <v-icon>mdi-information</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>ホーム</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact :to="{ name: 'user' }">
        <v-list-item-icon>
          <v-icon>mdi-account</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>ユーザー</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}

img {
  max-height: 64px;
  padding: 10px;
}
</style>
