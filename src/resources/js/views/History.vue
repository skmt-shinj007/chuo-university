<template>
<div class="history">

  <section class="history__time-series section-container">
    <contents-title-component :title="messages.SectionTitles.History.Main" :subTitle="messages.SectionTitles.History.Sub"/>

    <div class="history-content history-taisho">
      <!-- 大正の歴史 -->
      <div class="history-item">
        <history-card-component :Contents="messages.History.Taisho"/>
      </div>
    </div>

    <div class="history-content history-showa">
      <!-- 昭和の歴史 -->
      <div class="history-item" v-for="(showaHistory, i) in showaHistories" :key="`first-${i}`">
        <history-card-component :Contents="showaHistory"/>
      </div>
    </div>

    <div class="history-content history-heisei">
      <!-- 平成の歴史 (今後コンテンツが増える可能性を考慮し、配列ループで表示) -->
      <div class="history-item" v-for="(heiseiHistory, i) in heiseiHistories" :key="`second-${i}`">
        <history-card-component :Contents="heiseiHistory"/>
      </div>
    </div>
  </section>

  <section class="history__primary-titles section-container">
    <contents-title-component :title="messages.SectionTitles.PrimaryTitles.Main" :subTitle="messages.SectionTitles.PrimaryTitles.Sub"/>

    <table-component :tableItems="TitleAcquisitionData"/>
  </section>

</div>
</template>

<script>
// import components
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import HistoryCardComponent from '../components/modules/card/HistoryCardComponent';
import TableComponent from '../components/modules/table/TableComponent';

export default {
  components: {
    ContentsTitleComponent,
    HistoryCardComponent,
    TableComponent,
  },
  data() {
    return {
      showaHistories: [],
      heiseiHistories: [],
      TitleAcquisitionData: [],
    }
  },
  beforeMount() {
    this.$data.messages.History.Showa.forEach(element => this.showaHistories.push(element));
    this.$data.messages.History.Heisei.forEach(element => this.heiseiHistories.push(element));
    this.$data.messages.TitleAcquisitionData.forEach(element => this.TitleAcquisitionData.push(element));
  },
}
</script>

<style lang="scss" scoped>
.history {

  &-content {
    margin-bottom: interval(10);

    @include mq(md) {
      position: relative;

      &::before {
        display: block;
        content: '';
        width: interval(1);
        height: 100%;
        border-radius: radius(hard);
        background-color: darken($color: color(lightgray), $amount: 10%);
        position: absolute;
        top: 0;
        left: 8%;
      }
    }
  }

  &-taisho {
    @include mq(md) {
      @include historyAgeTag('大正', top);
    }
  }

  &-showa {
    @include mq(md) {
      @include historyAgeTag('昭和', top);
    }
  }

  &-heisei {
    @include mq(md) {
      @include historyAgeTag('平成', top);
    }
  }

  &-item {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }

}
</style>
