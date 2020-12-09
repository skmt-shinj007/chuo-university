<template>
  <div class="slider">
    <swiper ref="contentsImageSwiper" :options="params">
      <swiper-slide v-for="(playerInformation, n) in playerInformations" :key="n">
        <player-card-component v-bind="playerInformation"/>
      </swiper-slide>

      <!-- <div class="swiper-pagination" slot="pagination"></div> -->
      <!-- <div class="swiper-button swiper-button-prev" slot="button-prev"></div>
      <div class="swiper-button swiper-button-next" slot="button-next"></div> -->
    </swiper>
  </div>
</template>

<script>
// components import
import PlayerCardComponent from '../card/PlayerCardComponent';

export default {
  components: {
    PlayerCardComponent,
  },
  props: {
    playerInformations: Array,
  },
  computed: {
    params() {
      return {
        loop: true, // ループ
        speed: 1500,  // スライドする時間
        // effect: "coverflow",  // スライドタイプ
        autoHeight: true,

        autoplay: {
          delay: 2500,
        },

        breakpoints: {
          // md
          560: {
            slidesPerView: 2,
            slidesPerGroup: 2,
          },
          // pc
          992: {
            slidesPerView: 3,
            slidesPerGroup: 1,
          },

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
.slider {

  // slider の際のスタイルを指定
  .player-card {
    margin: 0 auto;

    @include mq(sm){
      width: 60%;
    }
  }

}

</style>
