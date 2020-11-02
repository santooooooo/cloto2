<template>
  <v-container py-0>
    <v-row>
      <v-col class="pa-0">
        <v-card tile min-height="700">
          <v-skeleton-loader
            type="card-heading, list-item@10"
            class="pt-1 px-4"
            v-if="projects.loading"
          ></v-skeleton-loader>

          <v-list nav permanent v-else>
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

      <v-col class="pa-0">
        <v-card tile min-height="700">
          <v-skeleton-loader
            type="card-heading, list-item@10"
            class="pt-1 px-4"
            v-if="tasks.loading"
          ></v-skeleton-loader>

          <v-list nav permanent v-else>
            <v-subheader>タスク</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="task in tasks.data" :key="task.id" color="primary">
                <v-list-item-content @click="getKartes(task.id)">
                  <v-list-item-title v-text="task.body"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-card>
      </v-col>

      <v-col class="pa-0">
        <v-card tile min-height="700">
          <v-skeleton-loader
            type="card-heading, list-item@10"
            class="pt-1 px-4"
            v-if="kartes.loading"
          ></v-skeleton-loader>

          <v-list nav permanent v-else>
            <v-subheader>カルテ</v-subheader>
            <v-list-item-group color="primary">
              <v-list-item v-for="karte in kartes.data" :key="karte.id" color="grey">
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

      var response = await this.$http.get(this.$endpoint('karteIndexFromTask', [taskId]));
      this.kartes.data = response.data;

      this.kartes.loading = false;
    },
  },
  mounted() {
    this.getProjects();
  },
};
</script>
