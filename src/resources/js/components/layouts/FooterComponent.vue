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
      <div class="address__wrap">
        <svg-vue icon="groups" class="address__icon"/>
        <h3 class="address__title"><router-link to="/">{{ messages.Information.ClubName }}</router-link></h3>
      </div>

      <div class="address__wrap">
        <svg-vue icon="place" class="address__icon"/>
        <span>{{ messages.Information.Address }}</span>
      </div>

      <div class="address__wrap">
        <svg-vue icon="phone" class="address__icon"/>
        <a class="address__telephone" :href="`tel:+${telephoneNum}`">
          {{ messages.Information.TelephoneNumber }}
        </a>
      </div>

      <div class="address__wrap">
        <svg-vue icon="mail_outline" class="address__icon"/>
        <span class="address__mail"
          v-clipboard:copy="mail.address"
          v-clipboard:success="successful"
          v-clipboard:error="err">

          {{ mail.address }}

          <transition name="copyComplate">
            <div class="address__copy" v-if="mail.complate">
              <span class="address__copy-message">{{ mail.message }}</span>
            </div>
          </transition>
        </span>
      </div>
    </address>
  </section>

  <section class="footer__copyright">
    {{ messages.Copyright }}
  </section>
</footer>
</template>

<script>
// config
import Config from '../../config/config.json';

// component import
import AccordionLink from '../modules/accordion/AccordionLinkComponent.vue';
import LinkButton from '../modules/button/LinkButtonComponent';
import ContentsTitle from '../modules/ContentsTitleComponent.vue';

export default {
  components: {
    ContentsTitle,
    LinkButton,
    AccordionLink,
  },

  data() {
    return {
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
       * メールアドレス関連データ
       */
      mail: {
        address: '',
        message: '',
        complate: false,
      },
    }
  },

  beforeMount() {
    this.mail.address = this.messages.Information.MailAddress;

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

    /**
     * クリップボードにコピー
     * ライブラリ > vue-clipboard2
     */
    successful() {
      this.mail.complate = true;

      setTimeout(() => {
        this.mail.complate = false;
      }, 1500);

      this.mail.message = 'Copied'
    },

    err() {
      this.mail.message = 'Error'
    }

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
      max-width: interval(50);
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
    margin: interval(5) auto 0 auto;
  }
}

.address {
  &__wrap {
    @include flex(row nowrap, flex-start, center);
    margin-bottom: interval(.5);
    position: relative;

    &:last-child {
      margin-bottom: 0;
    }

    & > span {
      line-height: 1.8;
      letter-spacing: 1.1px;
    }
  }

  &__icon {
    width: interval(2);
    height: interval(2);
    fill: color(darkblue);
    margin-right: interval(1);
  }

  &__title {
    line-height: 2;
  }

  &__telephone {
    font-weight: bold;
    line-height: 1.8;
    letter-spacing: 1.2px;
    text-decoration: underline;

    @include mq(sm) {
      pointer-events: none;
      text-decoration: none;
    }
  }

  &__mail {
    position: relative;
    text-decoration: underline;
    cursor: pointer;
  }

  $size: interval(8);
  &__copy {
    position: absolute;
    top: 0;
    right: 0;
    transform: translate(70%, -100%);

    &-message {
      position: relative;
      display: inline-block;
      width: $size;
      height: $size;
      line-height: $size;
      text-align: center;
      color: color(white);
      background: color(darkblue);
      border-radius: radius(circle);

      &::before {
        content: "";
        position: absolute;
        bottom: - interval(1.5);
        left: - interval(1.5);
        border: interval(2) solid transparent;
        border-left: interval(2) solid color(darkblue);
        transform: rotate(135deg);
      }
    }
  }
}

// transition
.copyComplate {
  &-enter-active,
  &-leave-active {
    transition: opacity .5s;
  }

  &-enter,
  &-leave-to {
    opacity: 0;
  }
}
</style>
