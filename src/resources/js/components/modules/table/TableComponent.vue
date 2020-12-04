<template>
  <table class="c-table">
    <tr class="c-table__record" v-for="(tableItem, n) in tableItems" :key="n">
      <th class="c-table__cell c-table__key">{{ tableItem.key }}</th>
      <td class="c-table__cell c-table__value">{{ tableItem.value }}</td>
    </tr>
  </table>
</template>

<script>
export default {
  props: {
    tableItems: {
      type: Array,
      default: []
    },
  },
}
</script>

<style lang="scss">
.c-table {
  width: 90%;
  margin: 0 auto;

  // tablet style
  @include mq(sm) {
    width: 80%;
  };

  // pc style
  @include mq(md) {
    width: 70%;
  };

  &__record {
    width: 100%;
    border: 1px solid color(lightGray);
  }

  &__key {
    width: 30%;
    background-color: color(light);
    text-align: center;
    vertical-align: middle;
  }

  &__value {
    width: 70%;
    white-space: pre-wrap;
  }
}
</style>
