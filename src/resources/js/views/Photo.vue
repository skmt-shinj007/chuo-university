<template>
<div class="photo">
  <!-- フォトギャラリー -->
  <section class="photo__gallery">
    <contents-title :title="messages.SectionTitles.Photo"/>
    <images :images="images"/>
  </section>

  <!-- プロバイダー -->
  <section class="photo__provider">
    <contents-title :title="messages.SectionTitles.Provider"/>
    <transition-group
      class="photo__ticket-group"
      name="ticket"
      tag="div"
      @before-enter="delay"
      @after-enter="cancelDelay"
      >

      <div class="photo__ticket" v-for="(provider, i) in provider.response" :key="provider.id" :data-index="i">
        <provider-ticket :provider="provider"/>
      </div>
    </transition-group>
  </section>

  <div class="photo__scroll-top">
    <scroll-top-button/>
  </div>
</div>
</template>

<script>
// config json import
import Mock from '../config/data/mock.json';
import Api from '../api/index';
import Animation from '../config/animation';

// component import
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import Images from '../components/contents/ImagesComponent';
import ProviderTicket from '../components/modules/ticket/ProviderTicketComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

export default {
  components: {
    ContentsTitle,
    Images,
    ProviderTicket,
    ScrollTopButton,
  },

  mixins: [Animation],

  data() {
    return {
      /**
       * [各データ]
       * @type { object }
       */
      mock: Mock,

      /**
       * [イメージデータ]
       * @type { Array }
       */
      images: [],

      /**
       * providerの情報
       * response : @type { Object }
       * err      : @type { Boolean }
       */
      provider: {
        response: null,
        err: false,
      }
    }
  },

  created() {
    this.getProvider();
    this.$data.mock.ImageApiResponse.forEach(element => this.images.push(element));
  },

  methods: {
    // Twitter Apiからデータを取得
    async getProvider() {
      const response = await Api.getResponse('/twitter/provider');

      // 予期しない型が返却された場合
      if (!response || !Array.isArray(response)) {
        this.provider.err = true;
        throw new Error('予期しないデータ型で返却されました。');
      }
      this.provider.response = response;
    },

    /**
     * transition methods
     */
    delay(el) {
      el.style.transitionDelay = 120 * parseInt(el.dataset.index, 10) + 'ms';
    },
    cancelDelay(el) {
      el.style.transitionDelay = '';
    }
  },
}

/**
 * imageApiResponseの想定データ
 * 写真の並び替えも行いたいので、撮影時期や大会名もデータとして持っておきたい。
 *
 * {
      "src": "player01.jpg",   （ここの値はデータを表示できればOK。ストレージAPIならファイル名かな？）
      "alt": "宮崎 悠登",        (テキストを写真に紐付けて格納できるかが不明。)
      "addDate": "2020.11.20",  (写真をストレージに格納した日付)
      "shooting": {
        "competition": "2018年関東春季リーグ戦",  (撮影時の大会)
        "year": 2018  (撮影時の年)
      }
    },
 */

</script>

<style lang="scss" scoped>
.photo {
  &__gallery {
    margin-top: interval(5);

    @include mq(md) {
      margin-top: 0;
    }
  }

  &__ticket-group {
    @include flex(column nowrap, center, center);
    max-width: pixel(50);
    margin: 0 auto;

    @include mq(sm) {
      @include flex(row wrap);
      max-width: none;
    }
  }

  // カード幅の計算に使うために変数に格納
  $card-margin: interval(.5);

  &__ticket {
    padding: interval(1);
    margin: $card-margin;
    width: 100%;

    @include mq(sm) {
      width: calc((100% / 2) - (#{$card-margin} * 2));
    }

    @include mq(md) {
      width: calc((100% / 3) - (#{$card-margin} * 2));
    }

    @include mq(lg) {
      width: calc((100% / 4) - (#{$card-margin} * 2));
    }
  }

  &__scroll-top {
    @include scroll-top();
  }
}

// チケットの表示アニメーション
.ticket {
  &-enter-active {
    transition: opacity .5s;
  }

  &-enter {
    opacity: 0;
  }
}
</style>
