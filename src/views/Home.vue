<template>
  <discover-component/>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import DiscoverComponent from '@/components/DiscoverComponent.vue';

@Component({
  components: {
    DiscoverComponent,
  },
})
export default class Home extends Vue {

}
</script>

<style lang="scss">
  .home-page {
    padding: 1.625rem 0 2.25rem;
  }
</style>
