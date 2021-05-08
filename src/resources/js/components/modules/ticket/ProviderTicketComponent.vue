<template>
<div class="provider-ticket" ref="targetElement" @click="openModal">
  <div class="provider-ticket__ticket">
    <div class="provider-ticket-thumbnail-border">
      <figure class="provider-ticket-thumbnail">
        <img :src="provider.profile_image_url_original" :alt="`${provider.name}のプロフィール画像`">
      </figure>
    </div>

    <div class="provider-ticket-item">
      <span class="provider-ticket__name">{{ provider.name }}</span>

      <!-- SNSタグは 2つ まで -->
      <div class="provider-ticket-tag-group">
        <!-- twitter -->
        <sns-tag sns="twitter" content="Twitter"/>
        <!-- instagram -->
        <sns-tag sns="instagram" content="Instagram"/>
      </div>
    </div>

    <div class="provider-ticket-item">
      <svg-vue class="provider-ticket-icon" icon="angle_right"/>
    </div>
  </div>

  <!-- モーダル -->
  <provider-modal v-if="isShow" :item="provider"/>
</div>
</template>

<script>
// component import
import SnsTag from '../tag/SnsTagComponent';
import ProviderModal from '../modal/ProviderModalComponent';

export default {
  components: {
    SnsTag,
    ProviderModal,
  },

  data() {
    return {
      /**
       * モーダルの開閉判定フラグ
       * @type { Boolean }
       */
      isShow: false,
    }
  },

  props: {
    provider: {
      type: Object,
      default: null
    }
  },

  methods: {
    /**
     * [モーダル開閉処理]
     */
    openModal() {
      this.isShow = true;
      document.body.classList.add("modal-open");
    },
    closeModal() {
      this.isShow = false;
      document.body.classList.remove("modal-open");
    },
  },
}
</script>

<style lang="scss">
.provider-ticket {
  width: interval(34);

  @include mq(md) {
    cursor: pointer;
  }

  &__ticket {
    @include flex(row nowrap, space-between, center);
    padding: interval(1);
    box-shadow: 0 3px 5px 3px color(darkShadow);
    border-radius: 100px;

    @include mq(md) {
      box-shadow: 0 1px 3px 1px color(darkShadow);
      transition: all .3s ease-out;
    }

    @include hover {
      box-shadow: 0 3px 5px 3px color(darkShadow);
      transform: translateY(-2px);
    }
  }

  &-thumbnail-border {
    @include thumbnail-border();
    width: interval(9);
    height: interval(9);
  }

  &-thumbnail {
    width: 100%;
    @include trimming(aspect(square));

    @include mq(sm) {
      width: interval(10);
    }

    & > img {
      border-radius: radius(circle);
    }
  }

  &__name {
    display: block;
    font-size: font(14);
    padding-left: interval(.5);
  }

  &-tag-group {
    @include flex(row wrap, flex-start, center);
  }

  &-icon {
    width: interval(1.5);
    height: interval(1.5);
    fill: color(darkblue);
  }
}

</style>
