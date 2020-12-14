<template>
<div class="record-tag">
  <tag-component class="record-tag__row" size="lg">
    <!-- svg要素は後々調整 -->
    <object class="record-tag__icon" type="image/svg+xml" data="/image/tennis-racket.svg" width="24" height="24"></object>
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
  &__row {
    @include flex(row nowrap, center, center);
  }

  &__icon {
    margin-right: interval(.5);
  }

  &__content {
    font-size: font(sm);
    padding: interval(.5) 0;
  }

}

</style>
