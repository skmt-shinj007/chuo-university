<template>
<div class="arrange-images">
  <ul class="arrange-images__list-container">
    <li class="arrange-images__list" v-for="(imageData, n) in imagesArraySlice" :key="n">
      <!-- img要素をクリックしたらモーダルで拡大表示する -->
      <img class="arrange-images__list-item" :src="`/image/${imageData.path}`" :alt="imageData.alt">
    </li>
  </ul>
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

  &__list-container {
    @include flex(row wrap);
  }

  &__list {
    @include trimming(aspect(square));
    @include flex(row nowrap, center);
    width: 50%;

    @include mq(sm) {
      width: 33.3%;
    }

    @include mq(md) {
      width: 20%;
    }
  }

  &__list-item {
    padding: interval(1);
    cursor: pointer;
  }
}

</style>
