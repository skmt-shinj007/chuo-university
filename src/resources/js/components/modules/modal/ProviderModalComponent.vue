<template>
  <modal @close="close">
    <template v-slot:content>
      <div class="provider-modal">
        <div class="provider-modal__container">
          <header class="provider-modal__header">
            <div class="provider-modal__thumbnail">
              <figure class="provider-modal__thumbnail-image">
                <img :src="item.profile_image_url_original" :alt="`${item.name}のプロフィール画像`">
              </figure>
            </div>

            <div class="provider-modal__profile">
              <h4 class="provider-modal__name">{{ item.name }}</h4>
              <div class="provider-modal__information-table">
                <table-component :tableItems="tableData" :ratio="5"/>
              </div>
            </div>
          </header>

          <div class="provider-modal__contents">
            <div class="provider-modal__description">
              <h5 class="provider-modal__description-title">プロフィール</h5>
              <p class="provider-modal__description-text">{{ item.description }}</p>
            </div>
            <div class="provider-modal__button">
              <primary-button :btn="messages.Button.Twitter" @clickEvent="externalLink(item.link)"/>
            </div>
          </div>
        </div>
      </div>
    </template>
  </modal>
</template>

<script>
// component import
import Modal from '../modal/ModalComponent';
import TableComponent from '../table/TableComponent';
import PrimaryButton from '../button/PrimaryButtonComponent';

export default {
  components: {
    Modal,
    TableComponent,
    PrimaryButton,
  },

  data() {
    return {
      /**
       * テーブルコンポーネントに渡す配列
       * @type {array}
       */
      tableData: [],
    }
  },

  props: {
    /**
     * TwitterAPIのproviderレスポンス
     */
    item: {
      type: Object,
      default: null,
    },
  },

  created() {
    // テーブルコンポーネントに送るデータに値を挿入する。
    this.pushTableData('ユーザーネーム', this.item.screen_name);
    this.pushTableData('フォロワー', this.item.followers_count);
    this.pushTableData('フォロー中', this.item.friends_count);
    this.pushTableData('ツイート数', this.item.statuses_count);
  },

  methods: {
    close() {
      this.$emit('close');
    },

    /**
     * テーブルに渡す配列にオブジェクトを格納する。
     * @param1 key [テーブル項目のタイトル]
     * @param2 value [テーブル項目の内容]
     */
    pushTableData(key, value) {
      this.tableData.push({
        key: key,
        value: value,
      });
    }
  },
}
</script>

<style lang="scss" scoped>
.provider-modal {
  background-color: color(white);
  width: 100%;
  margin: interval(5) auto;
  border-radius: radius(hard);
  position: relative;

  @include mq(sm) {
    width: 80%;
    max-width: pixel(150);
  }

  &__container {
    padding: interval(5) interval(2);
  }

  &__profile {
    margin-top: interval(3);
  }

  &__thumbnail {
    width: interval(20);
    margin: 0 auto;
    @include thumbnail-border();

    @include mq(sm) {
      width: interval(18);
    }

    &-image {
      @include trimming(aspect(square));
      width: 100%;

      & > img {
        border-radius: radius(circle);
      }
    }
  }

  &__name {
    text-align: center;
    font-size: font(18);
  }

  &__information-table {
    width: 100%;
    margin-top: interval(3);
  }

  &__contents {
    margin-top: interval(5);
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
