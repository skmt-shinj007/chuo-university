<template>
<div class="club">

  <div class="club__mainVisualSlider">
    <main-visual-slider :images="mainVisualImages"/>
  </div>

  <div class="background-darkblue">
    <section class="club__concept">
      <contents-title :title="messages.SectionTitles.Concept" color="white"/>

      <div class="concept__card-group">
        <div class="concept__card" v-for="(concept, n) in concepts" :key="n">
          <concept-card :concept="concept"/>
        </div>
      </div>

    </section>
  </div>

  <section class="club__practice">
    <contents-title :title="messages.SectionTitles.Practice"/>

    <div class="practice__table">
      <table-component :tableItems="practiceInformations"/>
    </div>

    <div class="practice__map">
      <google-map/>
    </div>

    <!-- PCデバイス幅 以下 -->
    <div class="practice__slider" v-if="windowWidth < breakpointPc">
      <contents-image-slider :images="courtImages"/>
    </div>

    <!-- PCデバイス幅 -->
    <div class="practice__image-group" v-if="windowWidth >= breakpointPc">
      <div class="practice__image" v-for="(image, n) in courtImages" :key="n">
        <caption-bar-image :imageUrl="`/image/${image.path}`" :alt="image.name" :barCaption="image.caption"/>
      </div>
    </div>

    <div class="practice__schedule">
      <h3 class="practice__schedule-title">{{ messages.ContentsTitles.Schedule }}</h3>

      <div class="practice__schedule-table">
        <table-component :tableItems="schedule"/>
      </div>
    </div>
  </section>

  <section class="club__dormitory">
    <contents-title :title="messages.SectionTitles.Dormitory"/>

    <div class="dormitory__lead">
      <p class="nl2br" v-text="messages.Club.Dormitory.LeadText"/>
    </div>

    <div class="dormitory__ticket-group">
      <div class="dormitory__ticket" v-for="(dormitoryInformation, n) in dormitoryInformations" :key="n">
        <dormitory-ticket :dormitoryData="dormitoryInformation"/>
      </div>
    </div>

    <!-- PCデバイス幅 以下 -->
    <div class="dormitory__slider" v-if="windowWidth < breakpointPc">
      <contents-image-slider :images="dormitoryImages"/>
    </div>

    <!-- PCデバイス幅 -->
    <div class="dormitory__image-group" v-if="windowWidth >= breakpointPc">
      <div class="dormitory__image" v-for="(image, n) in dormitoryImages" :key="n">
        <caption-bar-image :imageUrl="`/image/${image.path}`" :alt="image.name" :capacityNum="image.capacity"/>
      </div>
    </div>

  </section>

  <div class="background-darkblue">
    <section class="club__member">
      <contents-title :title="messages.SectionTitles.Member" color="white"/>

      <player-slider :players="players"/>

      <div class="member__number">
        <h3 class="member__number-title">{{ messages.ContentsTitles.Numbers }}</h3>

        <div class="member__number-table">
          <table-component :tableItems="memberNumber" addKeyText="年生" addValueText="名" size="lg"/>
        </div>

        <div class="member__button">
          <link-button :link="messages.Links.Member"/>
        </div>
      </div>
    </section>
  </div>

  <section class="club__photo">
    <contents-title :title="messages.SectionTitles.Photo"/>

    <arrange-images :imagesData="imagesData"/>

    <div class="photo__button">
      <link-button :link="messages.Links.Photo"/>
    </div>
  </section>

  <div class="club__scroll-top">
    <scroll-top-button/>
  </div>
</div>
</template>

<script>
// data
import Data from '../config/data.json';

// component import
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import GoogleMap from '../components/modules/GoogleMapComponent';
import conceptCard from '../components/modules/card/conceptCardComponent';
import ContentsImageSlider from '../components/modules/slider/contentsImageSliderComponent';
import MainVisualSlider from '../components/modules/slider/MainVisualSliderComponent';
import TableComponent from '../components/modules/table/TableComponent';
import CaptionBarImage from '../components/modules/CaptionBarImageComponent';
import DormitoryTicket from '../components/modules/ticket/DormitoryTicketComponent';
import PlayerSlider from '../components/modules/slider/PlayerSliderComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import ArrangeImages from '../components/contents/ArrangeImagesComponent';
import scrollTopButton from '../components/modules/button/ScrollTopButtonComponent'

export default {
  components: {
    ContentsTitle,
    conceptCard,
    MainVisualSlider,
    TableComponent,
    GoogleMap,
    ContentsImageSlider,
    CaptionBarImage,
    DormitoryTicket,
    PlayerSlider,
    LinkButton,
    ArrangeImages,
    scrollTopButton,
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
  }

  &__dormitory {
    margin-bottom: interval(10);
  }

  &__member {
    margin: 0 auto;
  }

  &__photo {
    margin-top: interval(5);
  }

  &__scroll-top {
    @include scroll-top();
  }
}

%slider {
  margin-top: interval(10);

  @include mq(sm) {
    max-width: pixel(80);
    margin: interval(10) auto 0 auto;
  }
}

%image {
  width: calc(100% / 3);
  margin-right: interval(2);

  &:last-child {
    margin-right: 0;
  }
}

%button {
  margin-top: interval(5);

  @include mq(sm) {
    max-width: interval(50);
    margin: interval(5) auto 0 auto;
  }
}

.concept {
  &__card-group {

    @include mq(sm) {
      max-width: interval(60);
      margin: 0 auto;
      @include flex(row nowrap, space-between, center);
    }

    @include mq(md) {
      max-width: interval(100);
    }
  }

  &__card {
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
}

.practice {
  &__map {
    padding-top: interval(5);
  }

  &__slider {
    @extend %slider;
  }

  &__image-group {
    @include flex(row nowrap, space-between, center);
    margin-top: interval(10);
  }

  &__image {
    @extend %image;
  }

  &__schedule {
    margin-top: interval(10);
  }

  &__schedule-title {
    @include middle-line-text(2, 1px, color(darkblue));
  }

  &__schedule-table {
    margin-top: interval(2);
  }
}

.dormitory {
  &__lead {

    @include mq(sm) {
      text-align: center;
      max-width: interval(80);
      margin: 0 auto;
    }

    @include mq(md) {
      max-width: interval(100);
    }
  }

  &__ticket-group {
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

  &__ticket {
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

  &__slider {
    @extend %slider;
  }

  &__image-group {
    @include flex();
  }

  &__image {
    @extend %image;
  }
}

.member {
  &__number {
    margin-top: interval(10);
  }

  &__number-title {
    @include middle-line-text(2, 1px, color(white));
  }

  &__number-table {
    margin-top: interval(2);
  }

  &__button {
    @extend %button;
  }
}

.photo {
  &__button {
    @extend %button;
  }
}
</style>
