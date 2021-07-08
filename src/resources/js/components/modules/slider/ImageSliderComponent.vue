<template>
  <div class="image-slider">
    <slider
      :options="viewdata.swiperOptions.imageSlider"
      :viewOptions="viewdata.sliderPartsOption.onlyPaginationDarkblue"
      :items="images"
    >
      <template v-slot:slideContents="props">
        <figure class="image-slider__container">
          <img class="image-slider__image" :src="`/image/${props.item.src}`" :alt="props.item.alt">
          <figcaption class="image-slider__caption">
            <slot name="caption" :image="props.item">
              <span class="image-slider__caption-text">{{ props.item.caption }}</span>
            </slot>
          </figcaption>
        </figure>
      </template>
    </slider>
  </div>
</template>

<script>
import Slider from '../slider/SliderComponent';
import { viewData } from '../../../config/data/viewData';

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
    images: Array,
  },
}
</script>

<style lang="scss" scoped>
.image-slider {

  &__container {
    @include trimming(aspect(golden));

    // 上のincludeで指定済みだが、&-caption でポジション指定しているので関係がわかりやすくなるように記述。
    position: relative;
  }

  &__image {
    border-radius: radius(soft);
  }

  &__caption {
    width: 90%;
    background-color: rgba($color: color(white), $alpha: .6);
    border-radius: radius(normal);
    padding: interval(.5) interval(2);
    position: absolute;
    bottom: 5%;
    left: 50%;
    transform: translateX(-50%);
    font-size: font(10);

    @include mq(sm) {
      line-height: 2;
    }
  }
}
</style>
