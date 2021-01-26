<template>
  <transition name="modal" appear>
    <div class="modal" @click.self="$emit('close')">
      <div class="modal__window">

        <div class="image-modal">
          <header class="image-modal__header">
            <button class="image-modal__close-btn" @click="$emit('close')">
              <i class="image-modal__close-btn-line"/>
            </button>
          </header>

          <transition :name="transitionName">
            <figure class="image-modal__img-wrap" :key="item.id">
              <img class="image-modal__img" :src="`/image/${item.src}`" :alt="item.alt">
            </figure>
          </transition>

          <footer class="image-modal__footer" v-if="footerShow">
            <div class="image-modal__prev-btn-area" @click="prevImage" v-if="showPrevBtn">
              <button class="image-modal__prev-btn">
                <svg-vue icon="arrow-left" class="image-modal__icon"/>
              </button>
            </div>

            <div class="image-modal__next-btn-area" @click="nextImage" v-if="showNextBtn">
              <button class="image-modal__next-btn">
                <svg-vue icon="arrow-right" class="image-modal__icon"/>
              </button>
            </div>
          </footer>
        </div>

      </div>
    </div>
  </transition>
</template>

<script>
export default {
  data() {
    return {
      /**
       * [表示する写真データ]
       * このオブジェクトのデータを参照して写真を表示
       * @type { Object }
       */
      item: null,

      /**
       * [表示する写真のインデックス番号]
       * @type { Number }
       */
      showIndex: 0,

      /**
       * [images配列の最後のインデックス番号]
       * @type { Number }
       */
      max: 0,

      /**
       * [footerの表示切り替え]
       * @type { Boolean }
       */
      footerShow: true,

      /**
       * [「前へ」ボタンの表示制御]
       * @type { Boolean }
       */
      showPrevBtn: true,

      /**
       * [「次へ」ボタンの表示制御]
       * @type { Boolean }
       */
      showNextBtn: true,

      transitionName: '',
    }
  },

  props: {
    // 親コンポーネントでクリックしたイメージのインデックス番号
    selectIndex: {
      type: Number,
      default: null,
    },

    // フィルタリングされた全イメージ配列
    images: {
      type: Array,
      default: [],
    },
  },

  beforeMount() {

    /**
     * 親コンポーネントで選択された写真のインデックス番号
     * propsの変数を直接いじれないので、[showIndex] に代入。
     */
    this.showIndex = this.selectIndex;

    /**
     * 初期表示する写真データを挿入（親コンポーネントで選択された写真）
     * 写真の表示は、firteringImagesのインデックス番号で指定する。
     * 理由：配列のインデックスで表示しないと「次へ」「前へ」ボタンで表示の制御ができない。
     */
    this.item = this.images[this.selectIndex];

    // イメージ配列の最後の[インデックス番号]を取得
    this.max = this.getMaxIndex(this.images);

    // images配列の要素数が 1つ の場合、フッターを非表示
    if (this.images.length === 1) this.footerShow = false;
    // 最初の要素が表示されている場合、前へボタンを非表示
    if (this.selectIndex === 0) this.showPrevBtn = false;
    // 最後の要素が表示されている場合、次へボタンを表示
    if (this.selectIndex === this.max) this.showNextBtn = false;
  },

  methods: {
    /**
     * [次へボタンのクリックイベント]
     * images配列の次の写真を表示させる
     */
    nextImage() {
      this.transitionName = 'next';
      const max = this.max;

      if (this.showIndex < max) {
        // 現在表示している写真の次の要素番号を代入
        this.showIndex = this.showIndex + 1;
        // showIndexを参照して表示するアイテムデータを更新
        this.item = this.images[this.showIndex];
      }

      /**
       * 最後の写真を表示している時、nextボタン非表示
       * 最初の写真を表示している時、prevボタン非表示
       */
      (this.showIndex === max) ? this.showNextBtn = false : this.showNextBtn = true;
      (this.showIndex > 0) ? this.showPrevBtn = true : this.showPrevBtn = false;
    },

    /**
     * [前へボタンのクリックイベント]
     * images配列の一つ前の写真を表示させる
     */
    prevImage() {
      this.transitionName = 'prev';
      const max = this.max;

      if (this.showIndex > 0) {
        // 現在表示している写真の一つ前の要素番号を代入
        this.showIndex = this.showIndex - 1;
        // 表示するアイテムデータを更新
        this.item = this.images[this.showIndex];
      }

      /**
       * 最後の写真を表示している時、nextボタン非表示
       * 最初の写真を表示している時、prevボタン非表示
       */
      (this.showIndex === 0) ? this.showPrevBtn = false : this.showPrevBtn = true;
      (this.showIndex < max) ? this.showNextBtn = true : this.showNextBtn = false;
    },

    /**
     * [最後のインデックス番号取得]
     * @param { Array } 調べたい配列
     * @return { Number } 引数に指定された配列の最終要素のインデックス番号が返ります
     */
    getMaxIndex(array) {
      let maxIndex = 0;
      let max = array[0];

      for (let i = 0; i < array.length; i++) {
        maxIndex = i;
      }

      return maxIndex;
    },
  },
}
</script>

<style lang="scss" scoped>
.modal {
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: 1000;
  background-color: rgba(color(deepDarkblue), $alpha: .9);
  @include flex(column nowrap);

  &__window {
    height: 100%;
    padding: 0 interval(2);
    position: relative;

    // ↓ モーダルがスクロールできない問題を解消
    max-height: 100%;
    overflow-y: auto;
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
  }

  &__prev-btn-area {
    padding: interval(1);
    position: fixed;
    left: 5%;
    bottom: 10%;
  }

  &__next-btn-area {
    padding: interval(1);
    position: fixed;
    right: 5%;
    bottom: 10%;
  }

  // next・prevボタンのスタイル
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
      font-size: font(10);
      display: block;
      color: color(white);
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
    }
  }

  &__prev-btn {
    @extend %btn;

    &::before {
      content: '前へ';
      right: - 130%;
    }
  }

  &__next-btn {
    @extend %btn;

    &::before {
      content: '次へ';
      left: - 130%;
    }
  }

  &__icon {
    width: interval(1.5);
    color: color(white);
    fill: color(white);
  }
}

// vue transitionのアニメーション
.modal-enter-active, .modal-leave-active {
  transition: opacity .3s;
}

.modal-leave-active {
  transition: opacity .3s ease .1s;
}

.modal-enter, .modal-leave-to {
  opacity: 0;

  .modal-window {
    opacity: 0;
  }
}

.next-enter-active,
.prev-enter-active {
  transition: all .5s ease-out;
}

.next-enter {
  transform: translateX(50%);
  opacity: 0;
}
.next-enter-to {
  transform: translateX(0);
  opacity: 1;
}
.next-leave {
  transform: translateX(0);
  opacity: 0;
}

.prev-enter {
  transform: translateX(-50%);
  opacity: 0;
}
.prev-enter-to {
  transform: translateX(0);
  opacity: 1;
}
.prev-leave {
  transform: translateX(0);
  opacity: 0;
}

</style>
