<template>
  <v-container ma-0 pa-0>
    <v-dialog persistent v-model="dialog" width="1000">
      <v-card class="headline grey darken-2 text-center px-2" v-if="karte">
        <v-container>
          <v-row justify="end">
            <v-btn fab x-small depressed color="error" class="mr-4" @click="$emit('close', null)">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-row justify="center" align="center" class="mt-2">
            {{ karte.activity_time.slice(0, 5) }}
          </v-row>

          <v-row justify="center">
            <v-chip class="ma-3" v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
              {{ tag.name }}
            </v-chip>
          </v-row>

          <v-row justify="center">
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 活動内容 </v-card-text>
              <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
                <pre class="px-6 py-2 text-body-1">{{ karte.body }}</pre>
              </v-card>

              <v-card-text class="pa-2 white--text title font-weight-bold"> 参考文献 </v-card-text>
              <v-card rounded="xl" min-height="48" max-width="457" class="mb-4 text-left">
                <p
                  class="px-6 py-2 text-body-1"
                  v-html="karte.reference ? $formatStr(karte.reference) : ''"
                ></p>
              </v-card>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 画像 </v-card-text>
              <v-img
                contain
                :src="$karte(karte, authUser.username) + karte.image"
                class="mx-auto"
                v-if="karte.image"
              ></v-img>
              <v-sheet
                color="grey lighten-2"
                width="450"
                height="280"
                class="mx-auto"
                v-else
              ></v-sheet>
            </v-col>
          </v-row>

          <v-row class="mb-7">
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold">
                達成したこと
              </v-card-text>
              <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
                <pre class="px-6 py-2 text-body-1">{{ karte.achieve }}</pre>
              </v-card>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 次の課題 </v-card-text>
              <v-card rounded="xl" min-height="154" max-width="457" class="mb-4 text-left">
                <pre class="px-6 py-2 text-body-1">{{ karte.challenge }}</pre>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  props: {
    karte: Object, // 表示するカルテ
  },
  data() {
    return {
      dialog: false,
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    karte: function (data) {
      if (data) {
        this.dialog = true;
      } else {
        this.dialog = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
pre {
  white-space: pre-wrap;
}
</style>
