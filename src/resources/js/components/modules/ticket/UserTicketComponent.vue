<template>
<div class="user-ticket">
  <div class="user-ticket__ticket" @click="openModal">
    <div class="user-ticket__thumbnail">
      <user-thumbnail :image="thumbnail" :borderColor='positionColor'/>
    </div>

    <div class="user-ticket__profile">
      <span class="user-ticket__profile-name">{{ user.name_ja }}</span>
      <span class="user-ticket__profile-name">{{ user.name_en }}</span>

      <!-- TODO：タグの改修 -->
      <div class="user-ticket__profile-tag-group">
        <div class="user-ticket__profile-tag">
          <!-- <position-tag :position="userObj.position"/> -->
        </div>
        <div class="user-ticket__profile-tag">
          <!-- <grade-tag :grade="user.grade"/> -->
        </div>
      </div>
    </div>

    <div class="user-ticket__border" :class="`user-ticket__border--${positionColor}`"/>
  </div>

  <user-modal v-if="showModal" @close="closeModal" :item="user"/>
</div>
</template>

<script>
// component import
import UserModal from '../modal/UserModalComponent';
import Tag from '../tag/TagComponent';
import PositionTag from '../tag/PositionTagComponent';
import GradeTag from '../tag/GradeTagComponent';
import UserThumbnail from '../UserThumbnailComponent';

export default {
  components: {
    UserModal,
    Tag,
    PositionTag,
    GradeTag,
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
       * @type {object}
       */
      thumbnail: {
        img: '',
        alt: ''
      },
    }
  },

  props: {
    user: {
      type: Object,
      default: null
    }
  },

  computed: {
    positionColor() {
      return (this.user.position) ? this.user.position.color : 'blue';
    }
  },

  created() {
    let image = this.user.img;
    if (image) {
      this.thumbnail.img = image.src;
      this.thumbnail.alt = image.alt;
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

<style lang="scss">
.user-ticket {
  background-color: color(white);
  position: relative;

  &__ticket {
    @include flex(row nowrap, flex-start, center);
    box-shadow: 0 1px 3px 1px color(darkShadow);
    border-radius: radius(soft);
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

    &-tag-group {
      @include flex(row wrap, flex-start, center);
    }

    &-tag {
      margin: interval(.5) interval(.5) 0 0;

      &:last-child {
        margin-right: 0;
      }
    }
  }

  &__border {
    width: 10%;
    height: pixel(.5);
    position: absolute;
    top: 50%;
    right: 0;
    transform: translate(25%, -50%);

    &--blue {
      @include gradient(color(lightDarkblue), color(blue), horizontal);
    }

    &--lightgreen {
      @include gradient(color(lightDarkblue), color(lightgreen), horizontal);
    }

    &--orange {
      @include gradient(color(lightDarkblue), color(orange), horizontal);
    }

    @include mq(md) {
      display: none;
    }
  }
}

</style>
