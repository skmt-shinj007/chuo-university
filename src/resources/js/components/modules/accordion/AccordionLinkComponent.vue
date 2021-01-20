<template>
<div class="accordion-link">

  <div class="accordion-link__title" @click="accordionToggle()">
    <label class="accordion-link__label">{{ item.menuName }}</label>
    <!-- <svg-vue class="accordion-link__icon" icon="plus"/> -->
    <div class="accordion-link__icon-wrap">
      <i class="accordion-link__icon" :class="{ 'accordion-link__open-icon': isOpened }"/>
    </div>
  </div>

  <collapse-transition>
    <ul class="accordion-link__children" v-if="isOpened" :class="background">
      <li class="accordion-link__children-item" v-for="(menu, n) in childrenMenus" :key="n">

        <!-- 別タブ遷移の場合は、<a> -->
        <a class="accordion-link__link"
          target="_blank" rel="noopener noreferrer"
          :href="menu.link"
          v-if="item.blank"
          @click="accordionReset(); $emit('navClose')">

          <label class="accordion-link__children-label">{{ menu.label }}</label>
          <svg-vue class="accordion-link__children-icon" icon="angle-right"/>
        </a>

        <!-- 同タブ遷移の場合は、<router-link> -->
        <router-link class="accordion-link__link" :to="menu.link" @click.native="accordionReset(); $emit('navClose')" v-else>
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
       * [アコーディオンのメニューが入った配列]
       * @type { Array }
       */
      childrenMenus: [],

      /**
       * [アコーディオンの表示・非表示フラグ]
       * @type { Boolean }
       */
      isOpened: false
    }
  },

  props: {
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
    this.item.childrenMenus.forEach(element => this.childrenMenus.push(element));
  },

  methods: {
    accordionToggle() {
      this.isOpened = !this.isOpened;
    },
    accordionReset() {
      this.isOpened = false;
    },
  },

  computed: {
    background() {
      return (this.color) ? `accordion-link__children--${this.color}` : null;
    }
  }
}
</script>

<style lang="scss">

.accordion-link {
  color: color(white);

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

    @include mq(sm) {
      font-size: font(lg);
    }
  }

  &__icon-wrap {
    width: interval(2);
  }

  %icon {
    display: block;
    background-color: color(white);
    width: 100%;
    height: 2px;
  }

  // アコーディオンが閉じている時のアイコン
  &__icon {
    position: relative;
    transition: all .3s ease-out;
    @extend %icon;

    &::before {
      content: '';
      @extend %icon;
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

  &__children {

    &--lightDarkblue {
      background-color: color(lightDarkblue);
    }

    &--orange {
      background-color: color(orange);
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
  }

  &__children-icon {
    width: interval(1);
    cursor: pointer;
  }
}
</style>
