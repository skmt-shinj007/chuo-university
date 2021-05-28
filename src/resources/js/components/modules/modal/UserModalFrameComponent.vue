<template>
  <modal @close="close">
    <template v-slot:content>
      <div class="user-modal">
        <div class="user-modal__content">
          <header class="user-modal__header">

            <div class="user-modal__thumbnail">
              <slot name="thumbnail">
                <!-- サムネイル -->
              </slot>
            </div>

            <div class="user-modal__profile">
              <div class="user-modal__name">
                <slot name="name">
                  <!-- 名前 -->
                  <h4 class="user-modal__name-ja">{{ user.name_ja }}</h4>
                  <span class="user-modal__name-en">{{ user.name_en }}</span>
                </slot>
              </div>

              <div class="user-modal__label-group">
                <slot name="label">
                  <!-- ラベル -->
                </slot>
              </div>
            </div>
          </header>

          <div class="user-modal__line"/>

          <slot name="content">
            <!-- コンテンツ -->
          </slot>
        </div>
      </div>
    </template>
  </modal>
</template>

<script>
// component import
import Modal from '../modal/ModalComponent';

export default {
  components: {
    Modal,
  },

  props: {
    /**
     * [クリックしたチケットのデータ]
     */
    user: {
      type: Object,
      default: null,
    },
  },

  methods: {
    close() {
      this.$emit('close');
    },
  },
}
</script>

<style lang="scss" scoped>
.user-modal {
  background-color: color(white);
  width: 100%;
  margin: interval(5) auto;
  border-radius: radius(hard);
  position: relative;

  @include mq(sm) {
    width: 80%;
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
  }

  &__profile {
    margin-top: interval(3);
  }

  &__thumbnail {
    width: interval(25);
  }

  &__image {
    @include trimming(aspect(square));
    width: 100%;

    & > img {
      border-radius: radius(circle);
    }
  }

  &__name {
    text-align: center;

    &-ja {
      font-size: font(18);
      line-height: 1;

      @include mq(md) {
        display: inline-block;
      }
    }

    &-en {
      font-size: font(14);

      @include mq(md) {
        display: inline-block;
        margin-left: interval(.5);
      }
    }
  }

  &__label-group {
    margin-top: interval(1);
    @include flex(row wrap, center, center);
  }

  &__line {
    width: 100%;
    height: 2px;
    background-color: color(lightgray);
  }
}
</style>
