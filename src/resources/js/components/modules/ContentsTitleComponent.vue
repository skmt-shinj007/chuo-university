<template>
  <!-- 呼び出し元の親コンポーネントに color="white" を付与することで色を変える -->
  <div class="contents-title" :class="colorChange">
    <span class="contents-title__assistance">{{ subTitle }}</span>
    <h2 class="contents-title__primary">{{ title }}</h2>
  </div>
</template>

<script>
export default {
  data() {
    return {

    }
  },
  props: {
    color: {
      type: String,
      default: '',
    },
    title: {
      type: String,
      default: 'title',
    },
    subTitle: {
      type: String,
      default: 'タイトル',
    },
  },
  computed: {
    colorChange() {
      return (this.color) ? `contents-title-${this.color}` : null;
    }
  },
}
</script>

<style lang="scss">
.contents-title {
  @include flex(
    $flow: column nowrap,
    $justify-content: center,
    $align-items: center
  );

  &-white {
    color: color(white);
  }

  &__assistance {
    font-size: font(xs);

    // pc style
    @include mq(md) {
      font-size: font(sm);
    };
  }

  &__primary {
    margin-top: interval(1);
    margin-bottom: interval(2);
    position: relative;

    &::after {
      .contents-title.contents-title-white & {
        background-color: color(white);
      }
      content: "";
      display: block;
      width: 50px;
      height: 2px;
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: color(darkblue);
    }
  }
}
</style>
