<template>
  <div class="slider">
    <swiper :options="params" :class="coloring">
      <swiper-slide v-for="(player, n) in players" :key="n">
        <player-card :player="player">
          <template v-slot:addCardContents="player" v-if="player.category === activeAlumniNum">
            <div class="alumni__record">
              <span class="alumni__record-text">{{ player.player.record }}</span>
            </div>
          </template>
        </player-card>
      </swiper-slide>

      <!-- swiper components -->
      <div class="swiper-button swiper-button-prev" slot="button-prev"/>
      <div class="swiper-button swiper-button-next" slot="button-next"/>
      <div class="swiper-pagination" slot="pagination"/>
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

    color: {
      type: String,
      default: '',
    },
  },

  computed: {
    params() {
      return {
        loop: true, // ループ
        speed: 1000,  // スライドする時間
        autoHeight: true,

        autoplay: {
          delay: 2500,
        },

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },

        pagination: {
          el: '.swiper-pagination',
          clickable: false,
          type: 'bullets',
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
      }
    },

    coloring() {
      return (this.color) ? `swiper--${this.color}` : null;
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

  .swiper {
    @include swiper-pagination(color(white), interval(3));
    @include swiper-button();
  }

  // swiper modifier
  .swiper--darkblue {
    .swiper {
      @include swiper-pagination();
      @include swiper-button(color(lightDarkblue));
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
