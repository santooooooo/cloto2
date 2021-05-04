<template>
  <v-list nav dense>
    <v-list-item-group color="#f6bf00">

      <v-list-item class="mb-4">
        <v-list-item-content id="enter" class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1">
            入門期<span class="pl-2" id="enter-text"></span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1">
            素人期<span class="pl-2">取り組み中</span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1">
            苦労人前期<span class="pl-2">未解放</span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1">
            苦労人後期<span class="pl-2">未解放</span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1">
            玄人期<span class="pl-2">未解放</span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<style lang="scss" scoped>
.v-list {
  width: 180px;
  margin: 0 auto;

  a:hover {
    text-decoration: none;
  }
}

span{
  font-size: 0.6rem;
}
</style>

<script>
export default {
  data(){
    return {
      progress: {
      enter: 2,
      begin: 1,
      cloFirst: 0,
      cloSecond: 0,
      cloto: 0
      }
    }
  },
  mounted() {
    let enter = document.getElementById('enter')
    let enterText = document.getElementById('enter-text')
    switch (this.progress.enter) {
      case 2:
        enter.classList.add('white--text', 'green')
        enterText.innerHTML = "解放済み"
        break;
      case 1:
        enter.classList.add('white--text', 'blue')
        enterText.innerHTML = "取り組み中"
        break;
      default:
        enter.classList.add('grey--text')
        enterText.innerHTML = "未解放"
        break;
    }
  },
}
</script>