<template>
<div class="concept-card">
  <div class="concept-card-inner">
    <span class="concept-card__subTitle" v-if="windowWidth > breakpointPc">
      {{ concept.Title.Sub }}
    </span>  <!-- tablet以下非表示 -->
    <span class="concept-card__title">{{ concept.Title.Main }}</span>
    <p class="concept-card__text">{{ concept.Content }}</p>
  </div>
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
  position: relative;
  width: 50%;
  margin: 0 auto;
  color: color(white);
  border: 3px solid color(white);
  border-radius: radius(normal);
  @include flex(column nowrap, center, center);
  @include gradient(color(lightDarkblue), color(deepDarkblue));

  @include mq(sm) {
    width: interval(16);
  }

  &::before {
    content: '';
    display: block;
    padding-top: 100%;
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

  &-inner {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    @include flex(column nowrap, center, center);
  }

  &__subTitle {
    font-size: font(10);
    letter-spacing: 2px;
    transition: all .5s ease-in-out;
  }

  &__title {
    font-size: font(16);
    transition: all .5s ease-in-out;
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
