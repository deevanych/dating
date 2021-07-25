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
      <v-dialog v-model="filterDialog"
                transition="dialog-bottom-transition">
        <template v-slot:activator="{ on, attrs }">
          <square-button-component
            v-bind="attrs"
            v-on="on"
            @click.native="filterDialog = !filterDialog">
            <v-icon size="16">$filter</v-icon>
          </square-button-component>
        </template>
        <filter-popup @close="filterDialog = false"/>
      </v-dialog>
    </v-container>
  </header>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import SquareButtonComponent from '@/components/@ui/SquareButtonComponent.vue';
import FilterPopup from '@/components/popups/FilterPopup.vue';
import BottomPopupLayout from '@/components/popups/BottomPopupLayout.vue';

@Component({
  components: {
    BottomPopupLayout,
    FilterPopup,
    SquareButtonComponent,
  },
})
export default class HeaderComponent extends Vue {
  private filterDialog = false
}
</script>

<style scoped lang="scss">
::v-deep {
  .v-dialog {
    margin: auto 0 0;
    border-radius: 50px 50px 0 0;
    box-shadow: -10px 4px 75px rgba(0, 0, 0, 0.35);
  }
}
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
