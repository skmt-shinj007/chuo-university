<template>
<footer class="footer">

  <section class="footer__contact">
    <contents-title :title="messages.SectionTitles.Contact"/>

    <div class="footer__contact-lead">
      <p class="footer__contact-text nl2br" v-text="messages.LeadContact"/>
    </div>

    <div class="footer__contact-btn">
      <link-button :link="messages.Links.ToContact"/>
    </div>
  </section>

  <section class="footer__accordion">
    <ul class="footer__list">
      <li class="footer__list-item" v-for="(link, n) in links" :key="n">
        <accordion-link :item="link" color="darkblue"/>
      </li>
    </ul>
  </section>

  <section class="footer__address">
    <address>
      <h3 class="address__title">
        <router-link to="/">{{ messages.Information.ClubName }}</router-link>
      </h3>

      <span class="address__item">{{ messages.Information.Address }}</span>

      <a class="address__telephone" :href="`tel:+${telephoneNum}`">
        {{ messages.Information.TelephoneNumber }}
      </a>

      <span class="address__item">{{ messages.Information.MailAddress }}</span>
    </address>
  </section>

  <section class="footer__copyright">
    {{ messages.Copyright }}
  </section>
</footer>
</template>

<script>
// component import
import AccordionLink from '../modules/accordion/AccordionLinkComponent.vue';
import LinkButton from '../modules/button/LinkButtonComponent';
import ContentsTitle from '../modules/ContentsTitleComponent.vue';

// data import
import Data from '../../config/data.json';
import Config from '../../config/config.json';

export default {
  components: {
    ContentsTitle,
    LinkButton,
    AccordionLink,
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
  margin-bottom: 0;
  padding-top: interval(5);
  padding-bottom: interval(3);
  background-color: color(lightgray);

  &__contact-lead {
    margin-bottom: interval(5);
    text-align: center;
  }

  &__contact-btn {
    @include mq(sm) {
      max-width: 60%;
      margin: 0 auto;
    }
  }

  &__list {
    margin-top: interval(10);
  }

  &__list-item {
    border-top: 2px solid color(darkblue);

    &:last-child {
      border-bottom: 2px solid color(darkblue);
    }
  }

  &__address {
    position: relative;
    margin-bottom: 0;
  }

  &__copyright {
    font-size: font(10);
    text-align: center;
    margin: interval(3) auto 0 auto;
  }
}

.address {
  &__title {
    line-height: 2;
  }

  &__item {
    display: block;
    font-weight: bold;
    line-height: 1.8;
    letter-spacing: 1.2px;
  }

  &__telephone {
    @extend .address__item;
    text-decoration: underline;

    @include mq(sm) {
      pointer-events: none;
      text-decoration: none;
    }
  }
}
</style>
