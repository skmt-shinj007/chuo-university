<template>
  <div class="player-slider">
    <slider :options="options" :items="players" :color="color">
      <template v-slot:slideContents="player">
        <player-card :player="player.item" @modal="openModal($event)"/>
      </template>
    </slider>
  </div>
</template>

<script>
// components import
import PlayerCard from '../card/PlayerCardComponent';
import slider from './SliderComponent';

export default {
  components: {
    PlayerCard,
    slider,
  },

  props: {
    // playerCardに受け渡す選手データ
    players: Array,

    color: {
      type: String,
      default: '',
    },
  },

  computed: {
    options() {
      return {
        /**
         * ループさせると仮想的なDOMが作られるので、スライド内のクリックイベントが動作しない。
         */
        speed: 1000,
        autoHeight: true,
        spaceBetween: 16,

        autoplay: {
          delay: 2500,
        },

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },

        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          type: 'bullets',
        },

        breakpoints: {
          500: {
            slidesPerView: 2,
            slidesPerGroup: 2,
          },
          860: {
            slidesPerView: 3,
            slidesPerGroup: 1,
          },
          1440: {
            slidesPerView: 5,
            slidesPerGroup: 1,
          },
        },
      }
    }
  },
}
</script>

<style lang="scss" scoped>
// .player-slider {

// }
</style>
