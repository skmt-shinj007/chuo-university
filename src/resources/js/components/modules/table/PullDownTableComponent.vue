<template>
  <div class="pull-down-table">
    <tr class="pull-down-table__record">

      <th class="pull-down-table__key">{{ titles.select.title }}</th>

      <td class="pull-down-table__value">
        <select class="pull-down-table__select" :name="titles.select.name" v-model="select">
          <option value="all" selected>{{ messages.Filter.All }}</option>
          <option v-for="(menu, n) in menus" :key="n" :value="menu">{{ menu }}</option>
        </select>
      </td>
    </tr>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // プルダウンの初期値は all
      select: "all"
    }
  },

  props: {
    /**
     * 1:プルダウンのタイトル
     * 2:selectタグに指定するname属性
     * 上記のデータを持ったオブジェクトの配列
     */
    titles: {
      type: Object,
      require: true
    },

    /**
     * プルダウンのメニューが入った配列
     * <option>に入る
     */
    menus: {
      type: Array,
      require: true
    }
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
