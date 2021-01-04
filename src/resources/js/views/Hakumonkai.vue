<template>
<div class="hakumonkai">
  <section class="hakumonkai__page-header">
    <contents-title-component
      :title="messages.SectionTitles.Hakumonkai.Main"
      :subTitle="messages.SectionTitles.Hakumonkai.Sub"/>

    <div class="hakumonkai-lead-wrap">
      <p class="hakunmonkai-lead-text nl2br" v-text="messages.Hakumonkai.Lead"></p>
    </div>

    <figure class="hakumonkai-lead-img-wrap">
      <img class="hakumonkai-lead-img" src="/image/player01.jpg" alt="">
    </figure>
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

  &-lead-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
      max-width: interval(75);
    }

    @include mq(md) {
      max-width: interval(90);
    }
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
