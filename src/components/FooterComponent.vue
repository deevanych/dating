<template>
  <footer class="footer">
    <nav class="footer-menu">
      <div class="footer-menu__blobs"
           ref="blobs"
           :class="{'footer-menu__blobs_transferred': isTransferred}"
           :style="computedStyle"></div>
      <div v-for="link in footerLinks"
           :key="link.title"
           @click="transferBlobs">
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
import lottie from 'lottie-web';
import blobs from '@/lottieFiles/blobs.json';
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

  private blobsOffset = 0

  private isTransferred = false

  private animationDuration = 0.4

  private footerElements!: Vue[]

  private activeElement!: HTMLElement

  get computedStyle(): { [key: string]: string } {
    if (this.activeElement) {
      this.footerInit();
    }

    return {
      left: `${this.blobsOffset}px`,
    };
  }

  public transferBlobs(): void {
    this.isTransferred = true;

    setTimeout(() => {
      this.isTransferred = false;
    }, this.animationDuration * 1000);
  }

  private footerInit(): void {
    this.footerElements = this.$refs[this.$route.name as string] as Vue[];
    this.activeElement = this.footerElements[0].$el as HTMLElement;
    const blobsElement = this.$refs.blobs as HTMLElement;
    const offset = (this.activeElement.offsetWidth / 2) - (blobsElement.offsetWidth / 2);
    this.blobsOffset = this.activeElement.offsetLeft + offset;
  }

  mounted(): void {
    this.footerInit();
    lottie.loadAnimation({
      container: this.$refs.blobs as Element,
      renderer: 'svg',
      loop: true,
      autoplay: true,
      animationData: blobs,
    });
  }
}
</script>

<style scoped lang="scss">
  .footer {
    position: fixed;
    width: 100%;
    bottom: -1rem;
    left: 0;
    background-color: var(--v-white-base);
    border: 0.7px solid var(--v-white-darken1);
    border-radius: 20px 20px 15px 15px;
    padding: 1.125rem 2.25rem 3rem;

    &-menu {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;

      &__blobs {
        position: absolute;
        width: 3rem;
        height: 3rem;
        top: -0.75rem;
        left: -0.375rem;
        color: var(--v-pink-lighten3);
        transition: left 1s cubic-bezier(0.81, 0.07, 0.17, 0.89),
                    transform 1s;

        &_transferred {
          transform: scaleX(1) scaleY(0);
        }

        ::v-deep {
          * {
            fill: var(--v-pink-lighten3);
          }
        }
      }

      &__item {
        text-decoration: none;
        color: var(--v-white-darken2);
        transition: 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        height: 3rem;

        &-title {
          font-size: 0.75rem;
          line-height: 0.75rem;
          font-weight: 500;
        }

        &:hover,
        &_active {
          color: var(--v-pink-base);
        }
      }
    }
  }
</style>
