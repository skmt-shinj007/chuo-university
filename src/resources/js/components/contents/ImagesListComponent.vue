<template>
<div class="images-list">
  <ul class="images-list__list">
    <li class="images-list__item" ref="item" v-for="(image, n) in filterImages" :key="n">
      <!-- img要素をクリックしたらモーダルで拡大表示する -->
      <figure class="images-list__image" @click="openModal(image)">
        <img :src="`/image/${image.src}`" :alt="image.alt">
      </figure>
    </li>

    <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
    <div
      class="enpty"
      v-for="n in 10"
      :key="`enpty-${n}`"
      :style="{ width: `${itemWidth}px` }"/>

  </ul>

  <image-modal
    v-if="showModal"
    @close="closeModal"
    :selectIndex="selectIndex"
    :images="filterImages"/>
</div>
</template>

<script>
// component
import ImageModal from '../modules/modal/ImageModalComponent';

// mixin
import Risize from '../../config/resize';

export default {
  components: {
    ImageModal,
  },

  mixins: [Risize],

  data() {
    return {
      /**
       * 写真の表示枚数
       * @type { Number }
       */
      count: 10,

      /**
       * リストアイテムの幅
       * @type { Number }
       */
      itemWidth: 0,

      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * [選択した画像のインデックス番号]
       * @type { Number }
       */
      selectIndex: 0,
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
      return this.images.slice(0, this.count);  // 配列の要素をを10個にスライス
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

    /**
     * [モーダル表示切り替え]
     */
    openModal(el) {
      this.showModal = true;

      this.selectIndex = this.filterImages.indexOf(el);
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.showModal = false;
      setTimeout(() => {
        document.body.classList.remove("modal-open");
      }, 500);
    },
  },
}
</script>

<style lang="scss" scoped>
.images-list {

  &__list {
    @include flex(row wrap, center, center);
  }

  &__item {
    border: 1px solid color(lightgray);
    width: interval(18);

    @include mq(md) {
      width: interval(20);
    }
  }

  &__image {
    cursor: pointer;
    @include trimming(aspect(square));
  }
}

</style>
