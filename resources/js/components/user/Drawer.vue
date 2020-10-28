<template>
  <v-card flat tile class="ma-0" width="250"  min-height="700" max-height="800">
        <v-list nav >
        <v-subheader>マイページ</v-subheader>
    <v-list-item-group
        v-model="selectedMyPage"
        color="primary"
      >
        <v-list-item
          v-for="(item, i) in myPageItems"
          :key="i"
          color="grey"
        >
          <v-list-item-content>
            <v-list-item-title v-text="item.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
      {{selectedMyPage}}
  </v-card>
</template>

<script>
export default {

  data() {
    return {
      selectedMyPage:0,
      myPageItems:[
        {text:'プロフィール'},
        {text:'カルテ'},
      ],

    };
  },

  
};
</script>

<style lang="scss" scoped>
* {
  font-weight: bold;
}
</style>
