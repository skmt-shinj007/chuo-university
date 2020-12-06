<template>
  <div class="c-footerTitle">
    <h3 class="c-footerTitle__title">{{ footerTitle }}</h3>
  </div>
</template>

<script>
export default {
  props: {
    footerTitle: String,
  }
}
</script>

<style lang="scss" scoped>
.c-footerTitle {
  text-align: center;

  &__title {
    font-size: font(heading);
    letter-spacing: 3px;

    // tablet style
    @include mq(sm) {
      font-size: font(xl);
    };
  }
}
</style>
