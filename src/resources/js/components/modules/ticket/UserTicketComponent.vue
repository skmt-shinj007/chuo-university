<template>
  <div class="user-ticket">
    <div class="user-ticket__ticket" @click="$emit('openModal')">
      <div class="user-ticket__thumbnail">
        <!-- サムネイル：userThumbnailComponentを想定 -->
        <slot name="thumbnail"/>
      </div>

      <div class="user-ticket__profile">
        <div class="user-ticket__name-wrap">
          <!-- 名前 -->
          <slot name="name"/>
        </div>

        <div class="user-ticket__label-group">
          <!-- ラベル：LabelComponentを想定 -->
          <slot name="label"/>
        </div>
      </div>
    </div>

    <!-- モーダル -->
    <slot name="modal"/>
  </div>
</template>

<style lang="scss">
.user-ticket {
  background-color: color(white);
  position: relative;

  &__ticket {
    @include flex(row nowrap, flex-start, center);
    box-shadow: 0 1px 3px 1px color(darkShadow);
    border-radius: radius(normal);
    padding: interval(1);

    @include mq(md) {
      cursor: pointer;
      transition: all .3s ease-out;
    }

    @include hover {
      box-shadow: 0 3px 5px 3px color(darkShadow);
      transform: translateY(-2px);
    }
  }

  &__thumbnail {
    width: interval(10);
  }

  &__profile {
    margin-left: 5%;

    &-name {
      display: block;
      font-size: font(14);
    }
  }

  &__label-group {
    @include flex(row wrap, flex-start, center);
  }
}

</style>
