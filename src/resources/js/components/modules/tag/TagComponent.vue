<template>
  <div class="tag">
    <div class="tag__color" :class="colorClass">
      <slot>
        <span class="tag__content" :class="[sizing, { 'tag__content--responsive': responsive }]">
          {{ content }}
        </span>
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    // タグサイズ
    size: {
      type: String,
      default: null,
    },

    // タグの色
    color: {
      type: String,
      default: '',
    },

    // レスポンシブのフラグ
    responsive: {
      type: Boolean,
      default: false
    },

    // タグの内容（文字列）
    content: {
      type: String,
      default: 'タグ',
    },
  },
  computed: {
    /**
     * [色によってクラスをつける]
     * @return { string } クラス名が文字列として返る
     */
    colorClass() {
      return (this.color) ? `tag__color--${this.color}` : null;
    },

    /**
     * [サイズクラスをつける]
     * @return { string } クラス名が文字列として返る
     */
    sizing() {
      return (this.size) ? `tag__content--${this.size}` : null;
    },
  }
}
</script>

<style lang="scss">
.tag {
  color: color(white);
  letter-spacing: 1.8px;
  line-height: 1.9;

  &__content {
    font-size: font(10);

    // レスポンシブがtrueの時
    &--responsive {

      @include mq(sm) {
        font-size: font(12);
        line-height: 2;
      }

      @include mq(md) {
        font-size: font(16);
      }
    }

    // サイズ スタイル
    &--md {
      font-size: font(14);
      line-height: 2;
    }

    &--lg {
      font-size: font(16);
      line-height: 2;
    }
  }

  &__color {
    padding: 0 interval(1.5);
    border-radius: radius(normal);
    background-color: color(darkblue);
    @include flex(row wrap, center, center);

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
}
</style>
