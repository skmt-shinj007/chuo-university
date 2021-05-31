<template>
  <div class="player-slider">
    <slider :options="options" :items="players" :color="color">
      <template v-slot:slideContents="player">
        <player-card :player="player.item" @open="openModal"/>
      </template>
    </slider>

    <!-- modal -->
    <player-modal
      v-if="modal.isShow"
      @close="closeModal"
      :player="modal.el"
      :labels="modal.labels"
    />
  </div>
</template>

<script>
// components import
import PlayerCard from '../card/PlayerCardComponent';
import slider from './SliderComponent';
import PlayerModal from '../modal/PlayerModalComponent';

export default {
  components: {
    PlayerCard,
    slider,
    PlayerModal,
  },

  props: {
    // Api Response [user data]
    players: Array,

    color: {
      type: String,
      default: '',
    },
  },

  data() {
    return {
      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      modal: {
        isShow: false,
        el: null,
      }
    }
  },

  computed: {
    options() {
      return {
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

  methods: {
    /**
     * モーダル開閉処理。
     */
    openModal(el, labels) {
      this.modal.isShow = true;
      this.modal.el = el;
      this.modal.labels = labels;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.modal.isShow = false;
      document.body.classList.remove("modal-open");
    },
  },
}
</script>

<style lang="scss" scoped>
// .player-slider {

// }
</style>
