<template>
  <table class="common-table">
    <tr class="common-table__record" v-for="(tableItem, n) in tableItems" :key="n">
      <th class="common-table__key">{{ tableItem.key }}{{ addKeyText }}</th>
      <td class="common-table__value">{{ tableItem.value }}{{ addValueText }}</td>
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
    addKeyText: {
      type: String,
      default: ''
    },
    addValueText: {
      type: String,
      default: ''
    }
  },
}
</script>

<style lang="scss">
.common-table {
  width: 90%;
  margin: 0 auto;

  // tablet style
  @include mq(sm) {
    width: 80%;
  };

  &__record {
    width: 100%;
    border: 1px solid color(lightgray);
  }

  &__key {
    width: 30%;
    background-color: color(light);
    text-align: center;
    vertical-align: middle;
  }

  &__value {
    width: 70%;
    background-color: color(white);
    white-space: pre-wrap;
  }
}
</style>
