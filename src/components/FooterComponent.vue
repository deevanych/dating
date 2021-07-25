<template>
  <footer class="footer">
    <nav class="footer-menu">
      <div v-for="link in footerLinks"
           :key="link.title">
        <router-link :to="{ name: link.to }"
                     :ref="link.to"
                     class="footer-menu__item"
                     exact-active-class="footer-menu__item_active">
          <v-icon tag="span"
                  size="22"
                  class="footer-menu__item-icon">{{ link.icon }}</v-icon>
          <span class="footer-menu__item-title">{{ link.title }}</span>
        </router-link>
      </div>
    </nav>
  </footer>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { TranslateResult } from 'vue-i18n';

interface FooterLinkType {
  title: TranslateResult,
  icon: string,
  to: string,
}

@Component
export default class FooterComponent extends Vue {
  private readonly footerLinks: FooterLinkType[] = [
    {
      title: this.$t('menu.home'),
      icon: '$footerHome',
      to: 'Home',
    },
    {
      title: this.$t('menu.matches'),
      icon: '$heart',
      to: 'Matches',
    },
    {
      title: this.$t('menu.inbox'),
      icon: '$message',
      to: 'Inbox',
    },
    {
      title: this.$t('menu.settings'),
      icon: '$folder',
      to: 'Settings',
    },
  ];
}
</script>

<style scoped lang="scss">
  .footer {
    margin-bottom: -1rem;
    background-color: var(--v-white-base);
    border: 0.7px solid var(--v-white-darken1);
    border-radius: 20px 20px 15px 15px;
    padding: 1.125rem 2.25rem 0;

    &-menu {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;

      &__item {
        text-decoration: none;
        color: var(--v-white-darken2);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 3rem;
        height: 6rem;
        position: relative;

        &-title {
          font-size: 0.75rem;
          line-height: 0.75rem;
        }

        &:hover,
        &_active {
          color: var(--v-pink-base);
          font-weight: 600;

          &::before {
            position: absolute;
            top: -0.5rem;
            background-size: cover;
            content: '';
            display: block;
            width: 2.25rem;
            height: 2.25rem;
            background-image: url("~@/assets/blob.svg");
          }

          &::after {
            position: absolute;
            bottom: 0.625rem;
            content: '';
            display: block;
            width: 1.75rem;
            height: 0.625rem;
            background-color: var(--v-pink-base);
            border-radius: 13px;
          }
        }
      }
    }
  }
</style>
