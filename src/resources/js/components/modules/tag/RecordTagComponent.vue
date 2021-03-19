<template>
<div class="record-tag">
  <div class="record-tag__color">
    <svg-vue icon="tennis-racket" class="record-tag__icon"/>
    <span class="record-tag__content">{{ messages.TagTitles.Record }}</span>
  </div>

  <div class="record-tag__open">
    <span class="record-tag__open-text">{{ messages.TagTitles.RecordHover }}</span>
  </div>
</div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.record-tag {
  cursor: pointer;
  position: relative;
  color: color(white);
  letter-spacing: 1.8px;
  line-height: 1.9;

  @include hover {
    > .record-tag__color {
      transform: rotateX(180deg);
    }

    > .record-tag__open {
      opacity: 1;
      transform: rotateX(0);
    }
  }

  &__color {
    padding: interval(.5) interval(1.5);
    border-radius: radius(normal);
    background-color: color(darkblue);
    @include flex(row nowrap, center, center);
    transition: all .5s cubic-bezier(.175, .885, .32, 1.275);
    box-shadow: 0 3px 20px 2px color(darkShadow);
  }

  &__icon {
    margin-right: interval(.5);
    width: interval(3);
    height: interval(3);
    fill: color(white);

    @include mq(sm) {
      margin-right: interval(1);
    }

    @include mq(md) {
      margin-right: interval(1.5);
    }
  }

  &__content {
    padding: interval(.5) 0;

    @include mq(sm) {
      font-size: font(14);
    }
  }

  &__open {
    @extend .record-tag__color;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    right: 0;
    transform: rotateX(-180deg);
    opacity: 0;
    transition: all .5s cubic-bezier(.175, .885, .32, 1.275);
  }

  &__open-text {
    letter-spacing: 1px;
    font-size: font(12);
    font-weight: bold;
    @include gradient(color(white),color(lightgray), horizontal);
    background-clip: text;
    -webkit-text-fill-color: transparent;

    @include mq(sm) {
      font-size: font(14);
    }
  }
}

</style>
