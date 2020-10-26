<template>
  <v-container ma-0 pa-0>
    <!-- プロジェクト選択ダイアログ -->
    <v-dialog persistent v-model="dialog" width="600">
      <!-- ローディングバー -->
      <v-progress-linear
        indeterminate
        color="white"
        class="mb-0"
        v-if="!projects"
      ></v-progress-linear>

      <v-card class="headline grey darken-2" v-else>
        <v-list class="rounded-lg">
          <v-list-item-group color="success" v-model="projectIndex">
            <v-list-item v-for="project in projects" :key="project.id">
              <v-list-item-content @click="detailDialog = true">
                <v-list-item-title v-text="project.name"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="newProjectForm.dialog = true" x-small fab color="white">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="yellow darken-1" @click="close()" right absolute>
            <span class="white--text">close</span>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- プロジェクト詳細ダイアログ -->
    <v-dialog persistent v-model="detailDialog" v-if="projectIndex !== ''" width="600">
      <v-card class="headline grey darken-2">
        <v-card-title class="text-center">{{ projects[projectIndex].title }} </v-card-title>
        <v-card-actions>
          <div class="ma-6">
            <v-btn color="yellow darken-1" @click="detailDialog = false">
              <span class="white--text">Let's study</span>
            </v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- プロジェクト追加ダイアログ -->
    <v-dialog persistent v-model="newProjectForm.dialog" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-card-text class="pa-2 white--text font-weight-bold">プロジェクトの追加</v-card-text>

        <v-form ref="form" v-model="newProjectForm.validation.valid">
          <v-text-field
            v-model="newProjectForm.name"
            :rules="newProjectForm.validation.nameRules"
            required
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

          <v-card-actions class="align-center">
            <v-spacer></v-spacer>
            <v-btn
              color="yellow darken-1"
              :loading="newProjectForm.loading"
              @click="submitNewProject()"
            >
              <span class="white--text">追加</span>
            </v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  data() {
    return {
      dialog: true,
      projects: null,
      projectIndex: '',
      detailDialog: false, // プロジェクト詳細モーダルの制御
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
    };
  },
  methods: {
    close: function () {
      this.dialog = false;
      this.$emit('close', false);
    },
    submitNewProject: async function () {
      if (this.$refs.form.validate()) {
        this.newProjectForm.loading = true;

        var input = {
          name: this.newProjectForm.name,
          detail: this.newProjectForm.detail,
        };

        // 仮登録処理
        var response = await this.$http.post(this.$endpoint('projectPost'), input);

        if (response.status === OK) {
          // 新規プロジェクトをリストに追加
          this.projects.push({ name: response.data.name, detail: response.data.detail });
          this.newProjectForm.dialog = false;

          // フォームの初期化
          this.$refs.form.reset();
          this.newProjectForm.loading = false;
        }

        // 結果表示
        // this.newProjectForm.loading = false;
        // this.newProjectForm.message = response.data;
        // this.newProjectForm.snackbar = true;
      }
    },
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('projectIndex'));
    this.projects = response.data;
  },
};
</script>
