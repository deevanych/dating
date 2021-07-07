<template>
  <v-app>
    <router-view/>
    <footer-component/>
  </v-app>
</template>

<script lang="ts">
import Vue from 'vue';
import { Component } from 'vue-property-decorator';

import FooterComponent from '@/components/FooterComponent.vue';

@Component({
  components: {
    FooterComponent,
  },
})
export default class App extends Vue {
}
</script>

<style lang="scss">

</style>
