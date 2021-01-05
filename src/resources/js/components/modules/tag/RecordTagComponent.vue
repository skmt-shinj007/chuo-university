<template>
<div class="record-tag">
  <tag-component class="record-tag__row" size="lg">
    <svg-vue icon="tennis-racket" class="record-tag__icon"></svg-vue>
    <span class="record-tag__content">{{ tagTitle }}</span>
  </tag-component>
</div>
</template>

<script>
// component import
import TagComponent from './TagComponent';

export default {
  components: {
    TagComponent
  },
  props: {
    tagTitle: {
      type: String,
      default: ''
    }
  },
}
</script>

<style lang="scss" scoped>
.record-tag {
  cursor: pointer;

  &__row {
    @include flex(row nowrap, center, center);
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
      font-size: font(base);
    }
  }

}

</style>
