<template>
  <div class="image-slider">
    <swiper :options="params">
      <swiper-slide v-for="(image, n) in images" :key="n">
        <figure class="image-slider__container">

          <img class="image-slider__image" :src="`/image/${image.src}`" :alt="image.alt">

          <figcaption class="image-slider__bar">
            <slot name="caption" :image="image">
              <span class="image-slider__caption">{{ image.caption }}</span>
            </slot>
          </figcaption>

        </figure>
      </swiper-slide>

      <!-- swiper components -->
      <div class="swiper-button swiper-button-prev" slot="button-prev"/>
      <div class="swiper-button swiper-button-next" slot="button-next"/>
      <div class="swiper-pagination" slot="pagination"/>
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
        speed: 800,  // スライドする時間
        effect: "fade",  // スライドタイプ
        autoHeight: true,

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },

        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          type: 'bullets',
        }
      }
    }
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

  .swiper {
    @include swiper-pagination();
    @include swiper-button();
  }
}
</style>
