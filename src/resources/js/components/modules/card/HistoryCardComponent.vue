<template>
<div class="history-card">
  <div class="history-card__tag-modal">
    <tag-component size="lg"/>
  </div>

  <div class="history-card__title">
    <h3 class="history-card__title-main">{{ messages.History.CreateClub.Title.Main }}</h3>
    <span class="history-card__title-sub">{{ messages.History.CreateClub.Title.Sub }}</span>
  </div>

  <div class="history-card__tag-date">
    <tag-component color="outline-orange" :content="messages.History.CreateClub.term"/>
  </div>

  <div class="history-card__text-container">
    <p class="history-card__text nl2br" v-text="messages.History.CreateClub.Text"/>
  </div>

</div>
</template>

<script>
// component import
import TagComponent from '../tag/TagComponent';

export default {
  components: {
    TagComponent,

  }
}
</script>

<style lang="scss" scoped>
.history-card {
  width: 90%;
  margin: 0 auto;
  border: 2px solid color(darkblue);
  border-radius: radius(hard);
  position: relative;

  &__tag-modal {
    position: absolute;
    top: - interval(3);
    right: 5%;
  }

  &__tag-date {
    margin: interval(1) interval(2);
  }

  &__title {
    text-align: center;
    margin-top: interval(3);

    &-main {
      font-size: font(lg);
    }

    &-sub {
      font-size: font(sm);
      font-weight: bold;
    }
  }

  &__text-container {
    margin: interval(2);
  }

  &__text {
    letter-spacing: 1.8px;
  }
}

</style>
