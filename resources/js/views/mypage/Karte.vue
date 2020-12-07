<template>
  <v-container py-0>
    <!-- <v-row>
      <v-col cols="3" class="pa-0">
        <v-card tile min-height="700" color="blue-grey lighten-2">
          <v-overlay v-if="projects.loading">
            <v-progress-circular indeterminate></v-progress-circular>
          </v-overlay>

          <v-list v-else nav permanent color="blue-grey lighten-2">
            <v-subheader>プロジェクト</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="project in projects.data" :key="project.id" color="primary">
                <v-list-item-content @click="getTasks(project.id)">
                  <v-list-item-title v-text="project.name"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>

      <v-col cols="3" class="pa-0">
        <v-card tile min-height="700" color="blue-grey lighten-3">
          <v-overlay v-if="tasks.loading">
            <v-progress-circular indeterminate></v-progress-circular>
          </v-overlay>

          <v-list v-else nav permanent color="blue-grey lighten-3" width="300">
            <v-subheader>タスク</v-subheader>
            <v-list-item-group color="primary" class="mr-3">
              <v-list-item v-for="task in tasks.data" :key="task.id" color="primary">
                <v-list-item-content @click="getKartes(task.id)">
                  <v-list-item-title v-text="task.body"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>

      <v-col cols="5" class="pa-0">
        <v-card tile min-height="700" color="blue-grey lighten-4" width="700">
          <v-overlay v-if="kartes.loading">
            <v-progress-circular indeterminate></v-progress-circular>
          </v-overlay>

          <v-list v-else nav permanent color="blue-grey lighten-4">
            <v-subheader>カルテ</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="karte in kartes.data" :key="karte.id" color="primary">
                <v-list-item-content @click="showKarte(karte)">
                  <v-list-item-title v-text="karte.body"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>
    </v-row> -->
<!-- v-for="karte in kartes.data" :key="karte.id" -->
    <v-card  width="984">
      <v-card color="grey darken-1">
        <v-container>
           {{kartes.data}}
         
          <v-row justify="center">
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 活動内容 </v-card-text>
              <v-card rounded> {{ karteDialog.data.body }}</v-card>

              <v-card-text class="pa-2 white--text title font-weight-bold"> 参考文献 </v-card-text>
              <v-card solo rounded height="30" v-if="karteDialog.data.reference != null">{{
                karteDialog.data.reference
              }}</v-card>
              <v-card solo rounded height="30" v-else>なし</v-card>
            </v-col>

            <v-col>

       


          <v-card-text class="pa-0 white--text title font-weight-bold"> 画像 </v-card-text>

        <v-card v-if="karteDialog.data.image!=null"  height="200" class="text-center pt-6">
          <v-avatar
            class="profile"
            color="grey"
            size="150"
          >
           <img
            :src="$storage('karte')+karteDialog.data.image"
            class="rounded-circle"
          />
          </v-avatar>  
              <!-- ここに画像持ってくる  -->
        </v-card>

        <v-card v-else height="200">
          なし

        </v-card>

    


  
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 技術タグ </v-card-text>
              <v-card solo rounded height="30">nullの時の処理を追加する</v-card>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 活動時間 </v-card-text>
              <v-card solo rounded height="30">a</v-card>
            </v-col>
          </v-row>

          <v-row>
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold">
                達成したこと
              </v-card-text>
              <v-card rounded height="200" v-if="karteDialog.data.archive != null">
                {{ karteDialog.data.achieve }}</v-card
              >

              <v-card rounded height="200" v-else> 特になし</v-card>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold">
                できなかったこと
              </v-card-text>
              <v-card rounded height="200" v-if="karteDialog.data.troble != null">{{
                karteDialog.data.troble
              }}</v-card>

              <v-card rounded height="200" v-else>特になし</v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
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

      var response = await this.$http.get(this.$endpoint('karteIndexFromAuthUser'));
      this.kartes.data = response.data;

      this.kartes.loading = false;
    },


  },
  mounted() {
    this.getProjects();
    this.getKartes();
  },
};
</script>
