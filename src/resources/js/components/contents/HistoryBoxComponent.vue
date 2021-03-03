<template>
<div class="history-box">
  <div class="history-box__tag-record" @click="openModal">
    <record-tag/>
  </div>

  <!-- タグ押下時のモーダル -->
  <div class="history-box__modal" v-if="showModal">
    <modal @close="closeModal">
      <template v-slot:content>
        <div class="record-modal">
          <div class="record-modal__box" v-for="(item, n) in data.Records" :key="n">
            <h4 class="record-modal__year">{{ data.Age + item.year }}年度</h4>
            <table-component :tableItems="item.result" :ratio="5"/>
          </div>
        </div>
      </template>
    </modal>
  </div>

  <div class="history-box__title">
    <h3 class="history-box__title-main">{{data.Title.Main }}</h3>
    <span class="history-box__title-sub">{{ data.Title.Sub }}</span>
  </div>

  <div class="history-box__tag-date">
    <tag color="outline-orange" :content="data.Term"/>
  </div>

  <div class="history-box__text-container">
    <p class="history-box__text nl2br" v-text="data.Text"/>
  </div>

</div>
</template>

<script>
// component import
import Tag from '../modules/tag/TagComponent';
import RecordTag from '../modules/tag/RecordTagComponent';
import Modal from '../modules/modal/ModalComponent.vue';
import TableComponent from '../modules/table/TableComponent.vue';

// data import
import Data from '../../config/data.json';

export default {
  components: {
    Tag,
    RecordTag,
    Modal,
    TableComponent,
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
    data: {
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

// 戦績モーダルのスタイル
.record-modal {
  margin: interval(5) 0;

  @include mq(sm) {
    width: 80%;
    margin: interval(5) auto;
  }

  &__box {
    margin-bottom: interval(3);
  }

  &__year {
    color: color(white);
  }
}

</style>
