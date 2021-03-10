<template>
<div class="accordion-link" :class="colorClass">

  <div class="accordion-link__title" @click="accordionToggle()">
    <label class="accordion-link__label">{{ item.name.ja }}</label>
    <div class="accordion-link__icon-wrap">
      <i class="accordion-link__icon" :class="{ 'accordion-link__open-icon': isOpened }"/>
    </div>
  </div>

  <collapse-transition>
    <ul class="accordion-link__children" v-if="isOpened">

      <li class="accordion-link__children-item" v-for="(menu, n) in item.childrenMenus" :key="n">

        <!-- 別タブ遷移の場合は、<a> -->
        <a class="accordion-link__link"
          target="_blank" rel="noopener noreferrer"
          :href="menu.to"
          v-if="isExternal"
          @click="accordionReset(); $emit('navClose')">

          <label class="accordion-link__children-label">{{ menu.label }}</label>
          <svg-vue class="accordion-link__children-icon" icon="angle-right"/>
        </a>

        <!-- 同タブ遷移の場合は、<router-link> -->
        <router-link class="accordion-link__link" :to="menu.to" @click.native="accordionReset(); $emit('navClose')" v-else>
          <label class="accordion-link__children-label">{{ menu.label }}</label>
          <svg-vue class="accordion-link__children-icon" icon="angle-right"/>
        </router-link>

      </li>
    </ul>
  </collapse-transition>

</div>
</template>

<script>
/**
 * [ライブラリ] アコーディオン開閉アニメーション
 * componentsプロパティに登録することで、コンポーネントで使用可能
 */
import CollapseTransition from "@ivanv/vue-collapse-transition"

export default {
  components: {
    CollapseTransition,
  },

  data() {
    return {
      /**
       * [アコーディオンの表示・非表示フラグ]
       * @type { Boolean }
       */
      isOpened: false,

      /**
       * [外部リンクかを判定]
       * @type { Boolean }
       */
      isExternal: false,
    }
  },

  props: {
    /**
     * アコーディオンを生成するデータ
     * prop => name(Obj), childrenMenus(Ary)
     */
    item: {
      type: Object,
      required: true
    },

    color: {
      type: String,
      default: null
    }
  },

  beforeMount() {
    /**
     * 外部リンクの判定
     * 'http'で始まる宛先を外部リンクと判定する。
     */
    this.item.childrenMenus.forEach(el => {
      if (el.to.startsWith('http')) this.isExternal = true;
    })
  },

  methods: {
    /**
     * アコーディオンの開閉処理
     * フラグになっている isOpened プロパティ
     */
    accordionToggle() {
      this.isOpened = !this.isOpened;
    },

    /**
     * [アコーディオンを閉める処理]
     * リンク押下後にアコーディオン開きっぱなしを防ぐ。
     */
    accordionReset() {
      this.isOpened = false;
    },
  },

  computed: {
    colorClass() {
      return (this.color) ? `accordion-link--${this.color}` : null;
    }
  }
}
</script>

<style lang="scss">

.accordion-link {
  color: color(white);

  &--darkblue {
    color: color(darkblue);

    .accordion-link {
      &__children-item {
        border-top: 1px solid rgba(color(darkblue), .3);
      }

      &__icon, &__icon::before {
        background-color: color(darkblue);
      }

    }
  }

  &__title {
    @include flex(row nowrap, space-between, center);
    padding: interval(2) interval(1);
    cursor: pointer;

    @include hover {
      .accordion-link__label {
        transform: translateX(interval(2));
      }
    }
  }

  &__label {
    cursor: pointer;
    transition: all .3s ease-out;
    font-size: font(16);
  }

  &__icon-wrap {
    width: interval(2);
  }

  %icon {
    display: block;
    width: 100%;
    height: 2px;
  }

  // アコーディオンが閉じている時のアイコン
  &__icon {
    @extend %icon;
    background-color: color(white);
    position: relative;
    transition: all .3s ease-out;

    &::before {
      content: '';
      @extend %icon;
      background-color: color(white);
      position: absolute;
      top: 0;
      left: 0;
      transition: all .3s ease-out;
      transform: rotate(90deg);
    }
  }

  // アコーディオンが開いた時のアイコン
  &__open-icon {
    transform: rotate(360deg);

    &::before {
      transform: rotate(0);
    }
  }

  &__children-item {
    border-top: 1px solid rgba(color(lightgray), .2);

    @include hover {
      .accordion-link__children-label {
        transform: translateX(interval(2));
      }
    }
  }

  &__link {
    padding: interval(1.5) interval(1);
    @include flex(row nowrap, space-between, center);
    cursor: pointer;
  }

  &__children-label {
    cursor: pointer;
    transition: all .3s ease-out;
    font-size: font(12);
  }

  &__children-icon {
    width: interval(1);
    cursor: pointer;
  }
}
</style>
