<template>
  <transition name="modal" appear>
    <div class="modal" @click.self="$emit('close')">
      <div class="modal-window" @click="$emit('close')">

        <div class="ticket-modal">
          <div class="ticket-modal__container">
            <header class="ticket-modal__header">
              <button class="ticket-modal__close-btn" @click="$emit('close')">
                <i/>
              </button>
            </header>

            <div class="ticket-modal__content">
              <div class="ticket-modal__basic-information">

                <div class="ticket-modal__thumbnail-border" :class="border">
                  <figure class="ticket-modal__thumbnail">
                    <img :src="`/image/${item.img.src}`" :alt="item.img.alt">
                  </figure>
                </div>

                <div class="ticket-modal__name">
                  <span class="ticket-modal__name-sub">{{ item.name.en }}</span>
                  <h4 class="ticket-modal__name-main">{{ item.name.ja }}</h4>
                </div>

                <div class="ticket-modal__tag-group">
                  <tag-component v-if="item.post.club" :content="item.post.club" :responsive="true"/>
                  <position-tag-component :position="item.position" :responsive="true"/>
                  <grade-tag-component :grade="item.grade" :responsive="true"/>
                </div>
              </div>

              <div class="ticket-modal__line"/>

              <ul class="ticket-modal__list">

                <!-- リストは、ユーザーカテゴリーによって内容が異なるのでslotに。 -->
                <slot name="list">
                <li class="ticket-modal__list-item" v-for="(listItem, n) in listItems" :key="n">
                  <span class="ticket-modal__list-title">{{ listItem.key }}</span>
                  <span class="ticket-modal__list-content nl2br" v-text="listItem.value"/>
                </li>
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

export default {
  components: {
    TagComponent,
    PositionTagComponent,
    GradeTagComponent,
  },

  data() {
    return {
      /**
       * リストのアイテム
       * @type { Array }
       */
      listItems: [],
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
     * リストの配列をチケットのデータを基に作成し、配列:listItems にプッシュする
     */
    const lists = [
      {
        key: "学年",
        value: `${this.item.grade}年生`
      },
      {
        key: "学部",
        value: this.item.undergraduate
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
        key: "戦績",
        value: this.item.record
      },
      {
        key: "メッセージ",
        value: this.item.message
      },
    ];
    lists.forEach(element => this.listItems.push(element));
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
      width: 60%;
    }
  }

  &__header {
    @include flex(row wrap, flex-end);
    padding: interval(2) 0;
  }

  &__close-btn {
    margin-right: interval(2);
    @include close-button(interval(5));
  }

  &__content {
    padding: 0 interval(2);

    @include mq(sm) {
      padding: interval(1) interval(2);
    }

    @include mq(md) {
      padding: interval(2) interval(4);
    }
  }

  &__basic-information {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      @include flex(row nowrap, flex-start, center);
    }
  }

  &__thumbnail-border {
    width: interval(20);
    height: interval(20);
    @include border-gradient();

    @include mq(sm) {
      min-width: interval(15);
      max-width: interval(34);
      width: 27%;
      height: 100%;
      margin-left: 5%;
    }

    &--orange {
      @include border-gradient($start-color: color(orange), $end-color: color(lightDarkblue));
    }

    &--green {
      @include border-gradient($start-color: color(lightGreen), $end-color: color(lightDarkblue));
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
    margin-top: interval(5);
    text-align: center;

    @include mq(sm) {
      margin-top: 0;
      margin-left: 10%;
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
      margin-top: 0;
      margin-left: interval(2);
      @include flex(column wrap, center, stretch);
    }

    @include mq(md) {
      margin-left: 10%;
    }
  }

  &__line {
    width: 100%;
    height: 2px;
    margin-top: interval(5);
    // @include gradient(color(deepDarkblue), color(white), horizontal);
    background-color: color(lightgray);
  }

  &__list {
    padding: interval(5) 0;
  }

  &__list-item {
    @include flex();
    margin-bottom: interval(2);

    &:last-child {
      margin-bottom: 0;
    }

    & > span {
      font-size: font(12);

      @include mq(sm) {
        font-size: font(16);
      }
    }
  }

  &__list-title {
    display: block;
    width: 30%;
    text-align: center;
  }

  &__list-content {
    display: block;
    width: 70%;
    margin-left: interval(1);

    @include mq(md) {
      margin-left: 0;
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
