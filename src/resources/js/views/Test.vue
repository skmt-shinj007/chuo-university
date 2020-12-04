<template>
<div class="test">
  <div v-if="windowWidth">
    windowの横幅は <span>{{ windowWidth }}px</span> です。
  </div>

  <figure class="wrap">
    <img src="/image/player15.jpeg" alt="">
  </figure>
</div>
</template>

<script>
export default {
  data() {
    return {
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
    },
  },
}
</script>

<style lang="scss" scoped>

.test {
  padding: 100px 0;
}
span {
  font-size: 1.2rem;
}

// image トリミング
.wrap {
  @include trimming(aspect(square));
}
</style>
