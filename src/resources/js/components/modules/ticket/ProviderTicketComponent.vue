<template>
  <user-ticket @openModal="openModal">
    <template v-slot:thumbnail>
      <user-thumbnail :image="provider.img"/>
    </template>

    <template v-slot:name>
      <span class="player-ticket__name">{{ provider.name }}</span>
    </template>

    <template v-slot:tag>
      <div class="provider-ticket__tag" v-for="(tag, i) in tags" :key="i">
        <tag :tag="tag"/>
      </div>
    </template>

    <template v-slot:modal>
      <provider-modal
        v-if="showModal"
        :provider="provider"
        :tags="tags"
        @close="closeModal"
      />
    </template>
  </user-ticket>
</template>

<script>
// component import
import UserTicket from './UserTicketFrameComponent';
import UserThumbnail from '../UserThumbnailComponent';
import Tag from '../tag/TagComponent';
import ProviderModal from '../modal/ProviderModalComponent';

export default {
  components: {
    UserTicket,
    Tag,
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

      tags: [],
    }
  },

  props: {
    provider: {
      type: Object,
      default: null
    }
  },

  created() {
    this.tags.push(this.formatTag('twitter', 'Twitter'));
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
  },
}
</script>

<style lang="scss">
.provider-ticket {
  &__name {
    display: block;
    font-size: font(14);
  }

  &__tag {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
