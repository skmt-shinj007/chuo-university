<!-- ※ オブジェクトの中身は、「key」と「value」で構成し、タイトルになるカラムには key の値が入る。 -->
<template>
<div class="table">
  <template v-if="table.title">
    <h3 class="table__title" :class="color">{{ table.title }}</h3>
  </template>
  <table class="table__table">
    <tbody class="table__body">
      <tr
        class="table__body-record"
        :class="cellRatio"
        v-for="(body, i) in table.body"
        :key="i"
      >
        <slot name="cell" :item="body">
          <th class="table__body-key">{{ body.key }}</th>
          <td class="table__body-value">{{ body.value }}</td>
        </slot>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
export default {
  props: {
    table: {
      type: Object,
      default: null
    },

    /**
     * テーブルセルのwidth比率
     * キーのセル割合を指定する。 (ex. :ratio="7" -> キーセル70% バリューセル30%となる。
     */
    ratio: {
      type: Number,
      default: 0
    },

    titleColor: {
      type: String,
      default: '',
    }
  },

  computed: {
    /**
     * カスタムクラス
     */
    cellRatio() {
      return (this.ratio) ? `table--${this.ratio}` : null;
    },
    color() {
      return (this.titleColor) ? `table__title--${this.titleColor}` : null;
    },
  },
}

// 想定データ
// const table = {
//   title: "",
//   body: [
//     { key: "", value: "" },
//     { key: "", value: "" },
//   ],
// }
</script>

<style lang="scss" scoped>
.table {
  &__title {
    @include middle-line-text(2, 1px, color(darkblue));
    margin-bottom: interval(1);

    &--white {
      @include middle-line-text(2, 1px, color(white));
    }
  }

  &__table {
    width: 100%;
  }

  &__body {
    &-record {
      font-size: font(12);
      width: 100%;
      border: 1px solid color(lightgray);
    }

    &-key {
      width: 30%;
      background-color: color(light);
      text-align: center;
      vertical-align: middle;
    }

    &-value {
      width: 70%;
      background-color: color(white);
      white-space: pre-wrap;
      vertical-align: middle;
    }
  }

  // セル幅 割合
  @for $i from 1 to 10 {
    .table--#{$i} {
      .table__body-key {
        width: calc(#{$i} * 10%);
      }
      .table__body-value {
        width: calc(100% - (#{$i} * 10%));
      }
    }
  }

}
</style>
