<template>
<table class="tile-table">

  <tr class="tile-table__heading">
    <th class="tile-table__title" v-for="(heading, n) in tableItemHeading" :key="n">{{ heading }}</th>
  </tr>

  <tr class="tile-table__body" v-for="(tableItem, i) in tableItems" :key="i">
    <td class="tile-table__el">{{ tableItem.post.alumni }}</td>
    <td class="tile-table__el">{{ tableItem.name.ja }}</td>
    <td class="tile-table__el">{{ tableItem.graduate.age }}{{ tableItem.graduate.year }}年</td>
    <td class="tile-table__el">{{ tableItem.schoolPost }}</td>
  </tr>

</table>
</template>

<script>
export default {
  props: {
    tableItems: {
      type: Array,
      default: null
    },
    tableItemHeading: {
      type: Array,
      default: null
    }
  },
}
</script>

<style lang="scss">
.tile-table {
  width: 100%;
  color: color(white);

  &__heading {
    background-color: color(darkblue);
    border-bottom: 8px solid color(white);
  }

  &__title {
    text-align: center;
    font-size: font(xs);

    @include mq(sm) {
      font-size: font(sm);
      border: 2px solid color(white);
    }
  }

  &__body {
    background-color: color(lightDarkblue);
  }

  &__el {
    text-align: center;
    font-size: font(xs);

    @include mq(sm) {
      font-size: font(sm);
      border: 2px solid color(white);
    }
  }
}
</style>
