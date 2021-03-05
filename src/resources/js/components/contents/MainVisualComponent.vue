<template>
<div class="main-visual wrapper">
  <slot name="inner">
    <div class="main-visual__wrap">
      <div class="main-visual__text" v-for="(text, i) in texts" :key="i">
        <span
          class="main-visual__item delay"
          v-for="(t, n) in text"
          :key="n"
          v-text="t"/>
      </div>
    </div>
  </slot>
</div>
</template>

<script>
export default {
  data() {
    return {
      /**
       *
       */
      texts: {},
    }
  },

  beforeMount() {
    this.texts = {...this.messages.MainVisual.Home}
    console.log()
  },
}
</script>

<style lang="scss" scoped>
.main-visual{
  width: 100%;
  height: 100vh;
  @include gradient(color(deepDarkblue), color(darkblue), horizontal);
  @include flex(row nowrap, center, center);
  position: relative;

  &__item {
    color: color(white);
    display: inline-block;
    font-size: font(48);
    line-height: 1.2;
    text-shadow: 3px 3px 0px color(orange);
    animation: textIn 0.8s cubic-bezier(0.22, 0.15, 0.25, 1.43) 0s backwards;
  }

  @for $i from 1 through 10 {
    &__item:nth-child(#{$i}) {
      animation-delay: $i * 100ms + 200ms;
    }
  }
}
</style>
