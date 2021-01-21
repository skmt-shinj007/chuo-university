<template>
<div class="lattice">

  <!-- フィルター機能 -->
  <div class="lattice__filter">
    <span class="lattice__filter-title">{{ messages.FunctionName.Filter }}</span>

    <pull-down-table-component
      :filterItem="filter.year"
      :pulldownMenus="years"
      @select="select = $event"/>
  </div>

  <!-- 写真 -->
  <div class="lattice__item-wrap">
    <div class="lattice__item" v-for="(image,n) in displayImages" :key="n">
      <figure class="lattice__img-wrap">
        <img class="lattice__img" :src="`/image/${image.src}`" :alt="image.alt" @click="modalOpen">
      </figure>
    </div>
  </div>

  <!-- 写真クリック後のモーダル -->
  <modal-frame-component v-if="showModal" @close="modalClose">
    <template v-slot:contents>
      <div class="image-modal">

        <header class="image-modal__header">
          <button class="image-modal__close-btn" @click="modalClose">
            <i class="image-modal__close-btn-line"/>
          </button>
        </header>

        <figure class="image-modal__img-wrap">
          <img class="image-modal__img" src="/image/group-photo_toutoSpring2018-02.jpg" alt="">
        </figure>

        <footer class="image-modal__footer">
          <div class="image-modal__btn-area">
            <button class="image-modal__prev-btn">
              <svg-vue icon="arrow-left" class="image-modal__icon"/>
            </button>
          </div>

          <span class="image-modal__border"></span>

          <div class="image-modal__btn-area">
            <button class="image-modal__next-btn">
              <svg-vue icon="arrow-right" class="image-modal__icon"/>
            </button>
          </div>
        </footer>

      </div>
    </template>
  </modal-frame-component>

  <!-- もっと見るボタン -->
  <div class="lattice__view-all" v-if="buttonShow">
    <view-all-button-component :clickEvent="viewMore"/>
  </div>

</div>
</template>

<script>
// component import
import ViewAllButtonComponent from '../modules/button/ViewAllButtonComponent';
import PullDownTableComponent from '../modules/table/PullDownTableComponent';
import ModalFrameComponent from '../modules/modal/ModalFrameComponent';

export default {
  components: {
    ViewAllButtonComponent,
    PullDownTableComponent,
    ModalFrameComponent,
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
      showModal: true,
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
    filteringImages() {
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
     */
    displayImages() {
      return this.filteringImages.slice(0, this.count);
    },

    /**
     * [ボタン表示制御] 処理
     * this.filteringImages.length：写真データの最大要素数
     * this.count：表示枚数
     */
    buttonShow() {
      if (this.filteringImages.length > this.count) {
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
    modalOpen() {
      this.showModal = true;
    },
    modalClose() {
      this.showModal = false;
    }
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
.lattice {

  &__filter {
    @include flex(column nowrap, center, stretch);
    margin: 0 0 interval(3) 0;

    @include mq(sm) {
      justify-content: center;
      padding: 0 interval(1);
      width: 100%;
    }

    @include mq(md) {
      width: 50%;
    }
  }

  &__filter-title {
    margin-bottom: interval(2);
    font-size: font(base);
    @include middle-line-text(2, 1px, color(darkblue));
  }

  &__filter-wrap {
    @include flex(row nowrap, flex-start, center);
    width: 100%;
  }

  &__item-wrap {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      @include flex(row wrap);
    }
  }

  &__item {
    width: 100%;
    margin-bottom: interval(10);

    @include mq(sm) {
      margin-bottom: 0;
      width: calc(100% / 2);
      padding: interval(1);
    }

    @include mq(md) {
      width: calc(100% / 3);
    }

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__img-wrap {
    @include trimming(aspect(square));
  }

  &__img {
    box-shadow: 0 0 10px 2px color(shadow);
    border-radius: radius(soft);
    transition: all .3s ease-out;

    @include hover {
      transform: scale(1.05);
    }

    @include mq(md) {
      cursor: pointer;
    }
  }
}

.image-modal {
  width: 100%;
  height: 100%;
  @include flex(column nowrap, center, center);

  &__header {
    @include flex(row nowrap, flex-end, center);
    padding: 0 interval(2);
    position: fixed;
    top: interval(2);
  }

  &__close-btn {
    @include close-button(interval(5));
  }

  &__img-wrap {
    @include flex(column nowrap, center, center);
    width: 100%;
    max-height: 100%;
    padding: interval(5) 0;

    @include mq(sm) {
      width: 90%;
    }

    @include mq(md) {
      width: 80%;
    }
  }

  &__img {
    width: 100%;
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    box-shadow: 0 0 15px 1px color(darkShadow);
  }

  &__footer {
    width: 100%;
    padding: 0 interval(2);
    position: fixed;
    bottom: interval(5);
    @include flex(row nowrap, space-between, center);
  }

  &__btn-area {
    padding: interval(1);
  }

  %btn {
    position: relative;
    width: interval(5);
    height: interval(5);
    border-radius: radius(circle);
    border: 1px solid color(white);
    @include flex(row nowrap, center, center);

    &::before {
      width: 150%;
      text-align: center;
      font-size: font(xs);
      display: block;
      color: color(white);
      position: absolute;
      bottom: - 60%;
      left: 50%;
      transform: translateX(-50%);
    }
  }

  &__prev-btn {
    @extend %btn;

    &::before {
      content: '前へ';
    }
  }

  &__next-btn {
    @extend %btn;

    &::before {
      content: '次へ';
    }
  }

  &__icon {
    width: interval(1.5);
    color: color(white);
    fill: color(white);
  }

  &__border {
    display: block;
    width: 50%;
    height: 1px;
    background-color: color(white);

    @include mq(sm) {
      width: 70%;
    }
  }
}

</style>
