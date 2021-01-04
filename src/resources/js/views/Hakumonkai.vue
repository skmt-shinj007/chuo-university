<template>
<div class="hakumonkai">
  <section class="hakumonkai__page-header">
    <contents-title-component
      :title="messages.SectionTitles.Hakumonkai.Main"
      :subTitle="messages.SectionTitles.Hakumonkai.Sub"/>

    <div class="hakumonkai-lead-text-wrap">
      <p class="hakumonkai-lead-text nl2br" v-text="messages.Hakumonkai.Lead"></p>
    </div>

    <figure class="hakumonkai-lead-img-wrap">
      <img class="hakumonkai-lead-img" src="/image/hakumon.jpg" alt="中央大学多摩キャンパスの白門">
    </figure>
  </section>

  <section class="hakumonkai__officer section-container">
    <contents-title-component
      :title="messages.SectionTitles.Officer.Main"
      :subTitle="messages.SectionTitles.Officer.Sub"/>

    <div class="hakumonkai__officer-table">

    </div>
  </section>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';

export default {
  components: {
    ContentsTitleComponent,
  },
  data() {
    return {

    }
  },
  beforeMount() {

  },
}
</script>

<style lang="scss" scoped>
.hakumonkai {
  padding: interval(15) 0;

  @include mq(md) {
    padding: interval(10) 0;
  }

  &__page-header {
    padding: 0 interval(2);
  }

  &-lead-text-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
      max-width: interval(75);
    }

    @include mq(md) {
      max-width: interval(90);
    }
  }

  &-lead-text {
    font-weight: bold;
  }

  &-lead-img-wrap {
    width: 100%;
    max-width: interval(75);
    margin: 0 auto;
    @include trimming(aspect(wide));

    @include mq(md) {
      max-width: interval(90);
    }
  }

  &-lead-img {
    border-radius: radius(soft);
  }
}
</style>
