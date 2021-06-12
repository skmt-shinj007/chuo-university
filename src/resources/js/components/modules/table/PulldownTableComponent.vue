<template>
  <table-component :table="setting">
    <template v-slot:cell="table">
      <th class="pull-down-table__key">{{ table.item.key }}</th>
      <td class="pull-down-table__value">
        <select class="pull-down-table__select" :name="table.item.value.name" v-model="select">
          <option :value="defaultSelected.en" selected>
            {{ defaultSelected.ja }}
          </option>
          <option v-for="(menu, n) in table.item.value.menus" :key="n" :value="menu">
            {{ menu }}
          </option>
        </select>
      </td>
    </template>
  </table-component>
</template>

<script>
import TableComponent from './TableComponent';

export default {
  components: { TableComponent },

  data() {
    return {
      // プルダウンの初期値は all
      select: "all",
      defaultSelected: {},
    }
  },

  props: {
    // プルダウンのテーブルを描画するためのデータ
    setting: {
      type: Object,
      require: true
    },
  },

  created() {
    this.defaultSelected = this.$data.messages.filters.defaultSelected;
  },

  watch: {
    // data の selectプロパティが変更されたタイミングで親に選択値のデータを送る
    select() {
      this.$emit("select", this.select);
    }
  },
}
</script>

<style lang="scss">
.pull-down-table {
  display: table;
  width: 100%;
  border: 1px solid color(lightgray);

  &__record {
    width: 100%;
    font-size: font(12);
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

  &__select {
    width: 100%;
    text-align: center;
    padding: interval(.5) interval(3) interval(.5) interval(1);
    border-radius: radius(soft);
    @include background-image('data:image/svg+xml;utf8,#{$angle-down}', right interval(.5) center, interval(1.5) interval(1.5));

    @include mq(sm) {
      background-size: interval(2) interval(1.5);
    }
  }
}
</style>
