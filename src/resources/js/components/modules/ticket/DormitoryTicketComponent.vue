<template>
<div class="dormitory-ticket">

  <div class="dormitory-ticket__icon-wrap">
    <svg-vue class="dormitory-ticket__icon" :icon="dormitoryData.Icon.Src" :alt="dormitoryData.Icon.Alt"/>
  </div>

  <div class="dormitory-ticket__text-wrap">
    <p class="dormitory-ticket__text nl2br" v-text="dormitoryData.Content"/>

    <div class="dormitory-ticket__complement-text" v-if="dormitoryData.Price">
      <span class="dormitory-ticket__laundry-price" v-text="dormitoryData.Price.Wash"></span>
      <span class="dormitory-ticket__laundry-price" v-text="dormitoryData.Price.Dry"></span>
    </div>

    <div class="dormitory-ticket__complement-text" v-if="dormitoryData.BathTime">
      <span class="dormitory-ticket__bath-time" v-text="dormitoryData.BathTime"/>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: {
    dormitoryData: {
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
    display: block;
    line-height: 1.5;
  }

  &__bath-time {
    line-height: 1.5;
  }
}
</style>
