<template>
<div class="member">
  <div class="member__main-visual">
    <main-visual-component>
      <template v-slot:inner>
        <svg-vue class="member__main-visual-icon" icon="chuo-logo"/>
        <span class="member__main-visual-ward nl2br" v-text="messages.MainVisual.Member"/>
      </template>
    </main-visual-component>
  </div>
</div>
</template>

<script>
// component import
import MainVisualComponent from '../components/contents/MainVisualComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    MainVisualComponent,

  },
  data() {
    return {
      data: Data,
    }
  },
  props: {

  },
  mounted() {

  },
  beforeMount() {
    /**
     * SP表示のときにメインビジュアルテキストの改行を増やす
     * *ウインドウ幅がリアルタイム取得ではないので、改行増はリロードする必要がある。
     * （そもそもPC幅からSP幅に移行する場面は想定できないのでこの作りでOKな気がする）
     */
    if (this.windowWidth < 560) {
      this.$data.messages.MainVisual.Member = "CHUO UNIVERSITY\nSOFT TENNIS\nTEAM MEMBER";
      return this.$data.messages.MainVisual.Member;
    }
  },

}
</script>

<style lang="scss" scoped>
.member {

  &__main-visual-icon {
    width: interval(30);
    height: interval(30);
    fill: color(white);
    stroke: color(orange);

    @include mq(md) {
      width: 40%;
      height: 40%;
      min-width: interval(60);
      min-height: interval(60);
    }
  }

  &__main-visual-ward {
    @include bangers(font(mv), 1px, 400);
    color: color(white);
    line-height: 1.2;
    margin: 0 interval(1);

    @include mq(sm) {
      text-align: center;
    }
  }

}
</style>
