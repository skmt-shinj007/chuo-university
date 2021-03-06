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
            <h4 class="record-modal__year">{{ data.age + item.year }}年度</h4>
            <table-component :tableItems="item.result" :ratio="5"/>
          </div>
        </div>
      </template>
    </modal>
  </div>

  <div class="history-box__title">
    <span class="history-box__title-sub">{{ data.title.sub }}</span>
    <h3 class="history-box__title-main">{{data.title.main }}</h3>
  </div>

  <div class="history-box__tag">
    <tag color="outline-orange" :content="term" size="md"/>
  </div>

  <div class="history-box__text-container">
    <p class="history-box__text nl2br" v-text="data.text"/>
  </div>

</div>
</template>

<script>
// component import
import Tag from '../modules/tag/TagComponent';
import RecordTag from '../modules/tag/RecordTagComponent';
import Modal from '../modules/modal/ModalComponent.vue';
import TableComponent from '../modules/table/TableComponent.vue';

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
    }
  },

  props: {
    /**
     * 歴史のブロックデータ
     */
    data: {
      type: Object,
      default: null
    }
  },

  computed: {
    /**
     * [タグ]:歴史カードの期間
     * @return { String }  ex) 昭和7年 - 昭和23年
     */
    term() {
      const data = this.data;
      let start = String(data.term.start);
      if (start === '1') start = '元';
      return `${data.age} ${start}年 - ${data.term.end}年`;
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
  background-color: color(lightgray);
  box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px;
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

  &__tag {
    margin: interval(1) 0;

    @include mq(sm) {
      width: 40%;
    }

    @include mq(md) {
      width: interval(26)
    }
  }

  &__title {
    @include flex(column nowrap, center, center);
    margin-top: interval(3);

    &-main {
      position: relative;
      font-size: font(18);
      transform: translateY(- interval(2.5));

      &::after {
        content: '';
        display: block;
        background-color: color(darkblue);
        width: interval(3);
        height: 2px;
        position: absolute;
        bottom: - interval(.5);
        left: 50%;
        transform: translateX(-50%);
      }
    }

    &-sub {
      font-size: font(26);
      opacity: .1;
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
