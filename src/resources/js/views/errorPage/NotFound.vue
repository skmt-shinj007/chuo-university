<template>
<div class="err">

  <section class="err__container">
    <transition-group name="num" appear class="err__number" tag="div">
      <span
        class="err__number-item"
        v-for="num in messages.Error.NotFound.Num"
        :key="num.key">

        {{ num.Number }}
      </span>
    </transition-group>
    <h1 class="err__message">{{ messages.Error.NotFound.Message }}</h1>

    <div class="err__tennis-ball-wrap">
      <div class="err__tennis-ball"/>
    </div>
  </section>

  <section class="err__container">
    <h3 class="err__guide nl2br">{{ messages.Error.NotFound.Guide }}</h3>

    <ul class="err__sitemap">
      <li class="err__sitemap-item" v-for="(menu, n) in menus" :key="n">
        <router-link class="err__link" :to="menu.to">{{ menu.label }}</router-link>
      </li>
    </ul>
  </section>
</div>
</template>

<script>
// import
import Config from '../../config/config.json';
export default {
  data() {
    return {
      config: Config,

      /**
       * サイトマップを生成するデータ
       * @type { Object }
       */
      menus: [],
    }
  },

  mounted() {
    this.menus = this.convertArray(this.config.route);
  },

  methods: {
    /**
     * オブジェクトから配列に変換する処理
     * @param { Object }
     */
    convertArray(obj) {
      return Object.keys(obj).map(function (key) {
        return obj[key];
      })
    },
  },
}
</script>

<style lang="scss" scoped>
.err {
  @include flex(column nowrap, center, center);

  @include mq(md) {
    width: 100%;
    height: 100vh;
    flex-direction: row;
  }

  &__container {
    width: 100%;

    @include mq(md) {
      margin-bottom: 0;
    }

    // 1番目のボックス
    &:first-child {
      @include flex(column nowrap, center, center);

      @include mq(md) {
        width: 50%;
      }
    }

    // 2番目のボックス
    &:last-child {
      @include mq(md) {
        width: 50%;
      }
    }
  }

  &__number {
    @include flex(row nowrap, center, center);
    margin-top: interval(20);
  }

  &__number-item {
    display: block;
    font-size: font(80);
    letter-spacing: 2px;
    line-height: 1;
    margin-right: pixel(1);
    transform: translate(0%,-100%);
    animation: bound 1.5s ease-in forwards;

    // アニメーション遅延の数値を変数に格納しておく
    $delay: 0s;

    @for $i from 1 through 3 {
      &:nth-child(#{$i}) {
        animation-delay: $delay;
      }

      // ループが回るたびに変数を更新して、.2s分遅らせる
      $delay: $delay + .1;
    }

    &:last-child {
      margin-right: 0;
    }
  }

  &__message {
    font-size: font(12);
    font-family: Arial, Helvetica, sans-serif;
  }

  &__tennis-ball-wrap {
    width: 100%;
    @include flex(row nowrap, flex-end, center);
    margin-top: interval(5);
  }

  &__tennis-ball {
    @include ball(interval(12), 'SORRY\ANOT FOUND', 8);
    transform: translateX(-50rem) rotate(0deg);
    animation: rotation 5s ease-out forwards;
    margin-right: interval(3);

    @include mq(md) {
      margin: 0;
    }
  }

  &__guide {
    font-size: font(14);
    letter-spacing: 1px;
    line-height: 1.2;
    @include middle-line-text(2, 1px, color(darkblue));
  }

  &__sitemap {
    width: 100%;
    margin-top: interval(5);
    border-top: 2px solid color(darkblue);
  }

  &__sitemap-item {
    @include border-gradient(100%, color(lightDarkblue), color(darkblue), bottom);
  }

  &__link {
    @include flex(row nowrap, flex-start, center);
    cursor: pointer;
    font-size: font(12);
    font-weight: bold;
    padding: interval(1.5) 0;
    transition: transform .3s ease-out;

    @include hover {
      transform: translateX(interval(1));
    }
  }
}

// 初期描画時のトランジション
.num {
  &-enter-active,
  &-leave-active {
    transition: opacity 2s linear;
  }

  &-enter {
    opacity: 0;
  }

  &-enter-to {
    opacity: 1;
  }
}

</style>
