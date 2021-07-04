<template>
  <div class="main-visual-slider">
    <slider
      :options="options"
      :viewOptions="viewdata.sliderPartsOption.allPartsHidden"
      :items="images"
    >
      <template v-slot:slideContents="prop">
        <img class="main-visual-slider__image" :src="`/image/${prop.item.img.src}`" :alt="prop.item.img.alt">
        <div class="main-visual-slider__contents">
          <template v-if="prop.item.caption">
            <span class="main-visual-slider__text">{{ prop.item.caption }}</span>
          </template>
          <div class="main-visual-slider__pagination">
            <span class="main-visual-slider__num">{{ currentIndex(prop.item.id) }}</span>
            <div class="main-visual-slider__gauge">
              <span class="main-visual-slider__gauge-active"></span>
            </div>
            <span class="main-visual-slider__num">{{ nextIndex(prop.item.id) }}</span>
          </div>
        </div>
      </template>
    </slider>
  </div>
</template>

<script>
import { viewData } from '../../../config/data/viewData';
import Slider from '../slider/SliderComponent';

export default {
  components: {
    Slider,
  },

  data() {
    return {
      viewdata: viewData,
    }
  },

  props: {
    images: {
      type: Array,
      require: true
    },

    options: {
      type: Object,
      default: () => {
        return viewData.swiperOptions.mainVisual;
      }
    }
  },

  computed: {
    currentIndex() {
      return (i) => {
        return ("00" + i).slice(-2);
      };
    },

    nextIndex() {
      return (i) => {
        const next = i + 1;
        const max = this.images.length;
        return (max >= next) ? `0${next}` : `01`;
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

  &__pagination {
    @include flex(row nowrap, flex-start, center);
    margin-top: interval(.5);
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
