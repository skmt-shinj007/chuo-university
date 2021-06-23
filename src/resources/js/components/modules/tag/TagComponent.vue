<template>
  <div class="tag">
    <div class="tag__wrap" :class="colorModifier">
      <slot name="tagText">
        <span class="tag__text" :class="{'tag__text-en': isAlphanumeric(tag.text)}">
          {{ tag.text }}
        </span>
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    tag: {
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
      return (this.tag.color) ? `tag__wrap--${this.tag.color}` : null;
    },
  },

  methods: {
    /**
     * 半角英数字かをチェックする。
     * @param {String} チェック対象の文字列
     * @return {Boolean} 半角英数字ならtrue。そ以外ならfalse。
     */
    isAlphanumeric(str) {
      return /^[A-Za-z0-9]*$/.test(str);
    }
  },
}

// [props example]
// tag: {
//   color: 'String',
//   text: 'String',
// }
</script>

<style lang="scss" scoped>
.tag {
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

    &--twitter {
      background-color: color(twitter);
    }
  }

  &__text {
    font-size: font(10);
    letter-spacing: 1.8px;
    line-height: 2;

    &-en {
      letter-spacing: 1px;
    }
  }
}
</style>
