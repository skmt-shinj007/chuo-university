<template>
<div class="player-card">
  <figure class="player-card__figure">
    <img :src="`/image/${imagePath}`" :alt="imageAlt">
  </figure>

  <div class="player-card__information">
    <div class="player-card__information-name-wrap">
      <span class="player-card__information-name">{{ name }}</span>
      <span class="player-card__information-name-english">{{ englishName }}</span>
    </div>

    <div class="player-card__information-tags">
      <tag-component tagType="position" :position="position"/>
      <tag-component tagType="grade" :grade="grade"/>
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
    name: {
      type: String,
      default: '中央 太郎'
    },
    englishName: {
      type: String,
      default: 'chuo taro'
    },
    imagePath: {
      type: String,
      default: 'player01.jpg',
    },
    imageAlt: {
      type: String,
      default: 'イメージの補足テキストが入ります',
    },
    position: {
      type: String,
      default: '後衛',
    },
    grade: {
      type: String,
      default: '4年生',
    },
  }
}
</script>

<style lang="scss">
.player-card {
  width: 60%;
  margin: 0 auto;

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
      @include flex($flow: row wrap , $align-items: center);
      margin: interval(.5) 0 interval(1) 0;
    }
  }
}
</style>
