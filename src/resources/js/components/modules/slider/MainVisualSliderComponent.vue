<template>
<div class="main-visual-slider">
    <swiper ref="mainVisualSwiper" :options="params">
      <swiper-slide v-for="(image, n) in images" :key="n">
        <img class="main-visual-slider__image" :src="`/image/${image.src}`" :alt="image.alt">
        <span class="main-visual-slider__text">{{ image.caption }}</span>
      </swiper-slide>
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
        loop: true,
        speed: 2000,
        effect: "fade",
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,  // スワイプ後に自動再生がオンのまま
        },
        navigation: {
          nextEl: '.main-visual-slider .swiper-button-next',
          prevEl: '.main-visual-slider .swiper-button-prev',
        },
        pagination: {
          el: '.main-visual-slider .swiper-pagination',
          clickable: true,
        },
        scrollbar: {
          el: '.swiper-scrollbar',
        },
        breakpoints: {
          // 560px 以上の時
          560: {
            // hoge
          },
          // 993px 以上の時
          993: {
            // hoge
          }
        }

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

  &__text {
    position: absolute;
    top: 50%;
    left: 0;
    z-index: 10;
    color: color(white);
    padding-left: interval(2);
    font-size: font(12);

    @include mq(sm) {
      left: 5%;
      padding-left: 0;
      font-size: font(16);
    }
  }
}
</style>
