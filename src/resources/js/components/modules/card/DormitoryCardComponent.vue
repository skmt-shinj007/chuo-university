<template>
<div class="dormitory-card">
  <div class="dormitory-card__icon-wrap">
    <img class="dormitory-card__icon" :src="`/image/${srcUrl}`" :alt="alt">
  </div>
  <div class="dormitory-card__text-wrap">
    <p class="dormitory-card__text nl2br" v-text="content"/>
  </div>
</div>
</template>

<script>
export default {
  props: {
    srcUrl: {
      type: String,
      default: "restaurant.svg"
    },
    alt: {
      type: String,
      default: "aa"
    },
    content: {
      type: String,
      default: "aa"
    }
  },
}
</script>

<style lang="scss" scoped>
.dormitory-card {
  width: 90%;
  margin: 0 auto interval(2) auto;
  padding: interval(1);
  @include flex($justify-content: center, $align-items: center);

  &:last-child {
    margin-bottom: 0;
  }

  @include mq(sm) {
    width: 50%;
  };

  &__icon-wrap {
    border: 2px solid color(darkblue);
    border-radius: radius(circle);
    padding: interval(1.5);
    margin-right: interval(1);
  }

  &__icon {
    width: icon(lg);
    height: icon(lg);
    fill: color(orange);
  }

  &__text-wrap {
    padding: interval(1);
  }

  &__text {
    font-size: font(sm);
    font-weight: bold;
    line-height: 1.5;
  }
}
</style>
