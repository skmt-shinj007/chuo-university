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
                  <div class="ticket-modal__thumbnail-border" :class="border">
                    <figure class="ticket-modal__thumbnail">
                      <img :src="`/image/${item.img.src}`" :alt="item.img.alt">
                    </figure>
                  </div>
                </div>

                <div class="ticket-modal__header-info">
                  <div class="ticket-modal__name">
                    <span class="ticket-modal__name-sub">{{ item.name.en }}</span>
                    <h4 class="ticket-modal__name-main">{{ item.name.ja }}</h4>
                  </div>

                  <div class="ticket-modal__tag-group">
                    <div class="ticket-modal__tag" v-if="item.post.club">
                      <tag-component :content="item.post.club" :responsive="true"/>
                    </div>
                    <div class="ticket-modal__tag" v-if="item.position">
                      <position-tag-component :position="item.position" :responsive="true"/>
                    </div>
                    <div class="ticket-modal__tag" v-if="item.grade">
                      <grade-tag-component :grade="item.grade" :responsive="true"/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="ticket-modal__line"/>

              <ul class="ticket-modal__list">

                <!-- リストは、ユーザーカテゴリーによって内容が異なるのでslotに。 -->
                <slot name="list">
                  <table-component :tableItems="lists"/>
                </slot>

              </ul>
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
    /**
     * ポジションによってボーダー色を変えるためにクラスを付与する
     */
    border() {
      const borderClass = 'ticket-modal__thumbnail-border';
      return (this.item.position === "前衛") ? `${borderClass}--orange` : (this.item.position === "後衛") ? `${borderClass}--green` : `${borderClass}--blue`;
    }
  },

  beforeMount() {
    /**
     * リストの配列をチケットのデータを基に作成し、配列:lists にプッシュする
     */
    const lists = [
      {
        key: "学年",
        value: `${this.item.grade}年生`
      },
      {
        key: "所属学部",
        value: this.item.undergraduate
      },
      {
        key: "役職",
        value: this.item.post.club
      },
      {
        key: "出身地",
        value: this.item.from.place
      },
      {
        key: "出身校",
        value: this.item.from.almaMater
      },
      {
        key: "ポジション",
        value: this.item.position
      },
      {
        key: "成績",
        value: this.item.record
      },
      {
        key: "メッセージ",
        value: this.item.message
      },
    ];
    lists.forEach(element => this.lists.push(element));
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
    @include close-button($color: color(darkblue));
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

    &--orange {
      @include thumbnail-border($start-color: color(orange), $end-color: color(lightDarkblue));
    }

    &--green {
      @include thumbnail-border($start-color: color(lightGreen), $end-color: color(lightDarkblue));
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

  &__name-sub {
    font-size: font(14);
  }

  &__name-main {
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

  &__list {
    padding: interval(5) 0;
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
