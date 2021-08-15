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
        <transition name="fade" mode="out-in">
          <v-icon v-if="isLike"
                  key="like"
                  size="94">$like</v-icon>
          <v-icon v-if="isDislike"
                  key="dislike"
                  size="94">$dislike</v-icon>
        </transition>
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
        <v-btn
          fab
          class="discover__profile-action
          discover__profile-action_dislike
          discover__profile-action_small"
          ref="dislike"
          @click.native="setVote(false)">
          <v-icon size="21">$dislike</v-icon>
        </v-btn>
        <v-btn
          fab
          class="discover__profile-action
          discover__profile-action_like"
          ref="like"
          @click.native="setVote">
          <v-icon size="36">$like</v-icon>
        </v-btn>
        <v-btn
          fab
          class="discover__profile-action
          discover__profile-action_superlike
          discover__profile-action_small"
          ref="superLike"
          @click.native="setVote">
          <v-icon size="26">$superLike</v-icon>
        </v-btn>
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

    let transform = `translate(-${moveOutWidth}px, -100px) rotate(30deg)`;

    if (like) {
      transform = `translate(${moveOutWidth}px, -100px) rotate(-30deg)`;
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
    const position = { x: 0, y: 0 };

    interact(discoverCard).draggable({
      listeners: {
        start() {
          setMoving();
        },
        move(event) {
          position.x += event.dx;
          position.y += event.dy;
          setLike(position.x > 0);
          const xMulti: number = position.x * 0.03;
          const yMulti: number = position.y / 80;
          const rotate: number = xMulti * yMulti;

          discoverCard.style.transform = `translate(${position.x}px, ${position.y}px) rotate(${rotate}deg)`;
        },
        end(event) {
          const keep: boolean = Math.abs(event.velocity.x) < 500;
          setMoving(false);

          if (keep) {
            position.x = 0;
            position.y = 0;
            discoverCard.style.transform = '';
            setLike();
            return;
          }

          setVote(position.x > 0);
        },
      },
    });
  }
}
</script>

<style scoped lang="scss">
  .discover {
    $discover: &;

    &__gradient-helper {
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

      &_like {
        background: linear-gradient(transparent, var(--v-pink-base));
      }

      &_dislike {
        background: linear-gradient(transparent, var(--v-red-base));
      }
    }

    &__profile {
      height: 100%;
      display: inline-block;
      width: 100%;
      border-radius: 8px;
      position: absolute;
      padding-bottom: 2.75rem;
      cursor: grab;
      transform: scale(0.8);
      opacity: 0;
      transition: 0.1s ease-in-out;
      z-index: 97;
      touch-action: none;
      user-select: none;

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
        width: 5.375rem !important;
        height: 5.375rem !important;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 20px 45px var(--v-white-darken4) !important;

        ::v-deep {
          .v-btn__content {
            transition: initial;
            transition-property: initial;
          }
        }

        &_small {
          width: 3.875rem !important;
          height: 3.875rem !important;
          margin-top: 0.5rem;
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
