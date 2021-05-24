<template>
  <div class="user-thumbnail" :class="color">
    <picture class="user-thumbnail__picture">
      <!-- <source v-if="image.source" :media="mq" :srcset="image.source.sp">
      <source v-if="image.source" :media="mq" :srcset="image.source.pc"> -->
      <img :src="image.src" :alt="image.alt" @error="noImage">
    </picture>
  </div>
</template>

<script>
export default {
  data() {
    return {
      /**
       * sourceのmedia属性に吐き出すブレークポイント
       * TODO:scssの$breakPointsマップをjsで使用したい。
       * @type {Object}
       */
      breakpoints: null,
    }
  },

  props: {
    /**
     * img, sourceに出力するデータ
     * props {
     *   source: {
     *     sp: 'url' {String},
     *     pc: 'url' {String},
     *   },
     *   src: 'url' {String},
     *   alt: 'url' {String},
     * }
     */
    image: {
      type: Object,
      default: null,
    },

    /**
     * ボーダーカラー
     */
    borderColor: {
      type: String,
      default: null
    }
  },

  computed: {
    color() {
      return (this.borderColor) ? `user-thumbnail--${this.borderColor}` : null;
    },
  },

  methods: {
    /**
     * 画像のロードエラーハンドリング
     * デフォルトの画像パスに置き換える。
     */
    noImage(element) {
      element.target.src = '/image/noimage.png';
    }
  },
}
</script>

<style lang='scss'>
.user-thumbnail {
  @include gradient(color(lightDarkblue), color(blue), diagonal);
  @include flex(row nowrap, center, center);
  border-radius: radius(circle);

  &--lightgreen {
    @include gradient(color(lightDarkblue), color(lightgreen), diagonal);
  }

  &--orange {
    @include gradient(color(lightDarkblue), color(orange), diagonal);
  }

  &__picture {
    width: 100%;
    display: block;
    transform: scale(.95);
    @include trimming(aspect(square));

    & > img {
      border-radius: radius(circle);
    }
  }
}
</style>
