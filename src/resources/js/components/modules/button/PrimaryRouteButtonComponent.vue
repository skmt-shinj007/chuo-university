<template>
<div class="route-btn" :class="variation">
  <router-link :to="button.to" class="route-btn__btn">
    <span class="route-btn__name">{{ button.name }}</span>
    <svg-vue icon="angle-right" class="route-btn__icon"/>
  </router-link>
</div>
</template>

<script>
export default {
  props: {
    /**
     * ルートデータ
     * 1.nameプロパティ
     * 2.linkプロパティ
     * をもつオブジェクト
     */
    button: {
      type: Object,
      default: null,
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
      return (this.variationClass) ? `route-button--${this.variationClass}` : null;
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

.route-btn {
  @extend %frame;
  width: 100%;
  position: relative;
  color: color(orange);

  @include hover {
    border: none;

    .route-link__btn {
      transform: none;
      border: none;
      color: color(white);
      background-color: color(orange);
    }
  }

  &__btn {
    @extend %frame;
    width: 100%;
    height: 100%;
    padding: interval(2.5);
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

    .route-link__btn {
      background-color: rgba($color: color(white), $alpha: .6);
    }
  }

}
</style>
