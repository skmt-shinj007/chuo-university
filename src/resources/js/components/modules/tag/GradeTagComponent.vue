<template>
<div class="grade-tag">
  <tag>
    <span class="grade-tag__content" :class="[sizing, {'grade-tag__content--responsive': responsive}]">
      {{ grade }}年生
    </span>
  </tag>
</div>
</template>

<script>
// component import
import Tag from './TagComponent'

export default {
  components: {
    Tag
  },

  props: {
    // 年次
    grade: {
      type: Number,
      default: ''
    },

    // タグサイズ
    size: {
      type: String,
      default: ''
    },

    // レスポンシブ フラグ
    responsive: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    sizing() {
      return (this.size) ? `grade-tag__content--${this.size}` : null;
    },
  }
}
</script>

<style lang="scss">
.grade-tag {

  &__content {
    font-size: font(10);

    // レスポンシブスタイル
    &--responsive {

      @include mq(sm) {
        font-size: font(10);
        line-height: 2;
      }

      @include mq(md) {
        font-size: font(16);
      }
    }

    // サイズ
    &--md {
      font-size: font(14);
      line-height: 2;
    }

    &--lg {
      font-size: font(16);
      line-height: 2;
    }
  }
}
</style>
