<template>
  <div class="discover"
       ref="tinder"
       :class="{
          loaded,
          'tinder_love': tinderLove,
          'tinder_nope': tinderNope,
        }">
    <div class="discover__cards">
      <discover-profile-component v-for="profile in profiles"
                                  :key="profile.id"
                                  :profile="profile"
                                  ref="profileCard"
                                  @removeCard="removeCard"/>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import DiscoverProfileComponent from '@/components/DiscoverProfileComponent.vue';
import { ProfileType } from '@/models/profile';
import axios from 'axios';

@Component({
  components: {
    DiscoverProfileComponent,
  },
})
export default class DiscoverComponent extends Vue {
  private profiles: ProfileType[] = []

  private tinderNope = false

  private tinderLove = false

  private loaded = false

  private readonly chunkCardsCount = 5

  public removeCard(): void {
    new Promise((resolve) => {
      setTimeout((): void => {
        this.$delete(this.profiles, 0);
        resolve(true);
      }, 200);
    }).then((): void => {
      if (this.profiles.length <= this.chunkCardsCount) this.loadCards();
    });
  }

  public loadCards(cardsCount: number = this.chunkCardsCount): void {
    axios.get('https://my-json-server.typicode.com/cashalotkzn/json/profiles')
      .then(({ data }): void => {
        this.profiles.push(...data.slice(0, cardsCount));
      })
      .finally((): void => {
        this.loaded = true;
      });
  }

  mounted(): void {
    axios.get('https://my-json-server.typicode.com/cashalotkzn/json/profiles')
      .then(({ data }): void => {
        this.profiles = data;
      })
      .finally(() => {
        this.loaded = true;
      });
  }
}
</script>

<style scoped lang="scss">
  .discover {
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    opacity: 0;
    transition: opacity 0.1s ease-in-out;

    &__filter {
      background-color: var(--v-white-base);
    }

    &__profile {
      transform: scale(0.8);
      opacity: 0;
      z-index: 1;

      &:first-of-type {
        transform: scale(1);
        z-index: 3;
        opacity: 1;
      }

      &:nth-of-type(2) {
        transform: scale(0.9);
        opacity: 0.8;
        z-index: 2;
      }
    }

    &__cards {
      flex-grow: 1;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      z-index: 1;
    }

    &.loaded {
      opacity: 1;
    }

    &__status {
      position: absolute;
      top: 50%;
      margin-top: -30px;
      z-index: 2;
      width: 100%;
      text-align: center;
      pointer-events: none;

      & i {
        font-size: 100px;
        opacity: 0;
        transform: scale(0.3);
        transition: all 0.2s ease-in-out;
        position: absolute;
        width: 100px;
        margin-left: -50px;
      }
    }
  }
</style>
