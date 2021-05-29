<template>
<div class="player-card" @click="open">
  <figure class="player-card__figure">
    <img :src="`/image/${player.img.src}`" :alt="player.img.alt">
  </figure>

  <div class="player-card__information">
    <div class="player-card__name">
      <span class="player-card__name-ja">{{ player.name.ja }}</span>
      <span class="player-card__name-en">{{ player.name.en }}</span>
    </div>

    <div class="player-card__tag-group">
      <div class="player-card__tag">
        <position-tag :position="player.position"/>
      </div>
      <div class="player-card__tag">
        <grade-tag v-if="player.grade" :grade="player.grade"/>
      </div>
    </div>

    <div class="player-card__post" v-if="player.post.club">
      <label class="player-card__post-label">{{ player.post.club }}</label>
    </div>
  </div>
</div>
</template>

<script>
// component import
import PositionTag from '../tag/PositionTagComponent';
import GradeTag from '../tag/GradeTagComponent';

export default {
  components: {
    PositionTag,
    GradeTag,
  },

  props: {
    player: {
      type: Object,
      default: null,
    }
  },

  methods: {
    /**
     * [モーダルを開ける]
     */
    open() {
      this.$emit('modal', this.player);
    },
  },
}
</script>

<style lang="scss">
.player-card {
  position: relative;
  cursor: pointer;
  border-radius: radius(hard);
  transition: transform .3s linear;

  @include hover {
    transform: scale(0.95);
  }

  &__figure {
    @include trimming(aspect(square));
    border-bottom: 2px solid color(darkblue);
    background-color: color(white);
  }

  &__information {
    background-color: color(lightgrey);
    padding: interval(1);
  }

  &__name-ja {
    display: block;
    margin-left: interval(.5);
  }

  &__name-en {
    @extend .player-card__name-ja;
    font-size: font(10);
  }

  &__tag-group {
    @include flex(row wrap);
    align-content: space-around;
    padding: interval(1) 0;
  }

  &__tag {
    margin: interval(.5);
  }

  &__post {
    position: absolute;
    top: 0;
    left: 0;
    background-color: color(darkblue);
    width: interval(6);
    height: interval(6);
    border: 2px solid color(white);
    border-radius: radius(circle);
    @include flex(row nowrap, center, center);
  }

  &__post-label {
    color: color(white);
    font-size: font(12);
    line-height: 1;
  }
}
</style>
