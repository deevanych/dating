<template>
  <bottom-popup-layout :title="$t('filters')"
                       @close="$emit('close')">
    <div class="filter-section">
      <div class="filter-section__title">{{ $t('gender.gender') }}</div>
      <div class="filter-section__content">
        <buttons-group-component v-model="FILTER_GENDER">
          <v-btn>{{ $t('gender.male') }}</v-btn>
          <v-btn>{{ $t('gender.female') }}</v-btn>
          <v-btn>{{ $t('other') }}</v-btn>
        </buttons-group-component>
      </div>
    </div>
    <div class="filter-section">
      <div class="filter-section__title">{{ $t('age') }}</div>
      <div class="filter-section__content">
        <range-slider-component/>
      </div>
    </div>
  </bottom-popup-layout>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import BottomPopupLayout from '@/components/popups/BottomPopupLayout.vue';
import { mapGetters } from 'vuex';
import ButtonsGroupComponent from '@/components/@ui/ButtonsGroupComponent.vue';
import RangeSliderComponent from '@/components/@ui/RangeSliderComponent.vue';

@Component({
  components: {
    RangeSliderComponent,
    ButtonsGroupComponent,
    BottomPopupLayout,
  },
  computed: {
    ...mapGetters(['FILTER_GENDER']),
  },
})
export default class FilterPopup extends Vue {
  @Prop({ default: true })
  private readonly value!: boolean
}
</script>

<style scoped lang="scss">
  .filter-section {
    display: flex;
    flex-direction: column;
    margin-bottom: 3rem;

    &__title {
      font-weight: 600;
      font-size: 1.125rem;
      line-height: 1;
      letter-spacing: -0.03em;
      margin-bottom: 0.75rem;
    }
  }
</style>
