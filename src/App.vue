<template>
  <v-app>
    <router-view/>
  </v-app>
</template>

<script lang="ts">
import Vue from 'vue';
import { Component } from 'vue-property-decorator';

@Component
export default class App extends Vue {
}
</script>

<style scoped lang="scss">
  .v-application {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
  }

  ::v-deep {
    .v-application {
      &--wrap {
        flex-direction: column;
        min-height: 100vh;
        width: 100%;
        position: relative;
        display: block;
      }
    }
  }
</style>
