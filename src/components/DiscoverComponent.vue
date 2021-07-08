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
                                  :key="profile.title"
                                  :profile="profile"
                                  ref="profileCard"/>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import DiscoverProfileComponent from '@/components/DiscoverProfileComponent.vue';
import Hammer from 'hammerjs';

export interface ProfileType {
  image: string,
  title: string,
  description: string,
}

@Component({
  components: {
    DiscoverProfileComponent,
  },
})
export default class DiscoverComponent extends Vue {
  private readonly profiles: ProfileType[] = [
    {
      image: 'https://placeimg.com/600/300/people',
      title: 'Demo card 1',
      description: 'This is a demo for Tinder like swipe cards',
    },
    {
      image: 'https://placeimg.com/600/300/animals',
      title: 'Demo card 2',
      description: 'This is a demo for Tinder like swipe cards',
    },
    {
      image: 'https://placeimg.com/600/300/nature',
      title: 'Demo card 3',
      description: 'This is a demo for Tinder like swipe cards',
    },
    {
      image: 'https://placeimg.com/600/300/tech',
      title: 'Demo card 4',
      description: 'This is a demo for Tinder like swipe cards',
    },
    {
      image: 'https://placeimg.com/600/300/arch',
      title: 'Demo card 5',
      description: 'This is a demo for Tinder like swipe cards',
    },
  ]

  private allCards!: Vue[]

  private tinderNope = false

  private tinderLove = false

  private loaded = false;

  public initCards(): void {
    this.allCards = this.$refs.profileCard as Vue[];

    this.allCards.forEach((card: Vue, index: number): void => {
      const element: HTMLElement = card.$el as HTMLElement;
      element.style.zIndex = `${this.allCards.length - index}`;
      element.style.transform = `scale(${(20 - index) / 20})`;
      element.style.opacity = `${(10 - index) / 10}`;
    });

    this.loaded = true;
  }

  mounted(): void {
    this.initCards();
    this.somethingWithCard();
  }

  public somethingWithCard(): void {
    this.allCards.forEach((el: Vue) => {
      const target = el.$el as HTMLElement;
      const hammerTime = new Hammer(target as HTMLElement);

      hammerTime.on('pan', () => {
        target.classList.add('discover__profile_moving');
      });

      hammerTime.on('pan', (event) => {
        if (event.deltaX === 0) return;
        if (event.center.x === 0 && event.center.y === 0) return;

        this.tinderLove = event.deltaX > 0;
        this.tinderNope = event.deltaX < 0;

        const xMulti = event.deltaX * 0.03;
        const yMulti = event.deltaY / 80;
        const rotate = xMulti * yMulti;

        target.style.transform = `translate(${event.deltaX}px, ${event.deltaY}px) rotate(${rotate}deg)`;
      });

      hammerTime.on('panend', (event) => {
        target.classList.remove('discover__profile_moving');
        this.tinderLove = false;
        this.tinderNope = false;

        const moveOutWidth = document.body.clientWidth;
        const keep = Math.abs(event.deltaX) < 80 || Math.abs(event.velocityX) < 0.5;

        if (keep) {
          target.style.transform = '';
        } else {
          const endX = Math.max(Math.abs(event.velocityX) * moveOutWidth, moveOutWidth);
          const toX = event.deltaX > 0 ? endX : -endX;
          const endY = Math.abs(event.velocityY) * moveOutWidth;
          const toY = event.deltaY > 0 ? endY : -endY;
          const xMulti = event.deltaX * 0.03;
          const yMulti = event.deltaY / 80;
          const rotate = xMulti * yMulti;
          target.style.transform = `translate(${toX}px, ${toY + event.deltaY}px) rotate(${rotate}deg)`;
          this.initCards();
        }
      });
    });
  }

  public createButtonListener(love = true): void | boolean {
    const cards = document.querySelectorAll('.tinder--card:not(.removed)');
    const moveOutWidth = document.body.clientWidth * 1.5;

    if (!cards.length) return false;

    const card = cards[0] as HTMLElement;

    card.classList.add('removed');

    if (love) {
      card.style.transform = `translate(${moveOutWidth}px, -100px) rotate(-30deg)`;
    } else {
      card.style.transform = `translate(-${moveOutWidth}px, -100px) rotate(30deg)`;
    }

    return this.initCards();
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
