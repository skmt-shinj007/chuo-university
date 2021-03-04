<template>
<div class="main-visual">
  <slot name="inner">
    <span class="main-visual__title" v-text="messages.MainVisual.Home"></span>
  </slot>
</div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.main-visual{
  width: 100%;
  height: 100vh;
  padding: 0 interval(2);
  @include gradient(color(deepDarkblue), color(darkblue), horizontal);
  @include flex(column nowrap, center, center);


  &__title {
    color: color(white);
    white-space: pre-wrap;
    font-family: Arial, Helvetica, sans-serif;
    font-size: font(48);
    text-shadow: 3px 3px 0px color(orange);

    @include mq(sm) {
      line-height: 1.2;
    }
  }
}
</style>
