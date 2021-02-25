<template>
<div class="text-box">
  <div class="text-box__title">
    <contents-title-component :title="content.title.Main" :subTitle="content.title.Sub"/>
  </div>
  <div class="text-box__text">
    <p class="nl2br" v-text="content.text"></p>
  </div>
  <div class="text-box__button">
    <link-button-component :link="content.button"/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from './ContentsTitleComponent';
import LinkButtonComponent from './button/LinkButtonComponent';

export default {
  components: {
    ContentsTitleComponent,
    LinkButtonComponent,
  },

  data() {
    return {
      /**
       * コンテンツを生成するデータ
       * ボタンやタイトルを変換しないといけないのでdataでもつ。
       * @type { Object }
       */
      content: null,
    }
  },

  props: {
    /**
     * コンテンツを生成するためのデータ ( * = 必須 )
     * * title
     * * text
     * * button
     */
    contentProps: {
      type: Object,
      required: true,
      default: null
    },
  },

  beforeMount() {
    // dataに挿入
    this.content = this.contentProps;

    // messagesのutton, title オブジェクトを配列に変換する。
    let LinkLists = this.convertArray(this.$data.messages.Links);
    let titles = this.convertArray(this.$data.messages.SectionTitles);

    LinkLists.forEach(element => {
      if (this.content.button === element.key) {
        this.content.button = element.value;
      }
    });

    titles.forEach(element => {
      if (this.content.title === element.key) {
        this.content.title = element.value;
      }
    });
  },

  methods: {
    /**
     * オブジェクトから配列に変換する処理
     * @param { Object }
     * @return [{key:hoge, value:hoge}, {key:hoge, value:hoge}, ...]
     */
    convertArray(obj) {
      return Object.entries(obj).map(([key, value]) => ({key, value}));
    },
  },
}
</script>

<style lang="scss">
.text-box {
  padding: 0 interval(2) interval(2) interval(2);
  background-color: rgba($color: color(white), $alpha: .8);
  box-shadow: 0px 6px 8px color(shadow);

  @include mq(sm) {
    padding: 0 interval(3) interval(3) interval(3);
  }

  @include mq(md) {
    @include flex(column nowrap, center, center);
    min-height: interval(50);
  }

  &__text {
    margin-bottom: interval(5);
  }

  &__button {
    width: 100%;

    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}
</style>
