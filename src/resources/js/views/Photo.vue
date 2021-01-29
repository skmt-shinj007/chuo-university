<template>
<div class="photo">
  <!-- フォトギャラリー -->
  <section class="photo__gallery">
    <contents-title-component
      :title="messages.SectionTitles.Photo.Main"
      :subTitle="messages.SectionTitles.Photo.Sub"/>

    <div class="photo__gallery-images">
      <image-lattice-component :images="images" :filter="features.ImageFilter"/>
    </div>
  </section>

  <!-- プロバイダー -->
  <section class="photo__provider">
    <contents-title-component
      :title="messages.SectionTitles.Provider.Main"
      :subTitle="messages.SectionTitles.Provider.Sub"/>

    <div class="photo__provider-ticket-group">
      <div class="photo__provider-ticket" v-for="(provider, n) in providers" :key="n" ref="providerTicket">
        <provider-ticket-component :providerObj="provider"/>
      </div>
      <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
      <div
        class="enpty"
        v-for="n in ticketNumber"
        :key="`enpty-${n}`"
        :style="{ width: `${ticketWidth}px` }"/>
    </div>
  </section>
</div>
</template>

<script>
// component import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent.vue';
import ImageLatticeComponent from '../components/contents/ImageLatticeComponent';
import ProviderTicketComponent from '../components/modules/ticket/ProviderTicketComponent';

// config json import
import Data from '../config/data.json';
import Features from '../config/features.json';

export default {
  components: {
    ContentsTitleComponent,
    ImageLatticeComponent,
    ProviderTicketComponent,
  },
  data() {
    return {
      /**
       * [各データ]
       * @type { object }
       */
      data: Data,
      features: Features,

      /**
       * [イメージデータ]
       * @type { Array }
       */
      images: [],

      /**
       * [写真提供者の情報]
       * @type { Array }
       */
      providers: [],

      /**
       * [チケットの要素数]
       * @type { Number }
       */
      ticketNumber: 0,

      /**
       * [チケットのwidth]
       * @type { Number }
       */
      wicketWidth: 0,
    }
  },

  beforeMount() {
    this.$data.data.ImageApiResponse.forEach(element => this.images.push(element));
    this.$data.data.Provider.forEach(element => this.providers.push(element));
  },

  mounted() {
    /**
     * [チケットの配置を左揃えするための処理]
     * 同一の処理 -> Member.vue 参照
     */
    const ticket = this.$refs.providerTicket;

    // チケットの要素数を取得 (チケットが一枚の時はenpty要素を増やさない)
    if(ticket.length > 1) this.ticketNumber = ticket.length;

    // チケットのwidthを取得
    this.getTicketWidth();
    window.addEventListener('resize', this.getTicketWidth);
  },

  methods: {
    /**
     * [チケットの幅を変数にぶち込む]
     * リサイズイベントに登録するため、メソッドにする。
     */
    getTicketWidth() {
      this.ticketWidth = this.$refs.providerTicket[0].offsetWidth;
    },
  },

  beforeDestroy() {
    // 登録したイベントを破棄
    window.romoveEventListener('resize', this.getTicketWidth);
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

  &__provider-ticket-group {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      @include flex(row wrap, center, center);
    }
  }

  &__provider-ticket {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin-bottom: 0;
      padding: interval(1);
    }
  }
}
</style>
