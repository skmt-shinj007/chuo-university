<template>
<header class="header">
  <div class="header__navbar" :class="{ 'header__navbar--hide': headerShow }">
    <router-link to="/" class="header__navbar-link">
      <div class="header__title">
        <span class="header__title-main">{{ messages.Header.MainTitle }}</span>
        <span class="header__title-assistance">{{ messages.Header.AssistanceTitle }}</span>
      </div>
    </router-link>

    <div class="header__menus">
      <button class="header__btn" @click="openModal">
        <svg-vue icon="menu" class="header__btn-icon"/>
      </button>

      <a class="header__btn" :href="twitter.link" target="_blank">
        <svg-vue icon="twitter" class="header__btn-icon"/>
      </a>
    </div>
  </div>

  <!-- グローバルナビ（モーダル） -->
  <nav-modal v-if="navShow" @close="closeModal"/>

</header>
</template>

<script>
// data import
import Data from '../../config/data.json';
import Config from '../../config/config.json';

// component import
import NavModal from '../modules/modal/NavModalComponent.vue';

// mixin
import TwitterAccount from '../../config/api/TwitterAccount';
import Scroll from '../../config/scroll';

export default {
  components: {
    NavModal,
  },

  mixins: [TwitterAccount, Scroll],

  data() {
    return {
      data: Data,
      config: Config,

      /**
       * ヘッダーの高さ
       * @type { Number }
       */
      headerHeight: 0,

      /**
       * [ヘッダーの表示を制御するフラグ]
       * クラスの付与で表示切り替え
       * @type { Boolean }
       */
      headerShow: true,

      /**
       * [スクロール位置]
       * ヘッダーの表示切り替えで使用
       * @type { Number }
       */
      lastScrollPosition: 0,

      /**
       * [ナビを開くフラグ]
       * @type { Boolean }
       */
      navShow: false,
    }
  },

  beforeMount() {
    this.getTwitterAccount();
  },

  watch: {
    /**
     * [スクロールに応じてヘッダーの表示を制御する]
     */
    scrollY() {
      let pos = this.scrollY;             // スクロール現在地
      let lastpos = this.lastScrollPosition;   // 最後のスクロール位置

      /**
       * 60pxスクロール かつ 上スクロールした際にクラスを付与
       */
      (pos > 60 && pos > lastpos) ? this.headerShow = true : this.headerShow = false;

      // 最後のスクロール位置を更新
      this.lastScrollPosition = this.scrollY;
    }
  },

  methods: {
    /**
     * [ナビ表示切り替え]
     */
    openModal() {
      this.navShow = true;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.navShow = false;
      document.body.classList.remove("modal-open");
    },
  },
}
</script>

<style lang="scss" scoped>
.header {

  &__navbar {
    width: 100%;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 900;
    height: interval(8);
    background-color: color(white);
    padding: 0 interval(2);
    box-shadow: 0px 2px 6px color(shadow);
    transition: all .3s ease-out;
    transform: translateY(0);
    @include flex(row nowrap, space-between, center);

    @include mq(md) {
      position: fixed;
      left: 0;
      width: width(header);
      height: 100vh;
      box-shadow: 2px 0px 10px color(shadow);
      @include flex(column nowrap, space-around, center);
    }

    &--hide {
      transform: translateY(-110%);

      @include mq(md) {
        transform: translateY(0);
      }
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
      font-size: font(14);

      @include mq(md) {
        margin-bottom: interval(6);
      }
    }

    &-assistance {
      display: none;

      @include mq(sm) {
        margin-left: interval(3);
        font-size: font(8);
        font-weight: normal;
        letter-spacing: 1.1px;
        position: relative;
        display: block;
      }

      @include mq(md) {
        margin: 0;
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
        fill: color(lightDarkblue);
        color: color(lightDarkblue);
      }
    }
  }

  &__btn-icon {
    width: interval(2.5);
    fill: color(white);
    color: color(white);
    transition: .3s all ease-out;
  }

  &__nav-modal {
    width: 100vw;
    height: 100vh;
    background-color: rgba(black, $alpha: .5);
    z-index: 998;
    position: fixed;
    top: 0;
    right: 0;
    color: color(white);
    transform: translateX(-100%);
    transition: all .3s ease-out;

    &--open {
      transform: translateX(0);
    }
  }
}
</style>
