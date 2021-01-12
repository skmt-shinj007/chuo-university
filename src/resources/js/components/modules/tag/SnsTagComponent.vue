<template>
  <div class="sns-tag">
    <div class="sns-tag__color" :class="snsClass">
      <!-- <svg-vue class="sns-tag__icon" :icon="sns"/> -->
      <span class="sns-tag__content" :class="sizeClass">{{ content }}</span>
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
    sns: {
      type: String,
      require: true,
    },
    content: {
      type: String,
      default: 'SNS',
    },
  },
  computed: {
    snsClass() {
      return (this.sns) ? `sns-tag__color--${this.sns}` : null;
    },
    sizeClass() {
      return (this.size) ? `sns-tag--${this.size}` : null;
    },
  }
}
</script>

<style lang="scss">
.sns-tag {
  margin: interval(.5);
  color: color(white);
  letter-spacing: 1.2px;
  line-height: 2;

  &__icon {
    width: interval(2.5);
    height: interval(2.5);
    padding-right: interval(1);
  }

  &__content {
    font-size: font(xs);

    &--lg {
      font-size: font(md);
      line-height: 2;
    }
  }

  &__color {
    padding: 0 interval(1);
    border-radius: radius(normal);
    @include flex(row wrap, center, center);

    &--twitter {
      background-color: color(twitter);
    }

    &--instagram {
      background: linear-gradient(to right, #5478f2 0%, #f23f79 60%, orange 100%);
    }

    &--facebook {
      background-color: color(facebook);
    }
  }
}
</style>
