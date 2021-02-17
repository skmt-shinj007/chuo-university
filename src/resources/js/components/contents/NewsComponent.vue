<template>
<div class="news">

  <contents-title-component :title="messages.SectionTitles.News.Main" :subTitle="messages.SectionTitles.News.Sub"/>

  <ul class="news-list">
    <li class="news-list__item">
      <a class="news-list__link" href="#">ここにニュースが入ります。ここにニュースが入ります。ここにニュースが入ります。ここにニュースが入ります。</a>
    </li>
    <li class="news-list__item">
      <a class="news-list__link" href="#">ここにニュースが入ります。ここにニュースが入ります。</a>
    </li>
    <li class="news-list__item">
      <a class="news-list__link" href="#">ここにニュースが入ります。ここにニュースが入ります。</a>
    </li>
  </ul>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../modules/ContentsTitleComponent';

import Api from '../../config/api';

export default {
  mixins: [ Api ],

  components: {
    ContentsTitleComponent,
  },

  data() {
    return {

    }
  },

  mounted() {

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

    &__item {
      font-size: font(12);
      margin-bottom: interval(1);
      word-wrap: break-word;

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
  }
}
</style>
