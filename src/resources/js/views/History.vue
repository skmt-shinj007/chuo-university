<template>
<div class="history">

  <section class="history__history section-container">
    <contents-title-component :title="messages.History.Title.Main" :subTitle="messages.History.Title.Sub"/>

    <div class="history__history-item">
      <history-card-component/>
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
}
</script>

<style lang="scss" scoped>
// .history {
//   &__history {
//   }
// }
</style>
