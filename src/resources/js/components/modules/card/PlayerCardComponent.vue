<template>
<div class="player-card">
  <figure class="player-card__figure">
    <img :src="`/image/${playerInformation.image.path}`" :alt="playerInformation.image.alt">
  </figure>

  <div class="player-card__information">
    <div class="player-card__information-name-wrap">
      <span class="player-card__information-name">{{ playerInformation.name.ja }}</span>
      <span class="player-card__information-name-english">{{ playerInformation.name.ja }}</span>
    </div>

    <div class="player-card__information-tags">
      <tag-component tagType="position" :position="playerInformation.position"/>
      <tag-component tagType="grade" :grade="playerInformation.studentInfo.grade"/>
      <tag-component :content="playerInformation.post"/>
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
    playerInformation: {
      type: Object,
      default: null,
    }
  }
}
</script>

<style lang="scss">
.player-card {
  width: 60%;

  @include mq(sm) {
    width: 30%;
  }

  @include mq(md) {
    width: 20%;
    max-width: interval(24);  // 192px
  }

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
      @include flex($flow: row wrap);
      align-content: space-around;
      padding-bottom: interval(1);
    }
  }
}
</style>
