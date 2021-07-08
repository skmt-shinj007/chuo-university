<template>
  <div class="main-visual-slider">
    <swiper
      :options="options"
      ref="swiper"
      @slideChange="getRealIndex"
      @slideChangeTransitionStart="resetProgress"
      @slideChangeTransitionEnd="startProgress"
    >
      <!-- スライド -->
      <swiper-slide v-for="image in images" :key="image.id">
        <img class="main-visual-slider__image" :src="`/image/${image.img.src}`" :alt="image.img.alt">
        <div class="main-visual-slider__contents">
          <template v-if="image.caption">
            <span class="main-visual-slider__text">{{ image.caption }}</span>
          </template>
        </div>
      </swiper-slide>
    </swiper>

    <!-- プログレスバー -->
    <div class="main-visual-slider__progress-bar">
      <span class="main-visual-slider__num">{{ currentIndex(realIndex) }}</span>
      <div class="main-visual-slider__gauge">
        <span class="main-visual-slider__gauge-active" ref="swiper-progress-bar"/>
      </div>
      <span class="main-visual-slider__num">{{ nextIndex(realIndex) }}</span>
    </div>
  </div>
</template>

<script>
import { viewData } from '../../../config/data/viewData';
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
// import style (<= Swiper 5.x)
import 'swiper/css/swiper.css'

export default {
  components: {
    Swiper,
    SwiperSlide
  },

  data() {
    return {
      viewdata: viewData,

      /**
       * デフォルトのスライドインデックス
       * @type {Number}
       */
      realIndex: 0,
    }
  },

  props: {
    // slide images
    images: {
      type: Array,
      require: true
    },

    /**
     * swiper options
     * loopをtrueにするとクローンされたスライドに到達した時にスライドが止まるので注意。
     */
    options: {
      type: Object,
      default: () => {
        return viewData.swiperOptions.mainVisual;
      }
    }
  },

  computed: {
    /**
     * 現在表示されているスライドが何枚目かを返す。
     * @return {String} 現在の表示されているスライド番号 "01"
     */
    currentIndex() {
      return (i) => {
        return `0${i}`;
      };
    },

    /**
     * 次に表示されるスライド番号
     * @return {String} 次に表示されるスライド番号 "01"
     */
    nextIndex() {
      return (i) => {
        const next = i + 1;
        const max = this.images.length;
        return (max >= next) ? `0${next}` : `01`;
      }
    },
  },

  mounted() {
    // スライドの初期表示（1枚目）でプログレスバーをアニメーションさせる
    this.startProgress();
  },

  methods: {
    // プログレスバーをリセット
    resetProgress() {
      const bar = this.$refs['swiper-progress-bar'];
      bar.style.transitionDuration = '0s';
      bar.style.transform = 'scaleX(0)';
    },

    // プログレスバーのアニメーションを開始
    startProgress() {
      const bar = this.$refs['swiper-progress-bar'];
      bar.style.transitionDuration = '4500ms';
      bar.style.transform = 'scaleX(1)';
    },

    // 現在のアクティブなインデックスを取得する
    getRealIndex() {
      this.realIndex = this.$refs.swiper.$swiper.realIndex;
    },
  },
}
</script>

<style lang="scss" scoped>
.main-visual-slider {
  height: 100%;
  position: relative;

  .swiper {

    &-slider {
      overflow: hidden;
    }
  }

  &__image {
    width: 100%;
    height: 100vh;
    object-fit: cover;
    object-position: 50% 50%;
  }

  &__contents {
    width: 60%;
    position: absolute;
    top: 50%;
    left: interval(2);
    color: color(white);

    @include mq(md) {
      left: interval(10);
    }
  }

  &__text {
    white-space: pre-wrap;
    line-break: normal;
    font-size: font(14);
  }

  &__progress-bar {
    position: absolute;
    top: 60%;
    left: interval(2);
    z-index: 2;
    @include flex(row nowrap, flex-start, center);

    @include mq(md) {
      left: interval(10);
    }
  }

  &__gauge {
    position: relative;
    overflow: hidden;
    width: interval(8);
    height: pixel(.5);
    margin: 0 interval(1);
    background-color: rgba($color: color(darkblue), $alpha: .5);
    border-radius: 1000px;

    &-active {
      display: block;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      background-color: color(white);
      border-radius: 1000px 0 0 1000px;
      transform: scaleX(0);
      transform-origin: 0 100%;

      // swiperのアニメーションスピードに合わせる
      transition: transform 4500ms linear;
    }
  }

  &__num {
    font-size: font(16);
  }
}
</style>
