<template>
  <div class="concept">
    <div class="concept__tab-group">
      <div
        class="concept__tab"
        v-for="item in items"
        :key="item.id"
        @click="change(item.id)">

        <input
          type="radio"
          :value="item.id"
          class="concept__radio"
          v-model="currentId">

        <label :for="item.label.en">{{ item.label.ja }}</label>
      </div>

    </div>
    <ul class="concept__content-list">
      <li class="concept__content-item" :key="currentId">
        <p class="concept__text">
          {{ current.content }}
        </p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      /**
       * 現在表示している記事id
       * @type { Number }
       */
      currentId: 1,
    }
  },

  props: {
    items: {
      type: Array,
      default: null
    }
  },

  computed: {
    current() {
      return this.items.find(el => el.id === this.currentId) || {};
    },
  },

  methods: {
    change(num) {
      this.currentId = num;
    }
  },
}
</script>

<style lang="scss" scoped>
.concept {

  @include hover {

  }

  &__tab-group {
    @include flex();
  }

  &__tab {
    background-color: color(lightgray);
    padding: interval(1) interval(2) interval(2) interval(2);
    border-radius: radius(soft);
    margin-right: interval(.5);
    transform: translateY(interval(1));

    &:last-child {
      margin-right: 0;
    }
  }

  &__radio {
    display: none;
  }

  &__label {
    @include fonts(font(12), bold, false, 1.2px)
  }

  &__content-list {
    position: relative;
    color: color(white);
    border-radius: radius(soft);
    background-color: color(darkblue);

    &::before {
      content: '';
      display: block;
      padding-bottom: aspect(square);
    }
  }

  &__text {
    position: absolute;
    top: 0;
    left: 0;
    padding: interval(2);
  }
}
</style>
