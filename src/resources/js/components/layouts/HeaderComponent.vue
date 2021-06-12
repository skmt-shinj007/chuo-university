<template>
<header class="header" :class="{ 'header--hide': !isShow }">
  <div class="header__navbar">
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

        <a class="header__button" :href="twitterProfileLink" target="_blank">
          <svg-vue icon="twitter" class="header__icon"/>
        </a>
      </div>
    </div>
  </div>

  <!-- グローバルナビ（モーダル） -->
  <nav-modal v-if="navShow" @close="closeModal" :twitter="twitter"/>

</header>
</template>

<script>
// data import
import Scroll from '../../config/scroll';
import Api from '../../config/api/index';

// component import
import NavModal from '../modules/modal/NavModalComponent.vue';

export default {
  components: {
    NavModal,
  },

  mixins: [Scroll],

  data() {
    return {
      /**
       * [ヘッダーの表示を制御するフラグ]
       * クラスの付与で表示切り替え
       * @type { Boolean }
       */
      isShow: true,

      /**
       * [スクロール位置]
       * ヘッダーの表示で使用
       * @type { Number }
       */
      lastScrollPosition: 0,

      /**
       * [ナビを開くフラグ]
       * @type { Boolean }
       */
      navShow: false,

      /**
       * Twitterレスポンス
       * @type {object}
       */
      twitter: null,
    }
  },

  computed: {
    twitterProfileLink() {
      let link = 'https://twitter.com/'
      return (this.twitter) ? this.twitter.link : link;
    }
  },

  created() {
    this.setTwitter();
  },

  watch: {
    /**
     * [スクロールに応じてヘッダーの表示を制御する]
     */
    scrollY() {
      let pos = this.scrollY;             // スクロール現在地
      let lastpos = this.lastScrollPosition;   // 最後のスクロール位置

      /**
       * 60pxスクロール かつ 上スクロールした際にヘッダーを非表示
       */
      (pos > 60 && pos > lastpos) ? this.isShow = false : this.isShow = true;

      // 最後のスクロール位置を更新
      this.lastScrollPosition = this.scrollY;
    },

    // ブラウザバック時にナビモーダルを閉じる
    '$route' (to, from) {
      this.closeModal();
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

    /**
     * APIレスポンスを変数にセットする。
     */
    async setTwitter() {
      const response = await Api.getResponse('/twitter/account');

      if (this.getType(response) !== 'object') {
        console.error('ERROR:オブジェクトで返却されませんでした。');
        return;
      }
      this.twitter = response;
    }
  },
}
</script>

<style lang="scss" scoped>
.header {
  width: 100%;
  height: interval(8);
  padding: 0 pixel(2);
  position: fixed;
  top: 0;
  right: 0;
  z-index: 900;
  background-color: color(white);
  box-shadow: 0px 2px 6px color(shadow);
  transition: transform .3s ease-out;

  &--hide {
    transform: translateY(-110%);

    @include mq(md) {
      transform: translateY(0);
    }
  }

  @include mq(sm) {
    padding: pixel(1) pixel(2);
  }

  @include  mq(md) {
    width: width(header);
    height: 100vh;
    padding: 3vh 0;
    position: fixed;
    left: 0;
    box-shadow: 2px 0px 10px color(shadow);
  }

  &__navbar {
    position: relative;
    height: 100%;
    @include flex(row nowrap, space-between, center);

    @include mq(md) {
      display: block;
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
    @include bangers(font(14));

    @include mq(md) {
      margin-bottom: pixel(6);
      font-size: min(3vh, 32px);
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
      font-size: min(1.5vh, 16px);

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
      width: interval(6);
      height: interval(6);
      max-width: pixel(10);
      max-height: pixel(10);
      margin: 0 0 pixel(1) 0;
    }

    @include hover {
      .header__icon {
        transform: translate(-50%, -50%) rotateZ(360deg);
      }
    }
  }

  &__icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotateZ(0);
    width: 50%;
    fill: color(white);
    color: color(white);
    transition: .3s all ease-out;
  }
}
</style>
