<template>
<div class="user-ticket">
  <div class="user-ticket-thumbnail-border" :class="borderColor">
    <figure class="user-ticket-thumbnail">
      <img :src="`/image/${userObj.img.src}`" :alt="userObj.img.alt">
    </figure>
  </div>

  <div class="user-ticket-item">
    <span class="user-ticket__name">{{ userObj.name.ja }}</span>
    <span class="user-ticket__name">{{ userObj.name.en }}</span>

    <!-- ユーザーカテゴリーが選手の場合 -->
    <div v-if="userObj.category === 1" class="user-ticket-tag-group">
      <div class="user-ticket-tag">
        <position-tag :position="userObj.position"/>
      </div>
      <div class="user-ticket-tag">
        <grade-tag :grade="userObj.grade"/>
      </div>
    </div>

    <!-- 選手ではない場合（スタッフ）は役職を出す -->
    <div v-else class="user-ticket-tag-group">
      <div class="user-ticket-tag">
        <tag :content="userObj.post.club"/>
      </div>
    </div>
  </div>

  <div class="user-ticket-item">
    <svg-vue class="user-ticket-icon" icon="angle_right"/>
  </div>

</div>
</template>

<script>
// component import
import Tag from '../tag/TagComponent';
import PositionTag from '../tag/PositionTagComponent';
import GradeTag from '../tag/GradeTagComponent';

export default {
  components: {
    Tag,
    PositionTag,
    GradeTag,
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
  border-radius: 100px;
  padding: interval(1);
  position: relative;
  width: interval(34);

  @include mq(md) {
    cursor: pointer;
    box-shadow: 0 1px 3px 1px color(darkShadow);
    transition: all .3s ease-out;
  }

  @include hover {
    box-shadow: 0 3px 5px 3px color(darkShadow);
    transform: translateY(-2px);

    .user-ticket-icon {
      animation: iconSlide 1.5s infinite;
    }
  }

  &-thumbnail-border {
    width: interval(9);
    height: interval(9);

    &--blue {
      @include thumbnail-border();
    }

    &--orange {
      @include thumbnail-border(
        $start-color: color(orange),
        $end-color: color(lightDarkblue),
      );
    }

    &--green {
      @include thumbnail-border(
        $start-color: color(lightGreen),
        $end-color: color(lightDarkblue),
      );
    }
  }

  &-thumbnail {
    width: 100%;
    @include trimming(aspect(square));

    @include mq(sm) {
      width: interval(10);
    }

    & > img {
      border-radius: radius(circle);
    }
  }

  &__name {
    display: block;
    font-size: font(14);

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

  &-tag {
    margin: interval(.5) interval(.5) 0 0;

    &:last-child {
      margin-right: 0;
    }
  }

  &-icon {
    width: interval(1.5);
    height: interval(1.5);
    fill: color(darkblue);
  }
}

</style>
