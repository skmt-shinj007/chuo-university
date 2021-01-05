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
</div>
</template>

<script>
// components import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TileTableComponent from '../components/modules/table/TileTableComponent';
import PlayerCardComponent from '../components/modules/card/PlayerCardComponent';

// data import
import Data from '../config/data.json';

export default {
  components: {
    ContentsTitleComponent,
    TileTableComponent,
    PlayerCardComponent,
  },
  data() {
    return {
      data: Data,
      tableHeading: [],
      officer: [],
      activeAlumni: [],
    }
  },
  beforeMount() {
    this.$data.data.HakumonkaiOfficer.Data.forEach(element => this.officer.push(element));
    this.$data.data.HakumonkaiOfficer.Heading.forEach(element => this.tableHeading.push(element));

    /**
     * ユーザー情報は、データベースから一括で引っ張る想定。-> ユーザーカテゴリーで活躍中のOBを仕分ける。
     * ユーザーカテゴリー情報
     * 1. 選手
     * 2. 現役スタッフ
     * 3. OB（役職あり）
     * *4. 現役OB（活躍中）
     * 5. OB
     */
    this.$data.data.Players.forEach(element => {
      (element.category === 4) ? this.activeAlumni.push(element) : null;
    });
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

  &__players {
    @include flex(column wrap, center, center);

    @include mq(sm) {
      flex-flow: row nowrap;
      padding: 0 interval(2);
    }
  }

  &__player-card {
    width: 60%;
    margin-bottom: interval(5);
    box-shadow: 0 1px 10px 2px color(shadow);

    @include mq(sm) {
      width: calc(100% / 3);
      margin-right: interval(2);
      margin-bottom: 0;
    }

    &:last-child {
      margin: 0;
    }
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
