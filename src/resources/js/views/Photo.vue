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
      <div class="ticket" v-for="(provider, n) in providers" :key="n" ref="providerTicket" @click="openModal(provider)">
        <provider-ticket :providerObj="provider"/>
      </div>
      <!-- 左寄せに並べたいので空の要素をチケット分追加 -->
      <div
        class="enpty"
        v-for="n in ticket.number"
        :key="`enpty-${n}`"
        :style="{ width: `${ticket.width}px` }"
      />
    </div>

    <!-- モーダル -->
    <user-modal v-if="modal.show" @close="closeModal" :item="modal.element">
      <template v-slot:content>
        <div class="provider">
          <!-- TODO:ここに出すコンテンツを考える。 -->
          ここに出すコンテンツを考える。
        </div>
      </template>
    </user-modal>
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
import UserModal from '../components/modules/modal/UserModalComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

export default {
  components: {
    ContentsTitle,
    Images,
    UserModal,
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
       * [写真提供者の情報]
       * @type { Array }
       */
      providers: [],

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
       * modalデータ
       * show: @type { Boolean }
       * element: @type { Object }
       */
      modal: {
        show: false,
        element: null
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

  beforeMount() {
    this.$data.data.ImageApiResponse.forEach(element => this.images.push(element));
    this.$data.data.Provider.forEach(element => this.providers.push(element));
  },

  mounted() {
    // Api叩く
    this.getProvider();

    /**
     * [チケットの配置を左揃えするための処理]
     */
    const ticket = this.$refs.providerTicket;
    // チケットの要素数を取得 (チケットが一枚の時はenpty要素を増やさない)
    if(ticket.length > 1) this.ticket.number = ticket.length;
    this.getTicketWidth();
  },

  methods: {
    /**
     * [チケットの幅を変数に格納]
     * リサイズイベントに登録するため、メソッドにする。
     */
    getTicketWidth() {
      this.ticket.width = this.$refs.providerTicket[0].offsetWidth;
    },

    /**
     * [モーダル開閉処理]
     */
    openModal(el) {
      this.modal.show = true;
      this.modal.element = el;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.modal.show = false;
      document.body.classList.remove("modal-open");
    },

    // Twitter Apiからデータを取得
    async getProvider() {
      const response = await Twitter.getResponse('/api/twitter/provider');

      // 予期しない型が返却された場合
      if (!response || !Array.isArray(response.data)) {
        this.provider.err = true;
        return
      }

      this.provider.response = response.data;
    }
  },

  watch: {
    windowWidth() {
      this.getTicketWidth();
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
