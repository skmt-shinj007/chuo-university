<template>
  <div class="slider">
    <swiper ref="contentsImageSwiper" :options="params">
      <swiper-slide v-for="(player, n) in players" :key="n">
        <player-card :player="player">
          <template v-slot:addCardContents="player" v-if="player.category === activeAlumniNum">
            <div class="alumni__record">
              <span class="alumni__record-text">{{ player.player.record }}</span>
            </div>
          </template>
        </player-card>
      </swiper-slide>

      <!-- <div class="swiper-pagination" slot="pagination"></div> -->
      <!-- <div class="swiper-button swiper-button-prev" slot="button-prev"></div>
      <div class="swiper-button swiper-button-next" slot="button-next"></div> -->
    </swiper>
  </div>
</template>

<script>
// components import
import PlayerCard from '../card/PlayerCardComponent';

export default {
  components: {
    PlayerCard,
  },

  props: {
    // playerCardに受け渡す選手データ
    players: Array,
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
          500: {
            slidesPerView: 2,
            slidesPerGroup: 2,
          },
          800: {
            slidesPerView: 3,
            slidesPerGroup: 1,
          },
          1440: {
            slidesPerView: 4,
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
  height: auto;

  // sliderの場合のplayer cardの幅を指定
  .player-card {
    margin: 0 auto;
    width: 80%;

    @include mq(sm){
      width: 90%;
    }
  }

}

// slotで差し込んだ部分のスタイル
.alumni__record {
  margin-left: interval(.5);

  &-text {
    font-size: font(12);
    letter-spacing: 1.1px;
  }
}

</style>
