<template>
<div class="hakumonkai">
  <section class="hakumonkai__header">
    <contents-title :title="messages.SectionTitles.Hakumonkai"/>

    <div class="lead__text-wrap">
      <p class="lead__text nl2br" v-text="messages.Hakumonkai.Lead"></p>
    </div>
  </section>

  <div class="background-prlx" v-prlx.background="{ speed: 0.3 }"/>

  <section class="hakumonkai__officer" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Officer"/>

    <tile-table :tableItemHeading="tableHeading" :tableItems="officer"/>
  </section>

  <section class="hakumonkai__active" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.ActiveAlumni"/>

    <player-slider :players="activeAlumni"/>
  </section>

  <section class="hakumonkai__message" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Message"/>

    <div class="message__content">
      <p class="message__text nl2br" v-text="messages.Hakumonkai.Message"/>
    </div>

    <div class="message__button">
      <link-button :link="messages.Links.ToContact"/>
    </div>
  </section>

  <div class="hakumonkai__scroll-top">
    <scroll-top-button/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import TileTable from '../components/modules/table/TileTableComponent';
import PlayerCard from '../components/modules/card/PlayerCardComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import PlayerSlider from '../components/modules/slider/PlayerSliderComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

// data import
import Data from '../config/data.json';

// mixin
import Animation from '../config/animation';

export default {
  components: {
    ContentsTitle,
    TileTable,
    PlayerCard,
    LinkButton,
    PlayerSlider,
    ScrollTopButton,
  },

  mixins: [Animation],

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

  &__header {
    margin-top: interval(5);
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

  &__scroll-top {
    @include scroll-top();
  }
}

.background-prlx {
  @include background-image('/image/group-photo2017-spring.jpg', center top);
  width: 100%;
  height: interval(30);
}

.lead {
  &__text-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
    }
  }

  &__text {
    font-weight: bold;
    text-align: center;
  }
}

.message {
  &__content {
    margin-bottom: interval(5);
  }

  &__text {
    text-align: center;
    font-weight: bold;
  }

  &__button {
    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}
</style>
