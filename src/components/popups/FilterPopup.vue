<template>
  <bottom-popup-layout :title="$t('filters')"
                       @close="$emit('close')">
    asdsadas
  </bottom-popup-layout>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import BottomPopupLayout from '@/components/popups/BottomPopupLayout.vue';
import { mapGetters } from 'vuex';

@Component({
  components: {
    BottomPopupLayout,
  },
  computed: {
    ...mapGetters(['isFilterPopupShown']),
  },
})
export default class FilterPopup extends Vue {
  @Prop({ default: true })
  private readonly value!: boolean
}
</script>

<style scoped lang="scss">
  .popup {

  }
</style>
