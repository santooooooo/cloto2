<template>
  
    <v-card color="grey darken-1" dark >
      <v-container>
        <v-row class="text-center" justify="center">
          <v-col class="pr-0" align-self="center">
            <v-avatar size="100"><img :src="$storage('icon') + user.icon" /></v-avatar>
            <v-row class="text-h5 mt-2" justify="center">{{ user.handlename }}</v-row>
            <v-row class="text-body-2" justify="center">{{ '@' + user.username }}</v-row>


            <v-row class="mt-3" justify="center" v-if="sns || user.web">
              <v-btn
                icon
                color="#00acee"
                :href="'https://twitter.com/' + sns.twitter"
                target="_blank"
                v-if="sns.twitter"
              >
                <v-icon>mdi-twitter</v-icon>
              </v-btn>

              <v-btn
                icon
                color="#000000"
                :href="'https://github.com/' + sns.github"
                target="_blank"
                v-if="sns.github"
              >
                <v-icon>mdi-github</v-icon>
              </v-btn>

              <v-btn icon :href="'https://qiita.com/' + sns.qiita" target="_blank" v-if="sns.qiita">
                <v-avatar size="20" color="white"
                  ><v-img :src="$storage('system') + 'qiita.png'"></v-img
                ></v-avatar>
              </v-btn>

              <v-btn icon color="#ffffff" :href="user.web" target="_blank" v-if="user.web">
                <v-icon>mdi-home</v-icon>
              </v-btn>
            </v-row>
            <v-row class="mt-3" justify="center">        
            <div class="profile__button">
            <!-- マイページの場合 -->
            <router-link
              class="btn btn-cloto-primary"
              :to="{
                name: 'profileEdit',
                params: { username: $store.getters['auth/user'].username },
              }"
              v-if="user.id == $store.getters['auth/user'].id"
              >編集する</router-link
            >
          </div></v-row>
          </v-col>

          <v-col class="pl-0">
            <v-card light flat class="mr-2 pa-2" height="240">
              {{ user.introduction ? user.introduction : '自己紹介が未記入です' }}
            </v-card>
          </v-col>
        </v-row>

        <v-tabs class="pa-0" fixed-tabs background-color="grey lighten-1" dark>
          <v-tab> Projects </v-tab>
          <v-tab> TO Do </v-tab>
          <v-tab> Record </v-tab>
        </v-tabs>
      </v-container>
    </v-card>
</template>

<script>
export default {
  props: {
    userName: String,
  },
  data() {
    return {
      user: null,
      sns: null,
    };
  },
  async mounted() {
    /**
     * ユーザーデータの取得
     */
    var response = await this.$http.get(this.$endpoint('userShow', [this.userName]));
    this.user = response.data;

    if (this.user.sns) {
      this.sns = JSON.parse(this.user.sns);
    }
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

</style>
