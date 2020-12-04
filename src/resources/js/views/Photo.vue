<template>
<div class="wrap">
  {{ windowWidth }}
</div>
</template>

<script>
export default {
  data() {
    return {
      hello: 'Hello,World',
      display: true,
      windowWidth: window.innerWidth,
    }
  },
  mounted() {
    window.addEventListener('resize', this.WindowWidthResize);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.WindowWidthResize);
  },
  methods: {
    WindowWidthResize() {
      this.windowWidth = window.innerWidth;
    }
  },
}
</script>

<style>

</style>
