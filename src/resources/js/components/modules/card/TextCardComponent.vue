<template>
<div class="text-card">
  <div class="text-card__title">
    <contents-title-component :title="titles.Main" :subTitle="titles.Sub" :color="titleColor"/>
  </div>
  <div class="text-card__text">
    <p class="nl2br" v-text="contentsText"></p>
  </div>
  <div class="text-card__button">
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
.text-card {
  padding: interval(2);
  background-color: color(white);
  box-shadow: 0px 6px 8px color(shadow);
  margin: 0 auto;

  @include mq(sm) {
    padding: interval(3);
  }

  @include mq(md) {
    @include flex(column nowrap, center, center);
    background-color: rgba($color: color(white), $alpha: .8);
    min-height: interval(60);
  };

  &__text {
    padding: 0 interval(1);
  }

  &__button {
    margin-top: interval(5);
  }
}
</style>
