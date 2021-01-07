<template>
<div class="view-all">
  <button class="view-all__btn">
    <label class="view-all__btn-label">{{ btnLabel }}</label>
    <svg-vue icon="angle-down" class="view-all__icon"/>
  </button>
</div>
</template>

<script>
export default {
  props: {
    btnLabel: {
      type: String,
      default: "MORE"
    },
    btnStyle: {
      type: Object,
      default: null
    }
  }
}
</script>

<style lang="scss">
.view-all {
  color: color(white);

  &__btn {
    position: relative;
    margin: 0 auto;
    width: 60%;
    max-width: interval(25);
    padding: interval(2) interval(4);
    border-radius: 40px;
    transition: all .3s ease-out;
    box-shadow: 0 32px 30px -30px darken($color: color(orange), $amount: 2%);
    @include flex(row nowrap, center, center);
    @include gradient(color(deepYellow), color(orange), horizontal);

    @include mq(sm) {
      max-width: interval(40);
      padding: interval(3) interval(6);
    }

    @include mq(md) {
      &:hover {
        box-shadow: 0 32px 30px -26px darken($color: color(orange), $amount: 2%);
        transform: translateY(-4px);

        .view-all__btn-label {
          letter-spacing: 3px;
        }
      }
    }
  }

  &__btn-label {
    transition: all .3s ease-out;
    font-weight: bold;
    font-size: font(sm);
    letter-spacing: 1.1px;

    @include mq(sm) {
      font-size: font(base);
    }
  }

  &__icon {
    width: interval(1.5);
    height: interval(1.5);
    position: absolute;
    top: 45%;
    right: interval(1);
    fill: color(white);
    animation: fadeoutDown 1.5s infinite;

    @include mq(sm) {
      right: interval(2);
    }
  }
}
</style>
