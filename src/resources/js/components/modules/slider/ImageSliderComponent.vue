<template>
  <div class="image-slider">
    <swiper :options="params">
      <swiper-slide v-for="(image, n) in images" :key="n">
        <figure class="image-slider__container">

          <img class="image-slider__image" :src="`/image/${image.path}`" :alt="image.name">

          <figcaption class="image-slider__bar">
            <slot name="caption" :image="image">
              <span class="image-slider__caption">{{ image.caption }}</span>
            </slot>
          </figcaption>

        </figure>
      </swiper-slide>
      <div class="swiper-pagination" slot="pagination"></div>
      <!-- <div class="swiper-button swiper-button-prev" slot="button-prev"></div>
      <div class="swiper-button swiper-button-next" slot="button-next"></div> -->
    </swiper>
  </div>
</template>

<script>
export default {
  props: {
    images: Array,
  },

  computed: {
    params() {
      return {
        loop: true, // ループ
        speed: 1500,  // スライドする時間
        effect: "coverflow",  // スライドタイプ
        autoHeight: true,

        autoplay: {
          delay: 2500,
        },

        // ナビゲーション
        navigation: {
          nextEl: '.c-imageSlider .swiper-button-next',
          prevEl: '.c-imageSlider .swiper-button-prev',
        },

        // ページネーション
        pagination: {
          el: '.c-imageSlider .swiper-pagination',
          clickable: true,
          type: 'progressbar',
        },
      }
    }
  },
}
</script>

<style lang="scss" scoped>
.image-slider {

  &__container {
    @include trimming(aspect(rectangle));

    // 上のincludeで指定済みだが、&-caption でポジション指定しているので関係がわかりやすくなるように記述。
    position: relative;
  }

  &__image {
    border-radius: radius(normal);
  }

  &__bar {
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
