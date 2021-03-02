<template>
<div class="images">

  <!-- フィルター機能 -->
  <div class="images__filter">
    <span class="images__filter-name">{{ messages.FunctionName.Filter }}</span>

    <pull-down-table-component :titles="filter.year" :menus="years" @select="select = $event"/>
  </div>

  <!-- 写真 -->
  <div class="images__group">
    <div class="images__box" v-for="(image,n) in displayImages" :key="n">
      <figure class="images__img">
        <img :src="`/image/${image.src}`" :alt="image.alt" @click="openModal(image)">
      </figure>
    </div>
  </div>

  <!-- 写真クリック後のモーダル -->
  <image-modal-component
    v-if="showModal"
    @close="closeModal"
    :selectIndex="selectImageIndex"
    :images="filterImages"/>

  <!-- もっと見るボタン -->
  <div class="images__button" v-if="buttonShow">
    <view-all-button-component :clickEvent="viewMore"/>
  </div>

</div>
</template>

<script>
// component import
import ViewAllButtonComponent from '../modules/button/ViewAllButtonComponent';
import PullDownTableComponent from '../modules/table/PullDownTableComponent';
import ImageModalComponent from '../modules/modal/ImageModalComponent';

export default {
  components: {
    ViewAllButtonComponent,
    PullDownTableComponent,
    ImageModalComponent,
  },

  data() {
    return {
      years: [],        // 撮影年の配列（プルダウンのメニューになる）
      select: "all", // 絞り込みの選択値
      count: 0,         // イメージの表示枚数（こいつで表示枚数を管理する）
      // TODO：初期表示枚数の値を変更
      defaultCountNumber: 10, // イメージ表示枚数のデフォルト値

      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * [選択した画像のインデックス番号]
       * @type { Number }
       */
      selectImageIndex: null,
    }
  },

  props: {
    /**
     * 写真データが格納されている配列。
     * この配列をフィルタリングしたり、ソートしたりする。
     */
    images: {
      type: Array,
      default: null
    },

    /**
     * 各絞り込みの情報（絞り込みメニューのタイトルなど）
     */
    filter: {
      type: Object,
      default: null
    }
  },

  beforeMount() {
    /**
     * [images配列を降順でソート]
     * フォトギャラリーは新しい写真から表示させる。
     * 比較対象は、shooting.yearプロパティ (撮影年)
     * @param1 配列の要素 比較対象 1つ目
     * @param2 配列の要素 比較対象 2つ目
     */
    this.images.sort( function(firstEl,secondEl) {
      if (firstEl.shooting.year > secondEl.shooting.year) return -1;
      if(firstEl.shooting.year < secondEl.shooting.year) return 1;
      return 0;
    });

    /**
     * [years配列を生成]
     * フィルター機能のプルダウンで使用するメニュー
     * 1:撮影年を写真のデータから抽出して years 配列にセット
     * 2:years配列の重複した値を削除
     */
    this.images.forEach(element => this.years.push(element.shooting.year));
    this.years = Array.from(new Set(this.years));

    /**
     * イメージの表示枚数はcountで管理するので、初期表示枚数をcountに代入
     */
    this.count = this.defaultCountNumber;
  },

  computed: {
    /**
     * [絞り込み機能] 処理
     * 返り値 => 絞り込みの値によってimages配列をフィルタリングした配列を返す
     * [表示枚数制御]と処理を切り分け => フィルタリングされた配列の要素数を使用するため。
     */
    filterImages() {
      if (this.select !== "all") {

        // 絞り込みの選択値を変数に代入
        let selected = this.select;

        // 絞り込み -> フィルタリングされた配列を count の数だけ返す。 -> dataに定義
        return this.images.filter( function(value) {
          return value.shooting.year === selected;
        });

      } else {
        // 絞り込まない -> フィルタリングされていない配列を count の数だけ返す。
        return this.images;
      }
    },

    /**
     * [表示枚数制御]
     * フィルタリング処理後の配列を count プロパティを参照して切り取る。
     * filterImagesで返された配列をcount数で切り取っているだけ。
     */
    displayImages() {
      return this.filterImages.slice(0, this.count);
    },

    /**
     * [ボタン表示制御] 処理
     * this.filterImages.length：写真データの最大要素数
     * this.count：表示枚数
     */
    buttonShow() {
      if (this.filterImages.length > this.count) {
        return true;
      } else {
        return false;
      }
    }
  },

  methods: {
    // もっと見るボタンのクリックイベント
    viewMore() {
      // TODO：ボタンクリック時に増やす枚数を変更
      return this.count += 1;
    },

    /**
     * [モーダル表示切り替え]
     */
    openModal(el) {
      this.showModal = true;

      this.selectImageIndex = this.filterImages.indexOf(el);
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.showModal = false;
      setTimeout(() => {
        document.body.classList.remove("modal-open");
      }, 500);
    },
  },

  watch: {
    /**
     * [count初期化]
     * プルダウンの選択値が切り替わる時に発火。
     */
    select() {
      this.count = this.defaultCountNumber;
    }
  }
}
</script>

<style lang="scss" scoped>
.images {

  &__filter {
    @include flex(column nowrap, center, stretch);

    @include mq(sm) {
      justify-content: center;
      width: 100%;
      padding: 0 pixel(1);
    }

    @include mq(md) {
      width: 70%;
    }
  }

  &__filter-name {
    margin-bottom: interval(2);
    font-size: font(16);
    @include middle-line-text(2, 1px, color(darkblue));
  }

  &__group {
    @include flex(column nowrap, center, center);
    margin-top: interval(5);

    @include mq(sm) {
      @include flex(row wrap);
    }
  }

  &__box {
    width: 100%;
    margin-bottom: interval(5);

    &:last-child {
      margin-bottom: 0;
    }

    @include mq(sm) {
      margin-bottom: 0;
      padding: pixel(1);
      width: calc(100% / 2);
    }

    @include mq(md) {
      width: calc(100% / 3);
    }
  }

  &__img {
    @include trimming(aspect(square));
    transition: all .3s ease-out;

    & > img {
      box-shadow: 0 0 10px 2px color(shadow);
      border-radius: radius(soft);
      cursor: pointer;
    }

    @include hover {
      transform: scale(1.05);
    }
  }

  &__button {
    margin-top: interval(5);
  }
}
</style>
