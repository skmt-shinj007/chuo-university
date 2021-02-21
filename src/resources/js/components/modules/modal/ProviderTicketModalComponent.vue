<template>
  <transition name="modal" appear>
    <div class="modal" @click.self="$emit('close')">
      <div class="modal-window" @click.self="$emit('close')">

        <div class="ticket-modal">
          <div class="ticket-modal__container">
            <button class="ticket-modal__close-btn" @click="$emit('close')">
              <i class="btn-line"/>
            </button>

            <div class="ticket-modal__content">
              <div class="ticket-modal__header">

                <div class="ticket-modal__header-thumbnail">
                  <div class="ticket-modal__thumbnail-border">
                    <figure class="ticket-modal__thumbnail">
                      <img :src="`/image/${item.img.src}.jpg`" :alt="item.img.alt">
                    </figure>
                  </div>
                </div>

                <div class="ticket-modal__header-info">
                  <div class="ticket-modal__name">
                    <h4 class="ticket-modal__name-account">{{ item.name }}</h4>
                  </div>
                </div>
              </div>

              <div class="ticket-modal__line"/>

              <!-- ここに出すコンテンツを検討 -->
            </div>
            <footer class="ticket-modal__footer">

            </footer>
          </div>
        </div>

      </div>
    </div>
  </transition>
</template>

<script>
// component import
import TagComponent from '../tag/TagComponent.vue';
import PositionTagComponent from '../tag/PositionTagComponent.vue';
import GradeTagComponent from '../tag/GradeTagComponent.vue';
import TableComponent from '../table/TableComponent.vue';

export default {
  components: {
    TagComponent,
    PositionTagComponent,
    GradeTagComponent,
    TableComponent,
  },

  data() {
    return {
      /**
       * [選手] リストのアイテム
       * @type { Array }
       */
      lists: [],
    }
  },

  props: {
    /**
     * [クリックしたチケットのデータ]
     */
    item: {
      type: Object,
      default: null,
    },
  },

  computed: {

  },

  beforeMount() {

  },

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
}

.ticket-modal {

  &__container {
    background-color: color(white);
    width: 100%;
    margin: interval(5) auto;
    border-radius: radius(hard);
    position: relative;

    @include mq(sm) {
      width: 80%;
    }

    @include mq(md) {
      max-width: interval(100);
      margin: interval(5) auto;
    }
  }

  &__close-btn {
    @include close-button(pixel(5), color(darkblue));
    position: absolute;
    right: interval(2);
    top: interval(2);
  }

  &__content {
    padding: interval(2);

    @include mq(md) {
      padding: interval(3)
    }
  }

  &__header {
    @include flex(column nowrap, center, center);
    padding: interval(5) 0;

    @include mq(sm) {
      @include flex(row nowrap, flex-start, center);
    }

    &-thumbnail {
      padding: pixel(1);

      @include mq(sm) {

      }
    }

    &-info {
      margin-top: interval(3);

      @include mq(sm) {
        margin-top: 0;
        margin-left: interval(4);
      }
    }
  }

  &__thumbnail-border {
    width: interval(20);
    height: 100%;
    @include thumbnail-border();

    @include mq(sm) {
      width: interval(18);
    }

    @include mq(md) {
      width: interval(24);
    }
  }

  &__thumbnail {
    @include trimming(aspect(square));
    width: 100%;

    & > img {
      border-radius: radius(circle);
    }
  }

  &__name {
    text-align: center;

    @include mq(sm) {
      text-align: left;
    }
  }

  &__name-account {
    font-size: font(18);
  }

  &__tag-group {
    margin-top: interval(2);
    @include flex(row wrap, center, center);

    @include mq(sm) {
      @include flex(row wrap, flex-start, center);
    }
  }

  &__tag {
    margin: 0 interval(.5) interval(.5) 0;

    &:last-child {
      margin-right: 0;
    }
  }

  &__line {
    width: 100%;
    height: 2px;
    // @include gradient(color(deepDarkblue), color(white), horizontal);
    background-color: color(lightgray);
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
