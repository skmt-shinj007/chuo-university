<template>
  <transition name="modal" appear>
    <div class="nav-modal" @click.self="$emit('close')">
      <div class="nav-modal__window modal-window">

        <header class="nav-modal__header" @click="$emit('close')">
          <svg-vue icon="hakumonkai-logo" class="nav-modal__logo"/>
          <button class="nav-modal__btn">
            <i class="nav-modal__btn-line"/>
          </button>
        </header>

        <nav class="nav-modal__main">
          <div class="nav-modal__accordion">
            <div class="nav-modal__accordion-item" v-for="(menu, n) in accordionMenu" :key="n">
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
            <div class="nav-modal__sns-item" v-for="(sns, n) in snsData" :key="n">
              <a :href="sns.link" class="nav-modal__sns-link">
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
    accordionMenu: {
      type: Array,
      required: true,
    },

    /**
     * [sns: snsメニューパネルを生成するデータ]
     */
    snsData: {
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
  z-index: 999;
  background-color: rgba(color(deepDarkblue), $alpha: .9);

  &__window {
    padding: 0 interval(2) interval(5) interval(2);
    color: color(white);

    // ↓ モーダルがスクロールできない問題を解消
    max-height: 100%;
    overflow-y: auto;
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
    width: interval(5);
    height: interval(5);
    border-radius: radius(circle);
    @include gradient(color(white), color(lightgray));
    box-shadow: 0 3px 15px 1px darken(color(orange), 10%);
    @include flex(row nowrap, center, center);

    @include mq(sm) {
      width: interval(6);
      height: interval(6);
    }
  }

  &__btn-line {
    position: relative;
    display: block;
    background-color: color(orange);
    width: interval(2.5);
    height: 3px;
    transform: rotate(-45deg);

    &::before {
      content: '';
      display: block;
      width: 100%;
      height: 100%;
      background-color: color(orange);
      transform: rotate(90deg);
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
  }

  &__menu-link {
    @include flex(row nowrap, space-between, center);
    padding: interval(2) interval(1);
    cursor: pointer;
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
    background-color: rgba(color(white), .3);
    border-right: 1px solid rgba(color(lightgray), .1);
  }

  &__sns-link {
    @include flex(row nowrap, center, center);

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
    font-size: font(xs);
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
