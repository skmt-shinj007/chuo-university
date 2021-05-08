<template>
  <modal @close="close">
    <template v-slot:content>
      <div class="provider-modal">
        <div class="provider-modal__container">
          <header class="provider-modal__header">

            <div class="provider-modal__thumbnail">
              <figure class="provider-modal__image">
                <img :src="item.profile_image_url_original" :alt="`${item.name}のプロフィール画像`">
              </figure>
            </div>

            <div class="provider-modal__info">
              <div class="provider-modal__name">
                <h4 class="provider-modal__name-main">{{ item.name }}</h4>
              </div>
            </div>
          </header>

          <div class="provider-modal__line"/>

          <div class="provider-modal__contents">

          </div>

        </div>
      </div>
    </template>
  </modal>
</template>

<script>
// component import
import Modal from '../modal/ModalComponent';
import TableComponent from '../table/TableComponent.vue';

export default {
  components: {
    Modal,
    TableComponent,
  },

  props: {
    /**
     * [クリックしたチケットのデータ]
     */
    item: {
      type: Object,
      default: null,
    },
  },

  beforeMount() {
    // console.log(this.item);
  },

  methods: {
    close() {
      this.$emit('close');
    },
  },
}
</script>

<style lang="scss" scoped>
.provider-modal {
  background-color: color(white);
  width: 100%;
  margin: interval(5) auto;
  border-radius: radius(hard);
  position: relative;

  @include mq(sm) {
    width: 80%;
  }

  &__container {
    padding: interval(2);

    @include mq(md) {
      padding: interval(3)
    }
  }

  &__header {
    @include flex(column nowrap, center, center);
    padding: interval(5) 0;

    @include mq(sm) {
      @include flex(row nowrap, center, center);
    }
  }

  &__info {
    margin-top: interval(3);

    @include mq(sm) {
      margin-top: 0;
      margin-left: interval(3);
    }
  }

  &__thumbnail {
    width: interval(20);
    @include thumbnail-border();

    @include mq(sm) {
      width: interval(18);
    }
  }

  &__image {
    @include trimming(aspect(square));
    width: 100%;

    & > img {
      border-radius: radius(circle);
    }
  }

  &__name {
    text-align: center;

    @include mq(sm) {
      text-align: left;
    }
  }

  &__name-sub {
    font-size: font(14);
  }

  &__name-main {
    font-size: font(18);
  }

  &__line {
    width: 100%;
    height: 2px;
    background-color: color(lightgray);
  }
}
</style>
