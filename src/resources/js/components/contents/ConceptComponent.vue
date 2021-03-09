<template>
  <div class="concept">
    <span class="concept__lead">{{ message }}</span>
    <div class="concept__ball-group">
      <div
        class="concept__ball"
        v-for="item in items"
        :key="item.id"
        @click="change(item.id)">

        <input type="radio" :value="item.id" class="concept__radio" v-model="currentId">
        <label class="concept__ball-label" :for="item.label.en">{{ upperCase(item.label.en) }}</label>
      </div>
    </div>

    <div class="concept__content">
      <div class="concept__tab-group">
        <div
          class="concept__tab"
          v-for="item in items"
          :key="item.id"
          @click="change(item.id)"
          :class="{ 'active': currentId === item.id }">

          <input type="radio" :value="item.id" class="concept__radio" v-model="currentId">
          <label class="concept__label" :for="item.label.en">{{ item.label.ja }}</label>
        </div>
      </div>

      <ul class="concept__list">
        <transition :name="transition">
          <li class="concept__item" :key="currentId" v-show="currentId">
            <span class="concept__keyword">{{ current.keyword }}</span>
            <p>{{ current.content }}</p>
          </li>
        </transition>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      /**
       * セクション上のメッセージ
       * @type { String }
       */
      message: '',

      /**
       * 現在表示している記事id
       * @type { Number }
       */
      currentId: 1,

      /**
       * トランジションの遷移方向
       */
      transition: '',
    }
  },

  props: {
    items: {
      type: Array,
      default: null
    }
  },

  computed: {
    current() {
      return this.items.find(el => el.id === this.currentId) || {};
    },

    upperCase() {
      return function(value) {
        return value.toUpperCase();
      }
    },
  },

  methods: {
    change(id) {
      // スタイルがpcかタブレットかを判定
      if (this.windowWidth < this.breakpoints.sm) {
        (this.currentId > id) ? this.transition = 'prev' : this.transition = 'next';
      }
      else {
        (this.currentId > id) ? this.transition = 'up' : this.transition = 'down';
      }

      // 表示するidを変更
      this.currentId = id;
    }
  },
}
</script>

<style lang="scss" scoped>
.concept {

  &__ball-group {
    @include flex(row nowrap, center, center);
    margin-bottom: interval(5);
    position: relative;
    z-index: 2;

    @include mq(sm) {
      margin-right: interval(1);
      @include flex(row nowrap, flex-end, center);
    }
  }

  // ボールタブのスタイルで使用するサイズを変数に代入。
  $size: interval(10);

  &__ball {
    width: $size;
    height: $size;
    background-color: color(white);
    box-shadow: inset -1rem -1rem 3rem color(darkShadow);
    border-radius: radius(circle);
    position: relative;
    transition: transform .5s ease-out;

    &:nth-child(1) {
      transform: rotate(10deg);
      margin-right: interval(1);

      &::after {
        transform: rotate(-10deg) translateX(10px);
      }
    }

    &:nth-child(2) {
      margin-right: interval(.5);
      transform: rotate(-8deg);

      &::after {
        transform: rotate(8deg) translateX(-8px);
      }
    }

    &:last-child {
      transform: rotate(5deg);
      margin-right: 0;

      &::after {
        transform: rotate(-5deg) translateX(5px);
      }
    }

    &::before {
      display: block;
      content: '';
      position: absolute;
      top: calc(#{$size} / 4);
      left: 50%;
      transform: translateX(-50%);
      width: calc(#{$size} / 25);
      height: calc(#{$size} / 25);
      background-color: darken($color: blue, $amount: 10%);
      border-radius: radius(circle);
    }

    &::after {
      content: '';
      display: block;
      position: absolute;
      left: 0;
      right: 0;
      top:0;
      bottom: -100%;
      margin: auto;
      width: 60px;
      height: 10px;
      border-radius: 50%;
      background: color(darkShadow);
      filter: blur(6px);
      opacity:0.9;
      transition: transform .3s ease-in;
    }

    @include mq(md) {
      cursor: pointer;
    }

    @include hover {
      transform: rotate(0);
      &::after {
        transform: rotate(0);
      }
    }
  }

  &__radio {
    display: none;
  }

  &__ball-label {
    @include fonts(font(10), bold, false, 0);
    color: darken($color: red, $amount: .4);
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  &__content {
    color: color(white);
    background-color: color(darkblue);
    border-radius: radius(soft);

    @include mq(sm) {
      @include flex();
    }
  }

  &__tab-group {
    @include flex();

    @include mq(sm) {
      flex-direction: column;
      width: 30%;
    }
  }

  &__tab {
    background-color: color(lightDarkblue);
    @include flex(row nowrap, center, center);
    padding: interval(2);
    width: calc(100% / 3);
    border-radius: radius(soft);
    border-right: 1px solid rgba($color: color(white), $alpha: .2);

    &:last-child {
      border: none;
    }

    @include mq(sm) {
      height: calc(100% / 3);
      border-right: none;
      border-bottom: 1px solid rgba($color: color(white), $alpha: .2);
      width: 100%;
    }

    @include mq(md) {
      cursor: pointer;
    }
  }

  &__label {
    @include fonts(font(12), bold, false, false);
  }

  &__list {
    border-radius: radius(soft);

    @include mq(sm) {
      width: 70%;
    }
  }

  &__item {
    padding: interval(2);
  }

  &__keyword {
    font-size: font(14);
    display: block;
    line-height: 2;
    margin-bottom: interval(3);

    &::after {
      content: '';
      display: block;
      width: 100%;
      height: 1px;
      background-color: color(white);
    }
  }

  .active {
    background-color: color(darkblue);
  }
}

.next {
  &-enter-active {
    transition: transform .8s;
  }

  &-enter {
    transform: translateX(50%);
  }
}

.prev {
  &-enter-active {
    transition: transform .8s;
  }

  &-enter {
    transform: translateX(-50%);
  }
}

.up {
  &-enter-active {
    transition: transform .8s;
  }

  &-enter {
    transform: translateY(-50%);
  }
}

.down {
  &-enter-active {
    transition: transform .8s;
  }

  &-enter {
    transform: translateY(50%);
  }
}
</style>
