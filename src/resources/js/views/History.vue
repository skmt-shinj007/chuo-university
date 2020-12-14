<template>
<div class="history">

  <section class="history__history section-container">
    <contents-title-component :title="messages.History.Title.Main" :subTitle="messages.History.Title.Sub"/>

    <!-- 大正の歴史 -->
    <div class="history__history-item">
      <history-card-component :Contents="messages.History.Taisho"/>
    </div>

    <!-- 昭和の歴史 -->
    <div class="history__history-item" v-for="(showaHistory, i) in showaHistories" :key="`first-${i}`">
      <history-card-component :Contents="showaHistory"/>
    </div>

    <!-- 平成の歴史 (今後コンテンツが増える可能性を考慮し、配列ループで表示) -->
    <div class="history__history-item" v-for="(heiseiHistory, i) in heiseiHistories" :key="`second-${i}`">
      <history-card-component :Contents="heiseiHistory"/>
    </div>
  </section>

</div>
</template>

<script>
// import components
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import HistoryCardComponent from '../components/modules/card/HistoryCardComponent';

export default {
  components: {
    ContentsTitleComponent,
    HistoryCardComponent,
  },
  data() {
    return {
      showaHistories: [],
      heiseiHistories: [],
    }
  },
  beforeMount() {
    this.$data.messages.History.Showa.forEach(element => this.showaHistories.push(element));
    this.$data.messages.History.Heisei.forEach(element => this.heiseiHistories.push(element));
  },
}
</script>

<style lang="scss" scoped>
.history {
  &__history-item {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }
}
</style>
