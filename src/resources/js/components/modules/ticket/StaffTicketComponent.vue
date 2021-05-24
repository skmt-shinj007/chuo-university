<template>
  <user-ticket @openModal="openModal">
    <template v-slot:thumbnail>
      <user-thumbnail :image="thumbnail"/>
    </template>

    <template v-slot:name>
      <span class="staff-ticket__name">{{ staff.name_ja }}</span>
      <span class="staff-ticket__name">{{ staff.name_en }}</span>
    </template>

    <template v-slot:label>
      <div class="staff-ticket__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:modal>
      <user-modal v-if="showModal" @close="closeModal" :item="staff"/>
    </template>
  </user-ticket>
</template>

<script>
// component import
import UserTicket from './UserTicketComponent';
import UserThumbnail from '../UserThumbnailComponent';
import LabelComponent from '../label/LabelComponent';
import UserModal from '../modal/UserModalComponent';

export default {
  components: {
    UserTicket,
    LabelComponent,
    UserThumbnail,
    UserModal,
  },

  data() {
    return {
      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      /**
       * thumbnailコンポーネントに渡すオブジェクト
       * @type {Object}
       */
      thumbnail: {
        img: '',
        alt: ''
      },

      /**
       * LabelComponentに渡すデータ
       * @type {Array}
       */
      labels: [],
    }
  },

  props: {
    staff: {
      type: Object,
      default: null
    }
  },

  created() {
    const staff = this.staff;
    this.thumbnail.src = staff.img.src;
    this.thumbnail.alt = staff.img.alt;

    /**
     * Labelに表示するタグを絞り込み
     * [監督, 部長, コーチ]
     */
    const labelTagId = [8, 9, 10];
    labelTagId.forEach(id => {
      let tag = this.pickUpTag(id);
      if (tag) {
        this.labels.push(this.formatToLabel('darkblue', tag.name_ja));
      }
    })
  },

  methods: {
    /**
     * モーダル開閉処理。
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

    /**
     * ラベルに出力するタグをIDで抽出する。
     * @param {Number} 抽出したいタグのid
     * @return {Object} tag object
     */
    pickUpTag(id) {
      return this.staff.tags.find(el => {
        return (el.tag_id === id);
      })
    },
  },
}
</script>

<style lang="scss" scoped>
.staff-ticket {
  &__name {
    display: block;
    font-size: font(14);

    &:last-of-type {
      font-size: font(12);
    }
  }

  &__label {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
