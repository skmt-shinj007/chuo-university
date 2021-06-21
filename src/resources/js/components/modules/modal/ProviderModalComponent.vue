<template>
  <user-modal :user="provider" @close="close">
    <template v-slot:thumbnail>
      <user-thumbnail :image="provider.img"/>
    </template>

    <template v-slot:name>
      <h4 class="provider-modal__name">{{ provider.name }}</h4>
    </template>

    <template v-slot:tag>
      <div class="provider-modal__tag" v-for="(tag, i) in tags" :key="i">
        <tag :tag="tag"/>
      </div>
    </template>

    <template v-slot:content>
      <div class="provider-modal__contents">
        <div class="provider-modal__description">
          <h5 class="provider-modal__description-title">{{ messages.provider.profile }}</h5>
          <p class="provider-modal__description-text">{{ provider.description }}</p>
        </div>
        <div class="provider-modal__lists">
          <table-component :table="table" :ratio="4"/>
        </div>
        <div class="provider-modal__button">
          <primary-button :btn="messages.Button.Twitter" @clickEvent="externalLink(provider.link)"/>
        </div>
      </div>
    </template>
  </user-modal>
</template>

<script>
// component import
import UserModal from './UserModalFrameComponent';
import UserThumbnail from '../UserThumbnailComponent';
import Tag from '../tag/TagComponent';
import TableComponent from '../table/TableComponent';
import PrimaryButton from '../button/PrimaryButtonComponent';

export default {
  components: {
    UserModal,
    UserThumbnail,
    Tag,
    TableComponent,
    PrimaryButton,
  },

  props: {
    provider: {
      type: Object,
      required: true,
    },

    tags: {
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
      table: null,
    }
  },

  created() {
    const provider = this.provider;

    let records = [
      this.createTableBody('ユーザーネーム', provider.screen_name),
      this.createTableBody('フォロワー', provider.followers_count),
      this.createTableBody('フォロー中', provider.friends_count),
      this.createTableBody('ツイート数', `${provider.statuses_count} ツイート`),
    ];
    this.table = this.createTableData(null, records);
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

  &__tag {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }

  &__contents {
    padding: interval(5) 0;
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

  &__lists {
    margin-top: interval(5);
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
