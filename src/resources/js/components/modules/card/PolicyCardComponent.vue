<template>
<div class="policy-card">
  <span class="policy-card__subTitle" v-if="windowWidth > pcWidth">{{ policy.Title.Sub }}</span>  <!-- tablet以下非表示 -->
  <span class="policy-card__title">{{ policy.Title.Main }}</span>
  <p class="policy-card__text">{{ policy.Content }}</p>
</div>
</template>

<script>
export default {
  props: {
    policy: {
      type: Object,
      default: null
    }
  },
}
</script>

<style lang="scss" scoped>
.policy-card {
  width: 160px;
  height: 160px;
  border: 3px solid color(white);
  border-radius: radius(normal);
  margin: 0 auto;
  @include flex(
    $flow: column nowrap,
    $justify-content: center,
    $align-items: center,
  );
  @include gradient(color(lightDarkblue), color(deepDarkblue), horizontal);

  // tablet style
  @include mq(sm) {
    margin: 0;
  };

  // pc style
  @include mq(md) {
    position: relative;

    &__title,
    &__subTitle {
      transition: all .5s ease-in-out;
    }

    &:hover {
      .policy-card__title,
      .policy-card__subTitle {
        opacity: 0;
      }

      .policy-card__text {
        opacity: 1;
      }
    }
  };

  &__subTitle {
    font-size: font(xs);
    color: color(white);
  }

  &__title {
    color: color(white);
    @include bangers($size: font(xl));
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
      font-size: font(sm);
      font-weight: bold;
      transition: all .5s ease-in-out;
    };
  }
}
</style>
