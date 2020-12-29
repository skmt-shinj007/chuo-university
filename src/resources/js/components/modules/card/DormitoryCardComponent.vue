<template>
<div class="dormitory-card">

  <div class="dormitory-card__icon-wrap">
    <svg-vue class="dormitory-card__icon" :icon="dormitoryData.Icon.Src" :alt="dormitoryData.Icon.Alt"/>
  </div>

  <div class="dormitory-card__text-wrap">
    <p class="dormitory-card__text nl2br" v-text="dormitoryData.Content"/>

    <div class="dormitory-card__complement-text" v-if="dormitoryData.Price">
      <span class="dormitory-card__laundry-price" v-text="dormitoryData.Price.Wash"></span>
      <span class="dormitory-card__laundry-price" v-text="dormitoryData.Price.Dry"></span>
    </div>

    <div class="dormitory-card__complement-text" v-if="dormitoryData.BathTime">
      <span class="dormitory-card__bath-time" v-text="dormitoryData.BathTime"/>
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
.dormitory-card {
  width: 100%;
  margin: 0 auto interval(2) auto;
  padding: interval(1);
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
    height: interval(3);
  }

  &__text-wrap {
    padding: interval(1);
    margin-left: interval(1);
  }

  &__text {
    font-size: font(sm);
    font-weight: bold;
    line-height: 1.5;
  }

  &__complement-text {
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
