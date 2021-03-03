<template>
<div class="arrange-images">
  <ul class="arrange-images__list">
    <li class="arrange-images__list-item" ref="item" v-for="(image, n) in filterImages" :key="n">
      <!-- img要素をクリックしたらモーダルで拡大表示する -->
      <figure class="arrange-images__image">
        <img :src="`/image/${image.path}`" :alt="image.alt">
      </figure>
    </li>

    <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
    <div
      class="enpty"
      v-for="n in 10"
      :key="`enpty-${n}`"
      :style="{ width: `${itemWidth}px` }"/>

  </ul>
</div>
</template>

<script>
export default {
  data() {
    return {
      /**
       * 写真の表示枚数
       */
      display: 10,

      /**
       * リストアイテムの幅
       * 空要素を足すときに使用。
       */
      itemWidth: 0,
    }
  },

  props: {
    images: {
      type: Array,
      default: null
    }
  },

  computed: {
    filterImages() {
      return this.images.slice(0, this.display);  // 配列の要素をを10個にスライス
    },
  },

  watch: {
    windowWidth() {
      this.getWidth();
    },
  },

  mounted() {
    this.getWidth();
  },

  methods: {
    /**
     * [写真の幅を変数にぶち込む]
     */
    getWidth() {
      this.itemWidth = this.$refs.item[0].offsetWidth;
    },
  },
}
</script>

<style lang="scss" scoped>
.arrange-images {

  &__list {
    @include flex(row wrap, center, center);
  }

  &__list-item {
    width: interval(32);
    padding: interval(.5);
  }

  &__image {
    cursor: pointer;
    @include trimming(aspect(square));
  }
}

</style>
