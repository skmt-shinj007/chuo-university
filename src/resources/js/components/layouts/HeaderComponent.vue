<template>
<header class="header">
  <div class="header__navbar" :class="{ 'header__navbar--hide': headerShow }">
    <div class="header__logo">
      <router-link to="/" class="header__link">
        <span class="header__title">{{ messages.Header.MainTitle }}</span>
        <span class="header__title-sub">{{ messages.Header.AssistanceTitle }}</span>
      </router-link>
    </div>

    <div class="header__menus">
      <div class="header__button-group">
        <button class="header__button" @click="openModal">
          <svg-vue icon="menu" class="header__icon"/>
        </button>

        <a class="header__button" :href="twitter.link" target="_blank">
          <svg-vue icon="twitter" class="header__icon"/>
        </a>
      </div>
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
  width: 100%;
  height: pixel(8);
  padding: 0 pixel(2);
  position: fixed;
  top: 0;
  right: 0;
  z-index: 900;
  background-color: color(white);
  box-shadow: 0px 2px 6px color(shadow);

  @include  mq(md) {
    width: width(header);
    height: 100vh;
    padding: pixel(2) 0;
    position: fixed;
    left: 0;
    box-shadow: 2px 0px 10px color(shadow);
  }

  &__navbar {
    position: relative;
    height: 100%;
    transition: all .3s ease-out;
    @include flex(row nowrap, space-between, center);

    @include mq(md) {
      display: block;
    }

    &--hide {
      transform: translateY(-110%);

      @include mq(md) {
        transform: translateY(0);
      }
    }
  }

  &__logo {
    margin-right: pixel(1);

    @include mq(md) {
      position: absolute;
      left: 50%;
      top: 0;
      transform: translateX(-50%);
      margin-right: 0;
    }
  }

  &__link {
    cursor: pointer;
    @include flex(row nowrap, center, center);

    @include mq(md) {
      writing-mode: vertical-rl;
    }
  }

  &__title {
    @include bangers();
    font-size: font(14);

    @include mq(md) {
      margin-bottom: pixel(6);
      font-size: 3vh;
    }
  }

  &__title-sub {
    display: none;

    @include mq(sm) {
      margin-left: pixel(2);
      font-size: font(8);
      font-weight: normal;
      letter-spacing: 1.1px;
      position: relative;
      display: block;
    }

    @include mq(md) {
      margin: 0;
      font-size: 1.5vh;

      &::before {
        content: '';
        display: block;
        width: 1px;
        height: pixel(2);
        background-color: color(darkblue);
        position: absolute;
        top: - pixel(4);
        left: 50%;
        transform: translateX(-50%);
      }
    }
  }

  &__menus {
    @include mq(md) {
      position: absolute;
      left: 50%;
      bottom: 0;
      transform: translateX(-50%);
    }
  }

  &__button-group {
    @include flex(row nowrap, space-around);

    @include mq(md) {
      @include flex(column nowrap, space-around);
    }
  }

  &__button {
    position: relative;
    @include flex(row nowrap, center, center);
    background-color: color(darkblue);
    width: interval(5);
    height: interval(5);
    border-radius: radius(circle);
    cursor: pointer;
    transition: all .3s ease-in-out;
    margin-right: pixel(1);

    &:last-child {
      margin: 0;
    }

    @include mq(md) {
      margin: 0 0 pixel(1) 0;
    }

    @include hover {
      .header__icon {
        transform: rotateZ(360deg);
      }
    }
  }

  &__icon {
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
