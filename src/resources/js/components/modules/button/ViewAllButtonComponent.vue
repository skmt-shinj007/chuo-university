<template>
<div class="view-all">
  <button class="view-all__btn">
    もっとみる
  </button>
</div>
</template>

<script>
export default {
  props: {

  }
}
</script>

<style lang="scss">
.view-all {
  width: 80%;
  max-width: btn-size(sm-width);
  height: btn-size(sm-height);
  margin: 0 auto;
  background-color: color(white);
  font-size: font(xs);
  border: 1px solid color(orange);
  border-radius: radius(soft);
  position: relative;

  // pc style
  @include mq(md) {
    width: btn-size(lg-width);
    height: btn-size(lg-height);
    font-size: font(sm);

    &--xs {
      max-width: btn-size(xs-width);
      height: btn-size(xs-height);
      font-size: font(xs);
    }

    &--sm {
      width: btn-size(sm-width);
      height: btn-size(sm-height);
      font-size: font(xs);
    }
  }
}
</style>
