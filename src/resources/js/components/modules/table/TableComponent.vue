<!-- このコンポーネントを呼ぶときは、親から要素がオブジェクトである「配列」を渡す。 -->
<!-- ※ オブジェクトの中身は、「key」と「value」で構成し、タイトルになるカラムには key の値が入る。 -->
<template>
  <table class="common-table">
    <tr class="common-table__record" :class="sizing" v-for="(tableItem, n) in levelingItems" :key="n">
      <th class="common-table__key">{{ tableItem.key }}{{ addKeyText }}</th>
      <td class="common-table__value" :class="background">{{ tableItem.value }}{{ addValueText }}</td>
    </tr>
  </table>
</template>

<script>
export default {
  data() {
    return {
      /**
       * 整地された tableItems が入る
       */
      levelingItems: [],
    }
  },

  props: {
    /**
     * テーブルを作成する配列
     */
    tableItems: {
      type: Array,
      default: []
    },

    /**
     * key や value に追加で付与したい文字列
     * 主に「単位」など
     */
    addKeyText: {
      type: String,
      default: ''
    },

    addValueText: {
      type: String,
      default: ''
    },

    /**
     * テーブルの背景を透明にするかどうかを判定するフラグ
     */
    valueTransparent: {
      type: Boolean,
      default: false
    },

    /**
     * テーブルのフォントサイズを指定する
     */
    size: {
      type: String,
      default: null
    }
  },

  computed: {
    /**
     * 背景を透過にするクラスを付与
     */
    background() {
      return (this.valueTransparent) ? `common-table__value--transparent` : null;
    },

    /**
     * サイズによってクラスを付与
     */
    sizing() {
      return (this.size) ? `common-table__record--${this.size}` : null;
    },

    /**
     * 配列を整地する
     */
    leveling() {
      this.tableItems = this.tableItems
    }
  },

  beforeMount() {
    /**
     * 1.value値がnullの要素
     * 2.value値に「null」という文字列が入っている要素
     * 上記をフィルターした配列を[levelingItems]に代入する。
     */
    this.levelingItems = this.tableItems.filter(element => {
      if (typeof element.value === 'string') {
        if(element.value.indexOf('null') !== -1) element.value = null;
      }
      return (element.value !== null);
    });
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
