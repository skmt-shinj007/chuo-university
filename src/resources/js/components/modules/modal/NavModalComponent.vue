<template>
  <transition name="modal" appear>
    <div class="nav-modal" @click.self="$emit('close')">

      <!-- pcのみ イメージ画像 -->
      <div class="nav-modal__visual modal-window" @click="$emit('close')">
        <div class="nav-modal__visual-overlay"/>
      </div>

      <div class="nav-modal__window modal-window">

        <header class="nav-modal__header" @click="$emit('close')">
          <svg-vue icon="hakumonkai-logo" class="nav-modal__logo"/>
          <button class="nav-modal__btn">
            <svg-vue icon="close"/>
          </button>
        </header>

        <nav class="nav-modal__main">
          <div class="nav-modal__accordion">
            <div class="nav-modal__accordion-item" v-for="(link, n) in links" :key="n">
              <accordion-link :item="link" @navClose="$emit('close')"/>
            </div>
          </div>

          <div class="nav-modal__menu">
            <button class="nav-modal__menu-item">
              <!-- TODO:コンタクトページに遷移するようにする -->
              <router-link to="contact" class="nav-modal__menu-link" @click.native="$emit('close')">
                <label class="nav-modal__menu-title">{{ messages.Links.ToContact.Name }}</label>
                <svg-vue icon="angle_right" class="nav-modal__menu-icon"/>
              </router-link>
            </button>
          </div>

          <div class="nav-modal__sns" v-if="snsPanels">
            <!-- snsの各プロフィールページに遷移するように修正 -->
            <a
              class="nav-modal__sns-item"
              :class="`nav-modal__sns-item--${item.service_name.en}`"
              v-for="(item, i) in snsPanels" :key="i"
              :href="item.link"
              target="_blank"
              rel="noopener noreferrer"
            >
              <svg-vue :icon="item.icon_name" class="nav-modal__sns-icon"/>
            </a>
          </div>
        </nav>

        <footer class="nav-modal__footer">
          <p class="nav-modal__copyright nl2br" v-text="messages.Copyright"/>
        </footer>

      </div>
    </div>
  </transition>
</template>

<script>
// component import
import AccordionLink from '../accordion/AccordionLinkComponent';

// data
import Config from '../../../config/config.json';

export default {
  components: {
    AccordionLink,
  },

  data() {
    return {
      config: Config,

      /**
       * アコーディオンコンポーネントに渡すデータ
       * @type { Array }
       */
      links: [],
    }
  },

  props: {
    twitter: {
      type: Object,
      deafult: null,
    }
  },

  computed: {
    /**
     * snsのメニューパネル配列を生成。
     * パネル配列の要素は3つまで。
     * @return {Array}
     */
    snsPanels() {
      let snsPanels = [];
      snsPanels.push(this.twitter);
      return snsPanels;
    }
  },

  beforeMount() {
    // アコーディオンリンクのデータを生成
    const config = this.$data.config;
    const messages = this.$data.messages;

    let sitemap = {};
    sitemap.name = messages.sitemap.name;
    sitemap.childrenMenus = this.convertArray(config.route);
    this.links.push(sitemap);

    let externalLink = {};
    externalLink.name = messages.externalLink.name;
    externalLink.childrenMenus = this.convertArray(config.links);
    this.links.push(externalLink);
  },

  methods: {
    /**
     * オブジェクトから配列に変換する処理
     * @param { Object }
     */
    convertArray(obj) {
      return Object.keys(obj).map(function (key) {
        return obj[key];
      })
    },
  },
}
</script>

<style lang="scss" scoped>
.nav-modal {
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: 910;
  background-color: rgba(color(deepDarkblue), $alpha: .9);
  @include flex(column nowrap);

  @include mq(md) {
    flex-direction: row;
  }

  &__window {
    padding: 0 interval(2) interval(5) interval(2);
    color: color(white);

    // ↓ モーダルがスクロールできない問題を解消
    max-height: 100%;
    overflow-y: auto;

    @include mq(sm) {
      padding-left: interval(4);
      padding-right: interval(4);
    }

    @include mq(md) {
      width: 50%;
    }
  }

  &__visual {
    display: none;

    @include mq(md) {
      display: block;
      width: 50%;
      height: 100%;
      @include background-image('/image/player06.jpg');
    }

    &-overlay {
      width: 100%;
      height: 100%;
      @include gradient(rgba( color(deepDarkblue) , .3), rgba( color(deepDarkblue) , .9));
    }
  }

  &__header {
    @include flex(row nowrap, space-between, center);
  }

  &__logo {
    width: interval(18);
    fill: color(white);

    @include mq(sm) {
      width: interval(22);
    }
  }

  &__btn {
    @include close-button;
  }

  &__accordion {
    margin-top: interval(5);
  }

  &__accordion-item {
    position: relative;

    &::before {
      content: '';
      display: block;
      width: 100%;
      height: 1px;
      position: absolute;
      bottom: 0;
      left: 0;
      @include gradient(rgba(color(lightgray), .3), rgba(color(lightgray), 0), horizontal);
    }
  }

  &__menu {
    margin-top: interval(2.5);
  }

  &__menu-item {
    width: 100%;

    @include hover {
      .nav-modal__menu-title {
        transform: translateX(interval(2));
      }
    }
  }

  &__menu-link {
    @include flex(row nowrap, space-between, center);
    padding: interval(2) interval(1);
    cursor: pointer;
  }

  &__menu-title {
    cursor: pointer;
    transition: all .3s ease-out;
    font-size: font(14);
  }

  &__menu-icon {
    width: interval(1.5);
    fill: color(white);
    cursor: pointer;
  }

  &__sns {
    @include flex(row wrap, flex-start, center);
    max-width: interval(40);
    margin: interval(5) 0 0 auto;
  }

  &__sns-item {
    @include flex(row nowrap, center, center);
    width: calc(100% / 3);
    background-color: transparent;
    transition: all .3s ease-out;

    &--twitter {
      @include panel-item(color(twitter));
    }

    &::before {
      display: block;
      content: '';
      padding-top: 100%;
    }
  }

  &__sns-icon {
    width: 30%;
  }

  &__footer {
    margin-top: interval(5);
  }

  &__copyright {
    text-align: center;
    font-size: font(10);
    line-height: 1.2;
    font-weight: bold;
  }
}

// モーダル開閉アニメーション
.modal {
  &-enter-active, &-leave-active {
    transition: opacity 0.4s;

    .modal-window {
      transition: opacity 0.4s, transform 0.4s;
    }
  }

  &-leave-active {
    transition: opacity 0.6s ease 0.4s;
  }

  &-enter, &-leave-to {
    opacity: 0;

    .modal-window {
      opacity: 0;
      transform: translateY(-20px);
    }
  }
}

// SNSリンクの表示アニメーション
.slide {
  &-enter-active {
    transition: opacity 0.6s;
    transition: transform .8s;
  }

  &-enter {
    opacity: 0;
    transform: translateX(-100%);
  }
}


</style>
