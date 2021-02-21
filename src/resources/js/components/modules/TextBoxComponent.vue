<template>
<div class="text-box">
  <div class="text-box__title">
    <contents-title-component :title="titles.Main" :subTitle="titles.Sub" :color="titleColor"/>
  </div>
  <div class="text-box__text">
    <p class="nl2br" v-text="contentsText"></p>
  </div>
  <div class="text-box__button">
    <primary-button-component :name="buttonName"/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from './ContentsTitleComponent';
import PrimaryButtonComponent from './button/PrimaryButtonComponent';

export default {
  components: {
    ContentsTitleComponent,
    PrimaryButtonComponent,
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
     * ボタンのラベル
     */
    buttonName: String,
  },
}
</script>

<style lang="scss">
.text-box {
  padding: 0 interval(2) interval(2) interval(2);
  background-color: rgba($color: color(white), $alpha: .8);
  box-shadow: 0px 6px 8px color(shadow);
  margin: 0 auto;

  @include mq(sm) {
    padding: 0 interval(3) interval(3) interval(3);
  }

  @include mq(md) {
    @include flex(column nowrap, center, center);
    min-height: interval(50);
  }

  &__button {
    margin-top: interval(5);
    width: 100%;
  }
}
</style>
