<template>
<div class="user-ticket" ref="targetElement">
  <div class="user-ticket-item" :class="borderColor">
    <figure class="user-ticket-thumbnail-wrap">
      <img class="user-ticket-thumbnail" :src="`/image/${userObj.img.src}`" alt="userObj.img.alt">
    </figure>
  </div>

  <div class="user-ticket-item">
    <span class="user-ticket__name">{{ userObj.name.ja }}</span>
    <span class="user-ticket__name">{{ userObj.name.en }}</span>

    <!-- ユーザーカテゴリーが選手の場合 -->
    <div v-if="userObj.category === 1" class="user-ticket-tag-group">
      <position-tag-component :position="userObj.position"/>
      <grade-tag-component :grade="userObj.grade"/>
    </div>

    <div v-else class="user-ticket-tag-group">
      <tag-component :content="userObj.post.club"/>
    </div>
  </div>

  <div class="user-ticket-item">
    <svg-vue class="user-ticket-icon" icon="angle-right"/>
  </div>

</div>
</template>

<script>
// component import
import TagComponent from '../tag/TagComponent';
import PositionTagComponent from '../tag/PositionTagComponent';
import GradeTagComponent from '../tag/GradeTagComponent';

export default {
  components: {
    TagComponent,
    PositionTagComponent,
    GradeTagComponent,
  },
  props: {
    userObj: {
      type: Object,
      default: null
    }
  },
  computed: {
    borderColor() {
      const borderClass = 'user-ticket-thumbnail-border';
      return (this.userObj.position === "前衛") ? `${borderClass}--orange` : (this.userObj.position === "後衛") ? `${borderClass}--green` : `${borderClass}--blue`;
    },
  },
}
</script>

<style lang="scss">
.user-ticket {
  @include flex(row nowrap, space-between, center);
  box-shadow: 0 3px 5px 3px color(darkShadow);
  background-color: color(white);
  border: 2px solid color(light);
  border-radius: 48px;
  padding: interval(1);
  position: relative;
  z-index: 1;

  @include mq(sm) {
    padding: interval(1) interval(1.5);
  }

  @include mq(md) {
    cursor: pointer;
    box-shadow: 0 1px 3px 1px color(darkShadow);
    transition: all .3s ease-out;

    &:hover {
      box-shadow: 0 3px 5px 3px color(darkShadow);
      transform: translateY(-2px);

      .user-ticket-icon {
        animation: iconSlide 1.5s infinite;
      }
    }
  }

  &-thumbnail-border {
    &--blue {
      @include border-gradient();
    }

    &--orange {
      @include border-gradient(
        $start-color: color(orange),
        $end-color: color(lightDarkblue),
      );
    }

    &--green {
      @include border-gradient(
        $start-color: color(lightGreen),
        $end-color: color(lightDarkblue),
      );
    }
  }

  &-thumbnail-wrap {
    width: 100%;
    @include trimming(aspect(square));

    @include mq(sm) {
      width: interval(10);
    }
  }

  &-thumbnail {
    border-radius: radius(circle);
  }

  &__name {
    display: block;
    font-size: font(base);
    font-weight: bold;
    padding-left: interval(.5);

    &:first-of-type {
      display: none;

      @include mq(sm) {
        display: block;
      }
    }
  }

  &-tag-group {
    @include flex(row wrap, flex-start, center);
  }

  &-icon {
    width: interval(2.5);
    height: interval(2.5);
    fill: color(darkblue);
  }
}

</style>
