<template>
<div class="primary-btn" :class="variation">
  <button class="primary-btn__btn" :type="btnType" @click="clickEvent">
    {{ name }}
    <i class="fas fa-angle-right fa-2x primary-btn__icon"></i>
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

  methods: {
    toRoute(route) {
      this.$router.push({ name: route })
    }
  },
}
</script>

<style lang="scss">
.primary-btn {
  width: 80%;
  max-width: interval(30);
  height: interval(6);
  margin: 0 auto;
  background-color: color(white);
  font-size: font(10);
  border: 1px solid color(orange);
  border-radius: radius(soft);
  position: relative;

  @include hover {
    border: none;

    .primary-btn__btn {
      transform: none;
      border: none;
      background-color: color(orange);
      color: color(white);
    }
  }

  // pc style
  @include mq(md) {

    &--sm {
      max-width: interval(26);
      height: interval(5);
      font-size: font(8);
    }
  }

  &__btn {
    width: 100%;
    height: 100%;
    text-align: center;
    background-color: color(white);
    color: color(orange);
    border: 1px solid color(orange);
    border-radius: radius(soft);
    transform: translateX(4px) translateY(-4px);
    transition: all .3s ease-out;
  }

  &__icon {
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
