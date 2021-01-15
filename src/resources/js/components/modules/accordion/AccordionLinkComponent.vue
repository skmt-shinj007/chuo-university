<template>
<ul class="accordion-link">

  <li class="accordion-link__menu">
    <div class="accordion-link__menu-title" @click="accordionToggle()">
      <label class="accordion-link__label">{{ item.menuName }}</label>
      <svg-vue class="accordion-link__icon" icon="plus"/>
    </div>

    <collapse-transition>
      <ul class="accordion-link__children" v-if="isOpened">
        <router-link
          tag="li"
          class="accordion-link__children-item"
          v-for="(menu, n) in childrenMenus"
          :key="n"
          :to="menu.link"
          @click.native="accordionReset()">

          <label class="accordion-link__label">{{ menu.label }}</label>
          <svg-vue class="accordion-link__children-icon" icon="angle-right"/>
        </router-link>
      </ul>
    </collapse-transition>


    <!-- <ul class="accordion-link__children" v-if="item.menuBlank">
      <li v-for="(menu, n) in childrenMenus" :key="n">
        <a class="accordion-link__children-item" :href="menu.link">
          <label class="accordion-link__label">{{ menu.label }}</label>
          <svg-vue class="accordion-link__children-icon" icon="angle-right"/>
        </a>
      </li>
    </ul> -->

  </li>
</ul>
</template>

<script>
/**
 * アコーディオン開閉アニメーション
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
    this.item.menus.forEach(element => this.childrenMenus.push(element));
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

<style lang="scss" scoped>

.accordion-link {
  color: color(white);

  &__menu {
    margin-bottom: interval(2);
    border-top: 2px solid color(lightgray);

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__menu-title {
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
    @include flex(row nowrap, space-between, center);
    padding: interval(1.5) interval(1);
    border-top: 1px solid color(lightgray);
    cursor: pointer;
  }

  &__children-icon {
    width: interval(1);
    cursor: pointer;
  }
}
</style>
