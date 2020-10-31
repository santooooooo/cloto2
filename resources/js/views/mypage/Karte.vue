<template>

<v-row no-gutters>
 <v-col cols="2" class="pa-0 " > 
    <v-card flat tile class="ma-0"  min-height="700" color="grey darken-1" >
    <v-list nav　permanent color="grey darken-1">
        <v-subheader>プロジェクト</v-subheader>
       <v-list-item-group
        color="primary"
        v-model="selectedProject"
      >
        <v-list-item
          v-for="(item, i) in myProjectItems"
          :key="i"
            color="grey"
        >
          <v-list-item-content>
            <v-list-item-title v-text="item.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
    {{selectedProject}}
   </v-card>
  </v-col>

   <v-col cols="2" class="pa-0 "> 
    <v-card flat tile class="ma-0"  min-height="700" color="grey lighten-1">
    <v-list nav　permanent color="grey lighten-1">
        <v-subheader>タスク</v-subheader>
       <v-list-item-group
        color="primary"
        v-model="selectedTask"
      >
        <v-list-item
          v-for="(item, i) in myTaskItems"
          :key="i"
            color="grey"
        >
          <v-list-item-content>
            <v-list-item-title v-text="item.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
    {{selectedProject}}
   </v-card>
  </v-col>

     <v-col cols="8" class="pa-0" > 
    <v-card flat tile class="ma-0" min-height="700" color="grey lighten-2" >
    <v-list nav　permanent color="grey lighten-2">
        <v-subheader>カルテ</v-subheader>
       <v-list-item-group
        color="primary"

      >
        <v-list-item
          v-for="(item, i) in myKartes"
          :key="i"
            color="grey"
        >
          <v-list-item-content>
            <v-list-item-title v-text="item.text"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
   </v-card>
  </v-col>
 </v-row> 

</template>

<script>
export default {
  data() {
    return {
      selectedMyPage:0,
      selectedProject:null,
      selectedTask:null,

      myProjectItems:[
        {text:'英語'},
        {text:'数学'},
        {text:'国語'},
      ],

      myTaskItems:[
        {text:'英単語10分'},
        {text:'長文問題１つ'},
        {text:'シャドーイング'}
      ],

      myKartes:[
        {text:'aaaaaaaaaaa'}
      ],
    };
  }
}
</script>

<style>

</style>