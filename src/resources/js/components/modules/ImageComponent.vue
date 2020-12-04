/**
 * コンポーネントの使用例
 * <image-component imageUrl="../image/group-photo_toutoSpring2017.jpg" alt="2017年東都春季リーグ集合写真"/>
 * pcスタイル未設定
*/

<template>
<div class="c-image">
  <img class="c-image__image" :src="imageUrl" :alt="alt" :class="radiusClass">
</div>
</template>

<script>
export default {
  props: {
    imageUrl: String,
    alt: String,
    radius: {
      type: Boolean,
      default: false
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
.c-image {
  width: 100%;
  @include trimming(aspect(rectangle));

  &__image {
    width: 100%;
    height: 100%;
    object-fit: cover;

    &-radius {
      border-radius: radius(soft);
    }
  }
}
</style>
