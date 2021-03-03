<template>
  <transition name="scrollTop">
    <button class="scroll-top" @click="scrollTop()" v-if="showBtn">
      <svg-vue class="scroll-top__icon" icon="angle-up-double"/>
    </button>
  </transition>
</template>

<script>
export default {
  data() {
    return {
      /**
       * スクロールボタンの表示制御
       * @type { Boolean }
       */
      showBtn: false,
    }
  },

  methods: {
    scrollTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      })
    },
  },

  watch: {
    scrollY() {
      (this.scrollY > 1000) ? this.showBtn = true : this.showBtn = false;
    }
  },
}
</script>

<style lang="scss" scoped>
.scroll-top {
  width: 100%;
  height: 100%;
  padding: interval(1);
  background-color: color(orange);
  border-radius: radius(circle);
  @include flex(row nowrap, center, center);
  cursor: pointer;

  @include mq(md) {
    background-color: rgba($color: color(orange), $alpha: .7);
    transition: background-color .3s ease-out, animation .5s;
  }

  @include hover {
    background-color: color(orange);

    .scroll-top__icon {
      animation: fadeoutTop 1s linear infinite;
    }
  }

  &__icon {
    width: interval(1.5);
    color: color(white);
  }
}

// アニメーション
.scrollTop {
  &-enter-active, &-leave-active {
    transition: transform .5s ease-out, opacity .3s;
  }

  &-enter, &-leave-to {
    opacity: 0;
    transform: scale(0);
  }

  &-enter-to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
