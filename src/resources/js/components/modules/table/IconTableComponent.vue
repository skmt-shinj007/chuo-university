<!-- アイコンを付属させたテキストが入る。 -->
<!-- ※ オブジェクトの中身は、「key」と「value」以外にも icon オブジェクトも定義する。 -->
<template>
  <table class="icon-table">
    <tr class="icon-table__record" v-for="(tableItem, n) in tableItems" :key="n">

      <th class="icon-table__key">{{ tableItem.key }}{{ addKeyText }}</th>

      <td class="icon-table__value">
        <slot name="value">
        <svg-vue class="icon-table__icon" :icon="tableItem.Icon.Src" :alt="tableItem.Icon.Alt"/>
        <span class="icon-table__value-unit" v-text="`× ${tableItem.value}`"/>
        </slot>
      </td>
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
    },
  },
}
</script>

<style lang="scss">
.icon-table {
  width: 100%;
  margin: 0 auto;

  &__record {
    width: 100%;
    border: 1px solid color(lightgray);
  }

  &__key {
    width: 50%;
    background-color: color(light);
    text-align: center;
    vertical-align: middle;
  }

  &__value {
    background-color: color(white);
    @include flex($align-items: center);
  }

  &__value-unit {
    font-size: font(base);
    margin-left: interval(1);
  }

  &__icon {
    width: interval(2.5);
    fill: #e3aa00;
  }
}
</style>
