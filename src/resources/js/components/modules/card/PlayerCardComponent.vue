<template>
  <div class="player-card">
    <figure class="player-card__figure">
      <img src="/image/player01.jpg" alt="">
    </figure>

    <div class="player-card__information">
      <div class="player-card__information-name-wrap">
        <span class="player-card__information-name">坂本 信治</span>
        <span class="player-card__information-name-english">sakamoto shinji</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.player-card {
  width: 50%;

  &__figure {
    @include trimming(aspect(square));
  }

  &__information {
    background-color: color(lightGray);
    padding: interval(1);

    &-name-wrap {
      @include flex($justify-content: space-around, $align-items: flex-end);
    }

    &-name {
      font-size: font(sm);
      font-weight: bold;
    }

    &-name-english {
      font-weight: bold;
      font-size: font(xs);
    }
  }
}
</style>
