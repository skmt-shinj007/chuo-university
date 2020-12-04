<template>
<div class="p-mainVisual">
  <span class="p-mainVisual__title">CHUO<br>UNIVERSITY<br>SOFT<br>TENNIS</span>
</div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.p-mainVisual{
  width: 100%;
  height: 100vh;
  @include gradient(color(deepDarkblue), color(darkblue), horizontal);
  @include flex(
    $flow:column nowrap,
    $justify-content:center,
    $align-items:center
  );


  &__title {
    color: color(white);
    font-family: Arial, Helvetica, sans-serif;
    font-size: font(mainVisual);
    font-weight: bold;
    text-shadow: 3px 3px 0px color(orange);

    // tablet style
    @include mq(sm) {
      font-size: font(mainVisual-lg);
    };

    // pc style
    @include mq(md) {
      line-height: 1.2;
      font-size: font(mainVisual-lg);
    };
  }
}
</style>
