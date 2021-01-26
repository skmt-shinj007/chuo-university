<template>
<div class="grade-tag">
  <tag-component>
    <span class="grade-tag__content" :class="[sizing, {'grade-tag__content--responsive': responsive}]">
      {{ grade }}年生
    </span>
  </tag-component>
</div>
</template>

<script>
// component import
import TagComponent from './TagComponent'

export default {
  components: {
    TagComponent
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
    font-size: font(xs);

    // レスポンシブスタイル
    &--responsive {

      @include mq(sm) {
        font-size: font(sm);
        line-height: 2;
      }

      @include mq(md) {
        font-size: font(md);
      }
    }

    // サイズ
    &--md {
      font-size: font(base);
      line-height: 2;
    }

    &--lg {
      font-size: font(md);
      line-height: 2;
    }
  }
}
</style>
