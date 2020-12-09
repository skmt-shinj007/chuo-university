<template>
  <div class="player-card">
    <figure class="player-card__figure">
      <img src="/image/player01.jpg" alt="">
    </figure>

    <div class="player-card__information">
      <div class="player-card__information-name-wrap">
        <span class="player-card__information-name">坂本 信治</span>
        <span class="player-card__information-name-english">sakamoto shinji</span>
      </div>

      <div class="player-card__information-tags">
        <tag-component tagType="position" position="前衛"/>
        <tag-component tagType="grade" grade="4年生"/>
      </div>
    </div>
  </div>
</template>

<script>
// component import
import TagComponent from '../TagComponent';

export default {
  components: {
    TagComponent,
  },
  props: {
    playerInfo: Array,
  }
}
</script>

<style lang="scss" scoped>
.player-card {
  width: 60%;



  &__figure {
    @include trimming(aspect(square));
    border-bottom: 2px solid color(darkblue);
  }

  &__information {
    background-color: color(lightgrey);
    padding: interval(1);

    &-name {
      font-size: font(sm);
      font-weight: bold;
      margin-right: interval(1);
    }

    &-name-english {
      font-weight: bold;
      font-size: font(xs);
    }

    &-tags {
      @include flex($flow: row wrap , $align-items: center);
      margin: interval(.5) 0 interval(1) 0;
    }
  }
}
</style>
