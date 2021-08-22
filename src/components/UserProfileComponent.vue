<template>
  <div class="user-profile"
       :class="{'user-profile_moving': isMoving}"
       ref="userProfile">
    <div class="user-profile__close-button"
         @click="closeUserProfile">
      <v-icon size="24">$chevronLeft</v-icon>
    </div>
    <div class="user-profile__wrapper">
      <img class="user-profile__image" alt='' :src="user.photos[0].url"/>
      <div class="user-profile__info">
        <div class="user-profile__header user-profile__section">
          <div>
            <div class="user-profile__title">
              {{ user.name }}, {{ user.age }}
            </div>
            <div class="user-profile__status">
              {{ user.status }}
            </div>
          </div>
          <div class="user-profile__distance">
            <v-icon size="12"
                    class="user-profile__distance-icon">$destination</v-icon>
            <span>{{ $tc('metrics.miles', 3) }}</span>
          </div>
        </div>
        <div class="user-profile__section">
          <div class="user-profile__section-title">
            {{ $t('about') }}
          </div>
          <div class="user-profile__section-content">
            {{ user.about }}
          </div>
        </div>
        <div v-if="user.interests"
             class="user-profile__section">
          <div class="user-profile__section-title">
            {{ $t('interests') }}
          </div>
          <div class="user-profile__section-content">
            <div class="user-profile__interests">
              <interest-component v-for="interest in user.interests"
                                  :key="interest.id"
                                  :title="interest.title"
                                  :type="interest.type"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import { UserType } from '@/models/User';
import InterestComponent from '@/components/InterestComponent.vue';
import interact from 'interactjs';

@Component({
  components: {
    InterestComponent,
  },
})
export default class UserProfileComponent extends Vue {
  @Prop({ required: true })
  private readonly user!: UserType

  private readonly closeVelocity = 1000

  private isMoving = false

  private toggleTransitionClass(): void {
    this.isMoving = !this.isMoving;
  }

  private closeUserProfile(velocityX = 0):void {
    const userProfileElement: HTMLElement = this.$refs?.userProfile as HTMLElement;

    if (velocityX > 0) {
      userProfileElement.style.transform = 'translateX(100%)';

      setTimeout(() => {
        this.$emit('close');
      }, 100);

      return;
    }

    userProfileElement.style.transform = 'translateY(100%)';

    setTimeout(() => {
      this.$emit('close');
    }, 100);
  }

  mounted(): void {
    const userProfileElement: HTMLElement = this.$refs?.userProfile as HTMLElement;
    const { closeUserProfile, closeVelocity, toggleTransitionClass } = this;
    let offsetY = 0;
    let offsetX = 0;

    interact(userProfileElement).draggable({
      startAxis: 'xy',
      lockAxis: 'start',
      listeners: {
        start() {
          offsetY = 0;
          offsetX = 0;
          toggleTransitionClass();
        },
        move(event) {
          offsetY += event.dy;
          offsetX += event.dx;

          if (offsetY > 30) {
            userProfileElement.style.transform = `translateY(${offsetY}px)`;
            return;
          }

          if (offsetX > 0) {
            userProfileElement.style.transform = `translateX(${offsetX}px)`;
            return;
          }

          userProfileElement.style.transform = 'translate(0 0)';
        },
        end(event) {
          const velocity = event.velocity.x + event.velocity.y;
          const keep: boolean = velocity < closeVelocity;
          toggleTransitionClass();

          if (keep) {
            userProfileElement.style.transform = 'translateY(0px)';
            return;
          }

          closeUserProfile(event.velocity.x);
        },
      },
    });
  }
}
</script>

<style scoped lang="scss">
  .user-profile {
    background-color: var(--v-white-base);
    height: 100%;
    touch-action: none;
    user-select: none;
    transition: 0.1s;

    &_moving {
      transition: 0s;
    }

    &__wrapper {
      overflow: hidden;
      height: 100%;
    }

    &__interests {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    &__section {
      margin-bottom: 2.125rem;

      &-title {
        font-weight: 600;
        font-size: 1.125rem;
        line-height: 1;
        margin-bottom: 0.75rem;
      }

      &-content {
        line-height: 1.5rem;
        letter-spacing: -0.02em;
        color: var(--v-white-darken10);
      }
    }

    &__distance {
      display: flex;
      align-items: center;
      color: var(--v-white-darken9);
      font-weight: 600;
      flex-shrink: 0;
      margin-left: 2rem;

      &-icon {
        margin-right: 0.5rem;
      }
    }

    &__header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    &__status {
      font-weight: 500;
      font-size: 1.125rem;
      line-height: 1;
      letter-spacing: -0.03em;
      color: var(--v-white-darken8);
    }

    &__title {
      font-weight: bold;
      font-size: 1.875rem;
      line-height: 2.625rem;
      letter-spacing: -0.03em;
      margin-bottom: 0.575rem;
    }

    &__image {
      height: 100%;
      width: 445%;
    }

    &__info {
      background-color: var(--v-white-base);
      position: absolute;
      bottom: 0;
      width: 100%;
      border-radius: 50px 50px 0 0;
      min-height: 50%;
      max-height: 60%;
      overflow: scroll;
      padding: 1.375rem 2.125rem;
      touch-action: none;
      user-select: none;
    }

    &__close-button {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.1);
      position: fixed;
      top: 3rem;
      left: 2rem;
      display: flex;
      color: var(--v-white-base);
      justify-content: center;
      align-items: center;
    }
  }
</style>
