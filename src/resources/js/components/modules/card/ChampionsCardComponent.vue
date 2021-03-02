<template>
<div class="champions-card">
  <div class="champions-card__background"/>

  <div class="champions-card__title-wrapper">
    <h5 class="champions-card__title">{{ messages.card.winner }}</h5>
  </div>

  <div class="champions-card__pair">
    <!-- 後衛 -->
    <div class="champions-card__player">
      <span class="champions-card__player-name">{{ cardElement.player01.name }}</span>
      <span class="champions-card__player-name">({{ cardElement.player01.belong }})</span>
      <svg-vue class="champions-card__icon" icon="chuo-logo" v-if="cardElement.player01.OB"/>
    </div>

    <!-- 前衛 -->
    <div class="champions-card__player">
      <span class="champions-card__player-name">{{ cardElement.player02.name }}</span>
      <span class="champions-card__player-name">({{ cardElement.player02.belong }})</span>
      <svg-vue class="champions-card__icon" icon="chuo-logo" v-if="cardElement.player02.OB"/>
    </div>
  </div>

  <div class="champions-card__tournament-info">
    <span class="champions-card__tournament-info-title">
      {{ messages.ContentsTitles.TournamentInformation }}
    </span>

    <table-component :tableItems="cardElement.information"/>
  </div>

</div>
</template>

<script>
import TableComponent from '../table/TableComponent';

export default {
  components: {
    TableComponent,
  },

  props: {
    cardElement: {
      type: Object,
      default: null
    }
  },
}
</script>

<style lang="scss" scoped>
.champions-card {
  width: 100%;
  background-color: color(white);
  padding: interval(2);
  position: relative;
  border-radius: radius(soft);

  &__background {
    width: interval(16);
    height: interval(13);
    opacity: .2;
    position: absolute;
    bottom: 0;
    right: 0;
    @include background-image('/svg/trophy-solid-gold.svg');
  }

  &__title-wrapper {
    padding-bottom: interval(1);
  }

  &__title {
    @include bangers(font(26), 1.5px);
    line-height: 1;
  }

  &__pair {
    width: 100%;
    margin-bottom: interval(2);
    font-size: font(12);

    @include mq(sm) {
      display: block;
    }
  }

  &__player {
    @include flex(row nowrap, flex-start, center);
    margin-top: interval(.5);

    &:first-child {
      margin-top: 0;
    }
  }

  &__player-name {
    letter-spacing: 1.8px;
  }

  &__icon {
    width: interval(3);
    margin-left: interval(.5);
    fill: color(darkblue);
  }

  &__tournament-info-title {
    display: block;
    margin-bottom: interval(.5);
    font-size: font(14);
    @include middle-line-text(2, 1px, color(darkblue));
  }
}
</style>
