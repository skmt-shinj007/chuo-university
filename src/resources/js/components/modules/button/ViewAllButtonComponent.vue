<template>
<div class="view-all">

  <!-- button をクリックしたら親で指定されたクリックイベントが走る -->
  <button class="view-all__btn" @click="runParentMethod">
    <label class="view-all__btn-label">{{ btnLabel }}</label>
    <svg-vue icon="plus" class="view-all__icon"/>
  </button>

</div>
</template>

<script>
export default {
  props: {
    btnLabel: {
      type: String,
      default: "MORE"
    },
    btnStyle: {
      type: Object,
      default: null
    },

    // ボタンのクリックイベントを親から受け取る
    clickEvent: {
      type: Function,
      required: true,  // クリックイベントの受け渡しを必須に。
    }
  },
  methods: {
    // propsで受け取った親のクリックイベントを実行
    runParentMethod() {
      this.clickEvent()
    }
  },
}
</script>

<style lang="scss">
.view-all {
  color: color(white);
  width: 70%;
  margin: 0 auto;

  @include mq(sm) {
    max-width: interval(50);
  }

  &__btn {
    width: 100%;
    position: relative;
    padding: interval(3) interval(6);
    border-radius: 100px;
    transition: all .3s ease-out;
    box-shadow: 0 15px 13px -15px darken($color: color(orange), $amount: 3%);
    @include flex(row nowrap, center, center);
    @include gradient(color(deepYellow), color(orange), horizontal);

    @include hover {
      box-shadow: 0 32px 30px -26px darken($color: color(orange), $amount: 3%);
      transform: translateY(-4px);

      .view-all__btn-label {
        letter-spacing: 3px;
        transform: scale(1.1);
      }
    }

    @include mq(sm) {
      padding: interval(3) interval(6);
    }

    @include mq(md) {
      box-shadow: 0 32px 30px -30px darken($color: color(orange), $amount: 3%);
    }
  }

  &__btn-label {
    transition: all .3s ease-out;
    font-size: font(14);
  }

  &__icon {
    width: interval(1.5);
    height: interval(1.5);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: interval(2);
    fill: color(white);

    @include mq(sm) {
      right: interval(4);
    }
  }
}
</style>
