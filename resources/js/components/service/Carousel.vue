c
<template>
  <div>
    <v-carousel hide-delimiters>
      <!-- height="autoを挙動がおかしくなる" -->
      <v-carousel-item v-for="(item, i) in items" :key="i" :src="item.src"> </v-carousel-item>
    </v-carousel>
    <v-list
      class="text-center"
      color="grey lighten-2
"
      ><p>aiueokaiksuedfi</p></v-list
    >
  </div>
</template>
<script>
export default {
  data() {
    return {
      items: [
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
        },
        {
          src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
        },
      ],
    };
  },
};
</script>
