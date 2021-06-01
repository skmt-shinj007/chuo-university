<!-- このコンポーネントを呼ぶときは、親から要素がオブジェクトである「配列」を渡す。 -->
<!-- ※ オブジェクトの中身は、「key」と「value」で構成し、タイトルになるカラムには key の値が入る。 -->
<template>
  <table class="common-table">
    <tr class="common-table__record" :class="[sizing, rating]" v-for="(tableItem, n) in tableItems" :key="n">
      <th class="common-table__key">{{ tableItem.key }}{{ addKeyText }}</th>
      <td class="common-table__value">{{ tableItem.value }}{{ addValueText }}</td>
    </tr>
  </table>
</template>

<script>
export default {
  props: {
    /**
     * テーブルを作成する配列
     */
    tableItems: {
      type: Array,
      default: () => {
        return [];
      }
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
     * テーブルセルのwidth比率
     * キーのセル割合を指定する。 (ex. :ratio="7" -> キーセル70% バリューセル30%となる。
     */
    ratio: {
      type: Number,
      default: 0
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
     * テーブルセルの幅割合を指定する。
     */
    rating() {
      return (this.ratio) ? `common-table--${this.ratio}` : null;
    },

    /**
     * サイズによってクラスを付与
     */
    sizing() {
      return (this.size) ? `common-table__record--${this.size}` : null;
    },
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
    vertical-align: middle;
  }

  // セル幅 割合
  @for $i from 1 to 10 {
    .common-table--#{$i} {
      @include rating($i);
    }
  }

}
</style>
