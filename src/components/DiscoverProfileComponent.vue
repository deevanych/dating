<template>
  <div class="discover__profile">
    <div class="discover__photos">
      <div class="discover__photo"
           :style="computedStyle"></div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import { ProfileType } from '@/components/DiscoverComponent.vue';

@Component
export default class DiscoverProfileComponent extends Vue {
  @Prop({ required: true })
  private readonly profile!: ProfileType

  get computedStyle(): { backgroundImage: string } {
    return {
      backgroundImage: `url(${this.profile.image})`,
    };
  }
}
</script>

<style scoped lang="scss">
  .discover {
    &__profile {
      height: 100%;
      display: inline-block;
      width: 100%;
      border-radius: 8px;
      overflow: hidden;
      position: absolute;
      will-change: transform;
      transition: all 0.3s ease-in-out;
      cursor: -webkit-grab;
      cursor: -moz-grab;
      cursor: grab;

      &_moving {
        transition: none;
        cursor: -webkit-grabbing;
        cursor: -moz-grabbing;
        cursor: grabbing;
      }
    }

    &__photos {
      height: 100%;
      padding-bottom: 2.75rem;
    }

    &__photo {
      background-image: url('/img/profiles/img.png');
      height: 100%;
      width: 100%;
      background-size: cover;
      background-position: center;
      border-radius: 25px 25px 35px 35px;
    }
  }
</style>
