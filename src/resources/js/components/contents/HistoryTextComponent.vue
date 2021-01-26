<template>
<div class="history-text">
  <div class="history-text__tag-modal">
    <record-tag-component :tagTitle="messages.TagTitles.Record"/>
  </div>

  <div class="history-text__title">
    <h3 class="history-text__title-main">{{ Contents.Title.Main }}</h3>
    <span class="history-text__title-sub">{{ Contents.Title.Sub }}</span>
  </div>

  <div class="history-text__tag-date">
    <tag-component color="outline-orange" :content="Contents.term"/>
  </div>

  <div class="history-text__text-container">
    <p class="history-text__text nl2br" v-text="Contents.Text"/>
  </div>

</div>
</template>

<script>
// component import
import TagComponent from '../modules/tag/TagComponent';
import RecordTagComponent from '../modules/tag/RecordTagComponent';

export default {
  components: {
    TagComponent,
    RecordTagComponent,
  },
  props: {
    Contents: {
      type: Object,
      default: null
    }
  }
}
</script>

<style lang="scss" scoped>
.history-text {
  border: 2px solid color(darkblue);
  border-radius: radius(hard);
  position: relative;

  @include mq(sm) {
    padding: interval(1);
  }

  &__tag-modal {
    position: absolute;
    top: - interval(2.5);
    right: 5%;

    @include mq(md) {
      top: - interval(3);
    }
  }

  &__tag-date {
    margin: interval(1) interval(2);

    @include mq(sm) {
      width: interval(22);
    }
  }

  &__title {
    text-align: center;
    margin-top: interval(3);

    &-main {
      font-size: font(18);
    }
  }

  &__text-container {
    margin: interval(2);
  }

  &__text {
    letter-spacing: 1.8px;
    font-weight: bold;
  }
}

</style>
