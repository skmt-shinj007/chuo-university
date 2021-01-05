<template>
  <div class="tag">
    <div class="tag__color" :class="colorClass">
      <slot>
        <span class="tag__content" :class="sizeClass">{{ content }}</span>
      </slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
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
  }
}
</script>

<style lang="scss">
.tag {
  margin: interval(.5);
  color: color(white);
  letter-spacing: 1.8px;
  line-height: 1.9;

  &__content {
    font-size: font(xs);

    &--lg {
      font-size: font(md);
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
  }
}
</style>
