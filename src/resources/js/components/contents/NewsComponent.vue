<template>
<div class="news">

  <contents-title-component :title="messages.SectionTitles.News.Main" :subTitle="messages.SectionTitles.News.Sub"/>

  <ul class="news__list">
    <li class="news__item" v-for="(tweet, n) in tweets" :key="n">
      <a class="news__link" :href="linkUrl + tweet.id_str">{{ tweet.text }}</a>
      <span class="news__latest" v-if="showLatestLabel">{{ messages.Label.Latest }}</span>
    </li>
  </ul>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../modules/ContentsTitleComponent';

import axios from 'axios';

export default {
  components: {
    ContentsTitleComponent,
  },

  data() {
    return {
      /**
       * ニュース押下後に遷移するリンクURL
       * @type { string }
       */
      linkUrl: '',

      /**
       * twitter APIから取得した情報を格納
       * 非同期処理でデータを取得しているため、コンソールで確認ができないことに注意。
       * template内で tweet を出力すると値が確認できる。
       * @type { Object }
       */
      tweets: null,

      /**
       * 1ヶ月以内の投稿に「NEW」を表示するためのフラグ。
       * @type { Boolean }}
       */
      showLatestLabel: false,
    }
  },

  beforeMount() {
    axios.get('/api/twitter')

      .then(function (response) {
        // apiレスポンスを変数に格納。(直近のツイート3件)
        this.tweets = response.data;

        const createdDate = this.tweets[0].created_date;
        const currentDate = this.tweets[0].current_date;

        if ((createdDate.year === currentDate.year) && (createdDate.month === currentDate.month)) {
          this.showLatestLabel = true;
        }
      }.bind(this))

      .catch(function (err) {
        // エラー情報出力
        console.log('Error Object -> ', err);
        console.log('Status Code -> ', err.response.status);
        console.log('Status Text -> ', err.response.statusText);
        console.log('Headers -> ', err.response.headers);

        if (err.response) {
          /**
           * クライアント側でエラー応答を受信した場合（400系, 500系）
           * エラーページにリダイレクトさせる。
           * TODO:APIエラーなので500系のエラーページに飛ばす。（現在は404に飛ばしている）
           */
          this.$router.push('notFound')
        }
      }.bind(this)
    );

    /**
     * [リンクURL]
     * 下記URLにツイートのIDを付与することでリンクURLを生成する。
     */
    this.linkUrl = 'https://twitter.com/SoftTennis_Chuo/status/';
  },
}
</script>

<style lang="scss" scoped>
.news {
  padding: 0 interval(2) interval(2) interval(2);
  background-color: color(white);
  box-shadow: 0px 6px 8px color(shadow);

  @include mq(sm) {
    padding: 0 interval(3) interval(3) interval(3);
  }

  &-list {
    width: 100%;
    list-style: disc;
    padding-left: interval(3);
  }

  &__item {
    font-size: font(12);
    margin-bottom: interval(1);
    word-wrap: break-word;
    position: relative;

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__link {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;

    @include hover {
      text-decoration: underline;
    }
  }

  &__latest {
    color: color(japanRed);
    font-weight: bold;
    position: absolute;
    top: 0;
    left: 0;
    transform: translate(- interval(2), - interval(1)) rotate(-15deg);
  }
}
</style>
