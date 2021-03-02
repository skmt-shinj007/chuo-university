<template>
  <button class="scroll-top" id="scrollTarget" @click="scrollTop()">
    <svg-vue class="scroll-top__icon" icon="angle-up-double"/>
  </button>
</template>

<script>
export default {
  data() {
    return {

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
}
</script>

<style lang="scss" scoped>
.scroll-top {
  width: interval(6);
  height: interval(6);
  padding: interval(1);
  background-color: color(orange);
  border-radius: radius(circle);
  @include flex(row nowrap, center, center);
  cursor: pointer;
  transition: background-color .3s ease-out;

  @include hover {
    .scroll-top__icon {
      animation: fadeoutTop 1s linear infinite;
    }
  }

  &__icon {
    width: interval(1.5);
    color: color(white);
  }
}
</style>
