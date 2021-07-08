<template>
  <v-btn floating
         fab
         depressed
         color="pink lighten-3"
         class="button">
    <slot/>
  </v-btn>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class SquareButtonComponent extends Vue {

}
</script>

<style scoped lang="scss">
  .button {
    width: 3.125rem !important;
    height: 3.125rem !important;
    color: var(--v-pink-base) !important;
    border-radius: 25% 25% 25% 25% / 25% 25% 25% 25%;
  }
</style>
