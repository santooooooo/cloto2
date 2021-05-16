<template>
  <v-container id="docs">
    <div v-if="$route.params.roadName === 'javascript'">
      <JavaScript0 v-if="$route.params.class === 0" />
      <JavaScript1 v-else-if="$route.params.class === 1" />
      <JavaScript2 v-else-if="$route.params.class === 2" />
      <JavaScript3 v-else-if="$route.params.class === 3" />
      <JavaScript4 v-else-if="$route.params.class === 4" />
      <JavaScript5 v-else-if="$route.params.class === 5" />
      <JavaScript6 v-else-if="$route.params.class === 6" />
      <JavaScript7 v-else-if="$route.params.class === 7" />
      <JavaScript8 v-else-if="$route.params.class === 8" />
      <JavaScript9 v-else-if="$route.params.class === 9" />
      <JavaScript10 v-else-if="$route.params.class === 10" />
    </div>
  </v-container>
</template>

<script>
import JavaScript0 from '@/views/mystudy/docs/javascript/Class0';
import JavaScript1 from '@/views/mystudy/docs/javascript/Class1';
import JavaScript2 from '@/views/mystudy/docs/javascript/Class2';
import JavaScript3 from '@/views/mystudy/docs/javascript/Class3';
import JavaScript4 from '@/views/mystudy/docs/javascript/Class4';
import JavaScript5 from '@/views/mystudy/docs/javascript/Class5';
import JavaScript6 from '@/views/mystudy/docs/javascript/Class6';
import JavaScript7 from '@/views/mystudy/docs/javascript/Class7';
import JavaScript8 from '@/views/mystudy/docs/javascript/Class8';
import JavaScript9 from '@/views/mystudy/docs/javascript/Class9';
import JavaScript10 from '@/views/mystudy/docs/javascript/Class10';

export default {
  components: {
    JavaScript0,
    JavaScript1,
    JavaScript2,
    JavaScript3,
    JavaScript4,
    JavaScript5,
    JavaScript6,
    JavaScript7,
    JavaScript8,
    JavaScript9,
    JavaScript10,
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#docs {
  background-color: $white;

  // router-view内の要素のCSS
  &::v-deep {
    .index {
      position: fixed;
      margin-left: 3%;

      li {
        cursor: pointer;
      }
    }

    .text-left-border {
      border-left: 6px solid $dark-blue;
    }
  }
}
</style>
