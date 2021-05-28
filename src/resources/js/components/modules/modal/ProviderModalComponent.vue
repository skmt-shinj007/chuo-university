<template>
  <user-modal :user="provider" @close="close">
    <template v-slot:thumbnail>
      <user-thumbnail :image="provider.img"/>
    </template>

    <template v-slot:name>
      <h4 class="provider-modal__name">{{ provider.name }}</h4>
    </template>

    <template v-slot:label>
      <div class="provider-modal__label" v-for="(label, i) in labels" :key="i">
        <label-component :label="label"/>
      </div>
    </template>

    <template v-slot:content>
      <div class="provider-modal__contents">
        <div class="provider-modal__lists">
          <table-component :tableItems="lists" :ratio="4"/>
        </div>
        <div class="provider-modal__profile">
          <div class="provider-modal__description">
            <h5 class="provider-modal__description-title">{{ messages.provider.profile }}</h5>
            <p class="provider-modal__description-text">{{ provider.description }}</p>
          </div>
          <div class="provider-modal__button">
            <primary-button :btn="messages.Button.Twitter" @clickEvent="externalLink(provider.link)"/>
          </div>
        </div>
      </div>
    </template>
  </user-modal>
</template>

<script>
// component import
import UserModal from './UserModalFrameComponent';
import UserThumbnail from '../UserThumbnailComponent';
import LabelComponent from '../label/LabelComponent';
import TableComponent from '../table/TableComponent';
import PrimaryButton from '../button/PrimaryButtonComponent';

export default {
  components: {
    UserModal,
    UserThumbnail,
    LabelComponent,
    TableComponent,
    PrimaryButton,
  },

  props: {
    provider: {
      type: Object,
      required: true,
    },

    /**
     * labelデータ
     * @type {Array}
     */
    labels: {
      type: Array,
      default: null,
    },
  },

  data() {
    return {
      /**
       * リストのデーブルデータ
       * @type {Array}
       */
      lists: [],
    }
  },

  created() {
    const provider = this.provider;
    console.log(this.provider);
    this.pushList('ユーザーネーム', provider.screen_name);
    this.pushList('フォロワー', provider.followers_count);
    this.pushList('フォロー中', provider.friends_count);
    this.pushList('ツイート数', `${provider.statuses_count} ツイート`);
  },

  methods: {
    /**
     * [モーダルを閉じる]
     * 親コンポーネントのメソッドを使う。
     */
    close() {
      this.$emit('close');
    },

    /**
     * テーブルのデータを作成する
     * @param {String} key テーブルの左辺に該当する文字列
     * @param {String} value テーブルの右辺に該当する文字列
     */
    pushList(key, value) {
      this.lists.push({
        key: key,
        value: value,
      });
    },
  },
}
</script>

<style lang="scss" scoped>
.provider-modal {
  &__name {
    font-size: font(18);
    line-height: 1;
  }

  &__label {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }

  &__contents {
    padding: interval(5) 0;
  }

  &__profile {
    margin-top: interval(2);
  }

  &__description {
    border-top: 2px solid color(lightgray);
    border-bottom: 2px solid color(lightgray);

    &-title {
      padding: interval(1) 0;
      text-align: center;
      background-color: color(light);
    }

    &-text {
      margin: interval(1) 0;
    }
  }

  &__button {
    margin-top: interval(5);

    @include mq(sm) {
      margin-right: auto;
      margin-left: auto;
      max-width: interval(50);
    }
  }
}
</style>
