<template>
<figure class="arrange-image">
  <img class="arrange-image__image" :src="imageUrl" :alt="alt" :class="radiusClass">
  <figcaption class="arrange-image__bar">
    <span class="arrange-image__text">{{ barText }}</span>
  </figcaption>
</figure>
</template>

<script>
export default {
  props: {
    imageUrl: String,
    alt: String,
    barText: {
      type: String,
      default: '写真の補足テキストが入ります。',
    },
  },
  computed: {
    radiusClass() {
      return (this.radius) ? `c-image__image-radius` : null;
    }
  },
}
</script>

<style lang="scss" scoped>
.arrange-image {
  width: 100%;
  margin-bottom: 100px;
  @include trimming(aspect(rectangle));

  &__image {
    border-radius: radius(soft);
    box-shadow: 0 0 6px color(darkShadow);
  }

  &__bar {
    width: 90%;
    background-color: rgba($color: color(white), $alpha: .6);
    border-radius: radius(normal);
    padding: interval(.5) interval(2);
    position: absolute;
    bottom: 5%;
    left: 50%;
    transform: translateX(-50%);
  }

  &__text {
    font-size: font(xs);
  }
}
</style>
