<template>
  <v-container ma-0 pa-0>
    <v-dialog persistent v-model="dialog" width="1000">
      <v-card class="headline grey darken-2 text-center px-2" v-if="karte">
        <v-container>
          <v-row justify="end">
            <v-btn fab x-small depressed color="error" class="mr-4" @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-row justify="center" align="center" class="mt-2">
            {{ karte.activity_time.slice(0, 5) }}
          </v-row>

          <v-row justify="center">
            <v-chip class="ma-3" filter v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
              {{ tag.name }}
            </v-chip>
          </v-row>

          <v-row justify="center">
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 活動内容 </v-card-text>
              <v-textarea
                v-model="karte.body"
                solo
                rounded
                rows="6"
                auto-grow
                disabled
              ></v-textarea>

              <v-card-text class="pa-2 white--text title font-weight-bold"> 参考文献 </v-card-text>
              <v-textarea
                v-model="karte.reference"
                solo
                rounded
                rows="1"
                auto-grow
                disabled
              ></v-textarea>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 画像 </v-card-text>
              <v-img contain :src="$storage('karte') + karte.image" v-if="karte.image"></v-img>
              <v-row justify="center" v-else>
                <v-sheet color="grey lighten-2" width="450" height="280"></v-sheet>
              </v-row>
            </v-col>
          </v-row>

          <v-row>
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold">
                達成したこと
              </v-card-text>
              <v-textarea
                v-model="karte.achieve"
                solo
                rounded
                rows="6"
                auto-grow
                disabled
              ></v-textarea>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold">
                できなかったこと
              </v-card-text>
              <v-textarea
                v-model="karte.challenge"
                solo
                rounded
                rows="6"
                auto-grow
                disabled
              ></v-textarea>
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
  watch: {
    karte: function () {
      this.dialog = true;
    },
  },
};
</script>
