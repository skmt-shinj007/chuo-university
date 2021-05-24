<template>
  <user-ticket @openModal="openModal">
    <template v-slot:thumbnail>
      <user-thumbnail :image="thumbnail" :borderColor='positionColor'/>
    </template>

    <template v-slot:name>
      <span class="player-ticket__name">{{ player.name_ja }}</span>
      <span class="player-ticket__name">{{ player.name_en }}</span>
    </template>

    <template v-slot:label>
      <div class="player-ticket__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:modal>
      <user-modal v-if="showModal" @close="closeModal" :item="player"/>
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
    player: {
      type: Object,
      default: null
    }
  },

  computed: {
    /**
     * ポジションでサムネイルを色分けする。
     * @return {String} css class
     */
    positionColor() {
      return (this.player.position) ? this.player.position.color : 'blue';
    },
  },

  created() {
    const player = this.player;
    this.thumbnail.src = player.img.src;
    this.thumbnail.alt = player.img.alt;

    // ポジションラベルのデータを作成。
    if (player.position) {
      this.labels.push(this.formatToLabel(player.position.color, player.position.name_ja));
    }

    /**
     * Labelに表示するタグを絞り込み
     * [主将, 主務, 副主将, 会計, 寮長]
     */
    const labelTagId = [2, 3, 4, 5, 6];
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

  &__label {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
