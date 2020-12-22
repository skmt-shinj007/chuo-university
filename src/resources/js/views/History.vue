<template>
<div class="history">

  <section class="history__time-series section-container">
    <contents-title-component :title="messages.SectionTitles.History.Main" :subTitle="messages.SectionTitles.History.Sub"/>

    <div class="history__time-series-container" id="historySection">

      <div class="history__age">
        <div
          id="historyAgeTag"
          class="history__age-tag"
          :style="{ transform: `translateY(${scrollLimit}px)`}"
          v-text="ageChange">
        </div>
      </div>

      <div class="history__time-series-wrap">
        <div class="history__time-series-content">

          <div class="history__cards" id="historyTaisho">
            <!-- 大正の歴史 -->
            <div class="history__card-item">
              <history-card-component :Contents="data.History.Taisho"/>
            </div>
          </div>

          <div class="history__cards" id="historyShowa">
            <!-- 昭和の歴史 -->
            <div class="history__card-item" v-for="(showaHistory, i) in showaHistories" :key="`first-${i}`">
              <history-card-component :Contents="showaHistory"/>
            </div>
          </div>

          <div class="history__cards" id="historyHeisei">
            <!-- 平成の歴史 (今後コンテンツが増える可能性を考慮し、配列ループで表示) -->
            <div class="history__card-item" v-for="(heiseiHistory, i) in heiseiHistories" :key="`second-${i}`">
              <history-card-component :Contents="heiseiHistory"/>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="history__primary-titles section-container">
    <contents-title-component :title="messages.SectionTitles.PrimaryTitles.Main" :subTitle="messages.SectionTitles.PrimaryTitles.Sub"/>

    <icon-table-component :tableItems="titleAcquisitionData"/>
  </section>

  <div class="background-darkblue">
    <section class="history__champions section-container">
      <contents-title-component
        :title="messages.SectionTitles.Champions.Main"
        :subTitle="messages.SectionTitles.Champions.Sub"
        color="white"/>

      <div class="history__champions-card-row">
        <div class="history__champions-card" v-for="(champion, n) in champions" :key="n">
          <champions-card-component :cardElement="champion"/>
        </div>
      </div>
    </section>
  </div>

</div>
</template>

<script>
// import components
import Data from '../config/data.json';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import HistoryCardComponent from '../components/modules/card/HistoryCardComponent';
import IconTableComponent from '../components/modules/table/IconTableComponent';
import ChampionsCardComponent from '../components/modules/card/ChampionsCardComponent';

export default {
  components: {
    ContentsTitleComponent,
    HistoryCardComponent,
    IconTableComponent,
    ChampionsCardComponent,
  },
  data() {
    return {
      data: Data,
      ageWard: '',
      ids: null,
      showaHistories: [],
      heiseiHistories: [],
      titleAcquisitionData: [],
      champions: [],
      height: {
        historySection: 0,
        scrollTag: 0,
        historyTaisho: 0,
        historyShowa: 0,
        historyHeisei: 0,
      },
      cardsMarginBottom: 0,
    }
  },

  beforeMount() {
    // マウントされる直前に各データを data() で定義したプロパティに移管
    this.$data.data.History.Showa.forEach(element => this.showaHistories.push(element));
    this.$data.data.History.Heisei.forEach(element => this.heiseiHistories.push(element));
    this.$data.data.TitleAcquisitionData.forEach(element => this.titleAcquisitionData.push(element));
    this.$data.data.Champions.forEach(element => this.champions.push(element));
  },

  mounted() {
    // 要素のidを複数取得 => global.js > methods
    this.ids = this.getElements('historySection', 'historyAgeTag', 'historyTaisho', 'historyShowa', 'historyHeisei');

    // .history__cards の margin-bottom を数値で取得
    this.cardsMarginBottom = parseInt(window.getComputedStyle(this.ids.historyTaisho).marginBottom);

    /**
     * スクロールタグのスクロール上限を設定するために、沿革セクション要素の高さを取得
     * TODO:関数とか使って一括で指定できそう(help)
     */
    this.height.historySection = this.ids.historySection.offsetHeight;
    this.height.scrollTag      = this.ids.historyAgeTag.offsetHeight
    this.height.historyTaisho  = this.ids.historyTaisho.offsetHeight;
    this.height.historyShowa   = this.ids.historyShowa.offsetHeight;
    this.height.historyHeisei  = this.ids.historyHeisei.offsetHeight;

    // for (let id in this.ids) {
    //   if (Object.hasOwnProperty.call(this.ids, id)) {
    //     console.log(id);
    //     let elementHeight = document.getElementById(id).offsetHeight;
    //     console.log(elementHeight);
    //   }
    // }
  },

  computed: {

    /**
     * スクロール量に応じて時代の表示を変える
     */
    ageChange() {
      let scrollLimitTaisho = this.height.historyTaisho + this.cardsMarginBottom;  // 大正の沿革コンテンツの高さを代入
      let scrollLimitShowa  = scrollLimitTaisho + this.height.historyShowa + this.cardsMarginBottom;  // 昭和の沿革コンテンツの高さを代入

      if (this.scrollAmount < scrollLimitTaisho) {
        this.ageWard = this.$data.messages.Age.Taisho;

      } else if (this.scrollAmount < scrollLimitShowa) {
        this.ageWard = this.$data.messages.Age.Showa;

      } else {
        this.ageWard = this.$data.messages.Age.Heisei;
      }

      return this.ageWard;
    },
    // スクロールタグのスクロール上限を設定
    scrollLimit() {
      if (this.scrollAmount > this.height.historySection) {
        this.scrollAmount = this.height.historySection - this.height.scrollTag;
      }
      return this.scrollAmount;
    }
  }
}
</script>

<style lang="scss" scoped>
.history {

  &__time-series {

    &-container {
      @include flex;
    }

    &-content {
      width: 90%;
      margin: 0 auto;
    }
  }

  &__age {
    display: none;

    @include mq(md) {
      display: block;
      position: relative;
      width: interval(20);
      margin: 0 interval(3);

      &::before {
        display: block;
        content: '';
        width: interval(1);
        height: 100%;
        border-radius: radius(hard);
        background-color: darken($color: color(lightgray), $amount: 10%);
        position: absolute;
        top: 0;
        left: 50%;
        z-index: -1;
        transform: translateX(-50%);
      }
    }

    &-tag {
      width: 100%;
      text-align: center;
      color: color(white);
      background-color: color(darkblue);
      border-radius: radius(hard);
      font-size: font(sm);
      font-weight: bold;
      padding: interval(.5);
      position: absolute;
      top: 0;
      transition: all 1s ease-out;
    }
  }

  &__cards {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__card-item {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__primary-titles {
    margin-bottom: interval(10);
  }

  &__champions {
    padding: interval(10) 0;
  }

  &__champions-card-row {
    @include mq(sm) {
      @include flex(row wrap);
      margin: 0 auto;
      max-width: interval(80);
    }

    @include mq(md) {
      max-width: interval(150);
    }
  }

  &__champions-card {
    margin: 0 interval(2) interval(5) interval(2);

    @include mq(sm) {
      margin: 0;
      padding: interval(1);
      width: 50%;
    }

    @include mq(md) {
      width: 33.33%;
    }
  }

}
</style>
