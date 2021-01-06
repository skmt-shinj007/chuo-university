<template>
<div class="lattice">
  <div class="lattice__item" v-for="(contentsItem,n) in contentsData" :key="n">
    <slot name="cardInner">

    <!-- デフォルトのコンテンツ（呼び出し元でv-slotを使用 -> コンテンツ変更可能） -->
    <figure class="lattice__img-wrap">
      <img class="lattice__img" :src="`/image/${contentsItem.src}`" :alt="contentsItem.alt">
    </figure>

    </slot>
  </div>
</div>
</template>

<script>
export default {
  props: {
    contentsData: {
      type: Array,
      default: null
    }
  }
}
</script>

<style lang="scss" scoped>
.lattice {
  @include flex(column nowrap, center, center);

  @include mq(sm) {
    @include flex(row wrap, flex-start, stretch);
  }

  &__item {
    width: 80%;
    margin-bottom: interval(5);

    @include mq(sm) {
      margin-bottom: 0;
      width: calc(100% / 2);
      padding: interval(2);
    }

    @include mq(md) {
      width: calc(100% / 3);
    }

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__img-wrap {
    @include trimming(aspect(square));
  }

  &__img {
    box-shadow: 0 0 10px 2px color(shadow);
    border-radius: radius(soft);
    transition: all .3s ease-out;

    @include mq(md) {
      &:hover {
        transform: scale(1.05);
      }
      cursor: pointer;
    }

  }
}

</style>
