<template>
  <div class="slider">
    <swiper :options="options" :class="coloring">
      <swiper-slide v-for="(item, n) in items" :key="n">
        <slot name="slideContents" :item="item">
          <!-- スライド要素 -->
        </slot>
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
    options: {
      type: Object,
      default: null,
    },

    color: {
      type: String,
      default: '',
    },

    items: {
      type: Array,
      require: true,
    }
  },

  computed: {
    coloring() {
      return (this.color) ? `swiper--${this.color}` : null;
    }
  },
}
</script>

<style lang="scss" scoped>
.slider {
  height: auto;

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

</style>
