<template>
  <transition name="modal" appear>
    <div class="modal" @click.self="$emit('close')">
      <div class="modal-window" @click.self="$emit('close')">

        <div class="modal__close">
          <button class="modal__button" @click="$emit('close')">
            <svg-vue icon="close"/>
          </button>
        </div>

        <slot name="content"/>

      </div>
    </div>
  </transition>
</template>

<script>
export default {

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

  &__close {
    position: fixed;
    top: interval(2);
    right: interval(2);
  }

  &__button {
    @include close-button;
    background-color: color(orange);

    @include mq(md) {
      background-color: rgba($color: #000000, $alpha: 0);
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
