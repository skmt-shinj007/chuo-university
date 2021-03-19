<template>
<div class="dormitory-ticket">

  <div class="dormitory-ticket__icon-wrap">
    <svg-vue class="dormitory-ticket__icon" :icon="information.Icon.Src" :alt="information.Icon.Alt"/>
  </div>

  <div class="dormitory-ticket__text-wrap">
    <p class="dormitory-ticket__text nl2br" v-text="information.Content"/>

    <div class="dormitory-ticket__complement-text" v-if="information.Price">
      <span class="dormitory-ticket__laundry-price" v-text="information.Price.Wash"></span>
      <span class="dormitory-ticket__laundry-price" v-text="information.Price.Dry"></span>
    </div>

    <div class="dormitory-ticket__complement-text" v-if="information.BathTime">
      <span class="dormitory-ticket__bath-time" v-text="information.BathTime"/>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    information: {
      type: Object,
      default: null
    }
  },
}
</script>

<style lang="scss" scoped>
.dormitory-ticket {
  width: 100%;
  margin: 0 auto interval(2) auto;
  padding: interval(1) 0;
  @include flex($align-items: center);

  &:last-child {
    margin-bottom: 0;
  }

  &__icon-wrap {
    @include flex(row nowrap, center, center);
    border: 2px solid color(darkblue);
    border-radius: radius(circle);
    padding: interval(1.5);
  }

  &__icon {
    width: interval(3);
    fill: color(lightDarkblue);
  }

  &__text-wrap {
    margin-left: interval(1);
  }

  &__text {
    font-size: font(12);
    font-weight: bold;
    line-height: 1.5;
  }

  &__complement-text {
    margin-top: interval(0.5);
  }

  &__laundry-price {
    margin-right: interval(1);
    line-height: 1.5;

    &:last-child {
      margin: 0;
    }

    @include mq(md) {
      margin: 0;
      display: block;
    }
  }

  &__bath-time {
    line-height: 1.5;
  }
}
</style>
