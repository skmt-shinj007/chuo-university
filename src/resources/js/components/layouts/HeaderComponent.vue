<template>

<header class="header">
  <div class="header__navbar">
    <router-link to="/">
      <div class="header__title">
        <span class="header__title-main">
          {{ messages.Header.MainTitle }}
        </span>

        <span class="header__title-assistance">
          {{ messages.Header.AssistanceTitle }}
        </span>
      </div>
    </router-link>

    <div class="header__menus">
      <header-button-component>
        <i class="fas fa-bars header-icon"></i>
      </header-button-component>

      <header-button-component>
        <i class="fab fa-twitter header-icon"></i>
      </header-button-component>
    </div>
  </div>
</header>

</template>

<script>
// component import
import HeaderButtonComponent from '../modules/button/HeaderButtonComponent';

export default {
  components: {
    HeaderButtonComponent,
  },

};
</script>

<style lang="scss" scoped>

// layout style
.header {
  height: 60px;
  position: fixed;
  top: 0;
  z-index: 1000;
  box-shadow: 0px 2px 6px color(shadow);

  // pc style
  @include mq(md) {
    width: width(header);
    height: 100vh;
    position: fixed;
    left: 0;
    box-shadow: 2px 0px 10px color(shadow);
  }

  &__navbar {
    height: 100%;
    @include flex(
      $justify-content:space-around,
      $align-items:center
    );

    // pc style
    @include mq(md) {
      @include flex(
        $flow: column nowrap,
        $justify-content:space-around,
        $align-items:center
      );
    };
  }

  &__title {
    cursor: pointer;
    @include flex($justify-content:center, $align-items:center);

    // pc style
    @include mq(md) {
      padding: interval(3);
      margin: 0 auto;
      writing-mode: vertical-rl;
    };

    &-main {
      @include bangers();

      // tablet style
      @include mq(sm) {
        font-size: font(lg);
      };

      // pc style
      @include mq(md) {
        margin-bottom: interval(7);
      };
    }

    &-assistance {
      display: none;

      // tablet style
      @include mq(sm) {
        margin-left: interval(3);
        font-size: font(xs);
        font-weight: normal;
        letter-spacing: 1.1px;
        position: relative;
        display: block;
      };

      // pc style
      @include mq(md) {
        margin: 0;
        font-size: font(sm);
      };
    }

    &-assistance::before {
      display: none;

      // pc style
      @include mq(md) {
        content: '';
        display: block;
        width: 1px;
        height: 16px;
        background-color: color(darkblue);
        position: absolute;
        top: -32px;
        left: 50%;
        transform: translateX(-50%);
      }
    }
  }

  &__menus {
    @include flex(
      $justify-content: space-around,
    );

    // pc style
    @include mq(md) {
      @include flex(
        $flow: column nowrap,
        $justify-content: space-around,
      );
    };

  }
}
</style>
