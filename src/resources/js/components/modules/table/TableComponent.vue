<!-- このコンポーネントを呼ぶときは、親から要素がオブジェクトである「配列」を渡す。 -->
<!-- ※ オブジェクトの中身は、「key」と「value」で構成し、タイトルになるカラムには key の値が入る。 -->
<template>
  <table class="common-table">
    <tr class="common-table__record" :class="sizing" v-for="(tableItem, n) in tableItems" :key="n">
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
    size: {
      type: String,
      default: null
    }
  },
  computed: {
    bgClassChange() {
      return (this.valueTransparent) ? `common-table__value--transparent` : null;
    },
    sizing() {
      return (this.size) ? `common-table__record--${this.size}` : null;
    }
  },
}
</script>

<style lang="scss">
.common-table {
  width: 100%;

  &__record {
    font-size: font(12);
    width: 100%;
    border: 1px solid color(lightgray);

    &--sm {
      font-size: font(10);
    }

    &--lg {
      font-size: font(14);
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
