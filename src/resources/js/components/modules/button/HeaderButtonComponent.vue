<template>
  <button class="header-button" :type="buttonType">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    buttonType: {
      type: String,
      default: 'button',
    },
  }
}
</script>

<style lang="scss">
.header-button {
  background-color: color(darkblue);
  color: color(white);
  width: 40px;
  height: 40px;
  border-radius: radius(circle);
  margin-right: interval(1);
  cursor: pointer;
  box-shadow: 1px 3px 6px 3px darken(color(shadow), 10%);
  @include flex(
    $justify-content: center,
    $align-items: center,
  );

  // tablet style
  @include mq(sm) {
    margin-right: interval(2);
  };

  // pc style
  @include mq(md) {
    margin-right: 0;
    margin-bottom: interval(2);
    position: relative;
    transition: .5s all ease-in-out;
    @include header-button-hover();
  };

  &:last-child {
    margin: 0;
  }

  .header-icon {
    width: icon(normal);
    height: icon(normal);
    transition: .3s all ease;
  }
}
</style>
