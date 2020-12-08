<template>
<div class="dormitory-card">
  <div class="dormitory-card__icon-wrap">
    <img class="dormitory-card__icon" :src="`/image/${srcUrl}`" :alt="alt">
  </div>
  <div class="dormitory-card__text-wrap">
    <p class="dormitory-card__text nl2br" v-text="content"/>

    <div class="dormitory-card__tag" v-if="washPrice">
      <span class="dormitory-card__laundry-price" v-text="washPrice"></span>
      <span class="dormitory-card__laundry-price" v-text="dryPrice"></span>
    </div>

    <div class="dormitory-card__tag" v-if="bathTime">
      <span class="dormitory-card__bath-time" v-text="bathTime"/>
    </div>
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
    },
    washPrice: {
      type: String,
      default: '',
    },
    dryPrice: {
      type: String,
      default: '',
    },
    bathTime: {
      type: String,
      default: '',
    }
  },
}
</script>

<style lang="scss" scoped>
.dormitory-card {
  width: 90%;
  margin: 0 auto interval(2) auto;
  padding: interval(1);
  @include flex($align-items: center);

  &:last-child {
    margin-bottom: 0;
  }

  @include mq(sm) {
    width: 70%;
  };

  @include mq(md) {
    width: 50%;
    max-width: 500px;
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

  &__tag {
    margin-top: interval(0.5);
  }

  &__laundry-price {
    display: block;
    font-size: font(sm);
    font-weight: bold;
    line-height: 1.5;
  }

  &__bath-time {
    font-size: font(sm);
    font-weight: bold;
    line-height: 1.5;
  }
}
</style>
