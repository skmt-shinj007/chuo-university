<template>
  <ul class="text-list">
    <li class="text-list__item">  <!-- v-for="list in lists" :key="list.title" -->
      <a class="text-list__item-link" href="#">ここにニュースが入ります。ここにニュースが入ります。ここにニュースが入ります。ここにニュースが入ります。</a>
    </li>
    <li class="text-list__item">  <!-- v-for="list in lists" :key="list.title" -->
      <a class="text-list__item-link" href="#">ここにニュースが入ります。ここにニュースが入ります。</a>
    </li>
    <li class="text-list__item">  <!-- v-for="list in lists" :key="list.title" -->
      <a class="text-list__item-link" href="#">ここにニュースが入ります。ここにニュースが入ります。</a>
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    lists: Array,
  },
}
</script>

<style lang="scss">
.text-list {
  width: 100%;
  list-style: disc;
  padding-left: interval(3);

  &__item {
    font-size: font(sm);
    margin-bottom: interval(1);
    word-wrap: break-word;

    @include mq(md) {
      font-size: font(base);
    }

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__item-link {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;

    @include hover {
      text-decoration: underline;
    }
  }
}

</style>
