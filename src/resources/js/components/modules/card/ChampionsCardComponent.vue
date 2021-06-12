<template>
<div class="champions-card">
  <div class="champions-card__background"/>

  <div class="champions-card__title">
    <h5 class="champions-card__title-text">{{ messages.card.winner }}</h5>
  </div>

  <div class="champions-card__pair">
    <!-- 後衛 -->
    <div class="champions-card__player">
      <span class="champions-card__player-name">{{ item.player1.name_ja }}</span>
      <span class="champions-card__player-belong">({{ item.player1.belong }})</span>
      <svg-vue class="champions-card__icon" icon="chuo-logo" v-if="item.player1.isOB"/>
    </div>

    <!-- 前衛 -->
    <div class="champions-card__player">
      <span class="champions-card__player-name">{{ item.player2.name_ja }}</span>
      <span class="champions-card__player-belong">({{ item.player2.belong }})</span>
      <svg-vue class="champions-card__icon" icon="chuo-logo" v-if="item.player2.isOB"/>
    </div>
  </div>

  <div class="champions-card__tournament-table">
    <table-component :table="item.table"/>
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
    item: {
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

  &__title {
    padding-bottom: interval(1);

    &-text {
      @include bangers(font(26), 1.5px);
      line-height: 1;
    }
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

    &-name,
    &-belong {
      letter-spacing: 1.8px;
    }
  }

  &__icon {
    width: interval(3);
    margin-left: interval(.5);
    fill: color(darkblue);
  }
}
</style>
