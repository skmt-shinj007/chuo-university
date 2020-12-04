<template>
<div class="p-contentsCard card-container">
  <div class="p-contentsCrad__title">
    <contents-title-component :title="title" :subTitle="subTitle" :color="titleColor"/>
  </div>
  <div class="p-contentsCard__lead">
    <p class="p-contentsCard__lead-text">
      {{ contentsText }}
    </p>
  </div>
  <div class="p-contentsCard__viewAll">
    <view-all-button-component :name="buttonName" :buttonSize="buttonSize"/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../modules/ContentsTitleComponent';
import ViewAllButtonComponent from '../modules/button/ViewAllButtonComponent';

export default {
  components: {
    ContentsTitleComponent,
    ViewAllButtonComponent,
  },
  props: {
    title: String,       // タイトル文言
    subTitle: String,    // サブタイトル文言
    titleColor: String,  // タイトルの色変更（未設定の場合：紺色）
    contentsText: {
      type: String,
      default: 'コンテンツ内テキストは準備中です。もうしばらくお待ちください。'
    },
    buttonName: String,
    buttonSize: String,
  },
}
</script>

<style lang="scss">
.p-contentsCard {
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

  &__lead {
    margin-top: interval(3);
    padding: interval(1);
  }

  &__viewAll{
    margin-top: interval(2);
  }
}
</style>
