<template>
<div class="history-box">
  <div class="history-box__tag-record" @click="openModal()">
    <record-tag-component/>
  </div>

  <div class="history-box__modal" v-if="showModal">
    <record-modal-component @close="closeModal"/>
  </div>

  <div class="history-box__title">
    <h3 class="history-box__title-main">{{ Contents.Title.Main }}</h3>
    <span class="history-box__title-sub">{{ Contents.Title.Sub }}</span>
  </div>

  <div class="history-box__tag-date">
    <tag-component color="outline-orange" :content="Contents.term"/>
  </div>

  <div class="history-box__text-container">
    <p class="history-box__text nl2br" v-text="Contents.Text"/>
  </div>

</div>
</template>

<script>
// component import
import TagComponent from '../modules/tag/TagComponent';
import RecordTagComponent from '../modules/tag/RecordTagComponent';
import RecordModalComponent from '../modules/modal/RecordModalComponent.vue';

export default {
  components: {
    TagComponent,
    RecordTagComponent,
    RecordModalComponent,
  },

  data() {
    return {
      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * [モーダルに渡すデータ]
       * @type { Object }
       */
      clickElement: null,
    }
  },

  props: {
    Contents: {
      type: Object,
      default: null
    }
  },

  methods: {
    /**
     * [モーダル開閉処理]
     */
    openModal() {
      this.showModal = true;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.showModal = false;
      document.body.classList.remove("modal-open");
    },
  },
}
</script>

<style lang="scss" scoped>
.history-box {
  border: 2px solid color(darkblue);
  border-radius: radius(hard);
  position: relative;
  padding: pixel(2);

  &__tag-record {
    position: absolute;
    top: - interval(2.5);
    right: 5%;

    @include mq(md) {
      top: - interval(3);
    }
  }

  &__tag-date {
    margin: interval(1) 0;

    @include mq(sm) {
      width: interval(22);
    }
  }

  &__title {
    text-align: center;
    margin-top: interval(3);

    &-main {
      font-size: font(18);
    }
  }

  &__text-container {
    margin: interval(2) 0;
  }

  &__text {
    letter-spacing: 1.8px;
    font-weight: bold;
  }
}

</style>
