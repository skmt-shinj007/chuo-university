<template>
<div class="footer-wrap">
  <footer class="footer wrapper">
    <div class="footer__contact">
      <contents-title-component
      :title="messages.SectionTitles.Contact.Main"
      :subTitle="messages.SectionTitles.Contact.Sub"
      color="white"/>

      <div class="footer__contact-lead">
        <p class="footer__contact-text nl2br" v-text="messages.LeadContact"/>
      </div>

      <div class="footer__contact-btn">
        <link-button-component :link="messages.Links.ToContact"/>
      </div>
    </div>

    <!-- sm, tablet -->
    <ul class="footer__accordion">
      <li class="footer__accordion-item" v-for="(link, n) in links" :key="n">
        <accordion-link-component :item="link" color="lightDarkblue"/>
      </li>
    </ul>

    <div class="footer__information">
      <div class="footer__information-logo"/>

      <address>
        <h3 class="footer__information-title">
          <router-link to="/">{{ messages.Information.ClubName }}</router-link>
        </h3>
        <span class="footer__information-item">{{ messages.Information.Address }}</span>
        <a class="footer__information-telephone" :href="`tel:+${telephoneNum}`">
          {{ messages.Information.TelephoneNumber }}
        </a>
        <span class="footer__information-item">{{ messages.Information.MailAddress }}</span>
      </address>

      <div class="footer__scroll-top" id="scrollTarget" @click="scrollTop()" :class="{ 'footer__scroll-top--animation': scrollAnimation }">
        <svg-vue class="footer__scroll-top-icon" icon="angle-up-double"/>
      </div>
    </div>

    <div class="footer__copyright">
      {{ messages.Copyright }}
    </div>
  </footer>
</div>
</template>

<script>
// component import
import AccordionLinkComponent from '../modules/accordion/AccordionLinkComponent.vue';
import LinkButtonComponent from '../modules/button/LinkButtonComponent';
import ContentsTitleComponent from '../modules/ContentsTitleComponent.vue';

// data import
import Data from '../../config/data.json';
import Config from '../../config/config.json';

export default {
  components: {
    ContentsTitleComponent,
    LinkButtonComponent,
    AccordionLinkComponent,
  },

  data() {
    return {
      data: Data,
      config: Config,

      /**
       * リンクデータ
       * @type {Array}
       */
      links: [],

      /**
       * 電話番号のリンク [81-00-0000-0000]
       * @type {Number}
       */
      telephoneNum: '',

      /**
       * スクロールボタンのアニメーションを制御するフラグ
       * @type {Boolean}
       */
      scrollAnimation: false
    }
  },

  beforeMount() {
    const config = this.$data.config;
    const messages = this.$data.messages;

    // リンクデータを生成
    let sitemap = {};
    sitemap.name = messages.sitemap.name;
    sitemap.childrenMenus = this.convertArray(config.route);
    this.links.push(sitemap);

    let externalLink = {};
    externalLink.name = messages.externalLink.name;
    externalLink.childrenMenus = this.convertArray(config.links);
    this.links.push(externalLink);

    /**
     * 電話番号にリンクを貼るため、最初の「0」に [国コード:81] を挿入
     * https://webliker.info/65145/#toc_4
     */
    const phoneNum = this.messages.Information.TelephoneNumber.slice(1);
    const phoneCode = this.messages.Information.PhoneCode;
    const phoneAry = [phoneCode, phoneNum];

    this.telephoneNum = phoneAry.join('-');
  },

  methods: {
    scrollTop() {
      // cssアニメーションを行うため、ボタンにクラスをつける
      this.scrollAnimation = true;

      // css アニメーションが完了次第実行 css fadeout -> .3s
      setTimeout(() => {
        /**
         * ページ最上部までスクロール
         * ! (safari,IE)非対応
         */
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        })

        // アニメーションフラグをデフォルトに戻す
        this.scrollAnimation = false;
      }, 500);
    },

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
.footer {
  color: color(white);
  margin-bottom: 0;

  &-wrap {
    @include gradient(color(deepDarkblue), color(lightDarkblue), horizontal);
    padding-top: interval(5);
    padding-bottom: interval(3);
  }

  &__contact-lead {
    margin-bottom: interval(5);
    text-align: center;
  }

  &__contact-btn {
    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }

  &__accordion {
    margin-top: interval(10);
  }

  &__accordion-item {
    border-top: 2px solid color(lightgray);

    &:last-child {
      border-bottom: 2px solid color(lightgray);
    }
  }

  &__information {
    position: relative;
    margin-top: interval(10);
  }

  &__information-logo {
    pointer-events: none;
    width: interval(18);
    height: 100%;
    opacity: .2;
    @include background-image('/svg/chuo-logo-white.svg');
    position: absolute;
    top: 50%;
    left: interval(2);
    transform: translateY(-50%);
  }

  &__information-title {
    margin-bottom: interval(1);
  }

  &__information-item {
    display: block;
    font-weight: bold;
    line-height: 1.8;
    letter-spacing: 1.2px;
  }

  &__information-telephone {
    @extend .footer__information-item;
    text-decoration: underline;

    @include mq(sm) {
      pointer-events: none;
      text-decoration: none;
    }
  }

  &__scroll-top {
    position: absolute;
    bottom: 0;
    right: 0;
    width: interval(6);
    height: interval(6);
    padding: interval(1);
    border: 1px solid color(white);
    border-radius: radius(circle);
    @include flex(row nowrap, center, center);
    cursor: pointer;
    transition: background-color .3s ease-out;

    @include hover {
      background-color: color(white);

      .footer__scroll-top-icon {
        fill: color(orange);
        color: color(orange);
      }
    }

    &--animation {
      opacity: 0;
    }
  }

  &__scroll-top-icon {
    width: interval(1.5);
    animation: fadeoutTop 1.5s linear infinite;
  }

  &__copyright {
    font-size: font(10);
    text-align: center;
    margin-top: interval(5);
  }
}
</style>
