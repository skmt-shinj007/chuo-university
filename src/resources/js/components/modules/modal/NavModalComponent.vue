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
            <i class="btn-line"/>
          </button>
        </header>

        <nav class="nav-modal__main">
          <div class="nav-modal__accordion">
            <div class="nav-modal__accordion-item" v-for="(link, n) in links" :key="n">
              <accordion-link-component
                :item="link"
                @navClose="$emit('close')"
                />
            </div>
          </div>

          <div class="nav-modal__menu">
            <button class="nav-modal__menu-item">
              <!-- TODO:コンタクトページに遷移するようにする -->
              <router-link to="contact" class="nav-modal__menu-link" @click.native="$emit('close')">
                <label class="nav-modal__menu-title">{{ messages.Nav.Contact }}</label>
                <svg-vue icon="angle-right" class="nav-modal__menu-icon"/>
              </router-link>
            </button>
          </div>

          <div class="nav-modal__sns">
            <!-- snsの各プロフィールページに遷移するように修正 -->
            <div class="nav-modal__sns-item" v-for="(item, n) in filteringSns" :key="n" :class="`nav-modal__sns-item--${item.name.en}`">
              <a :href="item.link" class="nav-modal__sns-link" target="_blank" rel="noopener noreferrer">
                <svg-vue :icon="item.icon" class="nav-modal__sns-icon" :class="`nav-modal__sns-icon--${item.name.en}`"/>
              </a>
            </div>
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
import AccordionLinkComponent from '../accordion/AccordionLinkComponent';

// data
import Config from '../../../config/config.json';

// mixin
import TwitterAccount from '../../../config/api/TwitterAccount';

export default {
  components: {
    AccordionLinkComponent,
  },

  mixins: [TwitterAccount],

  data() {
    return {
      config: Config,

      /**
       * snsのメニューパネルを生成する配列
       * @type { Array }
       */
      sns: [],

      /**
       * アコーディオンコンポーネントに渡すデータ
       * @type { Array }
       */
      links: []
    }
  },

  computed: {
    /**
     * sns配列の要素が3以上になったらカットする。
     */
    filteringSns() {
      if (this.sns.length > 3) {
        return this.sns.slice(0, 3);
      }
      else {
        return this.sns;
      }
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

    /**
     * sns データ生成
     * TODO：Apiを叩いてアカウント情報を持ってくる
     */
    this.getAccount(() => {
      // apiレスポンスと保持データの結合
      const apiResponse = this.twitter;
      const retained = this.config.twitter;
      this.twitter = {...apiResponse, ...retained};

      // sns配列に格納
      this.sns.push(this.twitter);
    });

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
    font-size: font(16);
  }

  &__menu-icon {
    width: interval(1);
    cursor: pointer;
  }

  &__sns {
    @include flex(row wrap, flex-start, center);
    border: 1px solid rgba(color(lightgray), .1);
    margin-top: interval(5);

    @include mq(sm) {
      max-width: interval(45);
      margin: interval(5) 0 0 auto;
    }
  }

  &__sns-item {
    width: calc(100% / 3);
    border-right: 1px solid darken( color(lightgray), 60%);

    &--twitter {
      background-color: color(twitter);
    }

    &--instagram {
      position: relative;
      background: linear-gradient(200deg, #5478f2 0%, #f23f79 60%, orange 100%);
    }

    &--facebook {
      background-color: color(facebook);
    }
  }

  &__sns-link {
    @include flex(row nowrap, center, center);
    transition: all .3s ease-out;
    background-color: darken( color(lightgray), 70%);

    @include hover {
      background-color: rgba( darken( color(lightgray), 70%) , 0);
    }

    &::before {
      display: block;
      content: '';
      padding-top: 100%;
    }
  }

  &__sns-icon {
    width: interval(4);
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
.modal-enter-active, .modal-leave-active {
  transition: opacity 0.4s;

  // オーバーレイに包含されているモーダルウィンドウのトランジション
  .modal-window {
    transition: opacity 0.4s, transform 0.4s;
  }
}

.modal-leave-active {
  transition: opacity 0.6s ease 0.4s;
}

.modal-enter, .modal-leave-to {
  opacity: 0;

  .modal-window {
    opacity: 0;
    transform: translateY(-20px);
  }
}
</style>
