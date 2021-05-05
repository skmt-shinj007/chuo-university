<template>
<div class="news">

  <contents-title :title="messages.SectionTitles.News"/>

  <!-- ローディング画面 -->
  <div class="news__loading" v-if="loading">
      <div class="loading">
        <div class="loading__obj" v-for="i in 8" :key="i"/>
      </div>
  </div>

  <!-- ニュースリスト -->
  <div class="news__wrap" v-else>
    <ul class="news__list" v-if="!twitter.err">
      <li class="news__item" v-for="(tweet, i) in twitter.timelines" :key="i">
        <a class="news__link" :href="tweet.link" target="_blank" rel="noopener noreferrer">
          {{ tweet.text }}
        </a>

        <!-- NEW ラベル -->
        <span class="news__latest-label" v-if="tweet.new">
          {{ messages.Label.Latest }}
        </span>
      </li>
    </ul>

    <!-- エラー画面 -->
    <div class="err" v-if="twitter.err">
      <span class="err__text">{{ messages.Error.Api.News }}</span>

      <div class="err__btn">
        <primary-button :btn="messages.Button.NewsRequest" @clickEvent="reload"/>
      </div>
    </div>
  </div>

</div>
</template>

<script>
// components import
import ContentsTitle from '../modules/ContentsTitleComponent';
import PrimaryButton from '../modules/button/PrimaryButtonComponent.vue';

import Twitter from '../../config/api/twitter/index';

export default {
  components: {
    ContentsTitle,
    PrimaryButton,
  },

  data() {
    return {
      twitter: {
        timelines: null,
        err: false,
        loading: true,
      },
    }
  },

  computed: {
    loading() {
      return (this.twitter.timelines) ? false : true;
    }
  },

  created() {
    this.getTweets();
  },

  methods: {
    async getTweets() {
      const tweets = await Twitter.getResponse('/api/twitter/timeline');

      if (this.getType(tweets) === 'array') {
        this.twitter.timelines = tweets;
      }
      else {
        this.twitter.timelines = {};
        this.twitter.err = true;
      }
    },
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
    margin-bottom: interval(1.5);
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
