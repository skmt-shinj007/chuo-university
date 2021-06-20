<template>
<div class="news">
  <contents-title :title="messages.SectionTitles.News"/>
  <template v-if="timeline.loading">
    <!-- ローディング画面 -->
    <div class="news__loading">
      <div class="loading">
        <div class="loading__obj" v-for="i in 8" :key="i"/>
      </div>
    </div>
  </template>

  <template v-else>
    <!-- ニュースリスト -->
    <!-- timelines配列が空かどうかでエラー画面を出し分ける -->
    <template v-if="timeline.tweets.length">
      <ul class="news__list">
        <li class="news__item" v-for="(tweet, i) in timeline.tweets" :key="i">
          <a class="news__link" :href="tweet.link" target="_blank" rel="noopener noreferrer">
            {{ tweet.text }}
          </a>
          <!-- NEW ラベル -->
          <span class="news__latest-label" v-if="tweet.new">
            {{ messages.Label.Latest }}
          </span>
        </li>
      </ul>
    </template>

    <!-- 表示するニュースがない場合 -->
    <template v-else>
      <div class="news__none">
        <span class="news__none-text">{{ messages.Error.Api.News }}</span>
      </div>
    </template>
  </template>
</div>
</template>

<script>
// components import
import ContentsTitle from '../modules/ContentsTitleComponent';
import PrimaryButton from '../modules/button/PrimaryButtonComponent.vue';

import twitter from '../../api/twitter';

export default {
  components: {
    ContentsTitle,
    PrimaryButton,
  },

  computed: {
    /**
     * timeline: {
     *    loading: {Boolean}
     *    tweets: {Array}
     * }
     */
    timeline() {
      return this.$root.twitter.timeline;
    },
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

  &__none {
    &-text {
      display: block;
      font-size: font(12);
      margin-bottom: interval(5);

      @include mq(sm) {
        text-align: center;
      }
    }
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
</style>
