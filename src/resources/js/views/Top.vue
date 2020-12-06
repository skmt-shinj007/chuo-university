<template>
  <div class="l-top">
    <main-visual-component/>

    <section class="l-top__news">
      <news-component/>
    </section>

    <section class="l-top__team section-container">
      <div class="l-top__backgroundImage l-top__team-background"/>
      <lead-text-component
        class="l-top__team-contentsCard"
        title="team"
        subTitle="チーム紹介"
        buttonName="メンバーを見る"
        :contentsText="messages.TeamDescription"/>
    </section>

    <section class="l-top__hakumonkai section-container">
      <div class="l-top__backgroundImage l-top__hakumonkai-background"/>
      <lead-text-component
        class="l-top__hakumonkai-contentsCard"
        title="hakumonkai"
        subTitle="白門会"
        buttonName="白門会を知る"
        :contentsText="messages.HakumonkaiDescription"/>
    </section>

    <section class="l-top__menuPanel section-container">
      <menu-panel-component
        class="l-top__menuPanel-item"
        v-for="menuPanel in menuPanels"
        :key="menuPanel.panelImageUrl"
        :panelImageUrl="menuPanel.panelImageUrl"
        :imageAlt="menuPanel.imageAlt"
        :buttonName="menuPanel.buttonName"
        :buttonSize="menuPanel.buttonSize"/>
    </section>

    <section class="l-top__support section-container">
      <div class="l-top__support-background">
        <contents-title-component title="support" subTitle="サポート" color="white"/>
        <div class="l-top__support-textaria">
          <p>{{ messages.Support }}</p>
        </div>
      </div>
    </section>

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
.l-top {
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
      padding-bottom: interval(20);
      @include flex();
    };

    &-background {
      @include background-image(
        $url: "/image/group-photo_toutoSpring2017.jpg",
        $position: center center
      );
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
      padding-bottom: interval(20);
      @include flex(
        $flow: row-reverse nowrap
      );
    }

    &-background {
      @include background-image(
        $url: "/image/hakumon.jpg",
        $position: center center
      );
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

  &__backgroundImage {
    width: 100%;
    height: 300px;
    border-top: 5px solid color(darkblue);
    border-bottom: 5px solid color(darkblue);
    box-shadow: 0px -5px 8px 3px color(shadow);
    // @include imageFlame;

    // tablet style
    @include mq(sm) {
      height: 500px;
    }

    // pc style
    @include mq(md) {
      width: 70%;
    };
  }

  &__menuPanel {

    // pc style
    @include mq(md) {
      @include flex($justify-content: center);
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
    height: 100vh;
    color: color(white);
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

    &-background {
      width: 100%;
      height: 100%;
      background-color: rgba($color: color(darkblue), $alpha: .8);
      @include flex(
        $flow: column nowrap,
        $justify-content: center,
        $align-items: center
      );
    }

    &-textaria {
      width: 80%;
      margin: interval(5) auto 0 auto;

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
}
</style>
