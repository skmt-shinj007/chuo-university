<template>
<div class="concept-card">
  <span class="concept-card__subTitle" v-if="windowWidth > breakpointPc">{{ concept.Title.Sub }}</span>  <!-- tablet以下非表示 -->
  <span class="concept-card__title">{{ concept.Title.Main }}</span>
  <p class="concept-card__text">{{ concept.Content }}</p>
</div>
</template>

<script>
export default {
  props: {
    concept: {
      type: Object,
      default: null
    }
  },
}
</script>

<style lang="scss" scoped>
.concept-card {
  width: interval(20);
  height: interval(20);
  border: 3px solid color(white);
  border-radius: radius(normal);
  margin: 0 auto;
  @include flex(column nowrap, center, center);
  @include gradient(color(lightDarkblue), color(deepDarkblue));

  @include mq(sm) {
    margin: 0;
  }

  @include mq(md) {
    position: relative;

    &__title,
    &__subTitle {
      transition: all .5s ease-in-out;
    }
  }

  @include hover {
    .concept-card__title,
    .concept-card__subTitle {
      opacity: 0;
    }

    .concept-card__text {
      opacity: 1;
    }
  }

  &__subTitle {
    font-size: font(10);
    letter-spacing: 2px;
    color: color(white);
  }

  &__title {
    color: color(white);
    font-size: font(16);
  }

  &__text {
    color: color(white);
    padding: interval(1);
    text-align: center;

    @include mq(md) {
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80%;
      font-weight: bold;
      transition: all .5s ease-in-out;
    }
  }
}
</style>
