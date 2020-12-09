<template>
  <div class="slider">
    <swiper ref="contentsImageSwiper" :options="params">

      <swiper-slide>
        <!-- スライドさせたいコンテンツを親から差し込む形で使用する -->
        <slot name="sliderElement"/>
      </swiper-slide>

      <div class="swiper-pagination" slot="pagination"></div>
      <!-- <div class="swiper-button swiper-button-prev" slot="button-prev"></div>
      <div class="swiper-button swiper-button-next" slot="button-next"></div> -->
    </swiper>
  </div>
</template>

<script>
export default {
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

</style>
