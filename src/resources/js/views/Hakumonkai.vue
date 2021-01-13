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

  <section class="hakumonkai__officer">
    <contents-title-component
      :title="messages.SectionTitles.Officer.Main"
      :subTitle="messages.SectionTitles.Officer.Sub"/>

    <div class="hakumonkai__officer-table">
      <tile-table-component :tableItemHeading="tableHeading" :tableItems="officer"/>
    </div>
  </section>

  <section class="hakumonkai__active-ob">
    <contents-title-component
      :title="messages.SectionTitles.ActiveAlumni.Main"
      :subTitle="messages.SectionTitles.ActiveAlumni.Sub"/>

    <div class="hakumonkai__players">

      <div class="hakumonkai__player-card" v-for="(alumni, n) in activeAlumni" :key="n">
        <player-card-component :player="alumni">
        <template v-slot:addCardContents="componentProps">
          <div class="player-card__record">
            <span class="player-card__record-text">{{ componentProps.player.record }}</span>
          </div>
        </template>
        </player-card-component>
      </div>

    </div>
  </section>

  <section class="hakumonkai__message">
    <contents-title-component
      :title="messages.SectionTitles.Message.Main"
      :subTitle="messages.SectionTitles.Message.Sub"/>

    <div class="hakumonkai__message-container">
      <p class="hakumonkai__message-text nl2br" v-text="messages.Hakumonkai.Message"/>
      <div class="hakumonkai__message-btn">
        <primary-button-component :name="messages.ButtonName.ToContact"/>
      </div>
    </div>
  </section>
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TileTableComponent from '../components/modules/table/TileTableComponent';
import PlayerCardComponent from '../components/modules/card/PlayerCardComponent';
import PrimaryButtonComponent from '../components/modules/button/PrimaryButtonComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    ContentsTitleComponent,
    TileTableComponent,
    PlayerCardComponent,
    PrimaryButtonComponent,
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
    padding: 0 interval(2);
  }

  &-lead-text-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
      max-width: interval(80);
    }

    @include mq(md) {
      max-width: interval(100);
    }
  }

  &-lead-text {
    font-weight: bold;
  }

  &-lead-img-wrap {
    width: 100%;
    max-width: interval(80);
    margin: 0 auto;
    @include trimming(aspect(wide));

    @include mq(md) {
      max-width: interval(100);
    }
  }

  &-lead-img {
    border-radius: radius(soft);
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

  &__message-text {
    text-align: center;
    font-weight: bold;
    max-width: interval(58);
    margin: 0 auto;

    @include mq(md) {
      max-width: interval(68);
    }
  }

  &__message-btn {
    margin-top: interval(5);
  }
}

// slotで差し込んだ部分のスタイル
.player-card__record {
  margin-left: interval(.5);

  &-text {
    font-size: font(xs);
    letter-spacing: 1.1px;

    @include mq(md) {
      font-size: font(sm);
    }
  }
}
</style>
