<template>
<div class="champions-card">
  <div class="champions-card__background">

  </div>

  <div class="champions-card__title-wrapper">
    <h5 class="champions-card__title">Champion pair</h5>
  </div>

  <div class="champions-card__pair">
    <!-- 後衛 -->
    <div class="champions-card__player">
      <span class="champions-card__player-name">{{ cardElement.Player01.Name }}</span>
      <span class="champions-card__player-name">({{ cardElement.Player01.Belong }})</span>
      <svg-vue class="champions-card__icon" icon="chuo-logo" v-if="cardElement.Player01.OB"/>
    </div>

    <!-- 前衛 -->
    <div class="champions-card__player">
      <span class="champions-card__player-name">{{ cardElement.Player02.Name }}</span>
      <span class="champions-card__player-name">({{ cardElement.Player02.Belong }})</span>
      <svg-vue class="champions-card__icon" icon="chuo-logo" v-if="cardElement.Player02.OB"/>
    </div>
  </div>

  <div class="champions-card__tournament-info">
    <h3 class="champions-card__tournament-info-title">{{ messages.ContentsTitles.TournamentInformation }}</h3>
    <table-component :tableItems="cardElement.TournamentInformation" :valueTransparent="true"/>
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
    @include background-image('/svg/trophy-solid-gold.svg', center center);
  }

  &__title-wrapper {
    padding-bottom: interval(1);
  }

  &__title {
    font-size: font(lg);
  }

  &__pair {
    @include flex();
    margin-bottom: interval(2);

    @include mq(sm) {
      display: block;
    }
  }

  &__player {
    width: 50%;
    @include flex(row nowrap, center, center);

    @include mq(sm) {
      width: 100%;
      justify-content: flex-start;
      padding-left: interval(1);
    }
  }

  &__player-name {
    font-size: font(sm);
    font-weight: bold;
    letter-spacing: 1.8px;
  }

  &__icon {
    width: interval(3);
    margin-left: interval(.5);
    fill: color(darkblue);
  }

  &__tournament-info {
    &-title {
      position: relative;
      padding-left: interval(3);
      margin-bottom: interval(1);
      @include text-before-line(interval(2), 1px, color(darkblue));
    }
  }
}
</style>
