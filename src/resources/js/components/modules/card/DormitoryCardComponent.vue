<template>
<div class="dormitory-card">
  <div class="dormitory-card__icon-wrap">
    <img class="dormitory-card__icon" :src="`/image/${iconSrc}`" :alt="iconAlt">
  </div>
  <div class="dormitory-card__text-wrap">
    <p class="dormitory-card__text nl2br" v-text="content"/>
  </div>
</div>
</template>

<script>
export default {
  props: {
    iconSrc: {
      type: String,
      default: "restaurant.svg"
    },
    iconAlt: {
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
  width: 80%;
  margin: 0 auto;
  padding: interval(1);
  @include flex($justify-content: center, $align-items: center);

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
