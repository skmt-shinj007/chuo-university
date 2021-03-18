<template>
  <div class="slider">
    <swiper :options="option" :class="coloring">
      <swiper-slide v-for="(player, n) in players" :key="n">
        <player-card :player="player" @modal="openModal($event)">
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

    <user-modal v-if="showModal" @close="closeModal" :item="clickEl"/>
  </div>
</template>

<script>
// components import
import PlayerCard from '../card/PlayerCardComponent';
import UserModal from '../modal/UserModalComponent';

export default {
  components: {
    PlayerCard,
    UserModal,
  },

  props: {
    // playerCardに受け渡す選手データ
    players: Array,

    color: {
      type: String,
      default: '',
    },

    option: {
      type: Object,
      default: () => {
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
      },
    }
  },

  data() {
    return {
      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * クリックしたカードのデータを格納
       * @type { Object }
       */
      clickEl: null,
    }
  },

  computed: {
    coloring() {
      return (this.color) ? `swiper--${this.color}` : null;
    }
  },

  methods: {
    // モーダル開閉処理
    openModal(el) {
      this.showModal = true;
      this.clickEl = el;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.showModal = false;
      document.body.classList.remove("modal-open");
    },
  },
}
</script>

<style lang="scss" scoped>
.slider {
  height: auto;

  // sliderの場合のplayer cardの幅を指定
  .player-card {
    // margin: 0 auto;
    // width: 80%;

    // @include mq(sm){
    //   width: 90%;
    // }
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
