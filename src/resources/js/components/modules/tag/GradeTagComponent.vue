<template>
<div class="grade-tag">
  <tag-component>
    <span class="grade-tag__content">{{ grade }}年生</span>
  </tag-component>
</div>
</template>

<script>
// component import
import TagComponent from './TagComponent'

export default {
  components: {
    TagComponent
  },
  props: {
    grade: {
      type: Number,
      default: ''
    }
  },
}
</script>

<style lang="scss">

</style>
