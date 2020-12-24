<template>
<div class="player">
  <div class="player-item" :class="borderColor">
    <figure class="player-thumbnail-wrap">
      <img class="player-thumbnail" :src="`/image/${playersObj.img.src}`" alt="playersObj.img.alt">
    </figure>
  </div>

  <div class="player-item">
    <span class="player-name">{{ playersObj.name.en }}</span>
    <div class="player-tag-group">
      <position-tag-component :position="playersObj.position"/>
      <grade-tag-component :grade="playersObj.grade"/>
    </div>
  </div>

  <div class="player-item">
    <svg-vue class="player-icon" icon="angle-right"/>
  </div>

</div>
</template>

<script>
// component import
import TagComponent from './tag/TagComponent';
import PositionTagComponent from './tag/PositionTagComponent';
import GradeTagComponent from './tag/GradeTagComponent';

export default {
  components: {
    TagComponent,
    PositionTagComponent,
    GradeTagComponent,
  },
  props: {
    playersObj: {
      type: Object,
      default: null
    }
  },
  computed: {
    borderColor() {
      return (this.playersObj.position === "前衛") ? `player-thumbnail-border--green` : `player-thumbnail-border--blue`;
    }
  }
}
</script>

<style lang="scss">
.player {
  @include flex(row nowrap, space-between, center);
  box-shadow: 0 3px 5px 3px color(darkShadow);
  background-color: color(white);
  width: interval(34);
  border: 2px solid color(light);
  border-radius: 48px;
  padding: interval(1);
  position: relative;
  z-index: 1;

  @include mq(sm) {
    width: interval(38);
    padding: interval(1) interval(1.5);
  }

  @include mq(md) {
    cursor: pointer;
  }

  &-thumbnail-border {
    &--blue {
      @include border-gradient();
    }

    &--green {
      @include border-gradient(
        $start-color: color(orange),
        $end-color: darken(color(orange), 50%),
      );
    }
  }

  &-thumbnail-wrap {
    width: 100%;
    @include trimming(aspect(square));

    @include mq(sm) {
      width: interval(10);
    }
  }

  &-thumbnail {
    border-radius: radius(circle);
  }

  &-name {
    display: block;
    font-size: font(base);
    font-weight: bold;
    padding-left: interval(.5);
  }

  &-tag-group {
    @include flex(row wrap, flex-start, center);
  }

  &-icon {
    width: interval(3);
    height: interval(3);
    fill: color(darkblue);
  }
}

</style>
