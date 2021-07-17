<template>
  <v-btn-toggle
    class="buttons-group"
    :value="value"
  >
    <slot/>
  </v-btn-toggle>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class ButtonsGroupComponent extends Vue {
  @Prop({ required: true })
  private readonly value!: number|string
}
</script>

<style scoped lang="scss">
  .buttons-group {
    display: flex;
    border-radius: 12px;

    ::v-deep {
      .v-btn {
        $btn: &;

        flex-grow: 1;
        background-color: transparent !important;
        color: var(--v-white-darken5);
        border-color: var(--v-white-darken6) !important;

        //todo
        &--active.v-btn.v-btn.v-btn {
          background-color: var(--v-pink-base) !important;
          color: var(--v-white-base) !important;
          border-color: var(--v-white-darken6) !important;
        }

        &__content {
          text-transform: capitalize;
          font-weight: 500;
          font-size: 1.125rem;
          line-height: 1;
          letter-spacing: -0.03em;
        }
      }
    }
  }
</style>
