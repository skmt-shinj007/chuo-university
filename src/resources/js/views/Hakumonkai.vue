<template>
<div class="hakumonkai">
  <section class="hakumonkai__page-header">
    <contents-title-component
      :title="messages.SectionTitles.Hakumonkai.Main"
      :subTitle="messages.SectionTitles.Hakumonkai.Sub"/>

    <div class="hakumonkai-lead-text-wrap">
      <p class="hakumonkai-lead-text nl2br" v-text="messages.Hakumonkai.Lead"></p>
    </div>
  </section>

  <div class="background-prlx" v-prlx.background="{ speed: 0.3 }"/>

  <section class="hakumonkai__officer">
    <contents-title-component
      :title="messages.SectionTitles.Officer.Main"
      :subTitle="messages.SectionTitles.Officer.Sub"/>

    <div class="hakumonkai__officer-table">
      <tile-table-component :tableItemHeading="tableHeading" :tableItems="officer"/>
    </div>
  </section>

  <section class="hakumonkai__active-alumni">
    <contents-title-component
      :title="messages.SectionTitles.ActiveAlumni.Main"
      :subTitle="messages.SectionTitles.ActiveAlumni.Sub"/>

    <player-slider-component :players="activeAlumni"/>
  </section>

  <section class="hakumonkai__message">
    <contents-title-component
      :title="messages.SectionTitles.Message.Main"
      :subTitle="messages.SectionTitles.Message.Sub"/>

    <div class="hakumonkai__message-content">
      <p class="hakumonkai__message-text nl2br" v-text="messages.Hakumonkai.Message"/>
    </div>

    <div class="hakumonkai__message-btn">
      <link-button-component :link="messages.Links.ToContact"/>
    </div>
  </section>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TileTableComponent from '../components/modules/table/TileTableComponent';
import PlayerCardComponent from '../components/modules/card/PlayerCardComponent';
import LinkButtonComponent from '../components/modules/button/LinkButtonComponent';
import PlayerSliderComponent from '../components/modules/slider/PlayerSliderComponent.vue';

// data import
import Data from '../config/data.json';

export default {
  components: {
    ContentsTitleComponent,
    TileTableComponent,
    PlayerCardComponent,
    LinkButtonComponent,
    PlayerSliderComponent,
  },
  data() {
    return {
      data:Data,
      tableHeading: [],
      officer: [],
      activeAlumni: [],
    }
  },
  beforeMount() {
    // 役員テーブルの [見出し] 配列を取得
    this.$data.messages.Hakumonkai.OfficerTable.Heading.forEach(element => this.tableHeading.push(element));

    // ユーザーカテゴリーで [役職OB] を抽出
    this.$data.data.Users.forEach(element => {
      (element.category === this.officerNum) ? this.officer.push(element) : null;
    });

    // ユーザーカテゴリーで [現役OB] を抽出
    this.$data.data.Users.forEach(element => {
      (element.category === this.activeAlumniNum) ? this.activeAlumni.push(element) : null;
    });
  },
}
</script>

<style lang="scss" scoped>
.hakumonkai {

  &__page-header {
    margin-top: interval(5);
  }

  &-lead-text-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
    }
  }

  &-lead-text {
    font-weight: bold;
    text-align: center;
  }

  &__officer {
    margin-top: interval(5);
  }

  &__players {
    @include flex(column wrap, center, center);

    @include mq(sm) {
      @include flex(row nowrap, flex-start, stretch);
    }
  }

  &__player-card {
    width: 100%;

    margin-bottom: interval(8);
    box-shadow: 0 1px 10px 2px color(shadow);
    background-color: color(lightgray);

    @include mq(sm) {
      width: calc(100% / 3);
      margin-right: interval(2);
      margin-bottom: 0;
    }

    &:last-child {
      margin: 0;
    }
  }

  &__message-content {
    margin-bottom: interval(5);
  }

  &__message-text {
    text-align: center;
    font-weight: bold;
  }

  &__message-btn {
    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}

.background-prlx {
  @include background-image('/image/group-photo2017-spring.jpg', center top);
  width: 100%;
  height: interval(30);
}
</style>
