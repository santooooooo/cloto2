<template>
  <v-container py-0>
    <!-- ローディング画面 -->
    <v-overlay v-if="!kartes.data">
      <v-progress-circular indeterminate size="64" v-if="!kartes.data"></v-progress-circular>
    </v-overlay>
    <v-card max-width="1080" tile class="ml-10">
      <!-- <v-row v-on:mouseover"open" width="225px">aaaaaaaaaaaaaaaaaaaaaa </v-row> -->

      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">画像</th>
              <th class="text-left">内容</th>
              <th class="text-left">投稿時間</th>
              <th class="text-left">達成</th>
              <th class="text-left">未達成</th>
              <th class="text-left">参考文献</th>
              <th class="text-left">技術タグ</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="karte in kartes.data" :key="karte.id">
              <td v-if="karte.image != null">
                <p class="karteContent">
                  <v-img
                    max-width="120"
                    class="mt-2"
                    v-on:mouseover="openKarte(karte.body)"
                    contain
                    :src="$storage('karte') + karte.image"
                  />
                </p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>

              <td v-if="karte.body != null">
                <p class="karteContent">{{ karte.body }}</p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>
              <td>
                <p class="karteContent">00:00</p>
              </td>
              <td v-if="karte.achieve != null">
                <p class="karteContent">{{ karte.achieve }}</p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>
              <td v-if="karte.trouble != null">
                <p class="karteContent">{{ karte.trouble }}</p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>
              <td v-if="karte.reference != null">
                <p class="karteContent">{{ karte.reference }}</p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>
              <td v-if="karte.technologies.length != 0">
                <p class="karteContent">{{ karte.technologies }}</p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>

      <!-- <v-list>
        <v-subheader>
          <v-row justify="center">
            <v-col> 画像 </v-col>
            <v-col> 内容 </v-col>
            <v-col> 投稿時間 </v-col>
            <v-col> 達成 </v-col>
            <v-col> できなかったこと </v-col>
            <v-col>文献</v-col>
            <v-col>技術タグ</v-col>
          </v-row>
        </v-subheader>
        <v-list-item-group v-model="selectedItem">
          <v-list-item v-for="karte in kartes.data" :key="karte.id">
            <v-list-item-content @click="openKarte(karte)">
              <v-row>
                <v-col
                  ><v-img
                    max-width="120"
                    v-on:mouseover="openKarte(karte.body)"
                    contain
                    :src="$storage('karte') + karte.image"
                  />
                </v-col>
                <v-col class="col-2 text-truncate pa-0"> {{ karte.body }} </v-col>
                <v-col class="text-truncate pa-0"> 活動時間 </v-col>
                <v-col class="text-truncate pa-0"> {{ karte.achieve }} </v-col>
                <v-col class="text-truncate pa-0"> {{ karte.trouble }} </v-col>
                <v-col class="text-truncate pa-0"> {{ karte.reference }} </v-col>
                <v-col class="text-truncate pa-0"> 技術タグ </v-col>
              </v-row>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list> -->

      <v-dialog v-model="dialog" width="300">
        <v-card>
          <v-card-text>
            {{ this.chosenKarte }}
          </v-card-text>
        </v-card>
      </v-dialog>

      <!-- <v-dialog v-model="dialog" width="800">
        <v-card color="grey darken-1">
          <v-container>
            {{ kartes.data }}
            <v-row justify="center">
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  活動内容
                </v-card-text>
                <v-card rounded>
                  <div>{{ chosenKarte.body }}</div></v-card
                >

                <v-card-text class="pa-2 white--text title font-weight-bold">
                  参考文献
                </v-card-text>
                <v-card solo rounded v-if="chosenKarte.reference != null">{{
                  chosenKarte.reference
                }}</v-card>
                <v-card solo rounded v-else>なし</v-card>
              </v-col>

              <v-col>
                <v-card-text class="pa-0 white--text title font-weight-bold"> 画像 </v-card-text>

                <v-card v-if="chosenKarte.image != null" height="200" class="text-center pt-6">
                  <v-avatar class="profile" color="grey" size="150">
                    <img :src="$storage('karte') + chosenKarte.image" />
                  </v-avatar>
                </v-card>

                <v-card v-else> なし </v-card>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  技術タグ
                </v-card-text>
                <v-card
                  solo
                  rounded
                  v-if="chosenKarte.technologies && chosenKarte.technologies.length !== 0"
                  ><span v-for="technology in chosenKarte.technologies" :key="technology.id"
                    >{{ technology.name }}　</span
                  ></v-card
                >

                <v-card v-else>なし</v-card>
              </v-col>

              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  活動時間
                </v-card-text>
                <v-card solo rounded>a</v-card>
              </v-col>
            </v-row>

            <v-row>
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  達成したこと
                </v-card-text>
                <v-card rounded v-if="chosenKarte.achieve != null">
                  {{ chosenKarte.achieve }}</v-card
                >

                <v-card rounded v-else> 特になし</v-card>
              </v-col>

              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  できなかったこと
                </v-card-text>
                <v-card rounded v-if="chosenKarte.trouble != null">{{
                  chosenKarte.trouble
                }}</v-card>

                <v-card rounded v-else>特になし</v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-dialog> -->
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      chosenKarte: '',
      projects: {
        data: '',
        loading: false,
      },
      tasks: {
        data: '',
        loading: false,
      },
      kartes: {
        data: '',
        loading: false,
      },
      karteDialog: {
        dialog: false,
        data: '',
      },
      //カルテダイアログ
      dialog: false,
      selectedItem: null,
    };
  },

  methods: {
    /**
     * プロジェクトの取得
     */
    getProjects: async function () {
      this.projects.loading = true;

      var response = await this.$http.get(this.$endpoint('projectIndex'));
      this.projects.data = response.data;

      this.projects.loading = false;
    },

    /**
     * タスクの取得
     *
     * @param Number  projectId 取得するタスクのプロジェクトID
     */
    getTasks: async function (projectId) {
      this.tasks.loading = true;
      this.kartes.data = '';

      var response = await this.$http.get(this.$endpoint('taskIndex', [projectId]));
      this.tasks.data = response.data;

      this.tasks.loading = false;
    },

    /**
     * カルテの取得
     *
     * @param Number  taskId 取得するカルテのタスクID
     */
    getKartes: async function (taskId) {
      this.kartes.loading = true;

      var response = await this.$http.get(this.$endpoint('karteIndexByAuthUser'));
      this.kartes.data = response.data;

      this.kartes.loading = false;
    },

    openKarte: function (content) {
      this.dialog = true;
      this.chosenKarte = content;
      console.log(content);
    },
  },

  mounted() {
    this.getProjects();
    this.getKartes();
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

element.style {
  width: 0px;
}

.karteContent {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  width: 100px;
}
</style>
