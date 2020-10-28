<template>
  <v-container ma-0 pa-0>
    <!-- タスク選択ダイアログ -->
    <v-dialog class="ma-0 pa-0" persistent v-model="dialog" width="600">
      <!-- ローディングバー -->
      <v-progress-linear indeterminate color="white" class="mb-0" v-if="!tasks"></v-progress-linear>

      <v-card class="headline grey darken-2 text-center" v-else>
        <v-container>
          <v-row>
            <v-btn small depressed @click="close()" color="error" class="ml-3">
              <v-icon dark>mdi-arrow-left</v-icon> プロジェクト選択に戻る
            </v-btn>
          </v-row>

          <v-card-text class="pa-2 white--text title whitefont-weight-bold">
            今日のタスクは？
          </v-card-text>

          <v-list class="rounded-lg">
            <v-list-item-group color="success">
              <v-list-item v-for="task in tasks" :key="task.id">
                <v-list-item-content @click="">
                  <v-list-item-title v-text="task.body"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="newTaskForm.dialog = true" x-small fab depressed color="white">
              <v-icon>mdi-plus</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-dialog>

    <!-- タスク追加ダイアログ -->
    <v-dialog persistent v-model="newTaskForm.dialog" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-container>
          <v-row justify="end">
            <v-btn
              fab
              x-small
              depressed
              color="error"
              class="mr-3"
              @click="newTaskForm.dialog = false"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <v-card-text class="pa-2 white--text font-weight-bold">タスクの追加</v-card-text>

          <v-form ref="form" v-model="newTaskForm.validation.valid">
            <v-text-field
              v-model="newTaskForm.body"
              :rules="newTaskForm.validation.bodyRules"
              required
              maxlength="20"
              counter
              label="タスク名"
              hint="例：ログイン機能の開発"
              solo
              rounded
              class="pa-2"
            ></v-text-field>

            <v-card-actions class="align-center">
              <v-spacer></v-spacer>
              <v-btn
                depressed
                color="#f6bf00"
                :loading="newTaskForm.loading"
                @click="submitNewTask()"
              >
                <span class="white--text">追加</span>
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    projectId: Number,
  },
  data() {
    return {
      dialog: true,
      tasks: null,
      newTaskForm: {
        // タスクの追加
        dialog: false,
        body: '',
        loading: false,
        validation: {
          valid: false,
          bodyRules: [
            (v) => !!v || 'タスク内容は必須項目です。',
            (v) => (v && v.length <= 20) || '20文字以下で入力してください。',
          ],
        },
      },
    };
  },
  methods: {
    close: function () {
      this.$emit('close', false);
    },
    startStudy: function () {
      //ドロワーに選択したtask と todoをカードとして表示
      this.close();
    },
    submitNewTask: async function () {
      if (this.$refs.form.validate()) {
        this.newTaskForm.loading = true;

        var input = {
          project_id: this.projectId,
          body: this.newTaskForm.body,
        };

        // 仮登録処理
        var response = await this.$http.post(this.$endpoint('taskPost'), input);

        if (response.status === OK) {
          // 新規タスクをリストに追加
          this.tasks.push(response.data);
          this.newTaskForm.dialog = false;

          // フォームの初期化
          this.$refs.form.reset();
          this.newTaskForm.loading = false;
        }

        // 結果表示
        // this.newTaskForm.loading = false;
        // this.newTaskForm.message = response.data;
        // this.newTaskForm.snackbar = true;
      }
    },
  },
  async mounted() {
    var response = await this.$http.get(this.$endpoint('taskIndex', [this.projectId]));
    this.tasks = response.data;
  },
};
</script>
