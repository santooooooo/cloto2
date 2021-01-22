<template>
  <v-navigation-drawer app dark fixed permanent>
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="text-center">
          <router-link :to="{ name: 'home' }">
            <img :src="$storage('system') + 'header_logo.svg'" />
          </router-link>
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-list nav>
      <v-list-item-group>
        <v-list-item exact :to="{ name: 'home' }">
          <v-list-item-icon>
            <v-icon>mdi-information</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>ホーム</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item exact :to="{ name: 'inquiry' }">
          <v-list-item-icon>
            <v-icon>mdi-help-circle</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>お問い合わせ</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-group no-action color="#f6bf00">
          <template v-slot:activator>
            <v-list-item-icon>
              <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>ユーザー</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item dense exact :to="{ name: 'user' }">
            <v-list-item-title>設定</v-list-item-title>
            <v-list-item-icon>
              <v-icon>mdi-account-search</v-icon>
            </v-list-item-icon>
          </v-list-item>

          <!-- <v-list-item dense exact :to="{ name: 'karte' }">
            <v-list-item-title>カルテ</v-list-item-title>
            <v-list-item-icon>
              <v-icon>mdi-clipboard-text</v-icon>
            </v-list-item-icon>
          </v-list-item> -->
        </v-list-group>

        <v-list-item exact :to="{ name: 'room' }">
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>部屋</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item exact :to="{ name: 'seat' }">
          <v-list-item-icon>
            <v-icon>mdi-map-marker-radius</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>座席</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <!-- <v-list-item exact :to="{ name: 'tag' }">
          <v-list-item-icon>
            <v-icon>mdi-tag</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>タグ</v-list-item-title>
          </v-list-item-content>
        </v-list-item> -->
      </v-list-item-group>
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
