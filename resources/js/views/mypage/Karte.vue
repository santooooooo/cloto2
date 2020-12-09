<template>
  <v-container py-0>
    
      
      <v-card v-for="karte in kartes.data" :key="karte.id" color="grey darken-1" class=" mt-2 mb-12">
        <v-container>
          <!-- {{ kartes.data }} -->
          <v-row justify="center">
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 活動内容 </v-card-text>
              <v-card rounded> {{ karte.body }}</v-card>

              <v-card-text class="pa-2 white--text title font-weight-bold"> 参考文献 </v-card-text>
              <v-card solo rounded height="30" v-if="karte.reference != null">{{
                karte.reference
              }}</v-card>
              <v-card solo rounded height="30" v-else>なし</v-card>
            </v-col>

            <v-col>
              <v-card-text class="pa-0 white--text title font-weight-bold"> 画像 </v-card-text>

              <v-card v-if="karte.image != null" height="200" class="text-center pt-6">
                <v-avatar class="profile" color="grey" size="150">
                  <img :src="$storage('karte') + karte.image"  />
                </v-avatar>
                <!-- ここに画像持ってくる  -->
              </v-card>

              <v-card v-else height="200"> なし </v-card>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold"> 技術タグ </v-card-text>
              <v-card solo rounded height="30" v-if="karte.technologies && karte.technologies.length !== 0"><span v-for="technology in karte.technologies" :key="technology.id">{{technology.name}}　</span></v-card>

            <v-card v-else height="30">なし</v-card>  
  
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
              <v-card rounded height="200" v-if="karte.achieve != null">
                {{ karte.achieve }}</v-card
              >

              <v-card rounded height="200" v-else> 特になし</v-card>
            </v-col>

            <v-col>
              <v-card-text class="pa-2 white--text title font-weight-bold">
                できなかったこと
              </v-card-text>
              <v-card rounded height="200" v-if="karte.trouble != null">{{
                karte.trouble
              }}</v-card>

              <v-card rounded height="200" v-else>特になし</v-card>
            </v-col>
          </v-row>
        </v-container>
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

      var response = await this.$http.get(this.$endpoint('karteIndexByAuthUser'));
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
