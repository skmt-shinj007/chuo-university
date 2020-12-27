<template>
<div class="player-ticket" ref="targetElement">
  <div class="player-ticket-item" :class="borderColor">
    <figure class="player-ticket-thumbnail-wrap">
      <img class="player-ticket-thumbnail" :src="`/image/${playersObj.img.src}`" alt="playersObj.img.alt">
    </figure>
  </div>

  <div class="player-ticket-item">
    <span class="player-ticket__name">{{ playersObj.name.ja }}</span>
    <span class="player-ticket__name">{{ playersObj.name.en }}</span>
    <div class="player-ticket-tag-group">
      <position-tag-component :position="playersObj.position"/>
      <grade-tag-component :grade="playersObj.grade"/>
    </div>
  </div>

  <div class="player-ticket-item">
    <svg-vue class="player-ticket-icon" icon="angle-right"/>
  </div>

</div>
</template>

<script>
// component import
import TagComponent from '../tag/TagComponent';
import PositionTagComponent from '../tag/PositionTagComponent';
import GradeTagComponent from '../tag/GradeTagComponent';

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
      const borderClass = 'player-ticket-thumbnail-border';
      return (this.playersObj.position === "前衛") ? `${borderClass}--orange` : (this.playersObj.position === "後衛") ? `${borderClass}--green` : `${borderClass}--blue`;
    },
  },
}
</script>

<style lang="scss">
.player-ticket {
  @include flex(row nowrap, space-between, center);
  box-shadow: 0 3px 5px 3px color(darkShadow);
  background-color: color(white);
  border: 2px solid color(light);
  border-radius: 48px;
  padding: interval(1);
  position: relative;
  z-index: 1;

  @include mq(sm) {
    padding: interval(1) interval(1.5);
  }

  @include mq(md) {
    cursor: pointer;
    box-shadow: 0 1px 3px 1px color(darkShadow);
    transition: all .3s ease-out;

    &:hover {
      box-shadow: 0 3px 5px 3px color(darkShadow);
      transform: translateY(-2px);

      .player-ticket-icon {
        animation: iconSlide 1.5s infinite;
      }
    }
  }

  &-thumbnail-border {
    &--blue {
      @include border-gradient();
    }

    &--orange {
      @include border-gradient(
        $start-color: color(orange),
        $end-color: color(lightDarkblue),
      );
    }

    &--green {
      @include border-gradient(
        $start-color: color(lightGreen),
        $end-color: color(lightDarkblue),
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

  &__name {
    display: block;
    font-size: font(base);
    font-weight: bold;
    padding-left: interval(.5);

    &:first-of-type {
      display: none;

      @include mq(sm) {
        display: block;
      }
    }
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
