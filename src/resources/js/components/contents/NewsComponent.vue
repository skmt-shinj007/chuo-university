<template>
<div class="news">

  <contents-title :title="messages.SectionTitles.News"/>

  <div class="news__loading" v-if="loading">
    <!-- <transition-group name="load" tag="div"> -->
      <div class="loading">
        <div class="loading__obj" v-for="i in 8" :key="i"/>
      </div>
    <!-- </transition-group> -->
  </div>

  <div class="news__wrap" v-else>
    <!-- ニュースリスト -->
    <ul class="news__list" v-if="!showErr">
      <li class="news__item" v-for="(tweet, i) in tweets" :key="i">
        <a class="news__link" :href="linkUrl + tweet.id_str" target="_blank" rel="noopener noreferrer">
          {{ tweet.text }}
        </a>

        <!-- NEW ラベル -->
        <span class="news__latest-label" v-if="showLatest && (i === 0)">
          {{ messages.Label.Latest }}
        </span>
      </li>
    </ul>

    <!-- エラー画面 -->
    <div class="err" v-if="showErr">
      <span class="err__text">{{ messages.Error.Api.News }}</span>

      <div class="err__btn">
        <primary-button :btn="messages.Button.NewsRequest" @clickEvent="getResponse"/>
      </div>
    </div>
  </div>

</div>
</template>

<script>
// components import
import ContentsTitle from '../modules/ContentsTitleComponent';
import PrimaryButton from '../modules/button/PrimaryButtonComponent.vue';

// Library import
import axios from 'axios';

export default {
  components: {
    ContentsTitle,
    PrimaryButton,
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
       * @type { Array }
       */
      tweets: null,

      /**
       * 1ヶ月以内の投稿に「NEW」を表示するためのフラグ。
       * @type { Boolean }
       */
      showLatest: false,

      /**
       * ツイートが取得できなかった場合に表示
       * @type { Boolean }
       */
      showErr: false,

      /**
       * ロード判定
       * @type { Boolean }
       */
      loading: false,
    }
  },

  beforeMount() {
    // サーバーからツイートデータを取得
    this.getResponse();

    /**
     * [リンクURL]
     * 下記URLにツイートのIDを付与することでリンクURLを生成する。
     */
    this.linkUrl = 'https://twitter.com/SoftTennis_Chuo/status/';
  },

  methods: {
    /**
     * サーバーからtwitter APIレスポンスを取得。
     */
    async getResponse() {
      // ロード開始
      this.loading = true;

      await axios.get('/api/twitter/timeline')

      .then(function (response) {
        // 返答がオブジェクト形式ではない場合にエラー画面を出す。
        if (typeof response.data !== 'object') {
          console.log(response.data);
          return this.err();
        }

        // apiレスポンスを変数に格納。(直近のツイート3件)
        this.tweets = response.data;

        // 投稿日と現在の日付を比較して、ラベルを表示させる。
        const createdYear = this.tweets[0].created_date.year;    // 投稿年
        const createdMonth = this.tweets[0].created_date.month;  // 投稿月
        const currentYear = this.tweets[0].current_date.year;    // 現在の年
        const currentMonth = this.tweets[0].current_date.month;  // 現在の月

        if ((createdYear === currentYear) && (createdMonth === currentMonth)) this.showLatest = true;

        this.showErr = false;
      }.bind(this))

      .catch(function (err) {
        console.log(err);

        if (err.response) {
          console.log('Err Message:', err.response.data.message);
          console.log('Status Code:', err.response.status);
          console.log('Status Text:', err.response.statusText);
        }

        // エラー画面出力。
        this.err();
      }.bind(this))

      // 成功でもエラーでも通信後に共通の処理
      .finally(function () {
        this.loading = false;
      }.bind(this))
    },

    err() {
      this.showErr = true;
      this.tweets = null;
    }
  }
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

  &__latest-label {
    color: color(japanRed);
    font-weight: bold;
    position: absolute;
    top: - interval(.5);
    left: interval(1);
    transform: translate(- interval(2), - interval(1)) rotate(-15deg);
  }
}

.loading {
  @include flex(row nowrap, center, center);
  height: interval(10);

  &__obj {
    width: interval(1);
    height: 80%;
    background-color: color(lightDarkblue);
    border-radius: radius(hard);
    margin-right: interval(1);
    animation: loading 0.8s infinite;

    &:last-child {
      margin-right: 0;
    }

    @for $i from 1 through 8 {
      &:nth-child( #{$i} ) {
        animation-delay: calc( 1s * #{$i} / 10 );
      }
    }

  }
}

.err {

  &__text {
    display: block;
    font-size: font(12);
    margin-bottom: interval(5);

    @include mq(sm) {
      text-align: center;
    }
  }

  &__btn {
    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}
</style>
