<template>
  <user-ticket @openModal="openModal">
    <template v-slot:thumbnail>
      <user-thumbnail :image="player.img" :borderColor='player.position.color'/>
    </template>

    <template v-slot:name>
      <span class="player-ticket__name">{{ player.name_ja }}</span>
      <span class="player-ticket__name">{{ player.name_en }}</span>
    </template>

    <template v-slot:tag>
      <div class="player-ticket__tag" v-for="(tag, i) in tags" :key="i">
        <tag :tag="tag"/>
      </div>
    </template>

    <template v-slot:modal>
      <player-modal
        v-if="showModal"
        @close="closeModal"
        :player="player"
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
import PlayerModal from '../modal/PlayerModalComponent';

import { viewData } from '../../../config/data/viewdata';

export default {
  components: {
    UserTicket,
    Tag,
    UserThumbnail,
    PlayerModal,
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
    player: {
      type: Object,
      default: null
    }
  },

  created() {
    const player = this.player;

    // ポジションラベルのデータを作成。
    if (player.position) {
      this.tags.push(this.formatTag(player.position.color, player.position.name_ja));
    }

    /**
     * Tagに表示するタグを絞り込み
     * [主将, 主務, 副主将, 会計, 寮長]
     */
    const displayTags = Object.values(viewData.playerCardDisplayTagId);
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
      return this.player.tags.find(el => {
        return (el.tag_id === id);
      })
    },
  },
}
</script>

<style lang="scss" scoped>
.player-ticket {
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
