<template>
<div class="arrange-images">
  <figure class="arrange-images__container" v-for="(imageData, n) in imagesArraySlice" :key="n">
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
  },
  computed: {
    imagesArraySlice() {
      return this.imagesData.slice(0, 10);  // 配列の要素をを10個にスライス
    },
  },
}
</script>

<style lang="scss" scoped>
.arrange-images {
  @include flex(row wrap, space-around, center);
  margin-top: - interval(1);

  @include mq(sm) {
    margin-top: - interval(2);
  };

  @include mq(md) {
    margin-top: - interval(1);
  };

  &__container {
    @include trimming(aspect(square));
    width: 45%;
    margin: interval(1);

    @include mq(sm) {
      margin-top: interval(2);
      width: 30%;
    };

    @include mq(md) {
      width: interval(22);
      margin: interval(1);
    }
  }
}

</style>
