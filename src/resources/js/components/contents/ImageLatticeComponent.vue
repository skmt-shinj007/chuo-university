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
    <div class="lattice__item" v-for="(image,n) in filteringImages" :key="n">
      <figure class="lattice__img-wrap">
        <img class="lattice__img" :src="`/image/${image.src}`" :alt="image.alt">
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
      years: [],        // 撮影年の配列（images配列参照）
      selectVal: "all", // 絞り込みの選択値
      count: 6,         // イメージの表示枚数（こいつで表示枚数を管理する）
    }
  },
  props: {
    // 全写真データが格納されている配列
    images: {
      type: Array,
      default: null
    }
  },
  beforeMount() {
    /**
     * イメージは新しいものから表示させたいので、イメージ配列を降順でソート。
     * 比較対象は、shooting.yearプロパティ (写真を撮った年月)
     * @param1 配列の要素 比較対象 1つ目
     * @param2 配列の要素 比較対象 2つ目
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
    console.log(this.filteringImages.slice(0, 6));
  },
  computed: {
    /**
     * 返り値 => images配列をフィルタリングした配列を返す
     */
    filteringImages() {
      if (this.selectVal !== "all") {
        // filter関数内で$dataにアクセスできなかったので、変数に代入。
        let selected = this.selectVal;

        // 絞り込む年を選択した場合、フィルタリングされた配列を 指定回数(20) 返す。
        return this.images.filter( function(value) {
          return value.shooting.year === selected;
        }).slice(0, this.count);

      } else {
        return this.images.slice(0, this.count);
      }
    }
  },
  methods: {
    viewMore() {
      this.count += 1
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
    margin-bottom: interval(8);

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

  &__view-all {
    margin-bottom: interval(10);
  }
}

</style>
