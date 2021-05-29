<template>
<div class="hakumonkai">
  <section class="hakumonkai__header">
    <contents-title :title="messages.SectionTitles.Hakumonkai"/>
    <div class="lead__text-wrap">
      <p class="lead__text nl2br" v-text="messages.Hakumonkai.Lead"></p>
    </div>
  </section>

  <div class="background-prlx" v-prlx.background="{ speed: 0.3 }"/>

  <section class="hakumonkai__officer" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Officer"/>
    <tile-table :tableItemHeading="tableHeading" :tableItems="officer"/>
  </section>

  <section class="hakumonkai__active fade" v-scroll="fade">
    <contents-title :title="messages.SectionTitles.ActiveAlumni"/>
    <player-slider :players="activeAlumni" color="darkblue" :option="swiperOptions"/>
  </section>

  <section class="hakumonkai__message" v-fade:[dir.up]>
    <contents-title :title="messages.SectionTitles.Message"/>
    <div class="message__content">
      <p class="message__text nl2br" v-text="messages.Hakumonkai.Message"/>
    </div>
    <div class="message__button">
      <link-button :link="messages.Links.ToContact"/>
    </div>
  </section>

  <div class="hakumonkai__scroll-top">
    <scroll-top-button/>
  </div>
</div>
</template>

<script>
// components import
import ContentsTitle from '../components/modules/ContentsTitleComponent';
import TileTable from '../components/modules/table/TileTableComponent';
import PlayerCard from '../components/modules/card/PlayerCardComponent';
import LinkButton from '../components/modules/button/LinkButtonComponent';
import PlayerSlider from '../components/modules/slider/PlayerSliderComponent';
import ScrollTopButton from '../components/modules/button/ScrollTopButtonComponent';

// config
import Animation from '../config/animation';
import Mock from '../config/data/mock.json';
import Api from '../config/api/index';

export default {
  components: {
    ContentsTitle,
    TileTable,
    PlayerCard,
    LinkButton,
    PlayerSlider,
    ScrollTopButton,
  },

  mixins: [Animation],

  data() {
    return {
      mock: Mock,
      tableHeading: [],
      officer: [],
      activeAlumni: [],
    }
  },

  created() {
    this.setActiveAlumni();
  },

  beforeMount() {
    // 役員テーブルの [見出し] 配列を取得
    this.$data.messages.Hakumonkai.OfficerTable.Heading.forEach(element => this.tableHeading.push(element));

    // ユーザーカテゴリーで [役職OB] を抽出
    this.$data.mock.Users.forEach(element => {
      (element.category === this.officerNum) ? this.officer.push(element) : null;
    });
  },

  computed: {
    swiperOptions() {
      return {
        speed: 1000,
        autoHeight: true,
        spaceBetween: 16,

        autoplay: {
          delay: 2500,
        },

        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },

        pagination: {
          el: '.swiper-pagination',
          clickable: true,
          type: 'bullets',
        },

        breakpoints: {
          560: {
            slidesPerView: 2,
            slidesPerGroup: 1,
          },
          860: {
            slidesPerView: 3,
            slidesPerGroup: 1,
          }
        },
      }
    }
  },

  methods: {
    /**
     * ユーザー取得
     */
    async setActiveAlumni() {
      const response = await Api.getResponse('/active_ob');
      (this.getType(response.data) === 'array') ? this.activeAlumni = response.data : new Error('player:レスポンスが配列ではありません。');
    },
  },
}
</script>

<style lang="scss" scoped>
.hakumonkai {

  &__header {
    margin-top: interval(5);
  }

  &__officer {
    margin-top: interval(5);
  }

  &__players {
    @include flex(column wrap, center, center);

    @include mq(sm) {
      @include flex(row nowrap, flex-start, stretch);
    }
  }

  &__scroll-top {
    @include scroll-top();
  }
}

.background-prlx {
  @include background-image('/image/hakumon03.jpg', center top);
  width: 100%;
  height: interval(30);
}

.lead {
  &__text-wrap {
    margin-bottom: interval(5);

    @include mq(sm) {
      margin: 0 auto interval(5) auto;
    }
  }

  &__text {
    font-weight: bold;
    text-align: center;

    @include mq(sm) {
      max-width: interval(80);
      margin: 0 auto;
    }
  }
}

.message {
  &__content {
    margin-bottom: interval(5);
  }

  &__text {
    text-align: center;
    font-weight: bold;
  }

  &__button {
    @include mq(sm) {
      max-width: interval(50);
      margin: 0 auto;
    }
  }
}
</style>
