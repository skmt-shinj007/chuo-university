<template>
  <div class="home">
    <main-visual-component/>

    <section class="home__news">
      <news-component/>
    </section>

    <section class="home__team">
      <figure class="home__section-img">
        <img src="/image/group-photo_toutoSpring2017.jpg" alt="2017年東都春季リーグ戦の集合写真">
      </figure>

      <div class="home__team-lead">
        <text-card-component
        :titles="messages.SectionTitles.Team"
        :buttonName="messages.ButtonName.Member"
        :contentsText="messages.Home.TeamDescription"/>
      </div>
    </section>

    <section class="home__hakumonkai">
      <figure class="home__section-img">
        <img src="/image/hakumon.jpg" alt="中央大学多摩キャンパス白門の画像">
      </figure>

      <div class="home__hakumonkai-lead">
        <text-card-component
        :titles="messages.SectionTitles.Hakumonkai"
        :buttonName="messages.ButtonName.Hakumonkai"
        :contentsText="messages.Home.HakumonkaiDescription"/>
      </div>
    </section>

    <section class="home__menuPanel">
      <!-- TODO:コンポーネントを v-for しない -->
      <!-- TODO:data.jsonからオブジェクトを引っ張る -->
      <menu-panel-component
        class="home__menuPanel-item"
        v-for="(menuPanelItem, n) in menuPanels"
        :key="n"
        :menuPanelData="menuPanelItem"/>
    </section>

    <div class="background-image">
      <div class="background-darkblue">
        <section class="home__support">
          <contents-title-component
            :title="messages.SectionTitles.Support.Main"
            :subTitle="messages.SectionTitles.Support.Sub"
            color="white"/>

          <div class="home__support-textaria">
            <p class="nl2br" v-text="messages.Home.Support"/>
          </div>
        </section>
      </div>
    </div>

  </div>
</template>

<script>
// component import
import Data from '../config/data.json';
import MainVisualComponent from '../components/contents/MainVisualComponent';
import NewsComponent from '../components/contents/NewsComponent';
import MenuPanelComponent from '../components/modules/MenuPanelComponent';
import ContentsTitleComponent from '../components/modules/ContentsTitleComponent';
import TextCardComponent from '../components/modules/card/TextCardComponent';

export default {
  components: {
    MainVisualComponent,
    NewsComponent,
    MenuPanelComponent,
    ContentsTitleComponent,
    TextCardComponent,
  },
  data() {
    return {
      data: Data,
      menuPanels: [],
    }
  },
  beforeMount() {
    this.$data.data.MenuPanels.forEach(element => this.menuPanels.push(element));
  },
}
</script>

<style lang="scss" scoped>
// team & hakumonkai セクションの共通スタイルを定義
%text-card {
  width: 90%;
  max-width: interval(100);
  margin: 0 auto;
  transform: translateY(-50px);

  // pc style
  @include mq(md) {
    width: 60%;
    position: absolute;
    top: 50%;
  };
}

.home {
  position: relative;

  &__news {
    transform: translateY(-50px);
    max-width: interval(100);
    margin: 0 auto interval(10) auto;
  }

  &__team {

    // pc style
    @include mq(md) {
      position: relative;
      @include flex();
    };
  }

  &__team-lead {
    @extend %text-card;
    @include mq(md) {
      right: interval(2);
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
  }

  &__hakumonkai-lead {
    @extend %text-card;
    @include mq(md) {
      left: interval(2);
    }
  }

  &__section-img {
    width: 100%;
    border-top: 5px solid color(darkblue);
    border-bottom: 5px solid color(darkblue);
    box-shadow: 0px -5px 8px 3px color(shadow);
    @include trimming(aspect(golden));

    // pc style
    @include mq(md) {
      width: 70%;
    };
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
