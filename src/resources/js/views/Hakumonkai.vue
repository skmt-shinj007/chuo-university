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
      <tile-table-component :tableItemHeading="tableHeading" :tableItems="officer"/>
    </div>
  </section>

  <section class="hakumonkai__active-ob section-container">
    <contents-title-component
      :title="messages.SectionTitles.ActiveAlumni.Main"
      :subTitle="messages.SectionTitles.ActiveAlumni.Sub"/>


  </section>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TileTableComponent from '../components/modules/table/TileTableComponent.vue';

// data import
import Data from '../config/data.json';

export default {
  components: {
    ContentsTitleComponent,
    TileTableComponent,
  },
  data() {
    return {
      data: Data,
      tableHeading: [],
      officer: [],
    }
  },
  beforeMount() {
    this.$data.data.HakumonkaiOfficer.Data.forEach(element => this.officer.push(element));
    this.$data.data.HakumonkaiOfficer.Heading.forEach(element => this.tableHeading.push(element));
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

  &__officer-table {
    // サイトの左右マージンが決まり次第削除
    padding: 0 interval(2);
  }
}
</style>
