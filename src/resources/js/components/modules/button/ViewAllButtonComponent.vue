<template>
<div class="view-all-button" :class="[changeSizing, variation]">
  <button class="view-all-button__button" :type="buttonType">
    {{ name }}
    <i class="fas fa-angle-right fa-2x view-all-button__icon"></i>
  </button>
</div>

<!--
  ボタンテキストとボタンタイプを指定可能 (name="hoge" buttonType="hoge" を親コンポーネントで指定)
  指定なしならpropsオブジェクト内default値が適用される。
  例）<view-all-button-component name="メンバーを見る" buttonType="submit"/>

  ボタンサイズの可変は、クラスの指定で行う。(親コンポーネントで buttonSize を指定)
  1. view-all-button-xs
  2. view-all-button-sm

  variation -> ボタンのレイアウトを変えたいときに追加のクラス名を指定する。（スタイルを追加する必要あり）
-->
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: 'もっと見る',
    },
    buttonType: {
      type: String,
      default: 'button',
    },
    buttonSize: {
      type: String,
      default: null,
    },
    variationClass: {
      type: String,
      default: null,
    }
  },
  computed: {
    changeSizing() {
      return (this.buttonSize) ? `view-all-button--${this.buttonSize}` : null;
    },
    variation() {
      return (this.variationClass) ? `view-all-button--${this.variationClass}` : null;
    }
  },
}
</script>

<style lang="scss">
.view-all-button {
  width: 80%;
  max-width: btn-size(sm-width);
  height: btn-size(sm-height);
  margin: 0 auto;
  background-color: color(white);
  font-size: font(xs);
  border: 1px solid color(orange);
  border-radius: radius(soft);
  position: relative;

  // pc style
  @include mq(md) {
    width: btn-size(lg-width);
    height: btn-size(lg-height);
    font-size: font(sm);

    &--xs {
      max-width: btn-size(xs-width);
      height: btn-size(xs-height);
      font-size: font(xs);
    }

    &--sm {
      width: btn-size(sm-width);
      height: btn-size(sm-height);
      font-size: font(xs);
    }

    &:hover {
      @include button-hover();  // ネストが深くなるためmixinファイルに変数としてスタイルを設定
    }
  };

  &__button {
    width: 100%;
    height: 100%;
    text-align: center;
    background-color: color(white);
    color: color(orange);
    border: 1px solid color(orange);
    border-radius: radius(soft);
    transform: translateX(4px) translateY(-4px);
    transition: all .3s ease-out;
  }

  &__icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
  }

  &--rgba {
    background-color: rgba($color: color(white), $alpha: .6);

    .view-all-button__button {
      background-color: rgba($color: color(white), $alpha: .6);
    }
  }

}
</style>
