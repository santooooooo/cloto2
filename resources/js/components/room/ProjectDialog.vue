<template>
  <v-container ma-0 pa-0>
    <!-- プロジェクト選択ダイアログ -->
    <v-dialog class="ma-0 pa-0" persistent v-model="dialog" width="600">
      <!-- ローディングバー -->
      <v-progress-linear
        indeterminate
        color="white"
        class="mb-0"
        v-if="!projects"
      ></v-progress-linear>

      <v-card class="headline grey darken-2 text-center" v-else>
        <v-container>
          <v-row>
            <v-btn small depressed @click="$emit('close')" dark class="grey darken-1 ml-3">
              <v-icon class="white--text">mdi-arrow-left</v-icon>
              退席
            </v-btn>
          </v-row>

          <v-card-text class="pa-2 white--text title whitefont-weight-bold">
            プロジェクトを決めよう！
          </v-card-text>

          <v-list class="rounded-lg">
            <!-- <v-list-item-group color="success"> -->
            <v-list-item-group color="grey">
              <v-list-item v-for="project in projects" :key="project.id">
                <v-list-item-content @click="openTaskDialog(project.id)">
                  <v-list-item-title v-text="project.name"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="newProjectForm.dialog = true" x-small fab depressed color="white">
              <v-icon>mdi-plus</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-dialog>

    <!-- プロジェクト追加ダイアログ -->
    <v-dialog persistent v-model="newProjectForm.dialog" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-container>
          <v-row justify="end">
            <v-btn
              fab
              x-small
              depressed
              color="error"
              class="mr-3"
              @click="newProjectForm.dialog = false"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-card-text class="pa-2 white--text title whitefont-weight-bold"
            >プロジェクトの追加</v-card-text
          >

          <v-form ref="newProjectForm" v-model="newProjectForm.validation.valid" lazy-validation>
            <v-text-field
              v-model="newProjectForm.name"
              :rules="newProjectForm.validation.nameRules"
              maxlength="20"
              counter
              label="プロジェクト名"
              hint="例：チャットアプリを作る"
              solo
              rounded
              class="pa-2"
            ></v-text-field>

            <v-textarea
              rows="10"
              v-model="newProjectForm.detail"
              :rules="newProjectForm.validation.detailRules"
              label="プロジェクトの詳細"
              solo
              rounded
              class="pa-2"
            ></v-textarea>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                depressed
                color="#f6bf00"
                :loading="newProjectForm.loading"
                :disabled="!newProjectForm.validation.valid"
                @click="submitNewProject()"
                dark
              >
                追加
              </v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-form>
        </v-container>
      </v-card>
    </v-dialog>

    <TaskDialog
      :project-id="projectId"
      @start-study="$emit('start-study')"
      @close="taskDialog = $event"
      v-if="taskDialog"
    ></TaskDialog>
  </v-container>
</template>

<script>
import TaskDialog from '@/components/room/TaskDialog';
import { OK } from '@/consts/status';

export default {
  components: {
    TaskDialog,
  },
  data() {
    return {
      dialog: true, // ダイアログの制御
      projects: null, // プロジェクト一覧
      newProjectForm: {
        // プロジェクトの追加
        dialog: false,
        name: '',
        detail: '',
        loading: false,
        validation: {
          valid: false,
          nameRules: [
            (v) => !!v || 'プロジェクト名は必須項目です。',
            (v) => (v && v.length <= 20) || '20文字以下で入力してください。',
          ],
          detailRules: [(v) => (v || '').length <= 200 || '200文字以下で入力してください。'],
        },
      },
      taskDialog: false, // タスクダイアログの制御
      projectId: '', // タスクを表示するプロジェクトのID
    };
  },
  methods: {
    /**
     * プロジェクトの追加
     */
    submitNewProject: async function () {
      if (this.$refs.newProjectForm.validate()) {
        this.newProjectForm.loading = true;

        var input = {
          name: this.newProjectForm.name,
          detail: this.newProjectForm.detail,
        };

        // 仮登録処理
        var response = await this.$http.post(this.$endpoint('projectPost'), input);

        if (response.status === OK) {
          // 新規プロジェクトをリストに追加
          this.projects.push(response.data);
          this.newProjectForm.dialog = false;

          // フォームの初期化
          this.$refs.newProjectForm.reset();
          this.newProjectForm.loading = false;
        }

        // 結果表示
        // this.newProjectForm.loading = false;
        // this.newProjectForm.message = response.data;
        // this.newProjectForm.snackbar = true;
      }
    },

    /**
     * タスクダイアログのオープン
     *
     * @param Number projectId プロジェクトID
     */
    openTaskDialog: function (projectId) {
      this.projectId = projectId;
      this.taskDialog = true;
    },
  },

  async mounted() {
    var response = await this.$http.get(this.$endpoint('projectIndex'));
    this.projects = response.data;
  },
};
</script>
