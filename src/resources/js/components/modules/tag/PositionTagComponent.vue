<template>
<div class="position-tag">
  <tag-component :color="positionColor" :content="position"/>
</div>
</template>

<script>
// component import
import TagComponent from './TagComponent'

export default {
  components: {
    TagComponent
  },
  data() {
    return {
      positionColor: '',
    }
  },
  props: {
    position: {
      type: String,
      default: ''
    }
  },
  computed: {
  },
  mounted() {
    // position が '後衛' の場合、カラーを 'lightgreen' に設定。
    // position が '前衛' の場合、カラーを 'orange' に設定。
    (this.position === '後衛') ? this.positionColor = 'lightgreen' : (this.position === '前衛') ? this.positionColor = 'orange' : null;
  },
}
</script>

<style lang="scss">

</style>
