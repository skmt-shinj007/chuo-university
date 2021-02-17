<template>
<div class="provider-ticket" ref="targetElement">
  <div class="provider-ticket-thumbnail-border">
    <figure class="provider-ticket-thumbnail">
      <img :src="`/image/${providerObj.img.src}.jpg`" alt="userObj.img.alt">
    </figure>
  </div>

  <div class="provider-ticket-item">
    <span class="provider-ticket__name">{{ providerObj.name }}</span>

    <!-- SNSタグは 2つ まで -->
    <div class="provider-ticket-tag-group">
      <!-- twitter -->
      <sns-tag-component sns="twitter" content="Twitter"/>
      <!-- instagram -->
      <sns-tag-component sns="instagram" content="Instagram"/>
    </div>
  </div>

  <div class="provider-ticket-item">
    <svg-vue class="provider-ticket-icon" icon="angle-right"/>
  </div>

</div>
</template>

<script>
// component import
import SnsTagComponent from '../tag/SnsTagComponent';

export default {
  components: {
    SnsTagComponent,
  },

  props: {
    providerObj: {
      type: Object,
      default: null
    }
  },

  computed: {

  },
}
</script>

<style lang="scss">
.provider-ticket {
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

    .provider-ticket-icon {
      animation: iconSlide 1.5s infinite;
    }
  }

  &-thumbnail-border {
    @include thumbnail-border();
    width: interval(9);
    height: interval(9);
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
    padding-left: interval(.5);
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
