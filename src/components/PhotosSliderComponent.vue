<template>
  <div class="photos-slider__wrapper">
    <div class="photos-slider__buttons">
      <div class="photos-slider__button photos-slider__button_prev"
           @click="prevSlider">prev</div>
      <div class="photos-slider__button photos-slider__button_next"
           @click="nextSlider">next</div>
    </div>
    <slick :options="options"
           ref="slick">
      <slot/>
    </slick>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import Slick from 'vue-slick';

@Component({
  components: {
    Slick,
  },
})
export default class PhotosSliderComponent extends Vue {
  private readonly options: { [key: string]: string|boolean } = {
    arrows: false,
    infinite: false,
    dots: true,
    // autoplay: true,
  }

  private slick!: Slick

  mounted(): void {
    this.slick = this?.$refs.slick as Slick;
  }

  public nextSlider(): void {
    this.slick.next();
  }

  public prevSlider(): void {
    this.slick.prev();
  }
}
</script>

<style scoped lang="scss">
.photos-slider {
  &__button {
    width: 25%;
    cursor: pointer;
  }

  &__buttons {
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: space-between;
    z-index: 2;
    color: transparent;
    text-indent: 99999999999px;
  }
}

::v-deep {
  .slick {
    &-list,
    &-list * {
      height: 100%;
    }

    &-slider {
      width: 100%;
      display: flex;
      border-radius: 25px 25px 35px 35px;
      overflow: hidden;
    }

    &-list {
      position: absolute;
      width: 100%;
      border-radius: 25px 25px 35px 35px;
      overflow: hidden;
    }

    &-dots {
      margin: 0 auto auto;
      border-radius: 0 0 15px 15px;
      background-color: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(25px);
      padding: 0.75rem 1.125rem;
      z-index: 1;
      display: flex;
      gap: 1rem;

      & > li {
        list-style-type: none;
        font-size: 0;

        //todo make hexToRGB mixin
        & > button {
          background: rgba(255, 255, 255, 0.2);
          width: 0.75rem;
          height: 0.75rem;
          display: block;
          border-radius: 1rem;
          transition: 0.3s;
        }

        &.slick-active {
          & > button {
            background: var(--v-white-base);
          }
        }
      }
    }
  }
}
</style>
