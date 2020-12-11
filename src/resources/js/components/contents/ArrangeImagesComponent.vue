<template>
<div class="arrange-images">
  <figure class="arrange-images__container" v-for="(imageData, n) in imagesData" :key="n">
    <img class="arrange-images__image" :src="`/image/${imageData.path}`" :alt="imageData.alt">
  </figure>
</div>
</template>

<script>
export default {
  props: {
    imagesData: {
      type: Array,
      default: null
    }
  }
}
</script>

<style lang="scss" scoped>
.arrange-images {
  @include flex(row wrap, space-around, center);
  margin-top: - interval(1);

  &__container {
    @include trimming(aspect(square));
    width: interval(22);
    margin-top: interval(1);

    @include mq(sm) {
      padding-top: interval(2);
    }
  }

  &__image {
  }
}

</style>
