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
    overflow: hidden;
  }

  ::v-deep {
    .v-application {
      &--wrap {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        min-height: 100%;
        overflow: hidden;
      }
    }
  }
</style>
