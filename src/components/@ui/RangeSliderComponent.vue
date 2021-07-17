<template>
  <v-range-slider
    color="pink"
    :value="FILTER_AGE"
    :min="AGE_LIMITS.min"
    :max="AGE_LIMITS.max"
    thumb-label="always"
    ripple="false"
    track-color="white-darken7"
  />
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { mapGetters } from 'vuex';

@Component({
  computed: {
    ...mapGetters(['AGE_LIMITS', 'FILTER_AGE']),
  },
})
export default class RangeSliderComponent extends Vue {
}
</script>

<style scoped lang="scss">
  ::v-deep {
    .v-slider {
      &__thumb {
        width: 9px;
        height: 9px;

        &::before {
          content: none;
        }

        &-label.pink {
          background-color: var(--v-pink-lighten1) !important;
          color: var(--v-pink-base) !important;
          font-size: 0.875rem;
          line-height: 1;
          font-weight: 600;
          transform: translateY(-20%) translateY(-12px) translateX(-57%) !important;
          padding: 0.25rem 0.325rem;
          border-radius: 3px;
          width: initial !important;
          height: initial !important;

          &::before {
            content: '';
            border-style: solid;
            border-width: 10px 10px 0px 0px;
            border-color: transparent var(--v-pink-lighten1) transparent transparent;
            position: absolute;
            transform: rotate(45deg);
            bottom: -4px;
          }

          & > * {
            transform: initial !important;
          }
        }
      }

      &__track {
        &-container {
          height: 3px;
        }

        &-background {
          background-color: var(--v-white-darken7) !important;
        }

        &-fill {
          background-color: var(--v-pink-base) !important;
        }
      }
    }
  }
</style>
