<template>
<div class="test">
  <!-- <div v-if="windowWidth">
    windowの横幅は <span>{{ windowWidth }}px</span> です。
  </div>

  <figure class="wrap">
    <img src="/image/dormitory-01.jpg" alt="">
  </figure> -->
  <div class="api">
    
  </div>
</div>
</template>

<script>
import Risize from '../config/resize';

export default {
  mixins: [Risize],

  data() {
    return {
      windowWidth: window.innerWidth,
      api: null,
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
    /**
     * 作成したAPIを叩くメソッド（テスト）
     *
     * @param {String} エンドポイント
     * @return {Object}
     */
    async getApiResponce($endPoint) {
      await this.$axios.get(`/api${$endPoint}`)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getApiResponce('/player');
    this.getApiResponce('/staff');
    this.getApiResponce('/ob');
    this.getApiResponce('/active_ob');
  }
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
  width: 500px;
  margin: 0 auto;
  @include trimming(aspect(golden));
}
</style>
