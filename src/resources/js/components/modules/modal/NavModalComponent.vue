<template>
  <transition name="modal" appear>
    <div class="nav-modal" @click.self="$emit('close')">

      <!-- pcのみ イメージ画像 -->
      <div class="nav-modal__visual modal-window" @click="$emit('close')">
        <div class="nav-modal__visual-overlay"/>
      </div>

      <div class="nav-modal__window modal-window">

        <header class="nav-modal__header" @click="$emit('close')">
          <svg-vue icon="hakumonkai-logo" class="nav-modal__logo"/>
          <button class="nav-modal__btn">
            <i class="nav-modal__btn-line"/>
          </button>
        </header>

        <nav class="nav-modal__main">
          <div class="nav-modal__accordion">
            <div class="nav-modal__accordion-item" v-for="(menu, n) in accordionMenus" :key="n">
              <accordion-link-component
                :item="menu"
                @navClose="$emit('close')"
                />
            </div>
          </div>

          <div class="nav-modal__menu">
            <button class="nav-modal__menu-item">
              <!-- TODO:コンタクトページに遷移するようにする -->
              <router-link to="contact" class="nav-modal__menu-link" @click.native="$emit('close')">
                <label class="nav-modal__menu-title">{{ messages.Nav.Contact }}</label>
                <svg-vue icon="angle-right" class="nav-modal__menu-icon"/>
              </router-link>
            </button>
          </div>

          <div class="nav-modal__sns">
            <!-- snsの各プロフィールページに遷移するように修正 -->
            <div class="nav-modal__sns-item" v-for="(sns, n) in snsLinks" :key="n" :class="`nav-modal__sns-item--${sns.name}`">
              <a :href="sns.link" class="nav-modal__sns-link" target="_blank" rel="noopener noreferrer">
                <svg-vue :icon="sns.icon" class="nav-modal__sns-icon" :class="`nav-modal__sns-icon--${sns.name}`"/>
              </a>
            </div>
          </div>
        </nav>

        <footer class="nav-modal__footer">
          <p class="nav-modal__copyright nl2br" v-text="messages.Copyright"/>
        </footer>

      </div>
    </div>
  </transition>
</template>

<script>
// component import
import AccordionLinkComponent from '../accordion/AccordionLinkComponent';

export default {
  components: {
    AccordionLinkComponent,
  },

  props: {
    /**
     * [アコーディオン: メニューデータ]
     */
    accordionMenus: {
      type: Array,
      required: true,
    },

    /**
     * [sns: snsメニューパネルを生成するデータ]
     */
    snsLinks: {
      type: Array,
      required: true
    }
  },
}
</script>

<style lang="scss" scoped>
.nav-modal {
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: 910;
  background-color: rgba(color(deepDarkblue), $alpha: .9);
  @include flex(column nowrap);

  @include mq(md) {
    flex-direction: row;
  }

  &__window {
    padding: 0 interval(2) interval(5) interval(2);
    color: color(white);

    // ↓ モーダルがスクロールできない問題を解消
    max-height: 100%;
    overflow-y: auto;

    @include mq(sm) {
      padding-left: interval(4);
      padding-right: interval(4);
    }

    @include mq(md) {
      width: 50%;
    }
  }

  &__visual {
    display: none;

    @include mq(md) {
      display: block;
      width: 50%;
      height: 100%;
      @include background-image('/image/player06.jpg');
    }

    &-overlay {
      width: 100%;
      height: 100%;
      @include gradient(rgba( color(deepDarkblue) , .3), rgba( color(deepDarkblue) , .9));
    }
  }

  &__header {
    @include flex(row nowrap, space-between, center);
  }

  &__logo {
    width: interval(18);
    fill: color(white);

    @include mq(sm) {
      width: interval(22);
    }
  }

  &__btn {
    @include close-button(interval(5));

    @include mq(sm) {
      width: interval(6);
      height: interval(6);
    }

    @include mq(md) {
      width: interval(5);
      height: interval(5);
      transition: all .3s ease-out;
    }

    @include hover {
      background: color(orange);
      box-shadow: 0 0 20px 2px darken(color(orange), 10%);

      .nav-modal__btn-line,
      .nav-modal__btn-line::before {
        background-color: color(white);
      }
    }
  }

  &__accordion {
    margin-top: interval(5);
  }

  &__accordion-item {
    position: relative;

    &::before {
      content: '';
      display: block;
      width: 100%;
      height: 1px;
      position: absolute;
      bottom: 0;
      left: 0;
      @include gradient(rgba(color(lightgray), .3), rgba(color(lightgray), 0), horizontal);
    }
  }

  &__menu {
    margin-top: interval(2.5);
  }

  &__menu-item {
    width: 100%;

    @include hover {
      .nav-modal__menu-title {
        transform: translateX(interval(2));
      }
    }
  }

  &__menu-link {
    @include flex(row nowrap, space-between, center);
    padding: interval(2) interval(1);
    cursor: pointer;
  }

  &__menu-title {
    cursor: pointer;
    transition: all .3s ease-out;

    @include mq(sm) {
      font-size: font(18);
    }
  }

  &__menu-icon {
    width: interval(1);
    cursor: pointer;
  }

  &__sns {
    @include flex(row wrap, flex-start, center);
    border: 1px solid rgba(color(lightgray), .1);
    margin-top: interval(5);

    @include mq(sm) {
      max-width: interval(45);
      margin: interval(5) 0 0 auto;
    }
  }

  &__sns-item {
    width: calc(100% / 3);
    border-right: 1px solid darken( color(lightgray), 60%);

    &--twitter {
      background-color: color(twitter);
    }

    &--instagram {
      position: relative;
      background: linear-gradient(200deg, #5478f2 0%, #f23f79 60%, orange 100%);
    }

    &--facebook {
      background-color: color(facebook);
    }
  }

  &__sns-link {
    @include flex(row nowrap, center, center);
    transition: all .3s ease-out;
    background-color: darken( color(lightgray), 70%);

    @include hover {
      background-color: rgba( darken( color(lightgray), 70%) , 0);
    }

    &::before {
      display: block;
      content: '';
      padding-top: 100%;
    }
  }

  &__sns-icon {
    width: interval(4);
  }

  &__footer {
    margin-top: interval(5);
  }

  &__copyright {
    text-align: center;
    font-size: font(10);
    line-height: 1.2;
    font-weight: bold;
  }
}

// モーダル開閉アニメーション
.modal-enter-active, .modal-leave-active {
  transition: opacity 0.4s;

  // オーバーレイに包含されているモーダルウィンドウのトランジション
  .modal-window {
    transition: opacity 0.4s, transform 0.4s;
  }
}

.modal-leave-active {
  transition: opacity 0.6s ease 0.4s;
}

.modal-enter, .modal-leave-to {
  opacity: 0;

  .modal-window {
    opacity: 0;
    transform: translateY(-20px);
  }
}
</style>
