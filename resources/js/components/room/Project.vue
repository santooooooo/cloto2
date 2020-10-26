<template>
  <v-container ma-0 pa-0>
    <!-- プロジェクト選択ダイアログ -->
    <v-dialog class="ma-0 pa-0" persistent v-model="dialog" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-card-text class="pa-2 white--text title whitefont-weight-bold">
          Project Selection
        </v-card-text>
        <v-btn
          @click="close()"
          left
          top
          fixed
          class="ml-16 mt-16"
          color="headline grey darken-2"
          dark
        >
          <v-icon dark left> mdi-arrow-left </v-icon>cancel
        </v-btn>

        <v-list class="rounded-lg">
          <v-list-item-group color="success" v-model="projectIndex">
            <v-list-item v-for="project in projects" :key="project.id">
              <v-list-item-content @click="todoDialog = true">
                <v-list-item-title v-text="project.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="addDialog = true" x-small fab color="white">
            <v-icon> mdi-plus </v-icon>
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- todoList選択ダイアログ -->
    <v-dialog persistent v-model="todoDialog" v-if="projectIndex !== ''" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-card-title class="text-center">{{ projects[projectIndex].title }} </v-card-title>

        <v-list class="rounded-lg">
          <v-list-item-group color="success" v-model="todoIndex">
            <v-list-item v-for="todoList in todoLists" :key="todoList.id">
              <v-list-item-content @click="todoDialog = true">
                <v-list-item-title v-text="todoList.body"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>

        <v-textarea
          solo
          rounded
          name="input-7-4"
          rows="1"
          v-model="newToDo"
          label="ToDoリストをつけよう"
          auto-grow
          class="pa-2"
        ></v-textarea>

        <v-card-actions>
          <v-btn color="yellow darken-1" @click="addToDo()">
            <span class="white--text">追加</span>
          </v-btn>
          <v-btn color="yellow darken-1" @click="startStudy()">
            <span class="white--text">自習開始</span>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- project追加Dialog -->
    <v-dialog persistent v-model="addDialog" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-card-text class="pa-2 white--text font-weight-bold"> プロジェクト </v-card-text>

        <v-textarea
          solo
          rounded
          name="input-7-4"
          rows="10"
          v-model="newProject"
          label="目標を入力しよう!"
          auto-grow
          class="pa-2"
        ></v-textarea>

        <v-card-actions class="align-center">
          <v-spacer></v-spacer>
          <v-btn color="yellow darken-1" @click="addProject">
            <span class="white--text"> 追加 </span>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      projects: [
        {
          id: 1,
          title: 'shuto',
        },
        {
          id: 10,
          title: 'shingai',
        },
        {
          id: 25,
          title: 'bana',
        },
        {
          id: 104,
          title: 'mamesu',
        },
      ],
      todoLists: [
        {
          id: 1,
          body: 'login',
        },
        {
          id: 2,
          body: 'register',
        },
      ],
      projectIndex: '',
      todoIndex: '',
      dialog: true, //プロジェクトモーダル
      todoDialog: false, // todoモーダルの制御
      addDialog: false, // プロジェクト追加モーダルの制御
      newProject: '', // 追加するプロジェクト
      newToDo: '', //追加するTODOリスト
    };
  },
  methods: {
    close: function () {
      //this.dialog = false;
      this.$emit('close', false);
      //退席処理追加
    },
    addProject: function () {
      this.addDialog = false;
      //project追加制御
    },
    addToDo: function () {
      //todo追加制御
    },
    startStudy: function () {
      //ドロワーに選択したproject と todoをカードとして表示
      this.close();
    },
  },
};
</script>
