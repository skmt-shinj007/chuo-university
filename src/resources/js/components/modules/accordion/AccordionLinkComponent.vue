<template>
<div class="accordion-link">

  <div class="accordion-link__title" @click="accordionToggle()">
    <label class="accordion-link__label">{{ item.menuName }}</label>
    <svg-vue class="accordion-link__icon" icon="plus"/>
  </div>

  <collapse-transition>
    <ul class="accordion-link__children" v-if="isOpened">
      <li class="accordion-link__children-item" v-for="(menu, n) in childrenMenus" :key="n">

        <!-- 別タブ遷移の場合は、<a> -->
        <a class="accordion-link__link"
          target="_blank" rel="noopener noreferrer"
          :href="menu.link"
          v-if="item.blank"
          @click="accordionReset()">

          <label class="accordion-link__label">{{ menu.label }}</label>
          <svg-vue class="accordion-link__children-icon" icon="angle-right"/>
        </a>

        <!-- 同タブ遷移の場合は、<router-link> -->
        <router-link class="accordion-link__link" :to="menu.link" @click.native="accordionReset()" v-else>
          <label class="accordion-link__label">{{ menu.label }}</label>
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
      childrenMenus: [],
      isOpened: false
    }
  },

  props: {
    item: {
      type: Object,
      required: true
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
}
</script>

<style lang="scss">

.accordion-link {
  color: color(white);

  &__title {
    @include flex(row nowrap, space-between, center);
    padding: interval(2) interval(1);
    cursor: pointer;
  }

  &__label {
    font-weight: bold;
    letter-spacing: 1.2px;
    cursor: pointer;
  }

  &__icon {
    width: interval(2);
  }

  &__children {
    background-color: color(lightDarkblue);
  }

  &__children-item {
    border-top: 1px solid color(lightgray);
  }

  &__link {
    padding: interval(1.5) interval(1);
    @include flex(row nowrap, space-between, center);
    cursor: pointer;
  }

  &__children-icon {
    width: interval(1);
    cursor: pointer;
  }
}
</style>
