<template>
  <v-list nav dense>
    <v-list-item-group color="#f6bf00">

      <v-list-item class="mb-4">
        <v-list-item-content id="enter">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1 text-center">
            入門期<span class="pl-2" id="enter-text"></span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content id="begin" class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1 text-center">
            素人期<span class="pl-2" id="begin-text"></span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content id="hard-one" class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1 text-center">
            苦労人前期<span class="pl-2" id="hard-one-text"></span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content id="hard-two" class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1 text-center">
            苦労人後期<span class="pl-2" id="hard-two-text"></span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item class="mb-4">
        <v-list-item-content id="master" class="pl-1">
          <v-list-item-title class="text-body-1 font-weight-bold accent-1 text-center">
            玄人期<span class="pl-2" id="master-text"></span>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<style lang="scss" scoped>
.v-list {
  width: 100%;
  margin: 0 auto;
  a:hover {
    text-decoration: none;
  }
}

.v-list-item{
  cursor: default;
}

span {
  font-size: 0.6rem;
}
</style>

<script>
export default {
  data() {
    return {
      progress: {
        enter: '解放済',
        begin: '取り組み中',
        cloFirst: '未解放',
        cloSecond: '未解放',
        cloto: '未解放',
      },
    };
  },
  mounted() {
    let enter = document.getElementById('enter');
    let enterText = document.getElementById('enter-text');

    let begin = document.getElementById('begin');
    let beginText = document.getElementById('begin-text');

    let hardOne = document.getElementById('hard-one');
    let hardOneText = document.getElementById('hard-one-text');

    let hardTwo = document.getElementById('hard-two');
    let hardTwoText = document.getElementById('hard-two-text');

    let master = document.getElementById('master');
    let masterText = document.getElementById('master-text');

    switch (this.progress.enter) {
      case '解放済':
        enter.classList.add('white--text', 'green');
        enterText.innerHTML = '解放済み';
        break;
      case '取り組み中':
        enter.classList.add('white--text', 'blue');
        enterText.innerHTML = '取り組み中';
        break;
      default:
        enter.classList.add('grey--text');
        enterText.innerHTML = '未解放';
        break;
    }
    switch (this.progress.begin) {
      case '解放済':
        begin.classList.add('white--text', 'green');
        beginText.innerHTML = '解放済み';
        break;
      case '取り組み中':
        begin.classList.add('white--text', 'blue');
        beginText.innerHTML = '取り組み中';
        break;
      default:
        begin.classList.add('grey--text');
        beginText.innerHTML = '未解放';
        break;
    }
    switch (this.progress.hardOne) {
      case '解放済':
        hardOne.classList.add('white--text', 'green');
        hardOneText.innerHTML = '解放済み';
        break;
      case '取り組み中':
        hardOne.classList.add('white--text', 'blue');
        hardOneText.innerHTML = '取り組み中';
        break;
      default:
        hardOne.classList.add('grey--text');
        hardOneText.innerHTML = '未解放';
        break;
    }
    switch (this.progress.hardTwo) {
      case '解放済':
        hardTwo.classList.add('white--text', 'green');
        hardTwoText.innerHTML = '解放済み';
        break;
      case '取り組み中':
        hardTwo.classList.add('white--text', 'blue');
        hardTwoText.innerHTML = '取り組み中';
        break;
      default:
        hardTwo.classList.add('grey--text');
        hardTwoText.innerHTML = '未解放';
        break;
    }
    switch (this.progress.master) {
      case '解放済':
        master.classList.add('white--text', 'green');
        masterText.innerHTML = '解放済み';
        break;
      case '取り組み中':
        master.classList.add('white--text', 'blue');
        masterText.innerHTML = '取り組み中';
        break;
      default:
        master.classList.add('grey--text');
        masterText.innerHTML = '未解放';
        break;
    }
  },
};
</script>
