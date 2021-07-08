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
  }

  .container {
    padding: 0 1.5rem;
    display: flex;
    flex-direction: column;
  }

  .content__wrapper {
    margin: 10rem auto 7.5rem;
  }

  .header {
    position: fixed;
    top: 0;
  }
</style>
