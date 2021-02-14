<template>
  <transition name="modal" appear>
    <div class="modal" @click.self="$emit('close')">
      <div class="modal-window" @click.self="$emit('close')">

        <button class="modal__btn" @click="$emit('close')">
          <i/>
        </button>

        <slot name="content"/>

      </div>
    </div>
  </transition>
</template>

<script>
// component import


export default {
  props: {
  }

}
</script>

<style lang="scss" scoped>
.modal {
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: 910;
  background-color: rgba(color(deepDarkblue), $alpha: .9);
  @include flex(column nowrap);

  &-window {
    height: 100%;
    padding: 0 interval(2);
    position: relative;

    // ↓ モーダルがスクロールできない問題を解消
    max-height: 100%;
    overflow-y: auto;
  }

  &__btn {
    @include close-button(pixel(5));
    position: fixed;
    top: interval(2);
    right: interval(2);

    @include mq(md) {
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
