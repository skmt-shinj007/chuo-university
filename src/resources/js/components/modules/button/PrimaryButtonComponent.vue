<template>
<div class="primary-btn" :class="variation">
  <button class="primary-btn__btn" :type="btnType" @click="clickEvent">
    <span class="primary-btn__name">{{ name }}</span>
    <svg-vue icon="angle-right" class="primary-btn__icon"/>
  </button>
</div>
</template>

<script>
export default {
  props: {
    /**
     * ボタンのラベル
     */
    name: {
      type: String,
      default: 'もっと見る',
    },

    /**
     * ボタンのタイプ
     * button, submit 等
     */
    btnType: {
      type: String,
      default: 'button',
    },

    /**
     * クリックイベント
     */
    clickEvent: {
      type: Function,
      // required: true,
      default: () => {}
    },

    /**
     * 特定の時にスタイルを変えたい場合のクラス名
     * スタイルを追加する必要がある。
     */
    variationClass: {
      type: String,
      default: null,
    }
  },
  computed: {
    variation() {
      return (this.variationClass) ? `primary-btn--${this.variationClass}` : null;
    }
  },
}
</script>

<style lang="scss">
%frame {
  background-color: color(white);
  border: 1px solid color(orange);
  border-radius: radius(soft);
  transition: transform .3s ease-out, background-color .5s linear;
}

.primary-btn {
  @extend %frame;
  width: 100%;
  position: relative;
  color: color(orange);

  @include hover {
    border: none;

    .primary-btn__btn {
      transform: none;
      border: none;
      color: color(white);
      background-color: color(orange);
    }
  }

  &__btn {
    width: 100%;
    height: 100%;
    padding: interval(2.5);
    @extend %frame;
    transform: translateX(-4px) translateY(4px);
    @include flex(row nowrap, center, center);
  }

  &__name {
    font-size: font(10);
  }

  &__icon {
    width: interval(2);
    height: interval(2);
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
  }

  &--rgba {
    background-color: rgba($color: color(white), $alpha: .6);

    .primary-btn__btn {
      background-color: rgba($color: color(white), $alpha: .6);
    }
  }

}
</style>
