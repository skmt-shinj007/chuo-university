<template>
<table class="tile-table">

  <thead class="tile-table__head">
    <tr class="tile-table__head-record">
      <th class="tile-table__cell" v-for="column in columns" :key="column.id">
        {{ column.label }}
      </th>
    </tr>
  </thead>

  <tbody class="tile-table__body">
    <tr class="tile-table__body-record" v-for="(body, i) in columnBodies" :key="i">
      <td class="tile-table__cell" v-for="column in columns" :key="column.id">
        {{ body[column.prop] }}
      </td>
    </tr>
  </tbody>

</table>
</template>

<script>
export default {
  props: {
    /**
     * カラム情報
     * id: {Num}
     * prop: {Str} プロパティ名
     * label: {Str}
     */
    columns: {
      type: Array,
      default: null
    },

    /**
     * カラムのボディ
     */
    columnBodies: {
      type: Array,
      default: null
    },
  },
}
</script>

<style lang="scss">
.tile-table {
  width: 100%;
  color: color(white);

  &__head {
    border-bottom: interval(1) solid color(white);

    &-record {
      background-color: color(darkblue);
    }
  }

  &__body {
    &-record {
      background-color: color(lightDarkblue);
    }
  }

  &__cell {
    text-align: center;
    font-size: font(10);
    border: 2px solid color(white);

    @include mq(sm) {
      font-size: font(12);
    }
  }
}
</style>
