<template>
<div class="photo">
  <section class="photo__gallery section-container">
    <contents-title-component
      :title="messages.SectionTitles.Photo.Main"
      :subTitle="messages.SectionTitles.Photo.Sub"/>

    <image-lattice-component :images="images"/>
  </section>
</div>
</template>

<script>
// component import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent.vue';
import ImageLatticeComponent from '../components/contents/ImageLatticeComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    ContentsTitleComponent,
    ImageLatticeComponent,
  },
  data() {
    return {
      data: Data,
      images: [],
    }
  },
  beforeMount() {
    this.$data.data.ImageApiResponse.forEach(element => this.images.push(element));
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
// .photo {

// }
</style>
