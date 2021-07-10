<template>
  <header class="header">
    <v-container class="header__wrapper">
      <square-button-component>
        <v-icon>$chevronLeft</v-icon>
      </square-button-component>
      <div class="header__data">
        <h2 class="header__title">Discover</h2>
        <h2 class="header__heading">Los Angeles, CA</h2>
      </div>
      <square-button-component>
        <v-icon size="16">$filter</v-icon>
      </square-button-component>
    </v-container>
  </header>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import SquareButtonComponent from '@/components/@ui/SquareButtonComponent.vue';

@Component({
  components: {
    SquareButtonComponent,
  },
})
export default class HeaderComponent extends Vue {

}
</script>

<style scoped lang="scss">
  .header {
    width: 100%;
    background-color: var(--v-white-base);

    &__wrapper {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    &__data {
      text-align: center;
    }

    &__title {
      font-weight: 800;
      font-size: 30px;
      line-height: 43px;
      margin-bottom: 0.375rem;
    }

    &__heading {
      font-weight: 500;
      font-size: 15px;
      line-height: 15px;
      color: var(--v-white-darken3);
    }
  }
</style>
