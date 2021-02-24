<template>
<div class="text-box">
  <div class="text-box__title">
    <contents-title-component :title="titles.Main" :subTitle="titles.Sub" :color="titleColor"/>
  </div>
  <div class="text-box__text">
    <p class="nl2br" v-text="contentsText"></p>
  </div>
  <div class="text-box__button">
    <primary-route-button-component :button="button"/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from './ContentsTitleComponent';
import PrimaryRouteButtonComponent from './button/PrimaryRouteButtonComponent';

export default {
  components: {
    ContentsTitleComponent,
    PrimaryRouteButtonComponent,
  },

  props: {
    /**
     * テキストのタイトル
     */
    titles: {
      type: Object,
      default: null
    },

    /**
     * タイトルの色
     */
    titleColor: String,

    /**
     * テキスト
     */
    contentsText: {
      type: String,
      default: 'コンテンツ内テキストは準備中です。もうしばらくお待ちください。'
    },

    /**
     * ボタンオブジェクト
     * nameとrouteが格納。
     */
    button: Object,
  },
}
</script>

<style lang="scss">
.text-box {
  padding: 0 interval(2) interval(2) interval(2);
  background-color: rgba($color: color(white), $alpha: .8);
  box-shadow: 0px 6px 8px color(shadow);

  @include mq(sm) {
    padding: 0 interval(3) interval(3) interval(3);
  }

  @include mq(md) {
    @include flex(column nowrap, center, center);
    min-height: interval(50);
  }

  &__text {
    margin-bottom: interval(5);
  }

  &__button {
    width: 100%;

    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}
</style>
