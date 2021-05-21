<template>
<div class="images">

  <!-- フィルター機能 -->
  <div class="images__filter">
    <span class="images__filter-name">{{ messages.FunctionName.Filter }}</span>
    <pull-down-table :settings="messages.yearFilter" :menus="menus" @select="select = $event"/>
  </div>

  <!-- 写真 -->
  <transition name="fade" appear>
    <div class="images__group">
      <div class="images__box" v-for="image in cutLists" :key="image.id">
        <figure class="images__img">
          <img :src="`/image/${image.src}`" :alt="image.alt" @click="openModal(image)">
        </figure>
      </div>
    </div>
  </transition>

  <!-- 写真クリック後のモーダル -->
  <image-modal
    v-if="showModal"
    @close="closeModal"
    :selectIndex="index"
    :images="filtering"/>

  <!-- もっと見るボタン -->
  <div class="images__button" v-if="buttonShow">
    <view-all-button :clickEvent="viewMore"/>
  </div>

</div>
</template>

<script>
// component import
import ViewAllButton from '../modules/button/ViewAllButtonComponent';
import PullDownTable from '../modules/table/PullDownTableComponent';
import ImageModal from '../modules/modal/ImageModalComponent';

export default {
  components: {
    ViewAllButton,
    PullDownTable,
    ImageModal,
  },

  data() {
    return {
      /**
       * 絞り込みのメニュー
       * @type { Array }
       */
      menus: [],

      /**
       * 絞り込みの選択値
       * @default all
       * @type { String }
       */
      select: "all",

      /**
       * イメージの表示枚数を管理
       * TODO:デフォルト枚数を変更
       * @type { Number }
       */
      count: {
        default: 10,
        current: 0,
      },

      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * [選択した画像のインデックス番号]
       * @type { Number }
       */
      index: null,
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
     * [絞り込みメニュー生成]
     * 1:撮影年を抽出
     * 2:メニューデータの重複した値を削除
     */
    this.images.forEach(element => this.menus.push(element.shooting.year));
    this.menus = Array.from(new Set(this.menus));

    /**
     * 初期描画時のリスト表示枚数を代入
     */
    this.count.current = this.count.default;
  },

  computed: {
    /**
     * フィルタリング
     * @return 絞り込みの値によってimagesをフィルタリングした配列を返す
     */
    filtering() {
      if (this.select !== "all") {
        let selected = this.select;

        // 絞り込み -> 選択した年と撮影年が合致する写真を返す。
        let images = this.images.filter((value) => {
          return (value.shooting.year === selected)
        });
        return images;
      }
      return this.images;
    },

    /**
     * [表示枚数制御]
     * フィルタリング処理後の配列を count.currentを参照して切り取る。
     */
    cutLists() {
      return this.filtering.slice(0, this.count.current);
    },

    /**
     * [ボタン表示制御] 処理
     */
    buttonShow() {
      return (this.filtering.length > this.count.current) ? true : false;
    }
  },

  methods: {
    // ボタンクリック後に表示枚数を増やす
    viewMore() {
      return this.count.current += 12;
    },

    /**
     * [モーダル表示切り替え]
     */
    openModal(el) {
      this.showModal = true;
      this.index = this.filtering.indexOf(el);
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
     * 絞り込み後のリスト表示枚数をデフォ値にリセット
     */
    select() {
      this.count.current = this.count.default;
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
    @include flex(row wrap, flex-start, center);
    margin-top: interval(5);

    @include mq(sm) {
      @include flex(row wrap);
    }
  }

  &__box {
    width: calc(100% / 2);

    @include mq(md) {
      width: calc(100% / 3);
    }

    @include mq(lg) {
      width: calc(100% / 4);
    }
  }

  &__img {
    @include trimming(aspect(square));
    transition: all .3s ease-out;

    & > img {
      border: 1px solid color(white);
      border-radius: radius(soft);
      cursor: pointer;
    }

    @include hover {
      transform: scale(.95);
    }
  }

  &__button {
    margin-top: interval(5);
  }
}

.fade {
  &-enter-active {
    transition:
      1.5s opacity cubic-bezier(0.39, 0.575, 0.565, 1),
      1.8s transform cubic-bezier(0.39, 0.575, 0.565, 1);
  }

  &-enter {
    transform: translate3d(0, 10px, 0);
    opacity: 0;
  }
}
</style>
