<template>
  <v-dialog persistent v-model="dialog" width="600">
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="white" class="mb-0" v-if="!user"></v-progress-linear>

    <v-card color="grey darken-1" dark v-else>
      <v-container>
        <v-row justify="end">
          <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', false)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-row>

        <v-row class="text-center" justify="center">
          <v-col class="pr-0" align-self="center">
            <v-avatar size="100"><img :src="$storage('icon') + user.icon" /></v-avatar>
            <v-row class="text-h5 mt-2" justify="center">{{ user.handlename }}</v-row>
            <v-row class="text-body-2" justify="center">{{ '@' + user.username }}</v-row>

            <v-row class="mt-3" justify="center" v-if="user.sns || user.web">
              <v-btn
                icon
                color="#00acee"
                :href="'https://twitter.com/' + user.sns.twitter"
                target="_blank"
                v-if="user.sns.twitter"
              >
                <v-icon>mdi-twitter</v-icon>
              </v-btn>

              <v-btn
                icon
                color="#000000"
                :href="'https://github.com/' + user.sns.github"
                target="_blank"
                v-if="user.sns.github"
              >
                <v-icon>mdi-github</v-icon>
              </v-btn>

              <v-btn
                icon
                :href="'https://qiita.com/' + user.sns.qiita"
                target="_blank"
                v-if="user.sns.qiita"
              >
                <v-avatar size="20" color="white"
                  ><v-img :src="$storage('system') + 'qiita.png'"></v-img
                ></v-avatar>
              </v-btn>

              <v-btn icon color="#ffffff" :href="user.web" target="_blank" v-if="user.web">
                <v-icon>mdi-home</v-icon>
              </v-btn>
            </v-row>
          </v-col>

          <v-col class="pl-0">
            <v-card light flat class="mr-2 pa-2" height="240">
              {{ user.introduction ? user.introduction : '自己紹介が未記入です' }}
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    userParam: String, // 表示するユーザーのIDまたはユーザー名
  },
  data() {
    return {
      dialog: true,
      user: null,
    };
  },
  async mounted() {
    /**
     * ユーザーデータの取得
     */
    var response = await this.$http.get(this.$endpoint('userShow', [this.userParam]));
    this.user = response.data;
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
