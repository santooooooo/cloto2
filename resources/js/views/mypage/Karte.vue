<template>
  <v-container pa-0>
    <!-- ローディングバー -->
    <v-progress-linear indeterminate color="blue" class="mb-0" v-if="!projects"></v-progress-linear>

    <v-row v-else>
      <v-col cols="2" class="pa-0">
        <v-card flat tile class="ma-0" min-height="700" color="grey darken-1">
          <v-list nav　permanent color="grey darken-1">
            <v-subheader>プロジェクト</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="project in projects" :key="project.id" color="primary">
                <v-list-item-content @click="getTasks(project.id)">
                  <v-list-item-title v-text="project.name"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>

      <v-col cols="2" class="pa-0">
        <v-card flat tile class="ma-0" min-height="700" color="grey lighten-1">
          <v-list nav　permanent color="grey lighten-1">
            <v-subheader>タスク</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="task in tasks" :key="task.id" color="primary">
                <v-list-item-content @click="getKartes(task.id)">
                  <v-list-item-title v-text="task.body"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>

      <v-col cols="8" class="pa-0">
        <v-card flat tile class="ma-0" min-height="700" color="grey lighten-2">
          <v-list nav　permanent color="grey lighten-2">
            <v-subheader>カルテ</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="karte in kartes" :key="karte.id" color="grey">
                <v-list-item-content>
                  <v-list-item-title v-text="karte.body"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      projects: '',
      tasks: '',
      kartes: '',
    };
  },
  methods: {
    /**
     * プロジェクトの取得
     */
    getProjects: async function () {
      var response = await this.$http.get(this.$endpoint('projectIndex'));
      this.projects = response.data;
    },

    /**
     * タスクの取得
     *
     * @param Number  projectId 取得するタスクのプロジェクトID
     */
    getTasks: async function (projectId) {
      var response = await this.$http.get(this.$endpoint('taskIndex', [projectId]));
      this.tasks = response.data;
    },

    /**
     * カルテの取得
     *
     * @param Number  taskId 取得するカルテのタスクID
     */
    getKartes: async function (taskId) {
      var response = await this.$http.get(this.$endpoint('karteIndexFromTask', [taskId]));
      this.kartes = response.data;
    },
  },
  mounted() {
    this.getProjects();
  },
};
</script>
