<template>
<div class="user-ticket">
  <div class="user-ticket__ticket" @click="openModal">
    <div class="user-ticket__thumbnail">
      <slot name="thumbnail" :user="user">
        <user-thumbnail :image="thumbnail" :borderColor='positionColor'/>
      </slot>
    </div>

    <div class="user-ticket__profile">
      <slot name="name" :user="user">
        <span class="user-ticket__profile-name">{{ user.name_ja }}</span>
        <span class="user-ticket__profile-name">{{ user.name_en }}</span>
      </slot>

      <div class="user-ticket__label-group">
        <slot name="label" :user="user">
          <div class="user-ticket__label" v-for="(label, i) in labels" :key="i">
            <label-component :label="label"/>
          </div>
        </slot>
      </div>
    </div>
  </div>

  <slot name="modal" :user="user">
    <user-modal v-if="showModal" @close="closeModal" :item="user"/>
  </slot>
</div>
</template>

<script>
// component import
import UserModal from '../modal/UserModalComponent';
import UserThumbnail from '../UserThumbnailComponent';
import LabelComponent from '../label/LabelComponent';

export default {
  components: {
    UserModal,
    LabelComponent,
    UserThumbnail,
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
    user: {
      type: Object,
      default: null
    }
  },

  computed: {
    /**
     * playerのみサムネイルを色分けする。
     * @return {String} css class
     */
    positionColor() {
      return (this.user.position && this.userType(1)) ? this.user.position.color : 'blue';
    },
  },

  created() {
    const user = this.user;
    this.thumbnail.src = user.img.src;
    this.thumbnail.alt = user.img.alt;

    // playerのみポジションラベルをつける。
    if (user.position && this.userType(1)) {
      this.labels.push(this.formatToLabel(user.position.color, user.position.name_ja));
    }

    // Labelに表示するタグを絞り込み
    const labelTagId = [2, 3, 4, 5, 6, 8, 9, 10];
    labelTagId.forEach(id => {
      let tag = this.pickUpTag(id);
      if (tag) {
        this.labels.push(this.formatToLabel('darkblue', tag.name_ja));
      }
    })
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
      return this.user.tags.find(el => {
        return (el.tag_id === id);
      })
    },

    /**
     * ユーザータイプをタグで判定する。
     * [1]:部員
     * [7]:スタッフ
     * @param {Number} tag_id
     * @return {Boolean}
     */
    userType(id) {
      return this.user.tags.some(tag => tag.tag_id === id);
    }
  },
}
</script>

<style lang="scss">
.user-ticket {
  background-color: color(white);
  position: relative;

  &__ticket {
    @include flex(row nowrap, flex-start, center);
    box-shadow: 0 1px 3px 1px color(darkShadow);
    border-radius: radius(normal);
    padding: interval(1);

    @include mq(md) {
      cursor: pointer;
      transition: all .3s ease-out;
    }

    @include hover {
      box-shadow: 0 3px 5px 3px color(darkShadow);
      transform: translateY(-2px);
    }
  }

  &__thumbnail {
    width: interval(10);
  }

  &__profile {
    margin-left: 5%;

    &-name {
      display: block;
      font-size: font(14);

      &:last-of-type {
        font-size: font(12);
      }
    }
  }

  &__label-group {
    @include flex(row wrap, flex-start, center);
  }

  &__label {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }
}

</style>
