<template>
  <div class="user-profile">
    <div class="user-profile__close-button"
         @click="$emit('close')">
      <v-icon size="24">$chevronLeft</v-icon>
    </div>
    <div class="user-profile__wrapper" v-if="isLoaded">
      <img class="user-profile__image" alt='' :src="profile.photos[0]"/>
      <div class="user-profile__info">
        <div class="user-profile__header user-profile__section">
          <div>
            <div class="user-profile__title">
              {{ profile.name }}, {{ profile.age }}
            </div>
            <div class="user-profile__status">
              {{ profile.status }}
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
            {{ profile.about }}
          </div>
        </div>
        <div class="user-profile__section">
          <div class="user-profile__section-title">
            {{ $t('interests') }}
          </div>
          <div class="user-profile__section-content">
            <div class="user-profile__interests">
              <interest-component v-for="interest in profile.interests"
                                  :key="interest.id"
                                  :title="interest.title"
                                  :type="interest.type"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="user-profile__skeleton" v-else>
      <v-skeleton-loader
        class="mx-auto"
        max-width="300"
        type="card"
      ></v-skeleton-loader>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import axios from 'axios';
import { ProfileType } from '@/models/profile';
import InterestComponent from '@/components/InterestComponent.vue';

@Component({
  components: {
    InterestComponent,
  },
})
export default class UserProfileComponent extends Vue {
  private profile!: ProfileType

  private isLoaded = false

  mounted(): void {
    axios.get('https://my-json-server.typicode.com/cashalotkzn/json/profiles/1')
      .then(({ data }): void => {
        this.isLoaded = true;
        this.profile = data;
      });
  }
}
</script>

<style scoped lang="scss">
  .user-profile {
    background-color: var(--v-white-base);
    height: 100%;

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
