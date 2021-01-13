<template>
<div class="news">
  <!-- :color="white" 記述でテキストを白に -->
  <contents-title-component :title="contentsTitle" :subTitle="contentsSubTitle"/>

  <div class="news__list">
    <text-list-component/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../modules/ContentsTitleComponent';
import TextListComponent from '../modules/TextListComponent.vue';

export default {
  components: {
    ContentsTitleComponent,
    TextListComponent,
  },
  data() {
    return {
      contentsTitle: 'news',
      contentsSubTitle: 'ニュース',
    }
  },
}
</script>

<style lang="scss" scoped>
.news {
  padding: interval(2);
  background-color: color(white);
  box-shadow: 0px 6px 8px color(shadow);

  @include mq(sm) {
    padding: interval(3);
  }

  &__list {
    margin: 0 interval(2);
  }
}
</style>
