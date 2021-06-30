<template>
  <section class="champions">
    <contents-title :title="messages.SectionTitles.Champions" color="white"/>

    <div class="champions__card-sliders">
      <slider
        :options="viewdata.swiperOptions.champions"
        :items="viewdata.champions"
        :viewOptions="viewdata.sliderPartsOption.championsSection"
      >
        <template v-slot:slideContents="slide">
          <champions-card :item="slide.item"/>
        </template>
      </slider>
    </div>
  </section>
</template>

<script>
import ContentsTitle from '../modules/ContentsTitleComponent';
import ChampionsCard from '../modules/card/ChampionsCardComponent';
import Slider from '../modules/slider/SliderComponent';
import { viewData } from '../../config/data/viewData';

export default {
  components: {
    ContentsTitle,
    ChampionsCard,
    Slider,
  },

  data() {
    return {
      viewdata: viewData,
    }
  },
}
</script>

<style lang='scss' scoped>
.champions {
  &__card-sliders {

  }
}
</style>
