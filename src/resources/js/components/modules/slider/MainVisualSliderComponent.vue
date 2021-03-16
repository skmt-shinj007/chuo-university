<template>
<div class="main-visual-slider">
    <swiper ref="mainVisualSwiper" :options="params">
      <swiper-slide v-for="(image,i) in images" :key="i">
        <img class="main-visual-slider__image" :src="`/image/${image.src}`" :alt="image.alt">

        <div class="main-visual-slider__box">
          <span class="main-visual-slider__text">{{ image.caption }}</span>

          <div class="main-visual-slider__pagination">
            <span class="main-visual-slider__num">{{ convert(i) }}</span>
            <div class="main-visual-slider__bar"/>
            <span class="main-visual-slider__num">{{ next(i + 1) }}</span>
          </div>
        </div>

      </swiper-slide>
    </swiper>
  </div>
</template>

<script>
export default {
  data() {
    return {
      /**
       * images配列の最大個数を格納
       */
      max: [],
    }
  },

  props: {
    images: Array,
  },

  mounted() {
    this.max = this.images.length;
  },

  computed: {
    params() {
      return {
        loop: true,
        speed: 2000,
        effect: "fade",
        autoplay: {
          delay: 3500,
          disableOnInteraction: false,  // スワイプ後に自動再生がオンのまま
        },
        scrollbar: {
          el: '.swiper-scrollbar',
        },
      }
    },

    convert() {
      return (i) => {
        let index = i + 1;
        return ("00" + index).slice(-2);
      };
    },

    next() {
      return (i) => {
        let nextIndex = i + 1;
        return (this.max >= nextIndex) ? ("00" + nextIndex).slice(-2) : ("00" + 1).slice(-2);
      }
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

  &__box {
    position: absolute;
    top: 50%;
    left: interval(2);
    z-index: 10;
    color: color(white);

    @include mq(md) {
      left: interval(10);
    }
  }

  &__text {
    font-size: font(14);
  }

  &__pagination {
    @include flex(row nowrap, flex-start, center);
    margin-top: interval(.5);
  }

  &__bar {
    position: relative;
    width: interval(8);
    height: pixel(.5);
    margin: 0 interval(1);
    background-color: rgba($color: #000000, $alpha: .5);
    border-radius: 1000px;

    &::before {
      content: '';
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      width: 50%;
      height: 100%;
      background-color: color(white);
      border-radius: 1000px 0 0 1000px;
    }
  }

  &__num {
    font-size: font(16);
  }
}
</style>
