<template>
<div class="lattice">
  <div class="lattice__filter">
    <span class="lattice__filter-name">絞り込み</span>
    <!-- フィルター機能 -->
    <select class="lattice__years-select" name="year" v-model="selectVal">
      <option value="all">全表示</option>
      <option v-for="(year, n) in years" :key="n" :value="year">{{ year }}</option>
    </select>
  </div>
  <div class="lattice__item-wrap">
    <!-- 写真 -->
    <div class="lattice__item" v-for="(contentsItem,n) in filteringData" :key="n">
      <figure class="lattice__img-wrap">
        <img class="lattice__img" :src="`/image/${contentsItem.src}`" :alt="contentsItem.alt">
      </figure>
    </div>
  </div>
  <div class="lattice__view-all">
    <view-all-button-component/>
  </div>
</div>
</template>

<script>
// component import
import ViewAllButtonComponent from '../modules/button/ViewAllButtonComponent';

export default {
  components: {
    ViewAllButtonComponent,
  },
  data() {
    return {
      years: [],
      selectVal: "all",
    }
  },
  props: {
    images: {
      type: Array,
      default: null
    }
  },
  beforeMount() {
    /**
     * イメージは新しいものから表示させたいので、イメージ配列を降順でソート。
     * 比較対象は、shooting.yearプロパティ (写真を撮った年月)
     */
    this.images.sort( function(firstEl,secondEl) {
      if (firstEl.shooting.year > secondEl.shooting.year) return -1;
      if(firstEl.shooting.year < secondEl.shooting.year) return 1;
      return 0;
    });

    /**
     * [フィルター機能]で使用する 撮影年 の配列を生成
     * 撮影年を写真のデータから抽出して year配列にセットする
     */
    this.images.forEach(element => this.years.push(element.shooting.year));
    // years配列の重複した値を削除
    this.years = Array.from(new Set(this.years));
  },
  mounted() {
  },
  computed: {
    filteringData() {
      if (this.selectVal !== "all") {
        // filter関数内で$dataにアクセスできなかったので、変数に代入。
        let selected = this.selectVal;

        // 絞り込みを選択した場合、フィルタリングされた配列を返す。
        return this.images.filter( function(value) {
          return value.shooting.year === selected;
        });

      } else {
        return this.images;
      }
    }
  },
}
</script>

<style lang="scss" scoped>
.lattice {

  &__filter {
    @include flex(row nowrap, flex-end, center);
    width: 80%;
    margin: 0 auto interval(3) auto;

    @include mq(sm) {
      justify-content: center;
      width: 100%;
      margin: 0 0 interval(3) 0;
    }
  }

  &__filter-name {
    margin-right: interval(2);
  }

  &__years-select {
    font-size: font(sm);
    text-align: center;
    padding: interval(.5) interval(1);
    border: 1px solid color(lightDarkblue);
    border-radius: radius(soft);
  }

  &__item-wrap {
    @include flex(column nowrap, center, center);

    @include mq(sm) {
      @include flex(row wrap, flex-start, stretch);
    }
  }

  &__item {
    width: 80%;
    margin-bottom: interval(5);

    @include mq(sm) {
      margin-bottom: 0;
      width: calc(100% / 2);
      padding: interval(2);
    }

    @include mq(md) {
      width: calc(100% / 3);
    }

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__img-wrap {
    @include trimming(aspect(square));
  }

  &__img {
    box-shadow: 0 0 10px 2px color(shadow);
    border-radius: radius(soft);
    transition: all .3s ease-out;

    @include mq(md) {
      &:hover {
        transform: scale(1.05);
      }
      cursor: pointer;
    }

  }
}

</style>
