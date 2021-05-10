<template>
<div class="photo">
  <!-- フォトギャラリー -->
  <section class="photo__gallery">
    <contents-title :title="messages.SectionTitles.Photo"/>

    <images :images="images" :filter="config.filter"/>
  </section>

  <!-- プロバイダー -->
  <section class="photo__provider">
    <contents-title :title="messages.SectionTitles.Provider"/>

    <div class="ticket-group">
      <div class="ticket" v-for="(provider, n) in provider.response" :key="n" ref="providerTicket">
        <provider-ticket :provider="provider"/>
      </div>
      <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
      <div
        class="empty"
        v-for="n in ticket.number"
        :key="`empty-${n}`"
        :style="{ width: `${ticket.width}px` }"
      />
    </div>

  </section>

  <div class="photo__scroll-top">
    <scroll-top-button/>
  </div>
</div>
</template>

<script>
// config json import
import Data from '../config/data.json';
import Config from '../config/config.json';
import Twitter from '../config/api/twitter/index';

// mixin
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
      data: Data,
      config: Config,

      /**
       * [イメージデータ]
       * @type { Array }
       */
      images: [],

      /**
       * [チケット]
       * width, 個数
       * @type { Number }
       */
      ticket: {
        width: 0,
        number: 0,
      },

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
    this.$data.data.ImageApiResponse.forEach(element => this.images.push(element));
  },

  /**
   * TODO:改修が必要。
   * APIの返却値で構成しているチケットの幅が読み取れない。
   * チケットは、APIが返却され次第レンダリングが実行されるので、幅や個数の初期値が設定できない。
   * そもそもの配置（CSS）から考える必要がある。
   */
  updated() {
    this.$nextTick(function () {
      if (this.$refs.providerTicket !== undefined) {
        this.setEmptyTicketData();
      }
    })
  },

  methods: {
    /**
     * 空要素を生成するデータを格納。
     * チケットの並びを左揃えにするために追加。
     */
    setEmptyTicketData() {
      const ticket = this.$refs.providerTicket;
      if(ticket.length > 1) {
        this.ticket.number = ticket.length;
        this.ticket.width = this.$refs.providerTicket[0].offsetWidth;
      }
    },

    // Twitter Apiからデータを取得
    async getProvider() {
      const response = await Twitter.getResponse('/api/twitter/provider');

      // 予期しない型が返却された場合
      if (!response || !Array.isArray(response)) {
        this.provider.err = true;
        throw new Error('予期しないデータ型で返却されました。');
      }
      this.provider.response = response;
    }
  },

  watch: {
    windowWidth() {
      if (this.ticket.width) {
        console.log(this.ticket.width);
        this.ticket.width = this.$refs.providerTicket[0].offsetWidth;
      }
    },
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

  &__scroll-top {
    @include scroll-top();
  }
}

.ticket-group {
  @include flex(column nowrap, center, center);

  @include mq(sm) {
    @include flex(row wrap, center, center);
  }
}

.ticket {
  margin-bottom: interval(5);

  @include mq(sm) {
    margin-bottom: 0;
    padding: interval(1);
  }
}
</style>
