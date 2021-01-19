<template>
<header class="header" id="header" :class="{ 'header--hide': display }">
  <div class="header__navbar">
    <router-link to="/" class="header__navbar-link">
      <div class="header__title">
        <span class="header__title-main">{{ messages.Header.MainTitle }}</span>
        <span class="header__title-assistance">{{ messages.Header.AssistanceTitle }}</span>
      </div>
    </router-link>

    <div class="header__menus">
      <button class="header__btn">
        <svg-vue icon="bars" class="header__btn-icon"/>
      </button>

      <a class="header__btn" :href="data.Href.Twitter" target="_blank">
        <svg-vue icon="twitter" class="header__btn-icon"/>
      </a>
    </div>
  </div>
</header>

</template>

<script>
// data import
import Data from '../../config/data.json';

export default {
  components: {

  },
  data() {
    return {
      data: Data,

      /**
       * 要素の高さが入った配列
       * @type { Array }
       */
      elementsHeight: null,

      /**
       * [ヘッダーの表示を制御するフラグ]
       * true  表示 (デフォ)
       * false 非表示
       * クラスの付与で表示切り替え
       * @type { Boolean }
       */
      display: true,

      /**
       * [スクロール位置]
       * ヘッダーの表示切り替えで使用
       * @type { Number }
       */
      lastPosition: 0,
    }
  },

  mounted() {
    // 要素の高さを取得
    const idName = ['header'];
    this.elementsHeight = this.getElementHeight(idName);
  },

  watch: {
    /**
     * [スクロールに応じてヘッダーの表示を制御する]
     */
    scrollAmount() {
      let pos = this.scrollAmount;                 // 現在地（スクロール）
      const headerH = this.elementsHeight.header;  // ヘッダーの高さ
      let lastpos = this.lastPosition;             // 最後のスクロール位置

      // ヘッダーの高さ分スクロール かつ 上スクロールした際にクラスを付与
      (pos > headerH && pos > lastpos) ? this.display = true : this.display = false;

      // 最後のスクロール位置を更新
      this.lastPosition = this.scrollAmount;
    }
  }
}
</script>

<style lang="scss" scoped>
.header {
  height: interval(8);
  box-shadow: 0px 2px 6px color(shadow);
  position: fixed;
  top: 0;
  right: 0;
  z-index: 1000;
  transition: all .3s ease-out;
  transform: translateY(0);

  &--hide {
    transform: translateY(-110%);

    @include mq(sm) {
      transform: translateY(0);
    }
  }

  @include mq(md) {
    width: width(header);
    height: 100vh;
    position: fixed;
    left: 0;
    box-shadow: 2px 0px 10px color(shadow);
  }

  &__navbar {
    height: 100%;
    padding: 0 interval(2);
    max-width: device(max);
    margin: 0 auto;
    @include flex(row nowrap, space-between, center);

    @include mq(md) {
      @include flex(column nowrap, space-around, center);
    }
  }

  &__title {
    cursor: pointer;
    @include flex(row nowrap, center, center);
    margin-right: interval(1);

    @include mq(md) {
      margin: 0;
      padding: 0 interval(2);
      writing-mode: vertical-rl;
    }

    &-main {
      @include bangers();
      font-size: font(lg);

      @include mq(md) {
        margin-bottom: interval(7);
      }
    }

    &-assistance {
      display: none;

      @include mq(sm) {
        margin-left: interval(3);
        font-size: font(xs);
        font-weight: normal;
        letter-spacing: 1.1px;
        position: relative;
        display: block;
      }

      @include mq(md) {
        margin: 0;
        font-size: font(sm);
      }
    }

    &-assistance::before {
      display: none;

      @include mq(md) {
        content: '';
        display: block;
        width: 1px;
        height: interval(2);
        background-color: color(darkblue);
        position: absolute;
        top: - interval(4);
        left: 50%;
        transform: translateX(-50%);
      }
    }
  }

  &__menus {
    @include flex(row nowrap, space-around);

    @include mq(md) {
      @include flex(column nowrap, space-around);
    }
  }

  &__btn {
    @include flex(row nowrap, center, center);
    background-color: color(darkblue);
    width: interval(5);
    height: interval(5);
    border-radius: radius(circle);
    box-shadow: 1px 3px 6px 3px darken(color(shadow), 10%);
    cursor: pointer;
    transition: .3s all ease-in-out;
    margin-right: interval(1);

    @include mq(md) {
      margin: 0 0 interval(1) 0;

      &::before {
        content: '';
        position: absolute;
        width: interval(5);
        height: interval(5);
        border-radius: radius(circle);
        border: 2px solid transparent;
        transition: .3s all ease-in-out;
      }
    }

    @include hover {
      background-color: color(white);
      transform: scale(1.1);

      &::before {
        border-color: color(darkblue);
      }

      .header__btn-icon {
        transform: rotateZ(360deg);
        color: color(darkblue);
      }
    }
  }

  &__btn-icon {
    width: interval(2);
    color: color(white);
    transition: .3s all ease-out;
  }
}
</style>
