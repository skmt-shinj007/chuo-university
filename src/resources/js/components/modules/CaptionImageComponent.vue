<template>
<figure class="caption-image">
  <img class="caption-image__image" :src="`/image/${image.src}`" :alt="image.alt">

  <figcaption class="caption-image__bar">
    <slot name="caption" :image="image">
      <span class="caption-image__caption">{{ image.caption }}</span>
    </slot>
  </figcaption>

</figure>
</template>

<script>
export default {
  props: {
    image: {
      type: Object,
      required: true,
    },
    barCaption: {
      type: String,
      default: '',
    },
    capacityNum: {
      type: Number,
      default: 0,
    },
  },
}
</script>

<style lang="scss" scoped>
.caption-image {
  width: 100%;
  @include trimming(aspect(rectangle));

  &__image {
    border-radius: radius(soft);
    box-shadow: 0 0 6px color(darkShadow);
  }

  &__bar {
    width: 90%;
    background-color: rgba($color: color(white), $alpha: .6);
    border-radius: radius(normal);
    padding: interval(.5) interval(1);
    line-height: 1;
    position: absolute;
    bottom: 5%;
    left: 50%;
    transform: translateX(-50%);
  }

  &__caption {
    font-size: font(10);
    line-height: 1.2;
  }
}
</style>
