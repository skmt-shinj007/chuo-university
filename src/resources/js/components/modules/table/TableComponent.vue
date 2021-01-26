<!-- このコンポーネントを呼ぶときは、親から要素がオブジェクトである「配列」を渡す。 -->
<!-- ※ オブジェクトの中身は、「key」と「value」で構成し、タイトルになるカラムには key の値が入る。 -->
<template>
  <table class="common-table">
    <tr class="common-table__record" :class="fontSizeChange" v-for="(tableItem, n) in tableItems" :key="n">
      <th class="common-table__key">{{ tableItem.key }}{{ addKeyText }}</th>
      <td class="common-table__value" :class="bgClassChange">{{ tableItem.value }}{{ addValueText }}</td>
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
    valueTransparent: {
      type: Boolean,
      default: false
    },
    font: {
      type: String,
      default: null
    }
  },
  computed: {
    bgClassChange() {
      return (this.valueTransparent) ? `common-table__value--transparent` : null;
    },
    fontSizeChange() {
      return (this.font) ? `common-table__record--${this.font}` : null;
    }
  },
}
</script>

<style lang="scss">
.common-table {
  width: 100%;

  &__record {
    width: 100%;
    border: 1px solid color(lightgray);

    &--xs {
      font-size: font(10);
    }

    &--sm {
      font-size: font(12);
    }
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

    &--transparent {
      background-color: rgba($color: color(white), $alpha: 0);
    }
  }
}
</style>
