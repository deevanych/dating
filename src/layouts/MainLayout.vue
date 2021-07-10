<template>
  <div class="page__wrapper">
    <header-component/>
    <v-container class="content__wrapper">
      <router-view/>
    </v-container>
    <footer-component/>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import FooterComponent from '@/components/FooterComponent.vue';
import HeaderComponent from '@/components/HeaderComponent.vue';

@Component({
  components: {
    HeaderComponent,
    FooterComponent,
  },
})
export default class MainLayout extends Vue {

}
</script>

<style scoped lang="scss">
  .page__wrapper {
    display: flex;
    height: 100%;
    overflow: hidden;
    flex-direction: column;
  }

  .container {
    padding: 0 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
</style>
