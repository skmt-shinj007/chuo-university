<template>
<div class="main-visual-alider">
    <swiper ref="mainVisualSwiper" :options="params">
      <swiper-slide v-for="(image, n) in images" :key="n">
        <img class="main-visual-alider__image" :src="`/image/${image.path}`" :alt="image.name">
        <p class="main-visual-alider__text">ここにテキストが入ります。<br>テキストもAPIでどうにかできないかな〜。</p>
      </swiper-slide>
      <!-- <div class="swiper-scrollbar" slot="scrollbar"></div> -->
      <!-- <div class="swiper-pagination" slot="pagination"></div> -->
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
        speed: 2000,  // スライドする時間
        effect: "fade",  // スライドタイプ

        // 自動再生オプション
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,  // スワイプ後に自動再生がオンのまま
        },

        // ナビゲーション
        navigation: {
          nextEl: '.main-visual-alider .swiper-button-next',
          prevEl: '.main-visual-alider .swiper-button-prev',
        },

        // ページネーション
        pagination: {
          el: '.main-visual-alider .swiper-pagination',
          clickable: true,
        },

        // スクロールバー
        scrollbar: {
          el: '.swiper-scrollbar',
        },

        // レスポンシブ設定
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
.main-visual-alider {
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
    max-width: 280px;
    color: color(white);
    padding-left: interval(3);
    font-size: font(md);
  }
}
</style>
