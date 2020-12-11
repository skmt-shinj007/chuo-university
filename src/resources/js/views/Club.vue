<template>
<div class="club">

  <section class="club__mainVisualSlider">
    <main-visual-slider-component :images="mainVisualImages"/>
  </section>

  <div class="background-darkblue">
    <section class="club__policy section-container">
      <contents-title-component :title="messages.Club.Policy.Title" :subTitle="messages.Club.Policy.SubTitle" color="white"/>

      <div class="club__policy-cards">
        <policy-card-component
        v-for="policy in policies"
        :key="policy.id"
        :policyTitle="policy.title"
        :policyContent="policy.content"
        :policySubTitle="policy.subTitle"/>
      </div>
    </section>
  </div>

  <section class="club__practice section-container">
    <contents-title-component :title="messages.Club.Practice.Title" :subTitle="messages.Club.Practice.SubTitle"/>

    <div class="club__practice-table">
      <table-component :tableItems="practiceInformations"/>
    </div>

    <div class="club__practice-map">
      <google-map-component/>
    </div>

    <!-- 画面幅992px以下で表示（tablet以下） -->
    <div class="club__practice-imageSlider" v-if="windowWidth < pcWidth">
      <contents-image-slider-component :images="courtImages"/>
    </div>

    <!-- 画面幅993pxから表示（pcから） -->
    <div class="club__practice-rowImages" v-if="windowWidth >= pcWidth">
      <div class="club__practice-rowImages-item" v-for="(image, n) in courtImages" :key="n">
        <caption-bar-image-component :imageUrl="`/image/${image.path}`" :alt="image.name" :barCaption="image.caption"/>
      </div>
    </div>

    <div class="club__practice-schedule">
      <h3 class="club__practice-schedule-title">{{ messages.Club.Practice.ScheduleTitle }}</h3>
      <table-component :tableItems="schedule"/>
    </div>
  </section>

  <section class="club__dormitory section-container">
    <contents-title-component :title="messages.Club.Dormitory.Title" :subTitle="messages.Club.Dormitory.SubTitle"/>

    <div class="club__dormitory-lead-wrap">
      <p class="nl2br" v-text="messages.Club.Dormitory.LeadText"/>
    </div>

    <div class="club__dormitory-cards">
      <div class="club__dormitory-card-item" v-for="(dormitoryInformation, n) in dormitoryInformations" :key="n">
        <dormitory-card-component v-bind="dormitoryInformation"/>
      </div>
    </div>

    <div class="club__practice-imageSlider" v-if="windowWidth < pcWidth">
      <contents-image-slider-component :images="dormitoryImages"/>
    </div>

    <div class="club__dormitory-images" v-if="windowWidth >= pcWidth">
      <div class="club__dormitory-images-item" v-for="(image, n) in dormitoryImages" :key="n">
        <caption-bar-image-component :imageUrl="`/image/${image.path}`" :alt="image.name" :capacityNum="image.capacity"/>
      </div>
    </div>
  </section>

  <div class="club__member-bg">
    <section class="club__member section-container">
      <contents-title-component :title="messages.Club.Member.Title" :subTitle="messages.Club.Member.SubTitle" color="white"/>

      <player-slider-component :playerInformations="playerInformations"/>

      <div class="club__member-number">
        <h3 class="club__member-number-title">{{ messages.Club.Member.NumbersText }}</h3>
        <table-component :tableItems="memberNumber" addKeyText="年生" addValueText="名"/>
      </div>

      <div class="club__member-button">
        <view-all-button-component :name="messages.Club.Member.Button"/>
      </div>
    </section>
  </div>

  <section class="club__photo section-container">
    <contents-title-component :title="messages.Club.Photo.Title" :subTitle="messages.Club.Photo.SubTitle"/>

    <div class="club__photo-images-container">
      <arrange-images-component :imagesData="imagesData"/>
    </div>

    <div class="club__photo-button">
      <view-all-button-component/>
    </div>
  </section>
</div>
</template>

<script>
// component import
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import GoogleMapComponent from '../components/modules/GoogleMapComponent';
import PolicyCardComponent from '../components/modules/card/PolicyCardComponent';
import ContentsImageSliderComponent from '../components/modules/slider/contentsImageSliderComponent';
import MainVisualSliderComponent from '../components/modules/slider/MainVisualSliderComponent';
import TableComponent from '../components/modules/table/TableComponent';
import CaptionBarImageComponent from '../components/modules/CaptionBarImageComponent';
import DormitoryCardComponent from '../components/modules/card/DormitoryCardComponent';
import PlayerSliderComponent from '../components/modules/slider/PlayerSliderComponent';
import ViewAllButtonComponent from '../components/modules/button/ViewAllButtonComponent';
import ArrangeImagesComponent from '../components/contents/ArrangeImagesComponent';

export default {
  components: {
    ContentsTitleComponent,
    PolicyCardComponent,
    MainVisualSliderComponent,
    TableComponent,
    GoogleMapComponent,
    ContentsImageSliderComponent,
    CaptionBarImageComponent,
    DormitoryCardComponent,
    PlayerSliderComponent,
    ViewAllButtonComponent,
    ArrangeImagesComponent,
  },
  data() {
    return {
      policies: [],
      mainVisualImages: [],
      practiceInformations: [],
      courtImages: [],
      schedule: [],
      dormitoryInformations: [],
      dormitoryImages: [],
      playerInformations: [],
      memberNumber: [],
      imagesData: [],
    }
  },

  beforeMount() {
    // TODO: 以下テストデータ生成
    mainVisualApiResponse.forEach(element => this.mainVisualImages.push(element));
    policiesData.forEach(element => this.policies.push(element));
    practiceData.forEach(element => this.practiceInformations.push(element));
    courtImageApiResponse.forEach(element => this.courtImages.push(element));
    scheduleData.forEach(element => this.schedule.push(element));
    dormitoryData.forEach(element => this.dormitoryInformations.push(element));
    dormitoryImageApiResponse.forEach(element => this.dormitoryImages.push(element));
    playerData.forEach(element => this.playerInformations.push(element));
    memberNumberData.forEach(element => this.memberNumber.push(element));
    imageApiResponse.forEach(element => this.imagesData.push(element));
  },

  mounted() {
    // console.log(this.$data.messages);
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
    path: 'tennis_court-in_chuoUniv-01.jpg',
    name: '中央大学ソフトテニスコートの画像',
    caption: '多摩校舎ソフトテニスコート（第二体育館）',
  },
  {
    path: 'tennis_court-in_chuoUniv-03.jpg',
    name: '中央大学ソフトテニスコートの画像',
    caption: 'ソフトテニスコート（1,2,3）',
  },
  {
    path: 'tennis_court-in_chuoUniv-02.jpg',
    name: '中央大学ソフトテニスコートの画像',
    caption: 'ソフトテニスコート（4,5,6）',
  }
];

/**
 * test api response : 寮の写真
 */
const dormitoryImageApiResponse = [
  {
    path: 'dormitory-02.jpg',
    name: '中央大学南平寮の3人部屋',
    capacity: 3,
  },
  {
    path: 'dormitory-01.jpg',
    name: '中央大学南平寮の4人部屋',
    capacity: 4,
  },
  {
    path: 'dormitory-03.jpg',
    name: '中央大学南平寮の4人部屋',
    capacity: 4,
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
const practiceData = [
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

/**
 * test data : 年間スケジュール
 */
const scheduleData = [
  {
    key: '1月',
    value: 'オフ'
  },
  {
    key: '2月',
    value: 'オフ / 練習開始'
  },
  {
    key: '3月',
    value: '春合宿'
  },
  {
    key: '4月',
    value: '東都リーグ（春）'
  },
  {
    key: '5月',
    value: '関東リーグ（春）'
  },
  {
    key: '6月',
    value: '定期戦（立命館大学）'
  },
  {
    key: '7月',
    value: '東日本インカレ'
  },
  {
    key: '8月',
    value: 'インカレ'
  },
  {
    key: '9月',
    value: '東都リーグ（秋）'
  },
  {
    key: '10月',
    value: '関東リーグ（秋）'
  },
  {
    key: '11月',
    value: '大学対抗'
  },
  {
    key: '12月',
    value: 'オフ / 納会'
  },
];

/**
 * test data : 寮のデータ
 */
const dormitoryData = [
  {
    srcUrl: 'restaurant.svg',
    alt: 'アイコンのaltが入ります',
    content: '食堂は、朝昼夜と利用することができます。寮食は中央大学のヒルトップ3Fで営業している「芭巣亭」が運営しています。',
  },
  {
    srcUrl: 'restaurant.svg',
    alt: 'アイコンのaltが入ります',
    content: '南平寮の大浴場は立ち風呂になっており、水風呂とサウナを完備しています。\n',
    bathTime: '入浴可能時間：6:00 - 9:30 / 12:00 - 14:00 / 16:30 - 23:00',
  },
  {
    srcUrl: 'restaurant.svg',
    alt: 'アイコンのaltが入ります',
    content: 'ソフトテニス部には、3人部屋・4人部屋が割り当たっています。\n上級生と下級生が自然とコミュニケーションをとれるよう、年次ごとに分けて配置しています。',
  },
  {
    srcUrl: 'restaurant.svg',
    alt: 'アイコンのaltが入ります',
    content: '洗濯機は、ソフトテニス部の部屋がある階に4台ございます。',
    washPrice: '洗濯機：無料',
    dryPrice: '乾燥機：24分 / 100円'
  }
];

/**
 * test data : 選手情報のテストデータ
 */
const playerData = [
  {
    name: '坂本 信治',
    englishName: 'sakamoto shinji',
    imagePath: 'player15.jpeg',
    imageAlt: '坂本 信治の写真',
    position: '前衛',
    grade: 4,
    post: '主務',
    undergraduate: '経済学部',
    birthplace: '北海道',
    almaMater: '北海道科学大学高等学校',
    record: '2016年インターハイ ベスト16',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: '宮崎 悠登',
    englishName: 'miyazaki yuto',
    imagePath: 'player01.jpg',
    imageAlt: '宮崎 悠登の写真',
    position: '後衛',
    grade: 4,
    post: '主将',
    undergraduate: '経済学部',
    birthplace: '山形県',
    almaMater: '山形県羽黒高等学校',
    record: '2016年ハイスクールジャパンカップ ダブルス準優勝',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: '田邊 雅人',
    englishName: 'tanabe masato',
    imagePath: 'player09.jpg',
    imageAlt: '田邊 雅人の写真',
    position: '前衛',
    grade: 4,
    post: '副主将',
    undergraduate: '法学部',
    birthplace: '福島県',
    almaMater: '三重高等学校',
    record: '2016年国民体育大会 少年の部 優勝',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: '斎藤 利貴',
    englishName: 'saito riki',
    imagePath: 'player03.jpg',
    imageAlt: '斎藤 利貴の写真',
    position: '後衛',
    grade: 4,
    post: '寮長',
    undergraduate: '経済学部',
    birthplace: '千葉県',
    almaMater: '千葉県昭和学院高等学校',
    record: '2016年ハイスクールジャパンカップ ベスト8',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: '佐藤 辰哉',
    englishName: 'sato shinya',
    imagePath: 'player16.jpg',
    imageAlt: '佐藤 辰哉の写真',
    position: '後衛',
    grade: 3,
    post: '副主将',
    undergraduate: '文学部',
    birthplace: '広島県',
    almaMater: '尾道高等学校',
    record: '2016年ハイスクールジャパンカップ ダブルス ベスト4',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
];

/**
 * test data : 部員数のデータ
 */
const memberNumberData = [
  {
    key: 4,    // 年次
    value: 4,  // 人数
  },
  {
    key: 3,
    value: 7,
  },
  {
    key: 2,
    value: 5,
  },
  {
    key: 1,
    value: 6,
  }
];

/**
 * test Api Data : 画像ストレージからのAPIレスポンス（想定）
 */
const imageApiResponse = [
  {
    path: 'player01.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player02.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player03.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player04.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player05.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player06.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player07.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player08.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player09.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player10.jpg',
    alt: '写真の補足テキスト',
  },
  {
    path: 'player11.jpg',
    alt: '写真の補足テキスト',
  },
];
</script>

<style lang="scss" scoped>
.club {
  &__mainVisualSlider {
    width: 100%;
    height: 100vh;
  }

  &__policy {
    padding: interval(10) 0;
    margin-top: 0;

    &-cards {

      // tablet style
      @include mq(sm) {
        margin: 0 interval(3);
        @include flex($justify-content: space-around);
      };
    }
  }

  &__practice {

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

    &-rowImages {
      @include flex($justify-content: space-around);
      margin-top: interval(10);

      &-item {
        width: 30%;
      }
    }

    &-schedule {
      margin-top: interval(10);
    }

    &-schedule-title {
      width: 90%;
      margin: 0 auto interval(2) auto;
      padding-left: interval(3);
      position: relative;
      @include text-before-line(interval(2), 1px, color(darkblue));

      @include mq(sm) {
        width: 80%;
      };

      @include mq(md) {
        width: 70%;
      };
    }
  }

  &__dormitory {

    &-lead-wrap {
      width: 90%;
      margin: 0 auto;

      @include mq(sm) {
        width: 80%;
      };

      @include mq(md) {
        text-align: center;
      };
    }

    &-cards {
      margin-top: interval(4);

      @include mq(md) {
        @include flex(row wrap);
      };
    }

    &-card-item {
      width: 90%;
      margin: 0 auto;

      @include mq(sm) {
        width: 70%;
      };

      @include mq(md) {
        width: 50%;
        max-width: 500px;
      };
    }

    &-images {
      @include flex($justify-content: space-around);
      margin-top: interval(10);
    }

    &-images-item {
      width: 30%;
    }
  }

  &__member {
    padding: interval(5) 0;

    @include mq(md) {
      padding: interval(10) 0;
    }

    &-bg {
      @include gradient();
    }

    &-number {
      margin-top: interval(10);
    }

    &-number-title {
      width: 90%;
      color: color(white);
      margin: 0 auto interval(2) auto;
      padding-left: interval(3);
      position: relative;
      @include text-before-line(interval(2), 1px, color(white));

      @include mq(sm) {
        width: 80%;
      };

      @include mq(md) {
        width: 70%;
      };
    }

    &-button {
      margin-top: interval(5);
    }
  }

  &__photo {
    margin: interval(10) 0;

    @include mq(md) {
      margin: interval(20) 0;
    }

    &-images-container {
      width: 90%;
      margin: 0 auto;
    }

    &-button {
      margin-top: interval(5);

      @include mq(sm) {
        margin-top: interval(7);
      };
    }
  }
}
</style>
