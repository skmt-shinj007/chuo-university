<template>
  <user-ticket @openModal="openModal">
    <template v-slot:thumbnail>
      <user-thumbnail :image="provider.img"/>
    </template>

    <template v-slot:name>
      <span class="player-ticket__name">{{ provider.name }}</span>
    </template>

    <template v-slot:label>
      <div class="provider-ticket__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:modal>
      <provider-modal
        v-if="showModal"
        :provider="provider"
        :labels="labels"
        @close="closeModal"
      />
    </template>
  </user-ticket>
</template>

<script>
// component import
import UserTicket from './UserTicketFrameComponent';
import UserThumbnail from '../UserThumbnailComponent';
import LabelComponent from '../label/LabelComponent';
import ProviderModal from '../modal/ProviderModalComponent';

export default {
  components: {
    UserTicket,
    LabelComponent,
    ProviderModal,
    UserThumbnail,
  },

  data() {
    return {
      /**
       * モーダルの開閉判定フラグ
       * @type { Boolean }
       */
      showModal: false,

      /**
       * labelData
       * @type {object}
       */
      labels: [],
    }
  },

  props: {
    provider: {
      type: Object,
      default: null
    }
  },

  created() {
    this.labels.push(this.formatToLabel('twitter', 'Twitter'));
    console.log(this.provider);
  },

  methods: {
    /**
     * モーダル開閉処理
     */
    openModal() {
      this.showModal = true;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.showModal = false;
      document.body.classList.remove("modal-open");
    },

    /**
     * ラベルコンポーネントに渡すオブジェクトを生成する。
     * @param1 {string} tag color
     * @param2 {string} tag text
     * @return {Object} ラベルコンポーネントに渡すオブジェクト
     */
    formatToLabel(color, text) {
      let data = {};
      data.color = color;
      data.text = text;
      return data;
    },
  },
}
</script>

<style lang="scss">
.provider-ticket {
  &__name {
    display: block;
    font-size: font(14);
  }

  &__label {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
