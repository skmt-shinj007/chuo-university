<template>
<div class="news">
  <div class="card-inner-margin">
    <contents-title-component :title="contentsTitle" :subTitle="contentsSubTitle"/>  <!-- :color="white" 記述でテキストを白に -->
    <div class="news__list">
      <text-list-component/>
    </div>
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
  width: 80%;
  background-color: color(white);
  box-shadow: 0px 6px 8px color(shadow);
  margin: 0 auto;

  &__list {
    margin: interval(3) interval(2);
  }
}
</style>
