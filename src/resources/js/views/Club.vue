<template>
<div class="club">

  <div class="club__mainVisualSlider">
    <main-visual-slider-component :images="mainVisualImages"/>
  </div>

  <div class="background-darkblue">
    <section class="club__concept">
      <contents-title-component :title="messages.SectionTitles.Concept.Main" :subTitle="messages.SectionTitles.Concept.Sub" color="white"/>

      <div class="club__concept-cards">
        <div class="club__concept-card" v-for="(concept, n) in concepts" :key="n">
          <concept-card-component :concept="concept"/>
        </div>
      </div>

    </section>
  </div>

  <section class="club__practice">
    <contents-title-component :title="messages.SectionTitles.Practice.Main" :subTitle="messages.SectionTitles.Practice.Sub"/>

    <div class="club__practice-table">
      <table-component :tableItems="practiceInformations"/>
    </div>

    <div class="club__practice-map">
      <google-map-component/>
    </div>

    <!-- PCデバイス幅 以下 -->
    <div class="club__practice-imageSlider" v-if="windowWidth < breakpointPc">
      <contents-image-slider-component :images="courtImages"/>
    </div>

    <!-- PCデバイス幅 -->
    <div class="club__practice-rowImages" v-if="windowWidth >= breakpointPc">
      <div class="club__practice-rowImages-item" v-for="(image, n) in courtImages" :key="n">
        <caption-bar-image-component :imageUrl="`/image/${image.path}`" :alt="image.name" :barCaption="image.caption"/>
      </div>
    </div>

    <div class="club__practice-schedule">
      <h3 class="club__practice-schedule-title">{{ messages.ContentsTitles.Schedule }}</h3>
      <div class="club__practice-schedule-table">
        <table-component :tableItems="schedule"/>
      </div>
    </div>
  </section>

  <section class="club__dormitory">
    <contents-title-component :title="messages.SectionTitles.Dormitory.Main" :subTitle="messages.SectionTitles.Dormitory.Sub"/>

    <div class="club__dormitory-lead-wrap">
      <p class="nl2br" v-text="messages.Club.Dormitory.LeadText"/>
    </div>

    <div class="club__dormitory-ticket-group">
      <div class="club__dormitory-ticket" v-for="(dormitoryInformation, n) in dormitoryInformations" :key="n">
        <dormitory-ticket-component :dormitoryData="dormitoryInformation"/>
      </div>
    </div>

    <!-- PCデバイス幅 以下 -->
    <div class="club__practice-imageSlider" v-if="windowWidth < breakpointPc">
      <contents-image-slider-component :images="dormitoryImages"/>
    </div>

    <!-- PCデバイス幅 -->
    <div class="club__dormitory-images" v-if="windowWidth >= breakpointPc">
      <div class="club__dormitory-images-item" v-for="(image, n) in dormitoryImages" :key="n">
        <caption-bar-image-component :imageUrl="`/image/${image.path}`" :alt="image.name" :capacityNum="image.capacity"/>
      </div>
    </div>

  </section>

  <div class="background-darkblue">
    <section class="club__member">
      <contents-title-component :title="messages.SectionTitles.Member.Main" :subTitle="messages.SectionTitles.Member.Sub" color="white"/>

      <player-slider-component :players="players"/>

      <div class="club__member-number">
        <h3 class="club__member-number-title">{{ messages.ContentsTitles.Numbers }}</h3>
        <div class="club__member-number-table">
          <table-component :tableItems="memberNumber" addKeyText="年生" addValueText="名"/>
        </div>
      </div>

      <div class="club__member-button">
        <primary-button-component :name="messages.ButtonName.Member"/>
      </div>
    </section>
  </div>

  <section class="club__photo">
    <contents-title-component :title="messages.SectionTitles.Photo.Main" :subTitle="messages.SectionTitles.Photo.Sub"/>

    <div class="club__photo-images-container">
      <arrange-images-component :imagesData="imagesData"/>
    </div>

    <div class="club__photo-button">
      <primary-button-component/>
    </div>
  </section>
</div>
</template>

<script>
// component import
import Data from '../config/data.json';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import GoogleMapComponent from '../components/modules/GoogleMapComponent';
import conceptCardComponent from '../components/modules/card/conceptCardComponent';
import ContentsImageSliderComponent from '../components/modules/slider/contentsImageSliderComponent';
import MainVisualSliderComponent from '../components/modules/slider/MainVisualSliderComponent';
import TableComponent from '../components/modules/table/TableComponent';
import CaptionBarImageComponent from '../components/modules/CaptionBarImageComponent';
import DormitoryTicketComponent from '../components/modules/ticket/DormitoryTicketComponent';
import PlayerSliderComponent from '../components/modules/slider/PlayerSliderComponent';
import PrimaryButtonComponent from '../components/modules/button/PrimaryButtonComponent';
import ArrangeImagesComponent from '../components/contents/ArrangeImagesComponent';

export default {
  components: {
    ContentsTitleComponent,
    conceptCardComponent,
    MainVisualSliderComponent,
    TableComponent,
    GoogleMapComponent,
    ContentsImageSliderComponent,
    CaptionBarImageComponent,
    DormitoryTicketComponent,
    PlayerSliderComponent,
    PrimaryButtonComponent,
    ArrangeImagesComponent,
  },
  data() {
    return {
      data: Data,
      mainVisualImages: [],
      concepts: [],
      practiceInformations: [],
      courtImages: [],
      schedule: [],
      dormitoryInformations: [],
      dormitoryImages: [],
      players: [],
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
    this.$data.data.Concept.forEach(element => this.concepts.push(element));
    this.$data.data.PracticeTable.forEach(element => this.practiceInformations.push(element));
    this.$data.data.ScheduleTable.forEach(element => this.schedule.push(element));
    this.$data.data.Dormitory.forEach(element => this.dormitoryInformations.push(element));

    // TODO:DBから情報を引っ張る
    // ユーザーカテゴリーで [選手] を抽出
    this.$data.data.Users.forEach(element => {
      (element.category === this.playerNum) ? this.players.push(element) : null;
    });
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

  &__concept {
    margin: 0 auto;

    &-cards {

      @include mq(sm) {
        max-width: interval(60);
        margin: 0 auto;
        @include flex(row nowrap, space-between, center);
      }

      @include mq(md) {
        max-width: interval(100);
      }
    }
  }

  &__concept-card {
    margin-bottom: interval(5);

    &:last-child {
      margin-bottom: 0;
    }

    @include mq(sm) {
      margin-bottom: 0;
      margin-right: interval(2);

      &:last-child {
        margin-right: 0;
      }
    }
  }

  &__practice {

    &-map {
      padding-top: interval(5);
    }

    &-imageSlider {
      margin-top: interval(10);

      @include mq(sm) {
        max-width: pixel(80);
        margin: interval(10) auto 0 auto;
      }

    }

    &-rowImages {
      @include flex(row nowrap, space-between, center);
      margin-top: interval(10);

      &-item {
        width: calc(100% / 3);
        margin-right: interval(2);

        &:last-child {
          margin-right: 0;
        }
      }
    }

    &-schedule {
      margin-top: interval(10);
    }

    &-schedule-title {
      margin: 0 auto interval(2) auto;
      @include middle-line-text(2, 1px, color(darkblue));
    }
  }

  &__dormitory {
    margin-bottom: interval(10);

    &-lead-wrap {

      @include mq(sm) {
        text-align: center;
        max-width: interval(80);
        margin: 0 auto;
      }

      @include mq(md) {
        max-width: interval(100);
      }
    }

    &-ticket-group {
      margin-top: interval(5);

      @include mq(sm) {
        max-width: interval(80);
        margin: interval(4) auto 0 auto;
      }

      @include mq(md) {
        margin-top: interval(10);
        max-width: none;
        @include flex(row wrap);
      }
    }

    &-ticket {
      margin-bottom: interval(5);
      @include flex(row nowrap, center, center);

      @include mq(md) {
        width: calc(100% / 2);
      }

      // アイテムが奇数個の場合、アイテム間に余白をつける
      &:nth-child(odd) {
        @include mq(md) {
          padding-right: interval(2);
        }
      }
    }

    &-images {
      @include flex();
    }

    &-images-item {
      width: calc(100% / 3);
      margin-right: interval(2);

      &:last-child {
        margin-right: 0;
      }
    }
  }

  &__member {
    margin: 0 auto;

    &-number {
      margin-top: interval(10);
    }

    &-number-title {
      color: color(white);
      margin-bottom: interval(2);
      @include middle-line-text(2, 1px, color(white));
    }

    &-button {
      margin-top: interval(5);
    }
  }

  &__photo {

    &-button {
      margin-top: interval(5);
    }
  }
}
</style>
