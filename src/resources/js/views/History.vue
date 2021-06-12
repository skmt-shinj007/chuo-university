<template>
<div class="history">

  <section class="history__archive">
    <contents-title :title="messages.SectionTitles.History"/>

    <div class="archive" ref="archive">

      <!-- PC時のみ追従する時代のタグを表示 -->
      <div class="archive__age">
        <div
          ref="ageTag"
          class="archive__tag"
          :style="{ transform: `translateY(${scrollLimit}px)`}"
          v-text="age"/>
      </div>

      <div class="archive__card">
        <!-- 大正の歴史 -->
        <div class="archive__wrap" ref="taisho">
          <div class="archive__content">
            <history-box :data="taisho"/>
          </div>
        </div>

        <!-- 昭和の歴史 -->
        <div class="archive__wrap" ref="showa">
          <div
            class="archive__content fade"
            v-for="(showaHistory, i) in showa"
            :key="`showa-${i}`"
            v-scroll="fade">

            <history-box :data="showaHistory"/>
          </div>
        </div>

        <!-- 平成の歴史 (今後コンテンツが増える可能性を考慮し、配列ループで表示) -->
        <div class="archive__wrap" ref="heisei">
          <transition name="scroll">
            <div
              class="archive__content fade"
              v-for="(heiseiHistory, i) in heisei"
              :key="`heisei-${i}`"
              v-scroll="fade">

              <history-box :data="heiseiHistory"/>
            </div>
          </transition>
        </div>

      </div>
    </div>
  </section>

  <section class="history__titles">
    <contents-title :title="messages.SectionTitles.PrimaryTitles"/>
    <table-component :table="viewdata.achievementsTable">
      <template v-slot:cell="body">
        <th class="titles__key">{{ body.item.key }}</th>
        <td class="titles__value">
          <svg-vue class="titles__icon" icon="trophy-solid" alt="トロフィーのアイコン"/>
          <span class="titles__unit" v-text="`× ${body.item.value}`"/>
        </td>
      </template>
    </table-component>
  </section>

  <div class="background-darkblue">
    <section class="history__winner">
      <contents-title :title="messages.SectionTitles.Champions" color="white"/>

      <div class="winner__card-group">
        <div class="winner__card" v-for="(champion, n) in viewdata.champions" :key="n">
          <champions-card :item="champion"/>
        </div>
      </div>
    </section>
  </div>

  <div class="history__scroll-top">
    <scroll-top-button/>
  </div>

</div>
</template>

<script>
// data
import HistoryData from '../config/data/historyData.json';
import ViewData from '../config/data/viewdata';

/**
 * mixin
 * resize.js は animation.js に組み込まれているので無駄にインポートしない。
 */
import Scroll from '../config/scroll';
import Animation from '../config/animation';

// import components
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import HistoryBox from '../components/contents/HistoryBoxComponent';
import TableComponent from '../components/modules/table/TableComponent';
import ChampionsCard from '../components/modules/card/ChampionsCardComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

export default {
  mixins: [Scroll, Animation],

  components: {
    ContentsTitle,
    HistoryBox,
    TableComponent,
    ChampionsCard,
    ScrollTopButton,
  },

  data() {
    return {
      historyData: HistoryData,
      viewdata: ViewData,

      /**
       * 沿革 (大正時代のみオブジェクト形式)
       * @type { Array }
       */
      taisho: {},
      showa: [],
      heisei: [],

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
    }
  },

  beforeMount() {
    // 各データを挿入
    this.taisho = this.$data.historyData.Taisho;
    this.$data.historyData.Showa.forEach(element => this.showa.push(element));
    this.$data.historyData.Heisei.forEach(element => this.heisei.push(element));
  },

  mounted() {
    this.getTargetHeight();
  },

  computed: {
    /**
     * スクロール量に応じて時代タグのテキストを変える
     * @return { String }  ex) 昭和
     */
    age() {
      // 扱いやすいようにdataのプロパティを変数に代入
      let marginBottom = this.archiveMarginBottom;
      let taishoHeight = this.elementsHeight.taisho + marginBottom;  // 大正の沿革ボックスの高さを代入
      let showaHeight  = this.elementsHeight.showa + taishoHeight + marginBottom;  // 昭和の沿革ボックスの高さを代入
      let scroll = this.scrollY;  // スクロール量

      if (scroll < taishoHeight) {
        return this.$data.messages.Age.Taisho;
      }
      else if (scroll < showaHeight) {
        return this.$data.messages.Age.Showa;
      }
      else {
        return this.$data.messages.Age.Heisei;
      }
    },

    /**
     * スクロールタグのスクロール上限を設定
     * @return { Number }  沿革セクションの高さからタグの高さを引いた数値が返る
     */
    scrollLimit() {
      let scroll = this.scrollY;  // スクロール量
      let archiveHeight = this.elementsHeight.archive;  // 沿革セクションの高さ
      let tag = this.elementsHeight.ageTag;  // スクロールタグの高さ

      if (scroll >= archiveHeight) scroll = archiveHeight - tag;

      return scroll;
    }
  },

  methods: {
    /**
     * 要素の高さを取得
     */
    getTargetHeight() {
      // refsオブジェクトを配列に変換
      const elements = Object.entries(this.$refs).map(([key, value]) => ({key, value}));

      // 要素の高さを取得（複数個を除く）
      elements.forEach(element => {
        if (!Array.isArray(element.value)) {
          this.elementsHeight[element.key] = element.value.offsetHeight;
        }
      });

      // 沿革ボックスのmargin-bottom を数値で取得
      this.archiveMarginBottom = parseInt(window.getComputedStyle(this.$refs.taisho).marginBottom);
    },
  },

  watch: {
    windowWidth() {
      this.getTargetHeight();
    }
  }
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

  &__titles {
    margin-bottom: interval(10);
  }

  &__winner {
    margin: 0 auto;
  }

  &__scroll-top {
    @include scroll-top();
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
    transition: transform .8s ease-out;
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

.titles {
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
  &__icon {
    width: interval(2.5);
    fill: #e3aa00;
  }
  &__unit {
    font-size: font(14);
    margin-left: interval(1);
  }
}

.winner {
  &__card-group {
    @include flex(row wrap, center, center);
    gap: interval(1);
  }

  &__card {
    width: interval(32);
  }
}
</style>
