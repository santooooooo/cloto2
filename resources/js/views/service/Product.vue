<template>
  <v-container fluid pa-0 class="index">
    aiueo
    <v-container fluid class="content">
      <Carousel></Carousel>
    </v-container>

    <!-- aieuo 
    <Carousel></Carousel> -->
    <!-- <v-container justify="center" class="grey lighten-5">
      <v-row class="mb-6" justify="center" no-gutters>
        <v-col lg="2">
          <v-card class="pa-2" outlined tile> 1 of 3 </v-card>
        </v-col>
        <v-col md="auto">
          <v-card class="pa-2" outlined tile> Variable width content </v-card>
        </v-col>
        <v-col lg="2">
          <v-card class="pa-2" outlined tile> 3 of 3 </v-card>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col>
          <v-card class="pa-2" outlined tile> 1 of 3 </v-card>
        </v-col>
        <v-col md="auto">
          <v-card class="pa-2" outlined tile> Variable width content </v-card>
        </v-col>
        <v-col lg="2">
          <v-card class="pa-2" outlined tile> 3 of 3 </v-card>
        </v-col>
      </v-row>
    </v-container> -->
  </v-container>
</template>

<script>
import Carousel from '@/components/service/Carousel';

export default {
  components: {
    Carousel,
  },
  data() {
    return { model: 0, colors: ['primary', 'secondary', 'yellow darken-2', 'red', 'orange'] };
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.index {
  width: 100vw;
  background-color: $primary;
}
</style>
