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
      <div class="photo__provider-ticket" v-for="(provider, n) in providers" :key="n">
        <provider-ticket-component :providerObj="provider"/>
      </div>
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
      data: Data,
      features: Features,
      images: [],
      providers: [],
    }
  },
  beforeMount() {
    this.$data.data.ImageApiResponse.forEach(element => this.images.push(element));
    this.$data.data.Provider.forEach(element => this.providers.push(element));
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

  &__gallery-images {
    margin-bottom: interval(10);
  }

  &__provider-ticket-group {
    // padding: interval(2);

    @include mq(md) {
      @include flex(row wrap, flex-start, center);
    }
  }

  &__provider-ticket {
    max-width: interval(50);
    margin: 0 auto;
    margin-bottom: interval(5);

    &:last-child {
      margin-bottom: 0;
    }

    @include mq(md) {
      margin: 0;
      width: calc(100% / 3);
      padding: interval(1);
      max-width: none;
    }
  }

}
</style>
