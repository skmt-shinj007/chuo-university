<template>
  <!-- 呼び出し元の親コンポーネントに color="white" を付与することで色を変える -->
  <div class="title" :class="colorChange">
    <span class="title__assistance">{{ title.Sub }}</span>
    <h2 class="title__primary">{{ title.Main }}</h2>
  </div>
</template>

<script>
export default {
  props: {
    color: {
      type: String,
      default: '',
    },
    title: {
      type: Object,
      default: 'null',
    },
  },

  computed: {
    colorChange() {
      return (this.color) ? `title-${this.color}` : null;
    }
  },
}
</script>

<style lang="scss">
.title {
  padding: interval(5) 0;
  @include flex(column nowrap, center, center);

  &-white {
    color: color(white);
  }

  &__assistance {
    font-size: font(10);
    letter-spacing: 2px;
    font-weight: normal;
  }

  &__primary {
    margin-top: interval(1);
    margin-bottom: interval(2);
    position: relative;

    &::after {
      .title-white & {
        background-color: color(white);
      }

      content: "";
      display: block;
      width: 50px;
      height: 2px;
      position: absolute;
      bottom: - interval(2);
      left: 50%;
      transform: translateX(-50%);
      background-color: color(darkblue);
    }
  }
}
</style>
