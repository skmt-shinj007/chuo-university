<template>
  <div class="menu-panel">
    <figure class="menu-panel__figure">
      <img class="menu-panel__image" :src="`/image/${menuPanelData.Image.Src}`" :alt="menuPanelData.Image.Alt">
    </figure>
    <primary-button-component
      class="menu-panel__button"
      :name="menuPanelData.Btn.Name"
      :btnSize="menuPanelData.Btn.Size"
      variationClass="rgba"/>
  </div>
</template>

<script>
// component import
import PrimaryButtonComponent from './button/PrimaryButtonComponent';

export default {
  components: {
    PrimaryButtonComponent,
  },
  props: {
    menuPanelData: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      imageRadius: true,
    }
  },
}
</script>

<style lang="scss" scoped>
.menu-panel {

  &__figure {
    width: 100%;
    @include trimming(aspect(rectangle));
  }

  &__image {
    width: 100%;
    border-radius: radius(soft);
    opacity: 0.8;
    box-shadow: 0 0 8px 2px color(shadow);
  }

  &__button {
    transform: translateY(-120%);

    // pc style
    @include mq(md) {
      transform: translateY(-50%);
    }
  }
}
</style>
