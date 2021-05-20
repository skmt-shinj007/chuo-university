<template>
  <div class="label">
    <div class="label__wrap" :class="colorModifier">
      <slot name="labelText">
        <span class="label__text">{{ label.text }}</span>
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: Object,
      required: true,
    }
  },

  computed: {
    /**
     * カラーバリエーションクラス
     * @return { string } class名
     */
    colorModifier() {
      return (this.label.color) ? `label__wrap--${this.label.color}` : null;
    },
  },
}

// [props example]
// label: {
//   color: 'String',
//   text: 'String',
// }
</script>

<style lang="scss">
.label {
  color: color(white);

  &__wrap {
    padding: 0 interval(1.5);
    border-radius: radius(normal);
    background-color: color(light);
    @include flex(row wrap, center, center);

    &--darkblue {
      background-color: color(darkblue);
    }

    &--lightgreen {
      background-color: color(lightGreen);
    }

    &--orange {
      background-color: color(orange);
    }

    &--outline-orange {
      background-color: color(white);
      border: 2px solid color(orange);
      color: color(orange);
    }

    &--red {
      background-color: color(japanRed);
    }
  }

  &__text {
    font-size: font(10);
    letter-spacing: 1.8px;
    line-height: 2;
  }
}
</style>
