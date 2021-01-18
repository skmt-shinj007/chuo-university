<template>
<div class="footer-wrap">
  <footer class="footer">
    <div class="footer__contact">
      <contents-title-component
      :title="messages.SectionTitles.Contact.Main"
      :subTitle="messages.SectionTitles.Contact.Sub"
      color="white"/>

      <div class="footer__contact-lead">
        <p class="footer__contact-text nl2br" v-text="messages.Footer.LeadContact"/>
      </div>

      <div class="footer__contact-btn">
        <primary-button-component :name="messages.ButtonName.ToContact"/>
      </div>
    </div>

    <!-- sm, tablet -->
    <ul class="footer__accordion-menu">
      <li class="footer__accordion-menu-item" v-for="(link, n) in links" :key="n">
        <accordion-link-component :item="link"/>
      </li>
    </ul>

    <!-- pc -->
    <div class="footer__menu" v-for="(link, n) in links" :key="n">
      <h4 class="footer__menu-list-title">{{ link.menuName }}</h4>
      <ul class="footer__menu-list">
        <li class="footer__menu-list-item" :class="`footer__menu-list-item--${menuClass[n]}`"
            v-for="(menu, i) in link.childrenMenus"
            :key="i">

          <router-link class="footer__menu-list-link" :to="menu.link" v-if="!link.blank">
            <svg-vue class="footer__menu-list-icon" icon="angle-right"/>
            <label class="footer__menu-list-label">{{ menu.label }}</label>
          </router-link>

          <a class="footer__menu-list-link" :href="menu.link" v-else>
            <svg-vue class="footer__menu-list-icon" icon="angle-right"/>
            <label class="footer__menu-list-label">{{ menu.label }}</label>
          </a>
        </li>
      </ul>
    </div>

    <div class="footer__information">
      <svg-vue class="footer__information-logo" icon="chuo-logo"/>

      <address>
        <h4 class="footer__information-title">{{ messages.Information.ClubName }}</h4>
        <span class="footer__information-item">{{ messages.Information.Address }}</span>
        <a class="footer__information-item footer__information-telephone" :href="`tel:+${telephoneNum}`">
          {{ messages.Information.TelephoneNumber }}
        </a>
        <span class="footer__information-item">{{ messages.Information.MailAddress }}</span>
      </address>

      <div class="footer__scroll-top" id="scrollTarget" @click="scrollTop()" :class="{ 'footer__scroll-top--animation': scrollAnimation }">
        <svg-vue class="footer__scroll-top-icon" icon="angle-up-double"/>
      </div>
    </div>

    <div class="footer__copyright">
      {{ messages.Footer.Copyright }}
    </div>
  </footer>
</div>
</template>

<script>
// component import
import AccordionLinkComponent from '../modules/accordion/AccordionLinkComponent.vue';
import PrimaryButtonComponent from '../modules/button/PrimaryButtonComponent.vue';
import ContentsTitleComponent from '../modules/ContentsTitleComponent.vue';

// data import
import Data from '../../config/data.json';
import Features from '../../config/features.json';

export default {
  components: {
    ContentsTitleComponent,
    PrimaryButtonComponent,
    AccordionLinkComponent,
  },

  data() {
    return {
      data: Data,
      features: Features,

      /**
       * footer linkの全データ
       * features.json > FooterLinksのデータを取得
       */
      links: [],

      /**
       * links配列のmenuNameを取得。
       * メニューアイテムの幅を個別に変更するため、クラスにつける文字列を配列で格納
       */
      menuClass: [],

      /**
       * 電話番号のリンク [81-00-0000-0000]
       */
      telephoneNum: '',

      /**
       * スクロールボタンのアニメーションを制御するフラグ
       */
      scrollAnimation: false
    }
  },

  beforeMount() {
    // フッターリンクの配列を[features.json]を元に生成
    this.$data.features.FooterLinks.forEach(element => this.links.push(element));

    // メニューアイテムに付与するclass名を生成 (links > menuName参照)
    this.links.forEach(element => {
      this.menuClass.push(element.menuName.replace(" ", "-").toLowerCase());
    })

    /**
     * メニュー配列のバリデーションを設定 (テスト的な処理)
     * -> 同タブか別タブかを判定するプロパティ [blank]
     */
    this.links.forEach(element => {
      if (!element.hasOwnProperty('blank')) {
        alert('メニューを生成している配列に [blank] プロパティを設定してください。')
      }
    });

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
    }
  },
}
</script>

<style lang="scss" scoped>
.footer {
  padding: 0 interval(2);
  max-width: device(max);
  margin: 0 auto;
  color: color(white);

  &-wrap {
    @include gradient(color(deepDarkblue), color(lightDarkblue), horizontal);
    padding-top: interval(10);
    padding-bottom: interval(3);
  }

  &__contact-lead {
    max-width: interval(40);
    margin: 0 auto;

    @include mq(sm) {
      max-width: none;
      text-align: center;
    }
  }

  &__contact-btn {
    margin-top: interval(5);
  }

  &__accordion-menu {
    margin-top: interval(10);

    // pc アコーディオンを非表示にする
    @include mq(md) {
      display: none;
    }
  }

  &__accordion-menu-item {
    border-top: 2px solid color(lightgray);

    &:last-child {
      border-bottom: 2px solid color(lightgray);
    }
  }

  &__menu {
    display: none;

    @include mq(md) {
      display: block;
      margin-top: interval(10);
    }
  }

  &__menu-list {
    margin-top: interval(2);
    padding: 0 interval(2);
    @include flex(row wrap, flex-start, center);

    &-title {
      @include bangers(font(heading), 2.5px);
    }

    &-item {
      padding: interval(1);
      cursor: pointer;

      @include hover {
        .footer__menu-list-label {
          text-shadow: 1px 1px color(orange);
        }

        .footer__menu-list-link {
          transform: translateX(interval(2));
        }
      }

      &--site-map {
        width: calc(100% / 4);
      }

      &--external-link {
        width: calc(100% / 3);
      }
    }

    &-link {
      @include flex(row nowrap, flex-start, center);
      cursor: pointer;
      transition: all .3s ease-out;
    }

    &-icon {
      width: interval(1);
      margin-right: interval(.5);
      cursor: pointer;
    }

    &-label {
      font-size: font(md);
      cursor: pointer;
    }

  }

  &__information {
    position: relative;
    margin-top: interval(10);
  }

  &__information-logo {
    width: interval(18);
    opacity: .2;
    fill: color(white);
    position: absolute;
    top: 50%;
    left: interval(2);
    transform: translateY(-50%);

    @include mq(sm) {
      width: interval(20);
    }
  }

  &__information-title {
    margin-bottom: interval(1);
  }

  &__information-item {
    display: block;
    font-weight: bold;
    line-height: 1.8;
    letter-spacing: 1.2px;

    @include mq(sm) {
      font-size: font(base);
    }
  }

  &__information-telephone {
    text-decoration: underline;

    @include mq(sm) {
      pointer-events: none;
      text-decoration: underline;
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
    transition: all .3s ease-out;

    &--animation {
      opacity: 0;
    }
  }

  &__scroll-top-icon {
    width: interval(1.5);
    animation: fadeoutTop 1.5s linear infinite;
  }

  &__copyright {
    font-size: font(xs);
    text-align: center;
    margin-top: interval(5);
  }
}
</style>
