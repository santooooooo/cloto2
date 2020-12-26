<template>
  <v-layout>
    <v-container justify="canter">
      <v-img :src="$storage('system') + '404.svg'" contain class="mx-auto"></v-img>
      <v-col align="center">
        <h5>お探しの場所はここではないようです．．．</h5>
        <router-link :to="{ name: 'home' }">
          <v-btn
            x-large
            depressed
            class="font-weight-bold mt-8 mb-12 alter-btn-color"
            color="#f6bf00"
            >トップへ戻る</v-btn
          >
        </router-link>
      </v-col>
    </v-container>
  </v-layout>
</template>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
