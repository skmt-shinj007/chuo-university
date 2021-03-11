<template>
<div class="primary-btn">
  <button class="primary-btn__btn" :type="btn.Type" @click="clickEvent">
    <span class="primary-btn__name">{{ btn.Name }}</span>
    <svg-vue icon="angle_right" class="primary-btn__icon"/>
  </button>
</div>
</template>

<script>
export default {
  props: {
    /**
     * ボタンを生成するためのデータ
     * prop => Name, Type
     */
    btn: {
      type: Object,
      default: null,
      required: true,
    },
  },

  methods: {
    clickEvent() {
      this.$emit("clickEvent");
    },
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

    .primary-icon__icon {
      fill: color(white);
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
    width: interval(1.5);
    position: absolute;
    top: 50%;
    right: interval(1);
    transform: translateY(-50%);
    fill: color(orange);
  }

}
</style>
