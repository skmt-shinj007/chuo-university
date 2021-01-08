<template>
<div class="lead-text card-inner-margin">
  <contents-title-component class="lead-text__title" :title="titles.Main" :subTitle="titles.Sub" :color="titleColor"/>
  <div class="lead-text__inner">
    <p class="nl2br" v-text="contentsText"></p>
  </div>
  <div class="lead-text__viewAll">
    <primary-button-component :name="buttonName" :btnSize="btnSize"/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../modules/ContentsTitleComponent';
import PrimaryButtonComponent from '../modules/button/PrimaryButtonComponent';

export default {
  components: {
    ContentsTitleComponent,
    PrimaryButtonComponent,
  },
  props: {
    titles: {
      type: Object,
      default: null
    },
    titleColor: String,  // タイトルの色変更（未設定の場合：紺色）
    contentsText: {
      type: String,
      default: 'コンテンツ内テキストは準備中です。もうしばらくお待ちください。'
    },
    buttonName: String,
    btnSize: String,
  },
}
</script>

<style lang="scss">
.lead-text {
  width: 80%;
  background-color: color(white);
  box-shadow: 0px 6px 8px color(shadow);
  margin: 0 auto;

  // tablet style
  @include mq(sm) {
    width: 70%;
  };

  // pc style
  @include mq(md) {
    width: 50%;
    background-color: rgba($color: color(white), $alpha: .8);
  };

  &__title {
    // コンテンツタイトルの下余白を上書き
    padding-bottom: interval(3);
  }

  &__inner {
    padding: 0 interval(1);
  }

  &__viewAll{
    margin-top: interval(2);
  }
}
</style>
