<template>
  <v-container py-0>
    <!-- ローディング画面 -->
    <v-overlay v-if="!kartes.data">
      <v-progress-circular indeterminate size="64" v-if="!kartes.data"></v-progress-circular>
    </v-overlay>
    <v-card max-width="600" tile class="ml-10">
      <v-list>
        <v-subheader>カルテ一覧</v-subheader>
        <v-list-item-group v-model="selectedItem">
          <v-list-item v-for="karte in kartes.data" :key="karte.id">
            <v-list-item-content @click="openKarte(karte)">
              <v-list-item-title>{{ karte.body }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>

      <v-dialog v-model="dialog" width="800" >
        <v-card
          color="grey darken-1"
         
        >
          <v-container>
            <!-- {{ kartes.data }} -->
            <v-row justify="center">
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  活動内容
                </v-card-text>
                <v-card rounded> <div>{{ chosenKarte.body }}</div></v-card>

                <v-card-text class="pa-2 white--text title font-weight-bold">
                  参考文献
                </v-card-text>
                <v-card solo rounded  v-if="chosenKarte.reference != null">{{
                  chosenKarte.reference
                }}</v-card>
                <v-card solo rounded  v-else>なし</v-card>
              </v-col>

              <v-col>
                <v-card-text class="pa-0 white--text title font-weight-bold" > 画像 </v-card-text>

                <v-card v-if="chosenKarte.image != null"  height="200" class="text-center pt-6">
                  <v-avatar class="profile" color="grey" size="150">
                    <img :src="$storage('karte') + chosenKarte.image" />
                  </v-avatar>
                </v-card>

                <v-card v-else > なし </v-card>
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

                <v-card v-else >なし</v-card>
              </v-col>

              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  活動時間
                </v-card-text>
                <v-card solo rounded >a</v-card>
              </v-col>
            </v-row>

            <v-row>
              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  達成したこと
                </v-card-text>
                <v-card rounded  v-if="chosenKarte.achieve != null">
                  {{ chosenKarte.achieve }}</v-card
                >

                <v-card rounded  v-else> 特になし</v-card>
              </v-col>

              <v-col>
                <v-card-text class="pa-2 white--text title font-weight-bold">
                  できなかったこと
                </v-card-text>
                <v-card rounded  v-if="chosenKarte.trouble != null">{{
                  chosenKarte.trouble
                }}</v-card>

                <v-card rounded  v-else>特になし</v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-dialog>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      chosenKarte: {},
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

    openKarte: function (task) {
      this.dialog = true;
      this.chosenKarte = task;
    },

    
  },

  mounted() {
    this.getProjects();
    this.getKartes();
  },
};
</script>
