<template>
  <div class="top">
    <main-visual-component/>

    <section class="top__news">
      <news-component/>
    </section>

    <section class="top__team section-container">
      <figure class="top__team-img">
        <img src="/image/group-photo_toutoSpring2017.jpg" alt="2017年東都春季リーグ戦の集合写真">
      </figure>
      <lead-text-component
        class="top__team-contentsCard"
        title="team"
        subTitle="チーム紹介"
        buttonName="メンバーを見る"
        :contentsText="messages.Top.TeamDescription"/>
    </section>

    <section class="top__hakumonkai section-container">
      <figure class="top__team-img">
        <img src="/image/hakumon.jpg" alt="中央大学多摩キャンパス白門の画像">
      </figure>
      <lead-text-component
        class="top__hakumonkai-contentsCard"
        title="hakumonkai"
        subTitle="白門会"
        buttonName="白門会を知る"
        :contentsText="messages.Top.HakumonkaiDescription"/>
    </section>

    <section class="top__menuPanel section-container">
      <menu-panel-component
        class="top__menuPanel-item"
        v-for="menuPanel in menuPanels"
        :key="menuPanel.panelImageUrl"
        :panelImageUrl="menuPanel.panelImageUrl"
        :imageAlt="menuPanel.imageAlt"
        :buttonName="menuPanel.buttonName"
        :buttonSize="menuPanel.buttonSize"/>
    </section>

    <div class="background-image">
      <div class="background-darkblue">
        <section class="top__support section-container">
          <contents-title-component title="support" subTitle="サポート" color="white"/>
          <div class="top__support-textaria">
            <p class="nl2br" v-text="messages.Top.Support"/>
          </div>
        </section>
      </div>
    </div>

  </div>
</template>

<script>
// component import
import MainVisualComponent from '../components/contents/MainVisualComponent';
import NewsComponent from '../components/contents/NewsComponent.vue';
import LeadTextComponent from '../components/contents/LeadTextComponent';
import MenuPanelComponent from '../components/modules/MenuPanelComponent.vue';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent.vue';

export default {
  components: {
    MainVisualComponent,
    NewsComponent,
    LeadTextComponent,
    MenuPanelComponent,
    ContentsTitleComponent,
  },
  data() {
    return {
      // メニューパネルコンポーネントのデータを定義
      menuPanels: [
        {
          buttonName: '大会結果',
          buttonSize: 'xs',
          panelImageUrl: '/image/awards-kantoOpen.jpg',
          imageAlt: '関東オープン表彰写真',
        },
        {
          buttonName: '活動詳細',
          buttonSize: 'xs',
          panelImageUrl: '/image/tennis_court-in_chuoUniv-02.jpg',
          imageAlt: '中央大学ソフトテニスコートの写真',
        },
        {
          buttonName: 'フォトギャラリー',
          buttonSize: 'xs',
          panelImageUrl: '/image/group-photo_spring2019.jpg',
          imageAlt: '春リーグ宿舎での集合写真',
        }
      ]
    }
  },
}
</script>

<style lang="scss" scoped>
.top {
  position: relative;

  &__news {
    transform: translateY(-50px);
    max-width: 800px;
    margin: 0 auto;

    // pc style
    @include mq(md) {
      transform: none;
      margin-top: interval(15);
      margin-bottom: interval(10);
    };
  }

  &__team {

    // pc style
    @include mq(md) {
      position: relative;
      @include flex();
    };

    &-img {
      width: 100%;
      border-top: 5px solid color(darkblue);
      border-bottom: 5px solid color(darkblue);
      box-shadow: 0px -5px 8px 3px color(shadow);
      // @include imageFlame;
      @include trimming(aspect(golden));

      // pc style
      @include mq(md) {
        width: 70%;
      };
    }

    &-contentsCard {
      transform: translateY(-50px);

      // pc style
      @include mq(md) {
        position: absolute;
        top: 50%;
        right: 0;
      };
    }
  }

  &__hakumonkai {

    // pc style
    @include mq(md) {
      position: relative;
      margin-top: interval(40);
      @include flex(
        $flow: row-reverse nowrap
      );
    }

    &-img {
      width: 100%;
      border-top: 5px solid color(darkblue);
      border-bottom: 5px solid color(darkblue);
      box-shadow: 0px -5px 8px 3px color(shadow);
      // @include imageFlame;
      @include trimming(aspect(golden));

      // pc style
      @include mq(md) {
        width: 70%;
      };
    }

    &-contentsCard {
      transform: translateY(-50px);

      // pc style
      @include mq(md) {
        position: absolute;
        top: 50%;
        left: 0;
      };
    }
  }

  &__menuPanel {

    // pc style
    @include mq(md) {
      @include flex($justify-content: center);
      margin-top: interval(40);
    };

    &-item {
      max-width: 500px;
      margin: 0 auto;

      // tablet style
      @include mq(sm) {
        width: 70%;
      };

      // pc style
      @include mq(md) {
        padding: interval(0.5);
        max-width: 340px;
      };
    }
  }

  &__support {
    width: 100%;
    height: 100%;
    color: color(white);
    @include flex(column nowrap, center, center);

    &-textaria {
      width: 80%;
      margin: 0 auto;

      // tablet style
      @include mq(sm) {
        width: 70%;
      };

      // pc style
      @include mq(md) {
        width: 60%;
      };
    }
  }

  .background-image {
    width: 100%;
    height: 100vh;
    @include background-image(
      $url: "/image/player09.jpg",
      $position: center center
    );

    // tablet style
    @include mq(sm) {
      @include background-image(
      $url: "/image/player11.jpg",
      $position: center center
      );
    };
  }

  .background-darkblue {
    width: 100%;
    height: 100%;
    background-color: rgba($color: color(darkblue), $alpha: .8);
  }
}
</style>
