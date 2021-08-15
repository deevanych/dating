<template>
  <div v-if="cards.length > 0"
       class="discover"
       ref="tinder">
    <div class="discover__cards">
      <discover-profile-component v-for="profile in cards"
                                  :key="profile.id"
                                  :profile="profile"
                                  ref="profileCard"
                                  @removeCard="$store.dispatch('REMOVE_CARD')"/>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import DiscoverProfileComponent from '@/components/DiscoverProfileComponent.vue';
import { Getter } from 'vuex-class';

@Component({
  components: {
    DiscoverProfileComponent,
  },
})
export default class DiscoverComponent extends Vue {
  @Getter('PROFILE_CARDS')
  private readonly cards!: []

  mounted(): void {
    this.$store.dispatch('GET_CARDS');
  }
}
</script>

<style scoped lang="scss">
  .discover {
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;

    &__filter {
      background-color: var(--v-white-base);
    }

    &__profile {
      &:first-of-type {
        transform: scale(1);
        opacity: 1;
        z-index: 99;
      }

      &:nth-of-type(2) {
        transform: scale(0.9);
        opacity: 0.8;
        z-index: 98;
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
