<template>
  <div class="tag" :class="sizeClass">

    <!-- 呼び出し元のコンポーネントタグに tagType="position" が指定された場合こっちのdivが読まれる -->
    <div v-if="tagType === 'position'" class="tag__color" :class="positionColor">
      <span class="tag__content">{{ position }}</span>
    </div>

    <!-- tagType="grade" （年次）の場合 -->
    <div v-else-if="tagType === 'grade'" class="tag__color" :class="gradeClass">
      <span class="tag__content">{{ grade }}年生</span>
    </div>

    <!-- tagType が position/grade 以外の場合こっちのdivが読まれる -->
    <div v-else class="tag__color" :class="colorClass">
      <span class="tag__content">{{ content }}</span>
    </div>
  </div>
</template>

<script>
// 必ず親でpositionのデータを指定する。
export default {
  props: {
    tagType: {
      type: String,
      default: '',
    },
    // tagType -> "position"
    position: {
      type: String,
      default: 'タグ',
    },
    // tagType -> "grade"
    grade: {
      type: Number,
      default: 0,
    },
    // else
    size: {
      type: String,
      default: null,
    },
    color: {
      type: String,
      default: '',
    },
    content: {
      type: String,
      default: 'タグ',
    },
  },
  computed: {
    colorClass() {
      return (this.color) ? `tag__color--${this.color}` : null;
    },
    sizeClass() {
      return (this.size) ? `tag--${this.size}` : null;
    },
    positionColor() {
      return (this.position === '後衛') ? `tag__color--lightgreen` : (this.position === '前衛') ? `tag__color--orange` : null;
    },
    gradeClass() {
      return (this.grade) ? `tag__grade` : null;
    },
  }
}
</script>

<style lang="scss" scoped>
.tag {
  margin-right: interval(1);
  padding-top: interval(1);
  color: color(white);
  font-size: font(sm);
  letter-spacing: 1.8px;
  font-weight: bold;
  line-height: 1.9;

  &:last-child {
    margin: 0;
  }

  &--lg {
    width: interval(10);
    font-size: font(md);
    line-height: 2;
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
  }

  &__grade {
    font-size: font(xs);
    line-height: 2.3;
    letter-spacing: 1.5px;
  }
}
</style>
