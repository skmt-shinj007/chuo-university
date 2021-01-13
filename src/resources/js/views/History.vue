<template>
<div class="history">

  <section class="history__time-series">
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

          <div class="history__contents" id="historyTaisho">
            <!-- 大正の歴史 -->
            <div class="history__contents-item">
              <history-text-component :Contents="data.History.Taisho"/>
            </div>
          </div>

          <div class="history__contents" id="historyShowa">
            <!-- 昭和の歴史 -->
            <div class="history__contents-item" v-for="(showaHistory, i) in showaHistories" :key="`first-${i}`">
              <history-text-component :Contents="showaHistory"/>
            </div>
          </div>

          <div class="history__contents" id="historyHeisei">
            <!-- 平成の歴史 (今後コンテンツが増える可能性を考慮し、配列ループで表示) -->
            <div class="history__contents-item" v-for="(heiseiHistory, i) in heiseiHistories" :key="`second-${i}`">
              <history-text-component :Contents="heiseiHistory"/>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="history__primary-titles">
    <contents-title-component :title="messages.SectionTitles.PrimaryTitles.Main" :subTitle="messages.SectionTitles.PrimaryTitles.Sub"/>

    <div class="history__primary-titles-table">
      <icon-table-component :tableItems="titleAcquisitionData"/>
    </div>
  </section>

  <div class="background-darkblue">
    <section class="history__champions">
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
import HistoryTextComponent from '../components/contents/HistoryTextComponent';
import IconTableComponent from '../components/modules/table/IconTableComponent';
import ChampionsCardComponent from '../components/modules/card/ChampionsCardComponent';

export default {
  components: {
    ContentsTitleComponent,
    HistoryTextComponent,
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
      cardsMarginBottom: 0,

      heights: []
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
    // jsでid属性を一括で取得するため、DOMのid属性を配列にする
    let idName = [
      'historySection',
      'historyAgeTag',
      'historyTaisho',
      'historyShowa',
      'historyHeisei',
    ];

    // DOM要素を取得 => global.js > methods
    this.ids = this.getElements(idName);

    /**
     * 要素の高さを取得
     * リアルタイム取得ではないため、下記動作をするとバグる
     * SPで画面読み込み > PC幅にしてスクロールタグを表示 > スクロール
     */
    this.heights = this.getElementHeight(idName, 'id');

    // .history-contents の margin-bottom を数値で取得
    this.cardsMarginBottom = parseInt(window.getComputedStyle(this.ids.historyTaisho).marginBottom);
  },

  computed: {
    /**
     * スクロール量に応じて時代の表示を変える
     */
    ageChange() {
      let taishoHeight = this.heights.historyTaisho + this.cardsMarginBottom;  // 大正の沿革コンテンツの高さを代入
      let showaHeight  = taishoHeight + this.heights.historyShowa + this.cardsMarginBottom;  // 昭和の沿革コンテンツの高さを代入
      let scroll = this.scrollAmount;  // スクロール量
      let age = this.ageWard;  // タグのテキスト

      if (scroll < taishoHeight) {
        age = this.$data.messages.Age.Taisho;
      } else if (scroll < showaHeight) {
        age = this.$data.messages.Age.Showa;
      } else {
        age = this.$data.messages.Age.Heisei;
      }

      return age;
    },

    // スクロールタグのスクロール上限を設定
    scrollLimit() {
      const scroll = this.scrollAmount;  // スクロール量
      const sectionHeight = this.heights.historySection;  // [沿革]セクションの高さ
      const tag = this.heights.historyAgeTag;  // スクロールタグの高さ

      if (scroll > sectionHeight) {
        this.scrollAmount = sectionHeight - tag;
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

  &__contents {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__contents-item {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__primary-titles {
    margin-bottom: interval(10);
  }

  &__champions {
    margin: 0 auto;
  }

  &__champions-card-row {
    @include mq(sm) {
      @include flex(row wrap);
    }
  }

  &__champions-card {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0;
      padding: interval(1);
      width: calc(100% / 2);
    }

    @include mq(md) {
      width: calc(100% / 3);
    }
  }

}
</style>
