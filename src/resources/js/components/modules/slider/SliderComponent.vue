<template>
  <div class="slider">
    <swiper :options="swiperOptions" ref="swiper">
      <swiper-slide v-for="(item, n) in items" :key="n">
        <slot name="slideContents" :item="item">
          <!-- スライド要素 -->
        </slot>
      </swiper-slide>

      <!-- pagination -->
      <template v-if="viewOptions.showPagination">
        <div class="swiper-pagination" slot="pagination" :class="pagination"/>
      </template>
    </swiper>

    <!-- navigation -->
    <template v-if="viewOptions.showNavigation">
      <div class="swiper-button swiper-button-prev" slot="button-prev" :class="navigation"/>
      <div class="swiper-button swiper-button-next" slot="button-next" :class="navigation"/>
    </template>
  </div>
</template>

<script>
import { viewData } from '../../../config/data/viewData';

export default {
  props: {
    // swiper option
    options: {
      type: Object,
      default: null,
      require: true,
    },

    /**
     * swiperパーツのUIオプション
     * paginationやnavigationの色、配置位置の制御
     */
    viewOptions: {
      type: Object,
      default: () => {
        return viewData.sliderPartsOption.default;
      },
    },

    // swiper-slide内に埋め込みたいデータ
    items: {
      type: Array,
      require: true,
    },

    // item width
    slideItemWidth: {
      type: Object,
      default: null,
    }
  },

  computed: {
    /**
     * pagination custom class
     * 複数クラスの付与に対応
     * @return {String} 'class1 class2'
     */
    pagination() {
      if (!this.viewOptions.color) return;
      let classes = [
        `swiper-pagination--${this.viewOptions.color.pagination}`,
      ];
      return classes.join(' ');
    },

    /**
     * navigation custom class
     * 複数クラスの付与に対応
     * @return {String} 'class1 class2'
     */
    navigation() {
      if (!this.viewOptions.color && !this.viewOptions.buttonPosition) return;
      let classes = [
        `swiper-button--${this.viewOptions.buttonPosition}`,
        `swiper-button--${this.viewOptions.color.navigation}`
      ];
      return classes.join(' ');
    },

    /**
     * 必須オプションと任意オプションを結合させたオブジェクトを返す。
     * @return {Object} options
     */
    swiperOptions() {
      return {...viewData.requireSwiperOption, ...this.options};
    },
  },
}
</script>

<style lang="scss" scoped>
.slider {
  position: relative;
  height: auto;
  padding-bottom: interval(3);
  overflow: hidden;
}

.swiper {
  &-container {
    overflow: visible;

    // swiper css の上書き
    &-horizontal > .swiper-pagination-bullets {
      bottom: - interval(3);
      left: 50%;
    }
  }

  &-pagination {
    width: 100%;
    bottom: - interval(3);
    left: 50%;
    transform: translate3d(-50%, 0, 0);

    &-bullets {
      // ページネーションのHTMLはスロット配信のためディープセレクタにする
      &::v-deep .swiper-pagination-bullet {
        opacity: 1;
        position: relative;
        width: interval(3);
        height: 3px;
        border-radius: 0;
        margin: 0 interval(.5);
        transition: background-color .3s ease;
        outline: none;
      }
    }

    // pagination modifier
    &--white {
      &::v-deep .swiper-pagination-bullet {
        background-color: rgba(color(white), .2);
      }
      &::v-deep .swiper-pagination-bullet-active {
        background-color: color(white);
      }
    }

    &--darkblue {
      &::v-deep .swiper-pagination-bullet {
        background-color: rgba(color(lightDarkblue), .2);
      }
      &::v-deep .swiper-pagination-bullet-active {
        background-color: color(lightDarkblue);
      }
    }
  }

  &-button {
    $this: &;
    $buttonSize: interval(5);

    &-next,
    &-prev {
      width: $buttonSize;
      height: $buttonSize;
      border-radius: radius(circle);
      outline: none;
      transform: translateY(- interval(2));

      &::after {
        content: '';
      }
    }

    &-next {
      right: interval(.5);
    }

    &-prev {
      left: interval(.5);
    }

    // navigation modifier
    &--bottom {
      top: calc(100% + #{interval(4)});
    }

    &--white {
      border: 1px solid color(lightgray);

      &#{$this}-next {
        @include background-image('data:image/svg+xml;utf8,#{$arrow-right}', center center, calc(#{$buttonSize} / 2));
      }

      &#{$this}-prev {
        @include background-image('data:image/svg+xml;utf8,#{$arrow-left}', center center, calc(#{$buttonSize} / 2));
      }
    }

    &--darkblue {
      border: 1px solid color(lightDarkblue);

      &#{$this}-next {
        @include background-image('data:image/svg+xml;utf8,#{$arrow-right-darkblue}', center center, calc(#{$buttonSize} / 2));
      }

      &#{$this}-prev {
        @include background-image('data:image/svg+xml;utf8,#{$arrow-left-darkblue}', center center, calc(#{$buttonSize} / 2));
      }
    }
  }
}
</style>
