<template>
  <div class="interest">
    <v-icon class="interest__icon"
            size="18">{{ computedType }}</v-icon>
    <div class="interest__title">{{ title }}</div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class InterestComponent extends Vue {
  @Prop({ required: true })
  private readonly title!: string

  @Prop({ default: 'unknown' })
  private readonly type!: string

  private get computedType(): string {
    return `$${this.type}Interest`;
  }
}
</script>

<style scoped lang="scss">
  .interest {
    display: flex;
    padding: 0.75rem 1.125rem;
    align-items: center;
    color: var(--v-pink-base);
    background: var(--v-pink-lighten3);
    border-radius: 2rem;

    &__title {
      color: var(--v-black-base);
      font-weight: 600;
      font-size: 1.125rem;
      line-height: 1;
      letter-spacing: -0.02em;
    }

    &__icon {
      margin-right: 0.5rem;
    }
  }
</style>
