<template>
  <div class="discover__profile"
       ref="discoverCard"
       :class="{
        'discover__profile_moving': isMoving,
        'discover__profile_like': isLike,
        'discover__profile_dislike': isDislike,
        }">
    <div class="discover__profile-wrapper">
      <photos-slider-component class="discover__photos"
                               @click.native="openProfile">
        <div class="discover__photo"
             v-for="(photo, n) in profile.photos"
             :key="n"
             :style="{backgroundImage: `url(${photo.url})`}"></div>
      </photos-slider-component>
      <div class="discover__gradient-helper"
           :class="{
            'discover__gradient-helper_like': isLike,
            'discover__gradient-helper_dislike': isDislike,
            }">
        <div class="discover__gradient-helper__icon"></div>
      </div>
      <div class="discover__profile-distance-wrapper">
        <v-icon size="12"
                class="discover__profile-distance-icon">$destination</v-icon>
        <span class="discover__profile-distance">{{ $tc('metrics.miles', 3) }}</span>
      </div>
      <div class="discover__profile-info">
        <h2 class="discover__profile-name">{{ computedProfileTitle }}</h2>
        <h4 class="discover__profile-status">{{ profile.status }}</h4>
      </div>
      <div class="discover__profile-actions">
        <div class="discover__profile-action
                    discover__profile-action_dislike
                    discover__profile-action_small"
             ref="dislike"
             @click="setVote(false)">
        </div>
        <div class="discover__profile-action
                    discover__profile-action_like"
             ref="like"
             @click="setVote">
        </div>
        <div class="discover__profile-action
                    discover__profile-action_superlike
                    discover__profile-action_small"
             ref="superLike"
             @click="setVote">
        </div>
      </div>
    </div>
    <v-dialog v-model="isProfileShown"
              transition="dialog-bottom-transition"
              fullscreen>
      <user-profile-component :user="profile"
                              @close="isProfileShown = false"/>
    </v-dialog>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import { UserType } from '@/models/User';

import interact from 'interactjs';

import PhotosSliderComponent from '@/components/PhotosSliderComponent.vue';
import UserProfileComponent from '@/components/UserProfileComponent.vue';

@Component({
  components: {
    UserProfileComponent,
    PhotosSliderComponent,
  },
})
export default class DiscoverProfileComponent extends Vue {
  @Prop({ required: true })
  private readonly profile!: UserType

  private readonly animationDuration = 300

  private isMoving = false

  private isLike = false

  private isDislike = false

  private isProfileShown = false

  get computedProfileTitle(): string {
    return `${this.profile.name}, ${this.profile.age}`;
  }

  private removeCard(): void {
    const discoverCard: HTMLElement = this.$refs?.discoverCard as HTMLElement;
    discoverCard.style.transition = `${this.animationDuration / 1000}s`;

    setTimeout(() => {
      this.$emit('removeCard');
    }, this.animationDuration);
  }

  public setVote(like = true): void | boolean {
    const discoverCard: HTMLElement = this.$refs?.discoverCard as HTMLElement;
    const moveOutWidth: number = document.body.clientWidth * 1.5;

    let transform = `translate(-${moveOutWidth}px, 200px) rotate(-20deg)`;

    if (like) {
      transform = `translate(${moveOutWidth}px, 200px) rotate(20deg)`;
      this.isLike = true;
    }

    discoverCard.style.transform = transform;
    this.removeCard();
  }

  public openProfile(): void {
    this.isProfileShown = true;
  }

  private setMoving(isMoving = true): void {
    this.isMoving = isMoving;
  }

  private setLike(like: boolean | null = null): void {
    switch (like) {
      case true:
        this.isLike = true;
        this.isDislike = false;
        break;

      case false:
        this.isLike = false;
        this.isDislike = true;
        break;

      default:
        this.isLike = false;
        this.isDislike = false;
    }
  }

  mounted(): void {
    const discoverCard: HTMLElement = this.$refs?.discoverCard as HTMLElement;
    const { setMoving, setVote, setLike } = this;
    let offsetX = 0;

    interact(discoverCard).draggable({
      startAxis: 'x',
      lockAxis: 'start',
      listeners: {
        start() {
          setMoving();
        },
        move(event) {
          offsetX += event.dx;
          setLike(offsetX > 0);
          const offsetY: number = Math.abs(offsetX / 7);
          const rotate: number = offsetX / 50;

          discoverCard.style.transform = `translate(${offsetX}px, ${offsetY}px) rotate(${rotate}deg)`;
        },
        end(event) {
          const keep: boolean = Math.abs(event.velocity.x) < 800;
          setMoving(false);

          if (keep) {
            offsetX = 0;
            discoverCard.style.transform = '';
            setLike();
            return;
          }

          setVote(offsetX > 0);
        },
      },
    });
  }
}
</script>

<style scoped lang="scss">
  .discover {
    $discover: &;

    &__icon {
      margin: auto;
      position: absolute;
      opacity: 0;
      transition: 0.3s;
      will-change: opactiy;
    }

    &__gradient-helper {
      $gradientHelper: &;

      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: 25px 25px 35px 35px;
      background: linear-gradient(transparent, var(--v-black-base));
      display: flex;
      justify-content: center;
      align-items: center;
      will-change: background;

      &__icon {
        width: 100%;
        height: 100%;
        background-position: center;
        background-size: 96px;
      }

      &_like {
        background: linear-gradient(transparent, var(--v-pink-base));

        & > #{$gradientHelper}__icon {
          background-image: url('~@/assets/icons/like.svg');
          opacity: 1;
        }
      }

      &_dislike {
        background: linear-gradient(transparent, var(--v-red-base));

        & > #{$gradientHelper}__icon {
          background-image: url('~@/assets/icons/dislike.svg');
          opacity: 1;
        }
      }
    }

    &__profile {
      $profile: &;

      height: 100%;
      display: inline-block;
      width: 100%;
      border-radius: 8px;
      position: absolute;
      padding-bottom: 2.75rem;
      cursor: grab;
      transition: 0.1s ease-in-out;
      z-index: 97;
      touch-action: none;
      user-select: none;
      will-change: transform;

      & * {
        user-select: none;
      }

      &-actions {
        position: absolute;
        bottom: -2.375rem;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        z-index: 100;
      }

      &-action {
        #{$profile}:first-of-type &,
        #{$profile}:nth-of-type(2) &, {
          box-shadow: 0 20px 45px var(--v-white-darken4);
        }

        width: 5.375rem;
        height: 5.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--v-white-base);
        transition: 0.3s;
        will-change: box-shadow;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 36px;

        &_small {
          width: 3.875rem !important;
          height: 3.875rem !important;
          margin-top: 0.5rem;
          background-size: 26px;
        }

        &_like {
          background-image: url('~@/assets/icons/like.svg');
        }

        &_dislike {
          background-image: url('~@/assets/icons/dislike.svg');
          background-size: 21px;
        }

        &_superlike {
          background-image: url('~@/assets/icons/superlike.svg');
        }
      }

      &-distance {
        display: block;
        font-weight: 600;
        text-align: center;
        letter-spacing: -0.03em;

        &-icon {
          margin-right: 0.5rem;
        }

        &-wrapper {
          position: absolute;
          bottom: 8.5rem;
          left: 1.875rem;
          color: var(--v-white-base);
          display: flex;
          align-items: center;
          padding: 0.75rem;
          border-radius: 10px;
          background-color: rgb(#FFF, 0.1);
          backdrop-filter: blur(10px);
        }
      }

      &-info {
        bottom: 3.75rem;
        left: 2rem;
        position: absolute;
        color: var(--v-white-base);
        text-align: left;
      }

      &-name {
        font-size: 1.875rem;
        line-height: 2.5rem;
        letter-spacing: -0.03em;
      }

      &-status {
        line-height: 1.5rem;
      }

      &_moving {
        transition: none !important;
      }

      &-wrapper {
        height: 100%;
        position: relative;
      }
    }

    &__photos {
      height: 100%;
      position: relative;
      border-radius: 25px 25px 35px 35px;
      overflow: hidden;
      background-color: var(--v-white-base);
      display: flex;
    }

    &__photo {
      height: 100%;
      width: 100%;
      background-size: cover;
      background-position: center;
    }
  }
</style>
