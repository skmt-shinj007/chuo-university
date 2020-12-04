<template>
<div class="l-club p-club">

  <section class="p-club__mainVisualSlider">
    <main-visual-slider-component :images="mainVisualImages"/>
  </section>

  <div class="p-club__policy-bg">
    <section class="p-club__policy section-container">
      <contents-title-component title="team policy" subTitle="方針" color="white"/>

      <div class="p-club__policy-cards">
        <policy-card-component
        v-for="policy in policies"
        :key="policy.id"
        :policyTitle="policy.title"
        :policyContent="policy.content"
        :policySubTitle="policy.subTitle"/>
      </div>
    </section>
  </div>

  <section class="p-club__practice section-container">
    <contents-title-component title="practice" subTitle="練習"/>

    <div class="p-club__practice-table">
      <table-component :tableItems="practiceInformations"/>
    </div>

    <div class="p-club__practice-map">
      <google-map-component/>
    </div>

    <!-- 画面幅992px以下で表示（tablet以下） -->
    <div class="p-club__practice-imageSlider" v-if="windowWidth < pcWidth">
      <contents-image-slider-component :images="courtImages"/>
    </div>

    <!-- 画面幅993pxから表示（pcから） -->
    <div class="p-club__practice-schedule" v-if="windowWidth >= pcWidth">
      <image-component/>
    </div>
  </section>
</div>
</template>

<script>
// component import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import GoogleMapComponent from '../components/modules/googleMapComponent';
import PolicyCardComponent from '../components/modules/PolicyCardComponent';
import ContentsImageSliderComponent from '../components/modules/slider/contentsImageSliderComponent';
import MainVisualSliderComponent from '../components/modules/slider/MainVisualSliderComponent';
import TableComponent from '../components/modules/table/TableComponent';
import ImageComponent from '../components/modules/ImageComponent';

export default {
  components: {
    ContentsTitleComponent,
    PolicyCardComponent,
    MainVisualSliderComponent,
    TableComponent,
    GoogleMapComponent,
    ContentsImageSliderComponent,
    ImageComponent,
  },
  data() {
    return {
      policies: [],
      mainVisualImages: [],
      practiceInformations: [],
      courtImages: [],
    }
  },

  beforeMount() {
    // TODO: 以下テストデータ生成
    mainVisualApiResponse.forEach(element => this.mainVisualImages.push(element));
    policiesData.forEach(element => this.policies.push(element));
    practiceData.forEach(element => this.practiceInformations.push(element));
    courtImageApiResponse.forEach(element => this.courtImages.push(element));
    console.log('マウント前');
    console.log(this.$data.messages);
  },

  mounted() {
    console.log('マウント後');
    console.log(this.$data.messages);
  },
}

/**
 * test api response : メインビジュアル画像
 */
const mainVisualApiResponse = [
  {
    path: 'tennisBall-vertical.jpg',
    name: 'altテキストを入れます',
    text: '感謝と謙虚な心を忘れずに、日本一。これが中央大学ソフトテニス部の永遠の目標です',
  },
  {
    path: 'tennisBall.jpg',
    name: 'altテキストを入れます',
    text: '感謝と謙虚な心を忘れずに、日本一。これが中央大学ソフトテニス部の永遠の目標です',
  }
];

/**
 * test api response : コート写真
 */
const courtImageApiResponse = [
  {
    // path: 'tennis_court-in_chuoUniv-01.jpg',
    path: 'tennis_court-in_chuoUniv-01.jpg',
    name: '中央大学ソフトテニスコートの画像',
    text: '多摩校舎ソフトテニスコート（第二体育館）',
  },
  {
    path: 'tennis_court-in_chuoUniv-03.jpg',
    name: '中央大学ソフトテニスコートの画像',
    text: 'ソフトテニスコート（1,2,3）',
  },
  {
    path: 'tennis_court-in_chuoUniv-02.jpg',
    name: '中央大学ソフトテニスコートの画像',
    text: 'ソフトテニスコート（4,5,6）',
  }
];

/**
 * test data : ポリシーの内容
 */
const policiesData = [
  {
    id: 1,
    title: 'Symbol',
    content: '部訓が入ります。部訓が入ります。',
    subTitle: '部訓'
  },
  {
    id: 2,
    title: 'Target',
    content: '全日本大学対抗戦優勝',
    subTitle: '目標'
  },
  {
    id: 3,
    title: 'mission',
    content: 'ソフトテニスを通じた人間育成',
    subTitle: '意義'
  }
];

/**
 * test data : 練習情報
 */
const practiceData =[
  {
    key: '練習時間',
    value: '9:00 ~ 12:00（全体練習）',
  },
  {
    key: '活動期間',
    value: '2月 - 8月、9月 - 12月',
  },
  {
    key: 'オフ',
    value: '毎週月曜日・各大会後',
  },
  {
    key: '練習場所',
    value: '〒192-0393\n東京都八王子市東中野742-1\n中央大学多摩キャンパス第二体育館ソフトテニスコート',
  }
];
</script>

<style lang="scss" scoped>
.p-club {
  &__mainVisualSlider {
    width: 100%;
    height: 100vh;
  }

  &__policy-bg {
    background-color: color(darkblue);
    margin-top: 0;
  }

  &__policy {
    padding: interval(10) 0;
    margin-top: 0;

    &-cards {
      margin-top: interval(5);

      // tablet style
      @include mq(sm) {
        margin: interval(10) interval(3) 0 interval(3);
        @include flex($justify-content: space-around);
      };
    }
  }

  &__practice {

    &-table {
      margin-top: interval(5);
    }

    &-map {
      padding-top: interval(5);
    }

    &-imageSlider {
      padding-top: interval(8);
      width: 90%;
      margin: 0 auto;

      // tab
      @include mq(sm) {
        width: 70%;
      };

    }
  }
}
</style>
