<template>
  <modal @close="close">
    <template v-slot:content>
      <div class="user-modal">
        <div class="user-modal__content">
          <header class="user-modal__header">

            <div class="user-modal__thumbnail" :class="color">
              <figure class="user-modal__image">
                <img :src="`/image/${item.img.src}`" :alt="item.img.alt">
              </figure>
            </div>

            <div class="user-modal__info">
              <div class="user-modal__name">
                <h4 class="user-modal__name-main">{{ item.name.ja }}</h4>
                <span class="user-modal__name-sub" v-if="item.name.en">{{ item.name.en }}</span>
              </div>

              <div class="user-modal__tag-group">
                <div class="user-modal__tag" v-if="item.post.club">
                  <tag :content="item.post.club" :responsive="true"/>
                </div>
                <div class="user-modal__tag" v-if="item.position">
                  <position-tag :position="item.position" :responsive="true"/>
                </div>
                <div class="user-modal__tag" v-if="item.grade">
                  <grade-tag :grade="item.grade" :responsive="true"/>
                </div>
              </div>
            </div>
          </header>

          <div class="user-modal__line"/>

          <slot name="content">
            <ul class="user-modal__list">
              <table-component :tableItems="lists"/>
            </ul>
          </slot>

        </div>
      </div>
    </template>
  </modal>
</template>

<script>
// component import
import Modal from '../modal/ModalComponent';
import Tag from '../tag/TagComponent.vue';
import PositionTag from '../tag/PositionTagComponent.vue';
import GradeTag from '../tag/GradeTagComponent.vue';
import TableComponent from '../table/TableComponent.vue';

export default {
  components: {
    Modal,
    Tag,
    PositionTag,
    GradeTag,
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
    color() {
      const borderClass = 'user-modal__thumbnail';
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
    ];
    lists.forEach(element => this.lists.push(element));
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

    @include mq(sm) {
      @include flex(row nowrap, center, center);
    }
  }

  &__info {
    margin-top: interval(3);

    @include mq(sm) {
      margin-top: 0;
      margin-left: interval(3);
    }
  }

  &__thumbnail {
    width: interval(20);
    @include thumbnail-border();

    @include mq(sm) {
      width: interval(18);
    }

    &--orange {
      @include thumbnail-border($color: color(orange));
    }

    &--green {
      @include thumbnail-border($color: color(lightGreen));
    }
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
    background-color: color(lightgray);
  }

  &__list {
    padding: interval(5) 0;
  }
}
</style>
