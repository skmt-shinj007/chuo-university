<template>
<div class="club">

  <section class="club__mainVisualSlider">
    <main-visual-slider-component :images="mainVisualImages"/>
  </section>

  <div class="background-darkblue">
    <section class="club__policy section-container">
      <contents-title-component :title="messages.SectionTitles.Policy.Main" :subTitle="messages.SectionTitles.Policy.Sub" color="white"/>

      <div class="club__policy-cards">
        <!-- TODO:コンポーネントに直接 v-for しない -->
        <policy-card-component
        v-for="(policy, n) in policies"
        :key="n"
        :policy="policy"/>
      </div>
    </section>
  </div>

  <section class="club__practice section-container">
    <contents-title-component :title="messages.SectionTitles.Practice.Main" :subTitle="messages.SectionTitles.Practice.Sub"/>

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
      <h3 class="club__practice-schedule-title">{{ messages.ContentsTitles.Schedule }}</h3>
      <table-component :tableItems="schedule"/>
    </div>
  </section>

  <section class="club__dormitory section-container">
    <contents-title-component :title="messages.SectionTitles.Dormitory.Main" :subTitle="messages.SectionTitles.Dormitory.Sub"/>

    <div class="club__dormitory-lead-wrap">
      <p class="nl2br" v-text="messages.Club.Dormitory.LeadText"/>
    </div>

    <div class="club__dormitory-cards">
      <div class="club__dormitory-card-item" v-for="(dormitoryInformation, n) in dormitoryInformations" :key="n">
        <dormitory-card-component :dormitoryData="dormitoryInformation"/>
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
      <contents-title-component :title="messages.SectionTitles.Member.Main" :subTitle="messages.SectionTitles.Member.Sub" color="white"/>

      <player-slider-component :playerData="playerData"/>

      <div class="club__member-number">
        <h3 class="club__member-number-title">{{ messages.ContentsTitles.Numbers }}</h3>
        <table-component :tableItems="memberNumber" addKeyText="年生" addValueText="名"/>
      </div>

      <div class="club__member-button">
        <view-all-button-component :name="messages.ButtonName.Member"/>
      </div>
    </section>
  </div>

  <section class="club__photo section-container">
    <contents-title-component :title="messages.SectionTitles.Photo.Main" :subTitle="messages.SectionTitles.Photo.Sub"/>

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
import Data from '../config/data.json';
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
      data: Data,
      mainVisualImages: [],
      policies: [],
      practiceInformations: [],
      courtImages: [],
      schedule: [],
      dormitoryInformations: [],
      dormitoryImages: [],
      playerData: [],
      memberNumber: [],
      imagesData: [],
    }
  },

  beforeMount() {
    // TODO:画像を格納するクラウドストレージからApiで取得する
    mainVisualApiResponse.forEach(element => this.mainVisualImages.push(element));
    courtImageApiResponse.forEach(element => this.courtImages.push(element));
    dormitoryImageApiResponse.forEach(element => this.dormitoryImages.push(element));
    imageApiResponse.forEach(element => this.imagesData.push(element));

    // config/data.jsonから引っ張る
    this.$data.data.Policy.forEach(element => this.policies.push(element));
    this.$data.data.PracticeTable.forEach(element => this.practiceInformations.push(element));
    this.$data.data.ScheduleTable.forEach(element => this.schedule.push(element));
    this.$data.data.Dormitory.forEach(element => this.dormitoryInformations.push(element));

    // TODO:DBから情報を引っ張る
    playerApiResponse.forEach(element => this.playerData.push(element));
    memberNumberData.forEach(element => this.memberNumber.push(element));
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
 * test API response : 選手情報
 */
const playerApiResponse = [
  {
    name: {
      ja: '坂本 信治',
      en: 'sakamoto shinji',
    },
    image: {
      path: 'player15.jpeg',
      alt: '坂本 信治の写真'
    },
    studentInfo: {
      grade: 4,
      undergraduate: '経済学部',
    },
    from: {
      birthplace: '北海道',
      almaMater: '北海道科学大学高等学校',
    },
    position: '前衛',
    post: '主務',
    record: '2016年インターハイ ベスト16',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: {
      ja: '宮崎 悠登',
      en: 'miyazaki yuto',
    },
    image: {
      path: 'player01.jpg',
      alt: '宮崎 悠登の写真'
    },
    studentInfo: {
      grade: 4,
      undergraduate: '経済学部',
    },
    from: {
      birthplace: '山形県',
      almaMater: '山形県羽黒高等学校',
    },
    position: '後衛',
    post: '主将',
    record: '2016年ハイスクールジャパンカップ ダブルス準優勝',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: {
      ja: '田邊 雅人',
      en: 'tanabe masato',
    },
    image: {
      path: 'player09.jpg',
      alt: '田邊 雅人の写真',
    },
    studentInfo: {
      grade: 4,
      undergraduate: '法学部',
    },
    from: {
      birthplace: '福島県',
      almaMater: '三重高等学校',
    },
    position: '前衛',
    post: '副主将',
    record: '2016年国民体育大会 少年の部 優勝',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: {
      ja: '斎藤 利貴',
      en: 'saito riki',
    },
    image: {
      path: 'player03.jpg',
      alt: '斎藤 利貴の写真',
    },
    studentInfo: {
      grade: 4,
      undergraduate: '経済学部',
    },
    from: {
      birthplace: '千葉県',
      almaMater: '千葉県昭和学院高等学校',
    },
    position: '後衛',
    post: '寮長',
    record: '2016年ハイスクールジャパンカップ ベスト8',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
  {
    name: {
      ja: '佐藤 辰哉',
      en: 'sato shinya',
    },
    image: {
      path: 'player16.jpg',
      alt: '佐藤 辰哉の写真',
    },
    studentInfo: {
      grade: 3,
      undergraduate: '経済学部',
    },
    from: {
      birthplace: '福岡県',
      almaMater: '香川県尽誠学園高等学校',
    },
    position: '後衛',
    post: '副主将',
    record: '2016年ハイスクールジャパンカップ ダブルス ベスト4',
    ward: 'ここに抱負や選手の一言が入ります。DBに登録する際には、実際に選手自身に聞いた本物のテキストを登録します。',
  },
];

/**
 * test API response : 部員数
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
 * test Api response : 画像ストレージからのAPIレスポンス（想定）
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
    }

    &-button {
      margin-top: interval(5);
    }
  }

  &__photo {
    margin: interval(10) auto;

    @include mq(md) {
      margin-top: interval(20);
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
