<template>
<div class="history">

  <section class="history__history section-container">
    <contents-title-component :title="messages.History.Title.Main" :subTitle="messages.History.Title.Sub"/>


  </section>

</div>
</template>

<script>
// import components
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent'

export default {
  components: {
    ContentsTitleComponent
  },
  props: {

  }
}
</script>

<style lang="scss" scoped>
.history {

}
</style>
