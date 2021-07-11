<template>
  <div class="popup">
    <div class="popup__header">
      <div class="popup__button" @click="close">
        <v-icon size="14">$close</v-icon>
      </div>
      <div class="popup__title">
        {{ title }}
      </div>
      <div class="popup__button">
        <v-icon size="16" color="pink">$save</v-icon>
      </div>
    </div>
    <div class="popup__content">
      <slot/>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class BottomPopupLayout extends Vue {
  @Prop({ required: true })
  private readonly title!: string

  public close(): void {
    this.$emit('close');
  }
}
</script>

<style scoped lang="scss">
.popup {
  background-color: var(--v-white-base);
  padding: 2rem;
  border-radius: 50px 50px 0 0;

  &__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
  }

  &__title {
    font-weight: 600;
    font-size: 1.5rem;
    line-height: 1;
    letter-spacing: -0.03em;
  }
}
</style>
