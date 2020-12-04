<template>
  <div class="c-menuPanel">
    <image-component class="c-menuPanel__image" :imageUrl="panelImageUrl" :alt="imageAlt" :radius="imageRadius"/>
    <view-all-button-component class="c-menuPanel__button" :name="buttonName" :buttonSize="buttonSize"/>
  </div>
</template>

<script>
// component import
import ImageComponent from './ImageComponent';
import ViewAllButtonComponent from './button/ViewAllButtonComponent';

export default {
  components: {
    ImageComponent,
    ViewAllButtonComponent,
  },
  props: {
    buttonName: String,
    panelImageUrl: String,
    imageAlt: String,
    buttonSize: String,
  },
  data() {
    return {
      imageRadius: true,
    }
  },
}
</script>

<style lang="scss" scoped>
.c-menuPanel {

  &__image {
    width: 100%;
    opacity: 0.7;
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
