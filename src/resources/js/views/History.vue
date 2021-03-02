<template>
<div class="history">

  <section class="history__archive">
    <contents-title-component :title="messages.SectionTitles.History.Main" :subTitle="messages.SectionTitles.History.Sub"/>

    <div class="archive" ref="archive">

      <!-- PC時のみ追従する時代のタグを表示 -->
      <div class="archive__age">
        <div
          ref="ageTag"
          class="archive__tag"
          :style="{ transform: `translateY(${scrollLimit}px)`}"
          v-text="ageChange"/>
      </div>

      <div class="archive__card">
        <!-- 大正の歴史 -->
        <div class="archive__wrap" ref="taisho">
          <div class="archive__content">
            <history-box-component :data="data.Taisho"/>
          </div>
        </div>

        <!-- 昭和の歴史 -->
        <div class="archive__wrap" ref="showa">
          <div class="archive__content" v-for="(showaHistory, i) in showa" :key="`first-${i}`">
            <history-box-component :data="showaHistory"/>
          </div>
        </div>

        <!-- 平成の歴史 (今後コンテンツが増える可能性を考慮し、配列ループで表示) -->
        <div class="archive__wrap" ref="heisei">
          <div class="archive__content" v-for="(heiseiHistory, i) in heisei" :key="`second-${i}`">
            <history-box-component :data="heiseiHistory"/>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="history__trophies">
    <contents-title-component :title="messages.SectionTitles.PrimaryTitles.Main" :subTitle="messages.SectionTitles.PrimaryTitles.Sub"/>

    <icon-table-component :tableItems="trophies"/>
  </section>

  <div class="background-darkblue">
    <section class="history__winner">
      <contents-title-component
        :title="messages.SectionTitles.Champions.Main"
        :subTitle="messages.SectionTitles.Champions.Sub"
        color="white"/>

      <div class="winner__card-group">
        <div class="winner__card" v-for="(champion, n) in champions" :key="n" ref="championCard">
          <champions-card-component :cardElement="champion"/>
        </div>
        <!-- カード配置を左揃えにするため、空の要素を追加 -->
        <div
          class="enpty"
          v-for="n in cardNumber"
          :key="`enpty-${n}`"
          :style="{ width: `${cardWidth}px` }"
        />
      </div>
    </section>
  </div>

</div>
</template>

<script>
// import components
import Data from '../config/data.json';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import HistoryBoxComponent from '../components/contents/HistoryBoxComponent';
import IconTableComponent from '../components/modules/table/IconTableComponent';
import ChampionsCardComponent from '../components/modules/card/ChampionsCardComponent';

export default {
  components: {
    ContentsTitleComponent,
    HistoryBoxComponent,
    IconTableComponent,
    ChampionsCardComponent,
  },
  data() {
    return {
      data: Data,

      /**
       * 追従タグの時代表示
       * @type { String }
       */
      ageWard: '',

      /**
       * 沿革 (大正時代のみオブジェクト形式)
       * @type { Array }
       */
      showa: [],
      heisei: [],

      /**
       * 過去に獲得したタイトル
       * @type { Array }
       */
      trophies: [],

      /**
       * 天皇杯優勝者（中大出身）
       * @type { Array }
       */
      champions: [],

      /**
       * 沿革セクションの各アイテムの下余白
       * @type { Number }
       */
      archiveMarginBottom: 0,

      /**
       * refで取得できる要素の高さ（同じref名で複数個ある要素は除く）
       * @type { Object }
       */
      elementsHeight: {},

      /**
       * チャンピオンセクションのカード個数
       * @type { Number }
       */
      cardNumber: 0,

      /**
       * チャンピオンカードのwidth値
       * @type { Number }
       */
      cardWidth: 0,
    }
  },

  beforeMount() {
    // 各データを挿入
    this.$data.data.Showa.forEach(element => this.showa.push(element));
    this.$data.data.Heisei.forEach(element => this.heisei.push(element));
    this.$data.data.Trophies.forEach(element => this.trophies.push(element));
    this.$data.data.champions.forEach(element => this.champions.push(element));
  },

  mounted() {
    /**
     * [要素の高さを取得]
     * $refsを配列に変換。
     */
    const elements = Object.entries(this.$refs).map(([key, value]) => ({key, value}));

    // 配列（同じref名で複数個ある要素）以外の要素の高さを取得
    elements.forEach(element => {
      if (!Array.isArray(element.value)) {
        this.elementsHeight[element.key] = element.value.offsetHeight;
      }
    });

    // スクロールタグの上限設定に関係ある要素の高さがリサイズされたらプロパティを更新
    window.addEventListener('resize', this.getScrollTargetHeight);

    // カードのmargin-bottom を数値で取得
    this.archiveMarginBottom = parseInt(window.getComputedStyle(this.$refs.taisho).marginBottom);

    /**
     * チャンピオンカードの配置を揃えるための処理
     */
    const card = this.$refs.championCard;

    // チャンピオンカード > 描画後の個数と幅を取得
    this.cardNumber = card.length;
    this.getCardWidth();

    // sp, md, pc でカード幅が変わるので、リアルタイムでwidthを取得
    window.addEventListener('resize', this.getCardWidth);
  },

  computed: {
    /**
     * スクロール量に応じて時代タグのテキストを変える
     * @return { String }  ex) 昭和
     */
    ageChange() {
      // 扱いやすいようにdataのプロパティを変数に代入
      let marginBottom = this.archiveMarginBottom;
      let taishoHeight = this.elementsHeight.taisho + marginBottom;  // 大正の沿革ボックスの高さを代入
      let showaHeight  = taishoHeight + this.elementsHeight.showa + marginBottom;  // 昭和の沿革ボックスの高さを代入
      let scroll = this.scrollAmount;  // スクロール量
      let age = this.ageWard;  // タグのテキスト

      if (scroll < taishoHeight) {
        age = this.$data.messages.Age.Taisho;
      }
      else if (scroll < showaHeight) {
        age = this.$data.messages.Age.Showa;
      }
      else {
        age = this.$data.messages.Age.Heisei;
      }

      return age;
    },

    /**
     * スクロールタグのスクロール上限を設定
     * @return { Number }  沿革セクションの高さからタグの高さを引いた数値が返る
     */
    scrollLimit() {
      let scroll = this.scrollAmount;  // スクロール量
      let archiveHeight = this.elementsHeight.archive;  // 沿革セクション全体の高さ
      let tag = this.elementsHeight.ageTag;  // スクロールタグの高さ

      if (scroll > archiveHeight) this.scrollAmount = archiveHeight - tag;

      return this.scrollAmount;
    }
  },

  methods: {
    /**
     * カード幅を取得
     */
    getCardWidth() {
      this.cardWidth = this.$refs.championCard[0].offsetWidth;
    },

    /**
     * スクロール上限設定に関係ある要素の高さを取得
     */
    getScrollTargetHeight() {
      const ref = this.$refs;
      this.elementsHeight.ageTag = ref.ageTag.offsetHeight;
      this.elementsHeight.archive = ref.archive.offsetHeight;
    }
  },

  beforeDestroy() {
    // 登録したイベントを解除
    window.removeEventListener('resize', this.getCardWidth);
    window.removeEventListener('resize', this.getScrollTargetHeight);
  },
}
</script>

<style lang="scss" scoped>
.history {
  &__archive {
    margin-top: interval(5);

    @include mq(md) {
      margin-top: 0;
    }
  }

  &__trophies {
    margin-bottom: interval(10);
  }

  &__winner {
    margin: 0 auto;
  }
}

.archive {
  @include flex;

  &__age {
    display: none;

    @include mq(md) {
      display: block;
      position: relative;
      width: interval(20);
      margin-right: interval(2);

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
  }

  &__tag {
    width: 100%;
    text-align: center;
    color: color(white);
    background-color: color(darkblue);
    border-radius: radius(hard);
    font-size: font(12);
    font-weight: bold;
    padding: interval(.5);
    position: absolute;
    top: 0;
    transition: all 1s ease-out;
  }

  &__wrap {
    margin-bottom: interval(15);

    &:last-child {
      margin-bottom: 0;
    }
  }

  &__content {
    margin-bottom: interval(10);

    &:last-child {
      margin-bottom: 0;
    }
  }
}

.winner {
  &__card-group {
    @include flex(row wrap, center, center);
  }

  &__card {
    width: interval(32);
    padding: interval(1);
  }
}
</style>
