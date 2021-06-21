<template>
<div class="club">

  <div class="club__mainVisualSlider">
    <main-visual-slider :images="mainVisualImages"/>
  </div>

  <section class="club__concept" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Concept"/>
    <div class="club__concept-content">
      <concept :items="viewdata.concepts"/>
    </div>
  </section>

  <section class="club__practice" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Practice"/>
    <div class="practice__table">
      <table-component :table="viewdata.practiceTable"/>
    </div>

    <div class="practice__map">
      <!-- google map 埋め込み（中央大学多摩キャンパス ソフトテニスコート） -->
      <iframe class="practice__map-content" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1621.2667723739717!2d139.3969191414313!3d35.63922419623377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018e3e36092b1eb%3A0xbda5deeac6e07b45!2z5Lit5aSu5aSn5a2mIOWkmuaRqeOCreODo-ODs-ODkeOCuSDjgr3jg5Xjg4jjg4bjg4vjgrnjgrPjg7zjg4g!5e0!3m2!1sja!2sjp!4v1606833350051!5m2!1sja!2sjp" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      <span class="practice__map-text">{{ messages.Club.AttentionText }}</span>
    </div>

    <div class="practice__images">
      <!-- スマホ -->
      <div class="practice__slider" v-if="windowWidth < breakpoints.md">
        <image-slider :images="viewdata.homeCourt"/>
      </div>

      <!-- PC -->
      <div class="practice__image-group" v-else>
        <div class="practice__image" v-for="(image, n) in viewdata.homeCourt" :key="n">
          <caption-image :image="image"/>
        </div>
      </div>
    </div>

    <div class="practice__schedule" v-fade:[dir.up]>
      <table-component :table="viewdata.scheduleTable"/>
    </div>
  </section>

  <section class="club__dormitory" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Dormitory"/>
    <div class="dormitory__lead">
      <p class="nl2br" v-text="messages.Club.Dormitory.LeadText"/>
    </div>

    <div class="dormitory__ticket-group">
      <div class="dormitory__ticket" v-for="(info, n) in viewdata.dormitory" :key="n">
        <div class="dormitory__ticket-inner">
          <div class="dormitory__ticket-icon-wrap">
            <svg-vue class="dormitory__ticket-icon" :icon="info.icon.src" :alt="info.icon.alt"/>
          </div>
          <div class="dormitory__ticket-text-wrap">
            <p class="dormitory__ticket-text nl2br" v-text="info.text"/>
            <template v-if="info.attributes">
              <div class="dormitory__ticket-supplement">
                <span class="dormitory__ticket-supplement-text" v-for="(attribute, n) in info.attributes" :key="n">
                  {{ attribute }}
                </span>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>

    <div class="dormitory__images">
      <!-- スマホ -->
      <div class="dormitory__slider" v-if="windowWidth < breakpoints.md">
        <image-slider :images="viewdata.roomImages">
          <template v-slot:caption="image">
            <span class="dormitory__caption">{{ image.image.caption }}</span>
            <span class="dormitory__caption-sub">人部屋</span>
          </template>
        </image-slider>
      </div>

      <!-- PC -->
      <div class="dormitory__image-group" v-else>
        <div class="dormitory__image" v-for="(image, n) in viewdata.roomImages" :key="n">
          <caption-image :image="image">
            <template v-slot:caption="image">
              <span class="dormitory__caption">{{ image.image.caption }}</span>
              <span class="dormitory__caption-sub">人部屋</span>
            </template>
          </caption-image>
        </div>
      </div>
    </div>
  </section>

  <div class="background-darkblue">
    <section class="club__member fade" v-scroll="fade">
      <contents-title :title="messages.SectionTitles.Member" color="white"/>
      <div class="member__player-slider">
        <slider :options="playerSliderOptions" :items="highestGradePlayer">
          <template v-slot:slideContents="player">
            <user-card :user="player.item" @open="openCardModal"/>
          </template>
        </slider>
        <!-- modal -->
        <player-modal
          v-if="card.modal.isShow"
          @close="closeCardModal"
          :player="card.modal.el"
          :tags="card.modal.tags"
        />
      </div>

      <div class="member__number">
        <div class="member__number-table">
          <table-component :table="playersNumberTable" titleColor="white"/>
        </div>
        <div class="member__button">
          <link-button :link="messages.Links.Member"/>
        </div>
      </div>
    </section>
  </div>

  <section class="club__photo fade" v-scroll="fade">
    <contents-title :title="messages.SectionTitles.Photo"/>
    <images-list :images="images"/>

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
// config
import { viewData } from '../config/data/viewdata';
import Mock from '../config/data/mock.json';
import Animation from '../config/animation';

// component import
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import Concept from '../components/contents/ConceptComponent';
import ImageSlider from '../components/modules/slider/ImageSliderComponent';
import MainVisualSlider from '../components/modules/slider/MainVisualSliderComponent';
import TableComponent from '../components/modules/table/TableComponent';
import CaptionImage from '../components/modules/CaptionImageComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import ImagesList from '../components/contents/ImagesListComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';
import UserCard from '../components/modules/card/UserCardComponent';
import Slider from '../components/modules/slider/SliderComponent';
import PlayerModal from '../components/modules/modal/PlayerModalComponent';

export default {
  components: {
    ContentsTitle,
    Concept,
    MainVisualSlider,
    TableComponent,
    ImageSlider,
    CaptionImage,
    LinkButton,
    ImagesList,
    ScrollTopButton,
    UserCard,
    Slider,
    PlayerModal,
  },

  mixins: [Animation],

  data() {
    return {
      mock: Mock,
      viewdata: viewData,
      mainVisualImages: [],
      dormitoryImages: [],
      images: [],

      // user card section data
      card: {
        modal: {
          isShow: false,
          el: null,
        },
      }
    }
  },

  created() {
    // TODO:画像を格納するクラウドストレージからApiで取得する
    mainVisualApiResponse.forEach(element => this.mainVisualImages.push(element));
    this.$data.mock.ImageApiResponse.forEach(element => this.images.push(element));
  },

  computed: {
    // app.jsのUserAPIレスポンスを取りに行く。
    players() {
      return this.$root.users.players;
    },

    // 4年生の部員を返す。
    highestGradePlayer() {
      return this.players.filter(el => el.grade === 4);
    },

    playersNumberTable() {
      const tableTitle = this.$data.messages.tableTitle.memberNumber;
      let tableBodies = [
        this.createTableBody('4年生', `${this.eachGradeNumber(4)}名`),
        this.createTableBody('3年生', `${this.eachGradeNumber(3)}名`),
        this.createTableBody('2年生', `${this.eachGradeNumber(2)}名`),
        this.createTableBody('1年生', `${this.eachGradeNumber(1)}名`),
      ];
      return this.createTableData(tableTitle, tableBodies);
    },

    /**
     * swiperのオプションを返す。
     * @return swiper option
     */
    playerSliderOptions() {
      return viewData.playerSliderOptions;
    },
  },

  methods: {
    /**
     * 学年毎の部員数を返す。
     * @param {Number} num 検索したい学年
     * @return {Number} 引数に指定した学年に一致する配列の要素数
     */
    eachGradeNumber(num) {
      return this.players.filter(el => el.grade === num).length;
    },

    /**
     * モーダル開閉処理。
     */
    openCardModal(el, tags) {
      this.card.modal.isShow = true;
      this.card.modal.el = el;
      this.card.modal.tags = tags;
      document.body.classList.add("modal-open");
    },
    closeCardModal() {
      this.card.modal.isShow = false;
      document.body.classList.remove("modal-open");
    },
  },
}

/**
 * test api response : メインビジュアル画像
 */
const mainVisualApiResponse = [
  {
    id      : 1,
    src     : 'player41.jpg',
    alt     : 'altテキストを入れます',
    caption : '感謝と謙虚な心を忘れずに、日本一。',
  },
  {
    id      : 2,
    src     : 'training01.jpg',
    alt     : 'altテキストを入れます',
    caption : 'テキストは AMAZON EC2 を使用します。',
  },
  {
    id      : 3,
    src     : 'player43.jpg',
    alt     : 'altテキストを入れます',
    caption : 'テキストは AMAZON EC2 を使用します。',
  },
];
</script>

<style lang="scss" scoped>
.club {
  &__mainVisualSlider {
    width: 100%;
    height: 100vh;
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

.practice {
  &__map {
    padding-top: interval(5);

    & > iframe {
      width: 100%;
      height: interval(40);
    }
  }

  &__map-text {
    margin: interval(1) auto 0 auto;
    display: block;
    width: 80%;
    text-align: center;
    font-size: font(10);
    font-weight: normal;
    letter-spacing: 1.5px;

    @include mq(md) {
      text-align: end;
      width: 100%;
      padding: 0 interval(1);
    }
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
        padding-right: interval(3);
      }
    }

    &-inner {
      width: 100%;
      margin: 0 auto interval(2) auto;
      padding: interval(1) 0;
      @include flex($align-items: center);

      &:last-child {
        margin-bottom: 0;
      }
    }

    &-icon-wrap {
      @include flex(row nowrap, center, center);
      border: 2px solid color(darkblue);
      border-radius: radius(circle);
      padding: interval(1.5);
    }

    &-icon {
      width: interval(3);
      fill: color(lightDarkblue);
    }

    &-text-wrap {
      margin-left: interval(1);
    }

    &-text {
      font-size: font(12);
      font-weight: bold;
      line-height: 1.5;
    }

    &-supplement {
      margin-top: interval(0.5);
      @include flex(row wrap);
      gap: interval(.5);

      &-text {
        padding: interval(.5) interval(1);
        background-color: color(lightgray);
        border-radius: 1000px;
      }
    }
  }

  &__slider {
    @extend %slider;
  }

  &__caption {
    font-size: font(16);
  }

  &__caption-sub {
    font-size: font(10);
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
