<template>
  <user-ticket @openModal="openModal">
    <template v-slot:thumbnail>
      <user-thumbnail :image="staff.img"/>
    </template>

    <template v-slot:name>
      <span class="staff-ticket__name">{{ staff.name_ja }}</span>
      <span class="staff-ticket__name">{{ staff.name_en }}</span>
    </template>

    <template v-slot:tag>
      <div class="staff-ticket__tag" v-for="(tag, i) in tags" :key="i">
        <tag :tag="tag"/>
      </div>
    </template>

    <template v-slot:modal>
      <staff-modal
        v-if="showModal"
        @close="closeModal"
        :staff="staff"
        :tags="tags"
      />
    </template>
  </user-ticket>
</template>

<script>
// component import
import UserTicket from './UserTicketFrameComponent';
import UserThumbnail from '../UserThumbnailComponent';
import Tag from '../tag/TagComponent';
import StaffModal from '../modal/StaffModalComponent';

import { viewData } from '../../../config/data/viewData';

export default {
  components: {
    UserTicket,
    Tag,
    UserThumbnail,
    StaffModal,
  },

  data() {
    return {
      /**
       * [モーダル表示フラグ]
       * @type { Boolean }
       */
      showModal: false,

      tags: [],
    }
  },

  props: {
    staff: {
      type: Object,
      default: null
    }
  },

  created() {
    /**
     * チケットに表示するタグを絞り込み
     * [監督, 部長, コーチ]
     */
    const displayTags = Object.values(viewData.staffCardDisplayTagId);
    displayTags.forEach(id => {
      let tag = this.pickUpTag(id);
      if (tag) {
        this.tags.push(this.formatTag('darkblue', tag.name_ja));
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

  &__tag {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
