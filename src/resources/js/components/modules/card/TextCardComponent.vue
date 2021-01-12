<template>
<div class="lead-text">
  <div class="lead-text__title">
    <contents-title-component :title="titles.Main" :subTitle="titles.Sub" :color="titleColor"/>
  </div>
  <div class="lead-text__text">
    <p class="nl2br" v-text="contentsText"></p>
  </div>
  <div class="lead-text__button">
    <primary-button-component :name="buttonName" :btnSize="btnSize"/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../ContentsTitleComponent';
import PrimaryButtonComponent from '../button/PrimaryButtonComponent';

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
  padding: interval(2);
  background-color: color(white);
  box-shadow: 0px 6px 8px color(shadow);
  margin: 0 auto;

  // pc style
  @include mq(md) {
    padding: interval(3);
    background-color: rgba($color: color(white), $alpha: .8);
  };

  &__text {
    padding: 0 interval(1);
  }

  &__button {
    margin-top: interval(5);
  }
}
</style>
