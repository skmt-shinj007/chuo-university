<template>
<figure class="caption-bar-image">
  <img class="caption-bar-image__image" :src="imageUrl" :alt="alt" :class="radiusClass">
  <figcaption class="caption-bar-image__bar">

    <!-- デフォルトのbar -->
    <span v-if="barCaption" class="caption-bar-image__caption">{{ barCaption }}</span>

    <!-- 寮の写真でのbarTextが特殊だったので追加。 -->
    <span v-if="capacityNum" class="caption-bar-image__capacity-number">{{ capacityNum }}</span>
    <span v-if="capacityNum" class="caption-bar-image__secondary-caption">人部屋</span>
  </figcaption>
</figure>
</template>

<script>
export default {
  props: {
    imageUrl: String,
    alt: String,
    barCaption: {
      type: String,
      default: '',
    },
    capacityNum: {
      type: Number,
      default: 0,
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
.caption-bar-image {
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

  &__caption,
  &__secondary-caption {
    font-size: font(10);
  }

  &__capacity-number {
    font-size: font(14);
    font-weight: bold;
  }
}
</style>
