<template>
<div class="link" :class="variation">

  <a :href="link.To"
      class="link__btn"
      target="_balnk"
      rel="noopener noreferrer"
      v-if="isExternal">

    <span class="link__name">{{ link.Name }}</span>
    <svg-vue icon="angle-right" class="link__icon"/>
  </a>

  <router-link :to="{ name: link.To }" class="link__btn" v-else>
    <span class="link__name">{{ link.Name }}</span>
    <svg-vue icon="angle-right" class="link__icon"/>
  </router-link>
</div>
</template>

<script>
export default {
  data() {
    return {
      isExternal: false,
    }
  },

  props: {
    /**
     * ボタンを生成するためのデータ
     * prop => Name, To
     */
    link: {
      type: Object,
      default: null,
      // required: true,
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
      return (this.variationClass) ? `link--${this.variationClass}` : null;
    }
  },

  beforeMount() {
    /**
     * 外部リンクの判定
     * 'http'で始まる宛先を外部リンクと判定する。
     */
    const to = this.link.To;

    if (to.startsWith('http')) {
      this.isExternal = true;
    }
  },
}
</script>

<style lang="scss" scoped>
%frame {
  background-color: color(white);
  border: 1px solid color(orange);
  border-radius: radius(soft);
  transition: transform .3s ease-out, background-color .5s linear;
}

.link {
  @extend %frame;
  width: 100%;
  position: relative;
  color: color(orange);

  @include hover {
    border: none;

    .link__btn {
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

    .link__btn {
      background-color: rgba($color: color(white), $alpha: .6);
    }
  }

}
</style>
